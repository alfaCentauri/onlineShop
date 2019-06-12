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
                <div class="card-header bg-success">Edit to Cart the item #<?php echo $data['id']; ?></div>
                <div class="card-body">
                    <div class="container">
                        <form name="formCart" method="POST" action="<?php echo URL; ?>index.php?url=cart/edit/<?php echo $data['id']; ?>" >
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $data["image_product"];?>" alt="Picture" class="img-fluid"/>
                                </div>
                                <div class="col-sm-12 col-md-8 mb-3">
                                    <ul class="list-group mb-3">
                                        <li class="list-group-item"><strong>Product Name:</strong> <?php echo $data['name_product']; ?></li>
                                        <li class="list-group-item"><strong>Price:</strong> <?php echo $data['totalPrice']; ?></li>
                                        <li class="list-group-item"><strong>Product Stock:</strong> <?php echo $data['stock']; ?></li>
                                        <li class="list-group-item">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend"><span class="input-group-text">Quantity: </span></div>
                                                <input id="quantity" type="number" min="1" name="quantity" value="<?php echo $data['quantity']; ?>" placeholder="1" class="form-control" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Und.</span>
                                                </div>
                                            </div>
                                        </li>
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
