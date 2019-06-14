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
        $node = array();
        if (isset($_POST['json']))
        {
            $content=$_POST['json'];
            $data = json_decode($content, true);
            if(isset($data))
            {
                if ($data['idUser']>0 && $data['idProduct']>0 && $data['points']>0)
                {
                    $this->qualification->setIdUser($data['idUser']);
                    $this->qualification->setIdProduct($data['idProduct']);
                    $this->qualification->setPoints($data['points']);
                    $id=$this->qualification->add();
                    if ($id>0)
                    {
                        $this->statusCode = 201;
                        $node['id']=$id;
                    }
                    else
                    {
                        $this->statusCode = 409;
                        $node['error']="Error saving the score.";
                    }
                }
                else
                {
                    $this->statusCode = 406;
                    $node['error']="Not Acceptable.";
                }
            }
            else
            {
                $this->statusCode = 400;
                $node['error']="Request error. :(";
            }
        }
        else
        {
            $this->statusCode = 400;
            $node['error']="Request error in method.";
        }
        // Response
        header('Content-Type', 'application/json', $this->statusCode);
        echo json_encode($node);
    }

    /**
     * Shows an average for the indicated product index.
     * @param int $id   Product index.
     */
    public function view(int $id = 0)
    {
        $url = getcwd();
        if ($id>0)
        {
            $this->qualification->setIdProduct($id);
            $data = $this->qualification->findAverage();
            if (isset($data))
                $this->statusCode = 200;
            else
                $this->statusCode = 500;
        }
        else
        {
            $this->statusCode = 400;
            $data['error']="Request error.";
        }
        // Response
        header('Content-Type', 'application/json', $this->statusCode);
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($data));
    }
    /**
     * @param int $id   Qualification index.
     */
    public function edit(int $id = 0)
    {
        $url = getcwd();
        if ($id>0)
        {
            $this->qualification->setId($id);
            $content = file_get_contents(URL.'Views/Templates/files/points.json');
            $data = json_decode($content, true);
            if ($data['idUser']>0 && $data['idProduct']>0 && $data['points']>0)
            {
                $this->qualification->setIdUser($data['idUser']);
                $this->qualification->setIdProduct($data['idProduct']);
                $this->qualification->setPoints($data['points']);
                $this->qualification->edit();
                $this->statusCode = 200;
                $node['id']=$id;
            }
            else
            {
                $this->statusCode = 406;
                $node['error']="Not Acceptable.";
            }
        }
        else
        {
            $this->statusCode = 400;
            $node['error']="Request error.";
        }
        // Response
        header('Content-Type', 'application/json', $this->statusCode);
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($node));
    }

    public function remove(int $id = 0)
    {
        $url = getcwd();
        if ($id>0)
        {
            $this->qualification->setId($id);
            $this->qualification->delete();
            // Response
            $this->statusCode = 200;
            $node['id']=$id;
        }
        else
        {
            $this->statusCode = 400;
            $node['error']="Request error.";
        }
        // Response
        header('Content-Type', 'application/json', $this->statusCode);
        file_put_contents($url.'/Views/Templates/files/result.json',json_encode($node));
    }
}