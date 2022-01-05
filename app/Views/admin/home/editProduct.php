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

            <?php echo form_open_multipart('/admin/updateProduct','')?>
            <input type="hidden" name="pId" value="<?php echo $product[0]['pId']?>">
            <input type="hidden" name="oldImg" value="<?php echo $product[0]['pDp']?>">
            <input type="hidden" name="oldImg2" value="<?php echo $product[0]['pDp2']?>">
            <input type="hidden" name="oldImg3" value="<?php echo $product[0]['pDp3']?>">
            <input type="hidden" name="oldImg4" value="<?php echo $product[0]['pDp4']?>">
            <div class="form-group">
                <?php echo form_input('productName',$product[0]['pName'],array('class'=>"form-control", 'placeholder'=>'Enter Product Name')); ?>
            </div>
            <div class="form-group">
                <?php echo form_input('pPrice',$product[0]['pPrice'],array('class'=>"form-control", 'placeholder'=>'Enter Product Price (90)')); ?>
            </div>
            <div class="form-group">
                <?php echo form_textarea('productDescription',$product[0]['pDescription'],array('class'=>"form-control", 'placeholder'=>'Enter Product Description (Optional)')); ?>
            </div>
            <div class="form-group">
            <select name="categoryId" id="categoryId" class="form-select" aria-label="Category Select">
            <option value="<?php echo $product[0]['categoryId'] ?>" selected>Select Main Category</option>
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
                    <option value="<?php echo $product[0]['subCatId'] ?>">Select Sub Category</option>
                </select>
            </div>



            <div class="form-group row">
                <div class="col-6">
                <label>Image 1:</label>
                <?php echo form_upload('pDp','',''); ?>
                </div>
                <div class="col-6">
                <label>Image 2:</label>
                <?php echo form_upload('pDp2','',''); ?>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-6">
                    <label>Image 3:</label>
                    <?php echo form_upload('pDp3','',''); ?>
                    </div>
                    <div class="col-6">
                    <label>Image 4:</label>
                    <?php echo form_upload('pDp4','',''); ?>
                </div>
            </div>

            <?php if ($product[0]['pCustom']==1)  : ?>
                <div>
                <div style="padding-top:25px;" class="form-check form-switch">
                <input class="form-check-input" value="1" type="radio" checked name="customCheck" id="customCheck">
                <label class="form-check-label" for="customCheck">Custom</label>
                <br><br>
                <input class="form-check-input" value="0" type="radio" name="customCheck" id="customCheck2">
                <label class="form-check-label" for="customCheck">Standard</label>
                </div>
            </div><br>
            <?php endif; ?>

            <?php if ($product[0]['pCustom']==0)  : ?>
                <div>
                <div style="padding-top:25px;" class="form-check form-switch">
                <input class="form-check-input" value="1" type="radio" name="customCheck" id="customCheck">
                <label class="form-check-label" for="customCheck">Custom</label>
                <br><br>
                <input class="form-check-input" value="0" checked type="radio" name="customCheck" id="customCheck2">
                <label class="form-check-label" for="customCheck">Standard</label>
                </div>
            </div><br>
            <?php endif; ?>



            <div class="form-group">
                <?php echo form_submit('Edit Product','Edit Product','class="btn btn-primary"'); ?>
            </div>
            <?php echo form_close()?>
        </div>



        <div class="col-md-5 row">
            <div class="col-12">
                <label>Image 1:</label>
                <img src="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>" height="250px" class="img-responsive">
            </div>
        

            <?php if (isset($product[0]['pDp2'])) :?>
            <div class="col-12">
            <label>Image 2:</label>
                <img src="<?php echo site_url('/img/products/'.$product[0]['pDp2'])?>" height="250px" class="img-responsive">
            </div>
            <?php endif; ?>

            <?php if (isset($product[0]['pDp3'])) :?>
            <div class="col-12">
            <label>Image 3:</label>
                <img src="<?php echo site_url('/img/products/'.$product[0]['pDp3'])?>" height="250px" class="img-responsive">
            </div>
            <?php endif; ?>
            
            <?php if (isset($product[0]['pDp4'])) :?>
            <div class="col-12">
            <label>Image 4:</label>
                <img src="<?php echo site_url('/img/products/'.$product[0]['pDp4'])?>" height="250px" class="img-responsive">
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

