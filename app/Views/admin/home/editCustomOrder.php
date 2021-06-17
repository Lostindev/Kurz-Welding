<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Customer Order # <?php echo $product[0]['coId'] ?></h3>
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
            <?php echo form_open_multipart(site_url('/admin/updateCustomOrder/'.$product[0]['coId']),'')?>
            <input type="hidden" name="coId" value="<?php echo $product[0]['coId']?>">
            <input type="hidden" name="oldImg" value="<?php echo $product[0]['coDp']?>">
            <input type="hidden" name="co_first" value="<?php echo $product[0]['coFirst']?>">
            <input type="hidden" name="co_last" value="<?php echo $product[0]['coLast']?>">
            <input type="hidden" name="co_phone" value="<?php echo $product[0]['coPhone']?>">
            <input type="hidden" name="co_email" value="<?php echo $product[0]['coEmail']?>">
            <input type="hidden" name="co_size" value="<?php echo $product[0]['coSize']?>">
            <input type="hidden" name="co_dp2" value="<?php echo $product[0]['coDp2']?>">
            <input type="hidden" name="co_user" value="<?php echo $product[0]['coUser']?>">
            <input type="hidden" name="co_message" value="<?php echo $product[0]['coMessage']?>">

            <div class="form-group">
            <label class="form-label" for="co_message">Vison</label>
                <textarea class="form-control" name="co_message" id="co_message" rows="4" readonly><?php echo $product[0]['coMessage']?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="co_size">Size</label>
                <input type="text" value="<?php echo $product[0]['coSize']?>" name="co_size" id="co_size" class="form-control" readonly />
            </div>

            <div class="form-group">
            <label class="form-label" for="co_size">Status</label>
                <select name="statusSelect" id="statusSelect" class="form-select col" aria-label="Sub Category Select" >
                    <option value="Quote">Quote</option>
                    <option value="Invoice">Invoice</option>
                    <option value="Mockup-1">Mockup 1</option>
                    <option value="Mockup-2">Mockup 2</option>
                    <option value="Production">Production</option>
                    <option value="Shipped">Shipped</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="co_tracking">Tracking #</label>
                <input type="text" value="<?php  if(isset($product[0]['coTracking'])){ echo $product[0]['coTracking'];}?>" name="co_tracking" id="co_tracking" class="form-control" />
            </div>

            <div class="form-group">
                <?php echo form_submit('Update Order','Update Order','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

        <div class="col-md-3">
            <label class="col-12">Image 1:<br></label>
            <img src="<?php echo site_url('/img/custom_orders/'.$product[0]['coDp'])?>" height="250px" class="img-responsive">
            <br>
            <label class="col-12">Image 2:</label>
            <img src="<?php echo site_url('/img/custom_orders/'.$product[0]['coDp2'])?>" height="250px" class="img-responsive">
        </div>
    </div>
</div>

