<style>
.content-wrapper {
    margin-left:0px!important;
};

body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
    
    margin-left: 0px!important;}
</style>

<div class="content-wrapper">
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

         
            <input name="id" type="hidden" value="<?php echo $category[0]['contactId'] ?>">
            <div class="form-group">
                
            <div class="form-group">
            <label class="form-label" for="order-date">Contact Name</label><br>
            <?php if (isset($category[0]['contactName'])) echo $category[0]['contactName'] ;?>
            </div>

            <div class="form-group">
            <label class="form-label" for="order-date">Message</label><br>
            <?php if (isset($category[0]['contactComment'])) echo $category[0]['contactComment'] ;?>
            </div>

            <div class="form-group">
            <label class="form-label" for="order-date">Contact Email</label><br>
            <?php if (isset($category[0]['contactEmail'])) echo $category[0]['contactEmail'] ;?>
            </div>

            <div class="form-group">
            <label class="form-label" for="order-date">Contact Date</label><br>
            <?php if (isset($category[0]['contactDate'])) echo $category[0]['contactDate'] ;?>
            </div>

            <a href="<?php echo site_url('/admin/deleteMessage/'.$category[0]['contactId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $category[0]['contactDate']; ?>" data-text="<?php echo $category[0]['contactId'] ;?>" >
                            Delete
                            </a>

        </div>

    </div>
</div>