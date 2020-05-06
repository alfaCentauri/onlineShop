<?php
/**
 * Copyright (C) 2019 Ingeniero en Computación: Ricardo Presilla.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Controllers;

use Models\Users as Users;
use Models\Product as Product;
use Models\Conection as Conection;
use Models\Qualification as Qualification;
use Repository\UsersRepository as UserRepository;
use Repository\ProductRepository as ProductRepository;
use Repository\QualificationRepository as QualificationRepository;
/**
 * This is the driver to add, edit, display and delete points of a product. Use 
 * Json files to send and receive the data.
 *
 * @package Controllers.
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.1.
 */
class qualificationController implements Crud
{
    /**
     * Contains a object of type Users.
     * @var Users
     **/
    private $user;
    /**
     * Contains a object of type Product.
     * @var Product
     */
    private $product;
    /**
     * Contains a object of type Qualificationes.
     * @var Qualification
     */
    private $qualification;
    /**
     * Contains the status of the request.
     */
    private $statusCode;
    /**
     * @var Conection
     */
    private $conection;
    private UserRepository $userRepository;
    private ProductRepository $productRepository;
    private QualificationRepository $qualificationRepository;
    /**
     * Qualification constructor.
     */
    public function __construct()
    {
        $this->conection = new Conection();
        $this->user = new Users();
        $this->userRepository = new UserRepository($this->user);
        $this->userRepository->setConection($this->conection);
        
        $this->product = new Product();
        $this->productRepository = new ProductRepository($this->product);
        $this->productRepository->setConection($this->conection);
        
        $this->qualification = new Qualification();
        $this->qualificationRepository = new QualificationRepository($this->qualification);
        $this->qualificationRepository->setConection($this->conection);
        
        $this->statusCode = 400;
    }
    
    /**
     * Displays a list of all averages.
     */
    public function index()
    {
        $data = $this->qualificationRepository->listAverage();
        return $data;
    }
    
    /**
     * Add a score to a product. Receive the data through a JSON and the post method.
     *
     */
    public function add()
    {
        $url = getcwd();
        $arrayResult = array();
        $dataJson = getFileJSon();
        if(isValidJSon($dataJson)) 
        {
            $id = appendQualification($dataJson);
            $arrayResult[] = setStatusCode($id);           
        }
        else
        {
            notAcceptable();
        }
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    
    /**
     * @return array Return array with data of json.
     */
    private function getFileJSon(String $nameFile = "qualification.json"): array
    {
        $content = file_get_contents(URL.'Views/Templates/files/' . $nameFile);
        $dataJson = json_decode($content, true);
        return $dataJson;
    }
    
    /**
     * @param array $dataJson Array of data.
     * @return bool Return a true if the data is valid else return false.
     */
    private function isValidJSon($dataJson): bool
    {
        if(isset($dataJson))
            if($dataJson['idUser'] > 0 && $dataJson['idProduct'] > 0 && $dataJson['points'] > 0)
                return true;
                
        return false;
    }
    
    /**
     * @param array $dataJson Array of data.
     * @return int Return a Integer with the index.
     */
    private function appendQualification($dataJson): int
    {
        $this->qualification->setIdUser($dataJson['idUser']);
        $this->qualification->setIdProduct($dataJson['idProduct']);
        $this->qualification->setPoints($dataJson['points']);
        return $this->qualificationRepository->add();
    }
    
    /**
     * @param int $id Index.
     * @return array Return array for create json message.
     */
    private function setStatusCode(int $id = 0): array
    {
        $arrayResult = array();
        if ($id > 0) 
        {
            $this->statusCode = 201;
            $arrayResult['id'] = $id;
            $arrayResult['message'] = "Data saved.";
        } 
        else 
        {
            $this->statusCode = 409;
            $arrayResult['message'] = "Error saving the score.";
        } 
        return $arrayResult;
    }

    /**
     * Shows a product qualification made by a user.
     *
     * @param int $id   Qualification index.
     */
    public function view(int $id = 0)
    {
        $url = getcwd();
        $arrayResult = array();
        if ($id > 0)
        {
            $arrayResult = findQualificationAndStatusCode($id);
        }
        else
        {
            notAcceptable();
        }
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    
    /** 
     * Find the qualification for a index, return array data with qualification
     * and set status code.
     *
     * @param int $id   Qualification index.
     * @return array Return at array.
    */
    private function findQualificationAndStatusCode(int $id): array
    {
        $arrayResult = array();
        $this->qualification = $this->qualificationRepository->find($id);
        $arrayResult = getQualificationAndStatusCode();
        return $arrayResult;
    }
    
    /** 
     * Get the qualification, return array data with qualification and set 
     * status code.
     * 
     * @return array Return at array.
    */
    private function getQualificationAndStatusCode(): array
    {
        $arrayResult = array();
        if (isset($this->qualification))
        {
            $this->statusCode = 200;
            $arrayResult['id'] = $this->qualification->getId();
            $arrayResult['idUser'] = $this->qualification->getIdUser();
            $arrayResult['idProduct'] = $this->qualification->getIdProduct();
            $arrayResult['points'] = $this->qualification->getPoints();
            $arrayResult['creationDate'] = 
                $this->qualification->getCreationDate();
        }
        else 
        {
            $this->statusCode = 500;
            $arrayResult['message'] = "Error on server.";
        }
        return $arrayResult;
    }
    
    /**
     * Shows an average for the indicated product index.
     * @param int $idProduct   Product index.
     */
    public function view_average_product(int $idProduct = 0)
    {
        $url = getcwd();
        $arrayResult = array();
        if ($idProduct > 0)
        {
            $arrayResult = findQualificationForAProductAndStatusCode($idProduct);                
        }
        else
        {
            $this->statusCode = 500;
            $arrayResult['message'] = "Error on server.";
        }
        file_put_contents($url.'/Views/Templates/files/resultAverage.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    
    private function findQualificationForAProductAndStatusCode(int $idProduct = 0): array
    {
        $this->qualification->setIdProduct($idProduct);
        $this->qualification = $this->qualificationRepository->findAverage();
        $dataAverage = getQualificationAndStatusCode();
        return $dataAverage;
    }
    
    /**
     * Edit a register.
     * @param int $idQualification Qualification index.
     */
    public function edit(int $idQualification = 0)
    {
        $url = getcwd();
        $arrayResult = array();
        if ($idQualification > 0)
        {   
            $dataJson = getFileJSon("points.json");
            if(isValidJSon($dataJson)) 
            {
                $arrayResult = updateQualification($dataJson, $idQualification); 
                $arrayResult[] = setStatusCode($idQualification);
            }            
        }
        else
        {
            notAcceptable();
        }
        file_put_contents($url.'/Views/Templates/files/resultEdit.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    
    /**
     * @param array $dataJson Array of data.
     * @return int Return a Integer with the index.
     */
    private function updateQualification($dataJson, int $idQualification): int
    {
        $this->qualification->setId($idQualification);
        $this->qualification->setIdUser($dataJson['idUser']);
        $this->qualification->setIdProduct($dataJson['idProduct']);
        $this->qualification->setPoints($dataJson['points']);
        return $this->qualificationRepository->update();
    }
    
    /**
     * Remove a register.
     * @param int $idQualification   Qualification index.
     */
    public function remove(int $idQualification = 0)
    {
        $url = getcwd();
        $arrayResult = array();
        if ($idQualification>0)
        {
            $this->qualification->setId($idQualification);
            $this->qualificationRepository->delete();
            
            $this->statusCode = 200;
            $arrayResult['message']= "Delete";
        }
        else
        {
            notAcceptable();
        }
        file_put_contents($url.'/Views/Templates/files/resultDelete.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    
    /**
     * Message of error.
     */
    private function notAcceptable(): void
    {
        $this->statusCode = 406;
        $arrayResult['message'] = "Not Acceptable.";
    }
}
