<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Create New Product</h3>
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
            <form enctype="multipart/form-data" action="/admin/addProduct" method="POST">
            <div class="form-group">
                <?php echo form_input('productName','',array('class'=>"form-control", 'placeholder'=>'Enter Product Name (No dashes ---)')); ?>
            </div>
            <div class="form-group">
                <?php echo form_input('pPrice','',array('class'=>"form-control", 'placeholder'=>'Enter Product Price (50)')); ?>
            </div>
            <div class="form-group">
                <?php echo form_textarea('productDescription','',array('class'=>"form-control", 'placeholder'=>'Enter Product Description (Optional)')); ?>
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

            <div>
                <div class="form-check form-switch">
                <input class="form-check-input" value="1" type="checkbox" name="customCheck" id="customCheck">
                <label class="form-check-label" for="customCheck">Check this box for custom products</label>
                </div>
            </div><br>

            <div class="form-group">
                <?php echo form_submit('Add Product','Add Product','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>

