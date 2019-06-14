<?php
/*
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

use Models\Product as Product;
use Models\Users as Users;
use Models\Qualification as Qualificationes;
/**
 * This is the driver to add, edit, display and delete points of a product. Use 
 * Json files to send and receive the data.
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
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
     * @var Qualificationes
     */
    private $qualification;
    /**
     * Contains the status of the request.
     */
    private $statusCode;
    /**
     * Qualification constructor.
     */
    public function __construct()
    {
        $this->user = new Users();
        $this->product = new Product();
        $this->qualification = new Qualificationes();
        $this->statusCode = 400;
    }
    /**
     * Displays a list of all averages.
     */
    public function index()
    {
        $data = $this->qualification->listAverage();
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
        $content = file_get_contents(URL.'Views/Templates/files/qualification.json');
        $dataJson = json_decode($content, true);
        if(isset($dataJson))
        {
            if ($dataJson['idUser']>0 && $dataJson['idProduct']>0 && $dataJson['points']>0) {
                $this->qualification->setIdUser($dataJson['idUser']);
                $this->qualification->setIdProduct($dataJson['idProduct']);
                $this->qualification->setPoints($dataJson['points']);
                $id = $this->qualification->add();
                if ($id > 0) {
                    $this->statusCode = 201;
                    $arrayResult['id'] = $id;
                } else {
                    $this->statusCode = 409;
                    $arrayResult['error'] = "Error saving the score.";
                }
            }
            else
            {
                $this->statusCode = 406;
                $arrayResult['error']="Not Acceptable.";
            }
        }
        else
        {
            $this->statusCode = 400;
            $arrayResult['error']="Request error.";
        }
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }

    /**
     * Shows a product qualification made by a user.
     * @param int $id   Qualification index.
     */
    public function view(int $id = 0)
    {
        $url = getcwd();
        if ($id>0)
        {
            $this->qualification->setId($id);
            $dataQualification = $this->qualification->view();
            if (isset($dataQualification))
                file_put_contents($url.'/Views/Templates/files/result.json',json_encode($dataQualification));
            else {
                http_response_code(500);
                return;
            }
        }
        else
        {
            http_response_code(500);
            return;
        }
        header("Location: ".URL."index.php?url=products");
    }
    /**
     * Shows an average for the indicated product index.
     * @param int $idProduct   Product index.
     */
    public function view_average_product(int $idProduct = 0)
    {
        $url = getcwd();
        if ($idProduct>0)
        {
            $this->qualification->setIdProduct($idProduct);
            $dataAverage = $this->qualification->findAverage();
            if (isset($dataAverage))
                file_put_contents($url.'/Views/Templates/files/resultAverage.json',json_encode($dataAverage));
            else {
                http_response_code(500);
                return;
            }
        }
        else
        {
            http_response_code(500);
            return;
        }
        header("Location: ".URL."index.php?url=products");
    }
    /**
     * Edit a register.
     * @param int $idQualification   Qualification index.
     */
    public function edit(int $idQualification = 0)
    {
        $url = getcwd();
        if ($idQualification>0)
        {
            $this->qualification->setId($idQualification);
            $content = file_get_contents(URL.'Views/Templates/files/points.json');
            $dataJson = json_decode($content, true);
            if ($dataJson['idUser']>0 && $dataJson['idProduct']>0 && $dataJson['points']>0)
            {
                $this->qualification->setIdUser($dataJson['idUser']);
                $this->qualification->setIdProduct($dataJson['idProduct']);
                $this->qualification->setPoints($dataJson['points']);
                $this->qualification->edit();
                $this->statusCode = 200;
                $arrayResult['id']=$idQualification;
            }
            else
            {
                $this->statusCode = 406;
                $arrayResult['error']="Not Acceptable.";
            }
        }
        else
        {
            $this->statusCode = 400;
            $arrayResult['error']="Request error.";
        }
        file_put_contents($url.'/Views/Templates/files/resultEdit.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
    /**
     * Remove a register.
     * @param int $idQualification   Qualification index.
     */
    public function remove(int $idQualification = 0)
    {
        $url = getcwd();
        if ($idQualification>0)
        {
            $this->qualification->setId($idQualification);
            $this->qualification->delete();
            // Response
            $this->statusCode = 200;
            $arrayResult['id']=$idQualification;
        }
        else
        {
            $this->statusCode = 400;
            $arrayResult['error']="Request error.";
        }
        file_put_contents($url.'/Views/Templates/files/resultDelete.json',json_encode($arrayResult));
        header("Location: ".URL."index.php?url=products");
    }
}