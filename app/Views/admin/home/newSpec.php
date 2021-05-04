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

            <?php echo form_open_multipart('/admin/addSpec','')?>

            <div class="form-group">
            <select name="productId" id="productId" class="form-select" aria-label="Product Select">
            <option value="0" selected>Select Product</option>
            <?php if(count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
            <option value="<?php echo $product['pId']; ?>">
            <?php echo $product['pName']; ?>
            </option>
            <?php endforeach; ?>
            <?php endif; ?>
            </select>
            </div>

            <div class="form-group">
                <?php echo form_input('sp_name','',array('class'=>"form-control", 'placeholder'=>'Enter Spec Name')); ?>
            </div>
            <div class="form-group form_special">
                <?php echo form_input('sp_value','',array('class'=>"form-control", 'placeholder'=>'Enter Spec Value')); ?>
            </div>

           <a href="javascript:void(0)" class="add_spec"><i class="far fa-plus-square"></i></a>

            <div class="form-group">
                <?php echo form_submit('Add Spec','Add Spec','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>

