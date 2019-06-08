<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/6/2019
 * Time: 12:17 PM
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Dispach</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-success">Dispach information</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Direcction of shipping:</strong> <?php echo $data['direction']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4"></div>
                        <div class="col-sm-4 col-md-4">
                            <a href="<?php echo URL; ?>product/" class="btn btn-success btn-block">OK</a>
                        </div>
                        <div class="col-sm-4 col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>