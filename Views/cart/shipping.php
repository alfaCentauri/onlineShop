<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla.
 * Date: 6/5/2019
 * Time: 7:25 PM
 */
$subtotal=0;
$idCart = 0;
$idU = 1;
    ?>
<!DOCTYPE html>
<!--
Copyright (C) 2019 Ingeniero en Computación: Ricardo Presilla.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Object-Oriented PHP: Online Shop Demo</title>
        <!-- Styles CSS -->
        <link rel="stylesheet" href="<?php echo URL?>Views/Templates/css/styles.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo URL?>Views/Templates/css/bootstrap.min.css" >
        <script src="<?php echo URL?>Views/Templates/js/jquery-3.3.1.slim.min.js" ></script>
        <script src="<?php echo URL?>Views/Templates/js/popper.min.js" ></script>
        <script src="<?php echo URL?>Views/Templates/js/bootstrap.min.js" ></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="<?php echo URL; ?>">Product manager</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars01" aria-controls="navbars01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbars01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL; ?>index.php?url=cart/">Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Shipping</h3>
                </div>
            </div>
            <?php
            if (isset($data)) {
                while ($row = mysqli_fetch_array($data)) {
                    $idCart= $row['id'];
                    $idU = $row['idUser'];
                    $subtotal = $row['totalPrice'] + $subtotal;

                }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header bg-success">Shipping information


                        </div>
                        <div class="card-body">
                            <form action="" id="formShipping" name="formShipping" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-4 col-md-3 col-lg-3">
                                        <label for="shipping" class="">Shipping option:</label>
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1">
                                        <input id="shipping" name="shipping" value="0" class="form-control" type="radio"
                                               onclick="Activate(this);">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        Pick up
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1">
                                        <input id="shipping" name="shipping" value="5" class="form-control" type="radio"
                                               onclick="Activate(this);">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        UPS
                                    </div>
                                    <div class="col-sm-2 col-md-3 col-lg-3">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <label for="direction" class="">Direction of shipping:</label>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <input type="text" class="form-control" id="direction" name="direction" value=""
                                               placeholder="Write a direction of shipping" readonly>
                                    </div>
                                    <div class="hidden-sm col-md-3 col-lg-3"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="hidden-sm col-md-6 col-lg-6"></div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <strong>Shipping costs: </strong>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <div class="price" id="priceShipping">0 $</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="hidden-sm col-md-6 col-lg-6"></div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <strong>Subtotal to pay: </strong>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <div class="price" id="subtotal">
                                            <?php echo $subtotal.' $'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="hidden-sm col-md-6 col-lg-6"></div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <strong>Total to pay: </strong>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <div class="price" id="total"><?php echo $subtotal; ?> $</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-md-2"></div>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="submit" id="accept" name="accept" value="Accept" class="btn btn-success btn-block" >
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <a href="<?php echo URL; ?>index.php?url=cart/toListUser/1/1" class="btn btn-warning btn-block">Cancel</a>
                                    </div>
                                    <div class="col-sm-2 col-md-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            else{
                echo 'Error';
            }
            ?>
        </div>
<script>
    var currentValue = 0;
    /**Activate the address field.*/
    function Activate(myRadio)
    {
        currentValue = myRadio.value;
        if(currentValue == 5)
        {
            document.getElementById('direction').removeAttribute('readonly'); 
            document.getElementById('direction').setAttribute('required',true);
            document.getElementById('direction').setAttribute('min',3);
            document.getElementById('priceShipping').innerText='5 $';
        }
        else
        {
           document.getElementById('direction').value='Pick up';
           document.getElementById('direction').setAttribute('readonly',true);
           document.getElementById('direction').removeAttribute('required');
           document.getElementById('direction').removeAttribute('min');
           document.getElementById('priceShipping').innerText='0 $';
        }
        var subtotal = <?php echo $subtotal;?>;
        var total = parseFloat(currentValue) + parseFloat(subtotal);
        document.getElementById('total').innerText=total.toFixed(2)+' $';
    }
</script>
        <footer>
            <div class="text-center foot">Developed by Ing. Ricardo Presilla. &copy; 2019</div>
        </footer>
    </body>
</html>