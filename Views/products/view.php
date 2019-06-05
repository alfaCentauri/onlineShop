<?php

/* 
 * Copyright (C) 2019 ricardo
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
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center">Product</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card mb-3">
                <div class="card-header bg-success">Product Details <?php echo $datos['name']; ?></div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $datos["image"];?>" alt="Picture" class="img-fluid"/>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <ul class="list-group mb-3">
                                  <li class="list-group-item"><strong>Product Name:</strong> <?php echo $datos['name']; ?></li>
                                  <li class="list-group-item"><strong>Price:</strong> <?php echo $datos['price']; ?></li>
                                  <li class="list-group-item"><strong>Stock:</strong> <?php echo $datos['stock']; ?></li>
                                  <li class="list-group-item"><strong>Creation date:</strong> <?php echo $datos["creatioDate"];?></li>
                                </ul>
                                <div class="row">
                                    <div class="col-sm-4 col-md-4"></div>
                                    <div class="col-sm-4 col-md-4">
                                        <a href="index.php?url=products" class="btn btn-info btn-block">Return</a>
                                    </div>
                                    <div class="col-sm-4 col-md-4"></div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
