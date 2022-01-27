<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>View Order # <?php echo $product[0]['tempId'] ?></h3>
        <?php if (isset($message)) : ?>
                            <div class=" alert alert-danger">
                                <div class="text-white">
                                 <?php print_r($message); ?>
                                </div>
                            </div>
        <?php endif; ?>

        <?php if (isset($successMessage)) : ?>
                            <div class=" alert alert-success">
                                <div class="text-white">
                                 <?php print_r($successMessage); ?>
                                </div>
                            </div>
        <?php endif; ?>
            <?php echo form_open_multipart(site_url('/admin/updateOrder/'.$product[0]['oId']),'')?>
            <input type="hidden" name="oId" value="<?php echo $product[0]['oId']?>">
            <input type="hidden" name="oStatus" value="<?php echo $product[0]['oStatus']?>">
            <input type="hidden" name="oProducts" value="<?php echo $product[0]['oProducts']?>">
            <input type="hidden" name="tempId" value="<?php echo $product[0]['tempId']?>">
            <input type="hidden" name="billingEmail" value="<?php echo $product[0]['billingEmail']?>">
            <input type="hidden" name="billingCompany" value="<?php echo $product[0]['billingCompany']?>">
            <input type="hidden" name="billingFirst" value="<?php echo $product[0]['billingFirst']?>">
            <input type="hidden" name="billingAddress" value="<?php echo $product[0]['billingAddress']?>">
            <input type="hidden" name="billingLast" value="<?php echo $product[0]['billingLast']?>">
            <input type="hidden" name="billingApt" value="<?php echo $product[0]['billingApt']?>">
            <input type="hidden" name="billingCity" value="<?php echo $product[0]['billingCity']?>">
            <input type="hidden" name="billingCountry" value="<?php echo $product[0]['billingCountry']?>">
            <input type="hidden" name="billingState" value="<?php echo $product[0]['billingState']?>">
            <input type="hidden" name="billingZip" value="<?php echo $product[0]['billingZip']?>">
            <input type="hidden" name="billingPhone" value="<?php echo $product[0]['billingPhone']?>">
            <input type="hidden" name="billingNotes" value="<?php echo $product[0]['billingNotes']?>">

           
            <input type="hidden" name="shippingCompany" value="<?php echo $product[0]['shippingCompany']?>">
            <input type="hidden" name="shippingFirst" value="<?php echo $product[0]['shippingFirst']?>">
            <input type="hidden" name="shippingLast" value="<?php echo $product[0]['shippingLast']?>">
            <input type="hidden" name="shippingAddress" value="<?php echo $product[0]['shippingAddress']?>">
            <input type="hidden" name="shippingApt" value="<?php echo $product[0]['shippingApt']?>">
            <input type="hidden" name="shippingCity" value="<?php echo $product[0]['shippingCity']?>">
            <input type="hidden" name="shippingCountry" value="<?php echo $product[0]['shippingCountry']?>">
            <input type="hidden" name="shippingState" value="<?php echo $product[0]['shippingState']?>">
            <input type="hidden" name="shippingZip" value="<?php echo $product[0]['shippingZip']?>">
            <input type="hidden" name="shippingPhone" value="<?php echo $product[0]['shippingPhone']?>">

            <input type="hidden" name="oDate" value="<?php echo $product[0]['oDate']?>">
            <input type="hidden" name="userId" value="<?php echo $product[0]['userId']?>">
            <input type="hidden" name="oPrice" value="<?php echo $product[0]['oPrice']?>">
            <input type="hidden" name="oCustom" value="<?php echo $product[0]['oCustom']?>">


            <div class="form-group">
            <label class="form-label" for="co_message">Products</label><br>
                <?php echo str_replace(';','<br><br>',$product[0]['oProducts']); ?>
            </div><br>

            <div class="form-group">
            <label class="form-label" for="order-date">Order Date</label><br>
            <?php if (isset($product[0]['oDate'])) echo $product[0]['oDate'] ;?>
            </div><br>
            

            <div class="form-group">
            <label class="form-label" for="co_message">Custom Design Information</label><br>
                <?php echo str_replace(";","<br>",$product[0]['oCustom']); ?>
            </div><br>

            <div class="form-group row justify-content-center">
                <div class="col-lg-6">
                    <label class="form-label" for="co_size">Shipping Address:</label><br>
                    <?php echo $product[0]['shippingFirst']; echo ' '.$product[0]['shippingLast'].'<br>';
                    if(isset($product[0]['shippingCompany'])) echo $product[0]['shippingCompany'].'<br>';
                    echo $product[0]['shippingAddress']; if(isset($product[0]['shippingApt'])) echo $product[0]['shippingApt'].'<br>';
                    echo $product[0]['shippingCity'].', '; echo $product[0]['shippingCountry'].', '; echo $product[0]['shippingState'].' '; echo $product[0]['shippingZip'];
                    ?>
                </div>
                <div class="col-lg-6">
                    <label class="form-label" for="co_size">Billing Address:</label><br>
                    <?php echo $product[0]['billingFirst']; echo ' '.$product[0]['billingLast'].'<br>';
                    if(isset($product[0]['billingCompany'])) echo $product[0]['billingCompany'].'<br>';
                    echo $product[0]['billingAddress']; if(isset($product[0]['billingApt'])) echo $product[0]['billingApt'].'<br>';
                    echo $product[0]['billingCity'].', '; echo $product[0]['billingCountry'].', '; echo $product[0]['billingState'].' '; echo $product[0]['billingZip'];
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="co_tracking">Order Notes</label><br>
                <?php  if(isset($product[0]['billingNotes'])){ echo $product[0]['billingNotes'];}?>
            </div>

            <div class="form-group">
            <label class="form-label" for="co_size">Status</label>
                <select name="statusSelect" id="statusSelect" class="form-select col" aria-label="Sub Category Select" >
                     <option value="<?php echo $product[0]['oStatus']?>"><?php echo $product[0]['oStatus']?></option>
                    <option value="Processing">Processing</option>
                    <option value="Payment Failed">Payment Failed</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Complete">Complete</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="co_tracking">Tracking #</label>
                <input type="text" value="<?php  if(isset($product[0]['oTracking'])){ echo $product[0]['oTracking'];}?>" name="o_tracking" id="o_tracking" class="form-control" />
            </div>

            <div class="form-group">
                <?php echo form_submit('Update Order','Update Order','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

    </div>
</div>

