<?php
    namespace Views;
    
/**
 * Description of templates
 *
 * @author Ingeniero en Computación: Ricardo Presilla.
 * @version 1.0.
 */
class Templates {
    /**Constructor*/
    function __construct() {
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
        <title>Object-Oriented PHP: Base project</title>
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
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
                  <div class="dropdown-menu" aria-labelledby="dropdown09">
                    <a class="dropdown-item" href="<?php echo URL; ?>products">List</a>
                    <a class="dropdown-item" href="<?php echo URL; ?>products/add">Add</a>
                  </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL; ?>cart/toListUser/">Cart</a>
                </li>
              </ul>
            </div>
        </nav>
<?php
    }
    /**Destruct**/
    function __destruct() {
?>
        <footer>
            <div class="text-center foot">Developed by Ing. Ricardo Presilla. &copy; 2019</div>
        </footer>
    </body>
</html>
<?php
    }
}
//Instantiating.
$templates = new Templates();
?>