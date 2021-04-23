<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Edit Sub Category: <?php echo $subCategory[0]['scName'] ?></h3>
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

            <?php echo form_open_multipart('/admin/updateSubCategory','')?>
            <input name="id" type="hidden" value="<?php echo $subCategory[0]['scId'] ?>">
            <input name="old" type="hidden" value="<?php echo $subCategory[0]['scDp'] ?>">
            <div class="form-group">
                <?php echo form_input('subCategoryName',$subCategory[0]['scName'],array('class'=>"form-control", 'placeholder'=>'Enter Sub Category Name')); ?>
            </div>
            <div class="form-group">
            <select name="categoryId" class="form-select" aria-label="Default select example">
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
                <?php echo form_upload('scDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Edit Sub Category','Edit Sub Category','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

        <div class="col-md-3">
            <img src="<?php echo site_url('/img/sub_categories/'.$subCategory[0]['scDp'])?>" height="250px" class="img-responsive">
        </div>
    </div>
</div>