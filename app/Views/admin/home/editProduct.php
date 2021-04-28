<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Edit Product: <?php echo $product[0]['pName'] ?></h3>
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

            <?php echo form_open_multipart('/admin/editProduct','')?>
            <input type="hidden" name="pId" value="<?php echo $product[0]['pId']?>">
            <input type="hidden" name="oldImg" value="<?php echo $product[0]['pDp']?>">
            <div class="form-group">
                <?php echo form_input('productName',$product[0]['pName'],array('class'=>"form-control", 'placeholder'=>'Enter Product Name')); ?>
            </div>
            <div class="form-group">
                <?php echo form_textarea('productDescription',$product[0]['pDescription'],array('class'=>"form-control", 'placeholder'=>'Enter Product Description (Optional)')); ?>
            </div>
            <div class="form-group">
            <select name="categoryId" id="categoryId" class="form-select" aria-label="Category Select">
            <option value="0" selected>Select Main Category</option>
            <?php if(count($categories) > 0): ?>
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['cId']; ?>">
            <?php echo $category['cName']; ?>
            </option>
            <?php endforeach; ?>
            <?php endif; ?>
            </select>
            </div>

            <div class="form-group">
                <select name="subCategory" id="subCategory" class="form-select" aria-label="Sub Category Select" >
                    <option value="0">Select Sub Category</option>
                </select>
            </div>


            <div class="form-group">
                <?php echo form_upload('pDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Edit Product','Edit Product','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

        <div class="col-md-3">
            <img src="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>" height="250px" class="img-responsive">
        </div>
    </div>
</div>

