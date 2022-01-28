<style>
.content-wrapper {
    margin-left:0px!important;
};

body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
    
    margin-left: 0px!important;}
</style>

<div class="content-wrapper">
<form action="/admin/updateReview" method="POST">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-1">
            <h3>View Message</h3>

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

         
            <input name="id" type="hidden" value="<?php echo $category[0]['rId'] ?>">
            <input name="message" type="hidden" value="<?php echo $category[0]['rMessage'] ?>">
            
            <div class="form-group">
                

            <div class="form-group">
                <label>Contact Name:</label>
                <input type="text" name="firstName" value="<?php if (isset($category[0]['rFirstName'])) echo $category[0]['rFirstName'].' ' ; 
                if (isset($category[0]['rLastName'])) echo $category[0]['rLastName'] ;?>" class="form-control" readonly="">
            </div>

            <div class="form-group">
                <label>Review Message:</label>
                <input type="text" name="firstName" value="<?php if (isset($category[0]['rMessage'])) echo $category[0]['rMessage'] ;?>" class="form-control" readonly="">
            </div>

            <div class="form-group">
                <label>Contact Email:</label>
                <input type="text" name="firstName" value=" <?php if (isset($category[0]['rEmail'])) echo $category[0]['rEmail'] ;?>" class="form-control" readonly="">
            </div>

            <div class="form-group">
                <label>Review Date:</label>
                <input type="text" name="firstName" value="<?php if (isset($category[0]['rDate'])) echo $category[0]['rDate'] ;?>" class="form-control" readonly="">
            </div>



            <?php if($category[0]['rStatus'] > 0):?>
                <div class="form-group">
                <label>Status:</label>
                <select style="width:100%;height:35px;" name="status" id="status">
                    <option value="1">Approved</option>
                    <option value="0">Pending</option>
                </select>
            </div>

            <?php else: ?>

                <div class="form-group">
                <label>Status:</label>
                <select style="width:100%;height:35px;" name="status" id="status">
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                </select>
            </div>
            
            <?php endif;?>


            <div class="row">
                <div class="col-6">
                    <input class="btn btn-primary col-12" type="submit" name="Update Review" value="Update Review" class="btn btn-primary">
                </div>
                <div class="col-6">
                    <a href="<?php echo site_url('/admin/deleteReview/'.$category[0]['rId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $category[0]['rDate']; ?>" data-text="<?php echo $category[0]['rId'] ;?>" >
                                Delete
                    </a>
                </div>
            </div>



        </div>

    </div>
</div>