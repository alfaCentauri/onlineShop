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
    if (isset($_SESSION['idUser']) && isset($_SESSION['idCart']))
    {
        $idUser = $_SESSION['idUser'];
        $idCart = $_SESSION['idCart'];
    }
    else
    {
        $idUser = 1;    //Debug
        $idCart = 1;    //Debug
    }
?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Cart</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header bg-success">Add to Cart</div>
                        <div class="card-body">
                            <div class="container">
                                <form name="formCart" action="<?php echo URL; ?>index.php?url=cart/add/<?php echo $data['id']; ?>/<?php echo $idUser; ?>/<?php echo $idCart; ?>" method="POST">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $data["image"];?>" alt="Picture" class="img-fluid"/>
                                    </div>
                                    <div class="col-sm-12 col-md-8 mb-3">
                                        <ul class="list-group mb-3">
                                            <li class="list-group-item"><strong>Product Name:</strong> <?php echo $data['name']; ?></li>
                                            <li class="list-group-item"><strong>Price:</strong> <?php echo $data['price']; ?></li>
                                            <li class="list-group-item"><strong>Stock:</strong> <?php echo $data['stock']; ?></li>
                                            <li class="list-group-item">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend"><span class="input-group-text">Quantity: </span></div>
                                                    <input id="quantity" type="number" min="1" name="quantity" value="0" placeholder="1" class="form-control" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Und.</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item"><strong>Average:</strong> <?php echo $data["average"];?></li>
                                            <?php
                                            if ($data["points"]==0)
                                            {
                                            ?>
                                                <li class="list-group-item"><strong>Indicate you valuation:
                                                        <div class="input-group mb-3">
                                                            <input id="points" type="number" min="0" max="5" name="points"
                                                                   value="<?php echo $data["points"];?>"
                                                                   placeholder="Indicate you valuation" class="form-control" />
                                                            <div class="input-group-append">
                                                      <span class="input-group-text">
                                                          <img src="<?php echo URL; ?>Views/Templates/images/star.png" class="iconImage">
                                                      </span>
                                                            </div>
                                                        </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-md-2"></div>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="submit" id="accept" name="accept" value="Accept" class="btn btn-success btn-block">
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <a href="<?php echo URL; ?>index.php?url=cart/" class="btn btn-warning btn-block">Return</a>
                                    </div>
                                    <div class="col-sm-2 col-md-2"></div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
