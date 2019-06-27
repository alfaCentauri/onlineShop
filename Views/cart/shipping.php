<?php
/**
 * Created by PhpStorm.
 * User: Ricardo Presilla.
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
            <?php if (isset($data)) {
?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header bg-success">
                          Shipping information
                        </div>
                        <div class="card-body">
                            <form action="" id="formShipping" name="formShipping" method="post">
                                <div class="row mb-3">
                                    <div class="col-sm-4 col-md-3 col-lg-3">
                                        <label for="shipping" class="">Shipping option:</label>
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1">
                                        <input id="shipping" name="shipping" value="0" class="form-control" type="radio"
                                               onclick="Activate(this);">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        Pick up
                                    </div>
                                    <div class="col-sm-1 col-md-1 col-lg-1">
                                        <input id="shipping" name="shipping" value="5" class="form-control" type="radio"
                                               onclick="Activate(this);">
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
                                        <input type="text" class="form-control" id="direction" name="direction" value=""
                                               placeholder="Write a direction of shipping" readonly>
                                    </div>
                                    <div class="hidden-sm col-md-3 col-lg-3"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <strong>Current Balance:</strong>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <div class="price" id="balance">
                                          <strong><?php echo $data['balanceCredit'].' $'; ?></strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <strong>Shipping costs: </strong>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <div class="price" id="priceShipping">0 $</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <strong>Remaining  Balance:</strong>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <div class="price" id="remainingBalance">
                                            <strong><?php echo ($data['balanceCredit'] - $data['subtotal']).' $'; ?></strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <strong>Subtotal to pay: </strong>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3 text-right">
                                        <div class="price" id="subtotal">
                                            <?php echo $data['subtotal'].' $'; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3 col-md-3 col-lg-3">

                                    </div>
                                    <div class="col-sm-3 col-md-3 col-lg-3">

                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <strong>Total to pay: </strong>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-lg-3">
                                        <div class="price" id="total"><?php echo $data['subtotal']; ?> $</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-md-2"></div>
                                    <div class="col-sm-4 col-md-4">
                                        <input type="submit" id="accept" name="accept" value="Accept" class="btn btn-success btn-block" >
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <a href="<?php echo URL; ?>index.php?url=cart/" class="btn btn-warning btn-block">Cancel</a>
                                    </div>
                                    <div class="col-sm-2 col-md-2"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            else{
                echo 'Error';
            }
            ?>
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
            document.getElementById('direction').setAttribute('min',3);
            document.getElementById('priceShipping').innerText='5 $';
        }
        else
        {
           document.getElementById('direction').value='Pick up';
           document.getElementById('direction').setAttribute('readonly',true);
           document.getElementById('direction').removeAttribute('required');
           document.getElementById('direction').removeAttribute('min');
           document.getElementById('priceShipping').innerText='0 $';
        }
        var subtotal = <?php echo $data['subtotal'];?>;
        var total = parseFloat(currentValue) + parseFloat(subtotal);
        var newBalance = parseFloat(<?php echo $data['balanceCredit'];?>) - total;
        document.getElementById('total').innerText=total.toFixed(2)+' $';
        document.getElementById('remainingBalance').innerText=newBalance.toFixed(2)+' $';
    }
</script>
