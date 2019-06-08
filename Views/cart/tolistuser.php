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
            <h3 class="text-center">User's cart history.</h3>
        </div>
    </div>
<?php
    if (isset($data))
    {
?>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-success">
                    My shopping carts:
                </div>
                <div class="card-body">
                    <table border="1" class="table table-striped table-hover">
                        <thead>
                        <tr class="table-primary">
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total Price $</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total = 0;
                        $idCart = 0;
                        $idU = 0;
                        $i=1;
                        while ($row = mysqli_fetch_array($data)){
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td>
                                    <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $row["image_product"];?>"
                                         width="60px" height="60px" alt="Picture"
                                         class="img-fluid"/>
                                </td>
                                <td>
                                    <?php echo $row["name_product"];?>
                                </td>
                                <td class="text-center"><?php echo $row['quantity']; ?></td>
                                <td class="text-right">
                                    <?php
                                    $idCart= $row['id'];
                                    $total = $row['totalPrice'] + $total;
                                    echo $row['totalPrice'];
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo URL; ?>index.php?url=cart/edit/<?php echo $row['id']; ?>" class="btn btn-warning">
                                        Edit
                                    </a>
                                    <a href="<?php echo URL; ?>index.php?url=cart/remove/<?php echo $row['id']; ?>" class="btn btn-danger" >
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- End card -->
        </div>
    </div>
    <div class="row"><!-- Row Total -->
        <div class="col-md-12">
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="hidden-sm col-md-6 col-lg-6"></div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <strong>Total to pay: </strong>
                            </div>
                            <div class="col-sm-6 col-md-3 col-lg-3">
                                <div class="price" id="total">
                                    <?php echo $total;?>$
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End card -->
        </div><!-- End col -->
    </div><!-- End row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-2 col-md-2 col-lg-2"></div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="<?php echo URL; ?>cart/shipping/<?php echo $idCart; ?>/<?php echo $idU; ?>" class="btn btn-success btn-block">Pay</a>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <a href="<?php echo URL; ?>products/" class="btn btn-info btn-block">Return</a>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2"></div>
                        </div>
                    </div>
                </div>
            </div><!-- End card -->
        </div><!-- End col -->
    </div><!-- End row -->
<?php
    }
    else
    {
        echo 'Error';
    }
?>
</div>
