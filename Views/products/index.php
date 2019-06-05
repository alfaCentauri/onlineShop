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
            <h3 class="text-center">Products list</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-success">Products list</div>
                <div class="card-body">
                    <table border="1" class="table table-striped table-hover">
                        <thead>
                            <tr class="table-primary">
                                <th>Image</th>
                                <th>Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Avg.</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
            <?php 
                while ($row = mysqli_fetch_array($data)){
            ?>
                            <tr>
                                <td>
                                    <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $row["image"];?>" 
                                         width="60px" height="60px" alt="Picture" 
                                         class="img-fluid"/>
                                </td>
                                <td>
                                    <a href="<?php echo URL; ?>index.php?url=products/view/<?php echo $row['id']; ?>"><?php echo $row["name"];?></a>
                                </td>
                                <td class="text-right"><?php echo $row["price"];?></td>
                                <td class="text-center"><?php echo '*'?></td>
                                <td class="text-center">
                                    <a href="<?php echo URL; ?>index.php?url=products/edit/<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="<?php echo URL; ?>index.php?url=products/remove/<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" >
                                        Delete
                                    </a>
                                    <a href="<?php echo URL; ?>index.php?url=cart/preview/<?php echo $row['id']; ?>" class="btn btn-success btn-sm" >
                                        Add to cart
                                    </a>
                                </td>
                            </tr>
            <?php 
                }
            ?>                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
        
