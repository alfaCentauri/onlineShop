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
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1 class="text-center">Add Product</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card mb-3">
                        <div class="card-header bg-success">Add Product</div>
                        <div class="card-body">
                            <div class="container">
                            <form name="formProduct" action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="name">Product Name:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="text" id="name" name="name" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="price">Price:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="number" step="any" min="0" name="price" value="" placeholder="0" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="stock">Stock:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <input type="number" min="0" name="stock" value="" placeholder="0" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label for="image">Image:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 mb-3">
                                        <input type="file" name="image" value="" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-md-2"></div>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="submit" value="Save" name="save" class="btn btn-success btn-block" />
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="reset" value="Reset" name="reset" class="btn btn-warning btn-block" />
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
