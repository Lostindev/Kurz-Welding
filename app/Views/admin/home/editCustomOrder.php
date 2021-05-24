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

            <?php echo form_open_multipart('/admin/updateProduct','')?>
            <input type="hidden" name="pId" value="<?php echo $product[0]['coId']?>">
            <input type="hidden" name="oldImg" value="<?php echo $product[0]['coDp']?>">

            <div class="form-group">
                <?php echo form_textarea('productDescription',$product[0]['coMessage'],array('class'=>"form-control", 'placeholder'=>'Enter Product Description (Optional)')); ?>
            </div>

            <div class="form-group">
                <select name="subCategory" id="subCategory" class="form-select" aria-label="Sub Category Select" >
                    <option value="">Select Sub Category</option>
                </select>
            </div>


            <div class="form-group">
                <?php echo form_upload('coDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Update Order','Update Order','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

        <div class="col-md-3">
        <label>Image 1:</label>
            <img src="<?php echo site_url('/img/custom_orders/'.$product[0]['coDp'])?>" height="250px" class="img-responsive">
        </div>
    </div>
</div>

