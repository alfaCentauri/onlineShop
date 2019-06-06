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
                    <div class="row mb-3">
                        <div class="col-sm-4 col-md-3 col-lg-3">
                            <label for="shipping" class="">Shipping option:</label>
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <input id="shipping" name="shipping" value="0" class="form-control" type="radio" required onclick="Activate(this);">
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2">
                            Pick up
                        </div>
                        <div class="col-sm-1 col-md-1 col-lg-1">
                            <input id="shipping" name="shipping" value="5" class="form-control" type="radio" required onclick="Activate(this);">
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-2">
                            UPS
                        </div>
                        <div class="col-sm-2 col-md-3 col-lg-3">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <label for="direction" class="">Direction of shipping:</label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <input type="text" class="form-control" id="direction" name="direction" min="3" value=""
                               placeholder="Write a direction of shipping" readonly>
                        </div>
                        <div class="hidden-sm col-md-3 col-lg-3"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <strong>Shipping costs: </strong>
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3">
                                <strong>00 $</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-md-2"></div>
                        <div class="col-sm-4 col-md-4">
                            <input type="submit" id="accept" name="accept" value="Accept" class="btn btn-success btn-block">
                        </div>
                        <div class="col-sm-4 col-md-4">
                            <a href="index.php?url=cart/preview/<?php echo $data['id']; ?>" class="btn btn-warning btn-block">Return</a>
                        </div>
                        <div class="col-sm-2 col-md-2"></div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var currentValue = 0;
    /**Activate the address field.*/
    function Activate(myRadio)
    {
        currentValue = myRadio.value;
        if(currentValue == 5)
        {
            document.getElementById('direction').removeAttribute('readonly'); 
            document.getElementById('direction').setAttribute('required',true);
        }
        else
        {
           document.getElementById('direction').setAttribute('readonly',true);
           document.getElementById('direction').removeAttribute('required');
        }
    }
</script>