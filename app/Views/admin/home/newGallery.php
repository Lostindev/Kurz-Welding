<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Create New Gallery Entry</h3>
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

            <?php echo form_open_multipart('/admin/addGallery','')?>
            <div class="form-group">
                <?php echo form_input('galleryName','',array('class'=>"form-control", 'placeholder'=>'Enter Gallery Item Name')); ?>
            </div>
            <div class="form-group">
                <?php echo form_textarea('galleryDescription','',array('class'=>"form-control", 'placeholder'=>'Enter gallery item description (Optional)')); ?>
            </div>
            <div class="form-group">
            <select name="categoryName" id="categoryName" class="form-select" aria-label="Category Select">
            <option value="0" selected>Select Category</option>
            <?php if(count($categories) > 0): ?>
            <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['cName']; ?>">
            <?php echo $category['cName']; ?>
            </option>
            <?php endforeach; ?>
            <?php endif; ?>
            </select>
            </div>

            <div class="form-group">
                <label>Image 1:</label>
                <?php echo form_upload('gDp','',''); ?>
            </div>
            <div class="form-group">
                <label>Image 2:</label>
                <?php echo form_upload('gDp2','',''); ?>
            </div>
            <div class="form-group">
                <label>Image 3:</label>
                <?php echo form_upload('gDp3','',''); ?>
            </div>
            <div class="form-group">
                <label>Image 4:</label>
                <?php echo form_upload('gDp4','',''); ?>
            </div>

            <div class="form-group">
                <?php echo form_submit('Add to Gallery','Add to Gallery','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>

