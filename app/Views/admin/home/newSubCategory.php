<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
        <h3>Create New Sub Category</h3>
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

            <?php echo form_open_multipart('/admin/addSubCategory','')?>
            <div class="form-group">
                <?php echo form_input('subCategoryName','',array('class'=>"form-control", 'placeholder'=>'Enter Sub Category Name')); ?>
            </div>
            <div class="form-group">
            
            <?php 
            $categoryOptions = array();
            foreach ($categories as $category) {
                $categoryOptions[$category->cId] = $category['cName'];
            }
                echo form_dropdown('categoryId',$categoryOptions,'class="form-control');
              ?>

            </div>


            <div class="form-group">
                <?php echo form_upload('cDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Add Category','Add Category','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>