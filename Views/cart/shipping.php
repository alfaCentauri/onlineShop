<?php
/**
 * Created by PhpStorm.
 * User: rpres
 * Date: 6/5/2019
 * Time: 7:25 PM
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">Shipping</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header bg-success">Shipping information</div>
                <div class="card-body">
                <form action="<?php echo URL; ?>cart/dispach/<?php echo $data['id']; ?>"
                      id="formShipping" name="formShipping" method="post">
                    <div class="row">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="shipping" class="">Shipping option:</label>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <select id="shipping" name="shipping" class="form-control">
                                    <option value="0">Pick up</option>
                                    <option value="5">UPS</option>
                                </select>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <strong>Shipping costs: </strong>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <strong>00 $</strong>
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
