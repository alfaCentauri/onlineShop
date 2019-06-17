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
                    <h3 class="text-center">List of qualifications</h3>
                </div>
            </div>
            <?php
            if (isset($data))
            {
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header bg-success">List of qualifications</div>
                        <div class="card-body">
                            <table border="1" class="table table-striped table-hover">
                                <thead>
                                <tr class="table-primary">
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th class="text-center">Avg.</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td>
                                            <img src="<?php echo URL; ?>Views/Templates/images/products/<?php echo $row["image_product"];?>"
                                                 width="60px" height="60px" alt="Picture"
                                                 class="img-fluid"/>
                                        </td>
                                        <td>
                                            <?php echo $row["name_product"];?>
                                        </td>
                                        <td class="text-center"><?php echo $row['average'];?></td>
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
                <?php
            }
            else
            {
                ?>
                <h2 class="text-center">List of qualifications is empty</h2>
                <?php
            }
            ?>
        </div>
        <footer>
            <div class="text-center foot">Developed by Ing. Ricardo Presilla. &copy; 2019</div>
        </footer>
    </body>
</html>
