<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-1">
            <h3>Edit Category</h3>

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

            <?php echo form_open_multipart('/admin/updateCategory','')?>
            <input name="id" type="hidden" value="<?php echo $category[0]['cId'] ?>">
            <input name="old" type="hidden" value="<?php echo $category[0]['cDp'] ?>">
            <div class="form-group">
                <?php echo form_input('categoryName',$category[0]['cName'],'class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_upload('cDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Update Category','Update Category','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>

        <div class="col-md-3">
            
            <img src="<?php echo site_url('/img/categories/'.$category[0]['cDp'])?>" height="250px" class="img-responsive">
        </div>
    </div>
</div>