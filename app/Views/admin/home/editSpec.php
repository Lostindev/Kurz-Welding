<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-6 col-md-offset-3">
        <h3>Edit Spec</h3>
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

            <?php echo form_open_multipart('/admin/updateSpec','')?>
            <input type="hidden" value="<?php echo $spec[0]['spId']; ?>" name="specId"></input>
            <?php $specId = $spec[0]['spId'] ;?>
            <?php $productId = $spec[0]['productId'] ;?>

            <div class="form-group">
            <select name="productId" id="productId" class="form-select" aria-label="Product Select">
            <option value="<?php echo $productId?>" selected><?php echo $getProduct[0]['pName']; ?></option>
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
                <input type="text" class="form-control" placeholder="Enter Spec Name" name="sp_name" value="<?php echo $spec[0]['spName']?>">
            </div>
            


            <div class="form-group">
                <?php echo form_submit('Add Spec','Add Spec','class="btn btn-primary"'); ?>
            </div>
            
            <?php echo form_close()?>
        </div>
    </div>
</div>

