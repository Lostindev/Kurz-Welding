<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <?php echo form_open_multipart('/admin/addCategory','')?>
            <div class="form-group">
                <?php echo form_input('categoryName','','class="form-control"'); ?>
            </div>
            <div class="form-group">
                <?php echo form_upload('catDp','',''); ?>
            </div>
            <div class="form-group">
                <?php echo form_submit('Add Category','Add Category','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>