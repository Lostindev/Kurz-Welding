<div class="content-wrapper">
    <div class="row justify-content-center dataRow">
        <div class="col-md-10 col-md-offset-3">

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

            <h1>All Orders</h1>
            <table class="dataTable">
                <th>ID</th>
                <th>Price</th>
                <th>Date</th>
                <th>Full Name</th>
                <th>Status</th>
                <th>Email</th>
                <th>Notes</th>
                <th>View Order</th>
                <th>Delete</th>

                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                        
                    <tr>
                        <td>
                            
                            <?php if (isset($getResult['stripeId'])) echo $getResult['stripeId']; else echo $getResult['oId']  ;?>
                        </td>
                        <td>
                            <?php if (isset($getResult['oPrice'])) echo $getResult['oPrice']  ;?>
                            <?php if (isset($getResult['stripeAmount'])) echo $getResult['stripeAmount']  ;?>
                        </td> 
                        <td>
                        <?php if (isset($getResult['oDate'])) echo $getResult['oDate']  ;?>
                        </td>
                        <td>
                        <?php if (isset($getResult['billingFirst'])) echo $getResult['billingFirst'].' '.$getResult['billingLast']  ;?>
                        </td>
                        <td>
                        <?php if (isset($getResult['oStatus'])) echo $getResult['oStatus']  ;?>
                        <?php if (isset($getResult['stripeStatus'])) echo $getResult['stripeStatus']  ;?>
                        </td>
                        <td>
                        <?php if (isset($getResult['billingEmail'])) echo $getResult['billingEmail']  ;?>
                        <?php if (isset($getResult['stripeEmail'])) echo $getResult['stripeEmail']  ;?>
                        </td>
                        <td>
                        <?php if (isset($getResult['oNotes'])) echo $getResult['oNotes']  ;?>
                        </td>

                        <td>
                            <a href="<?php echo site_url('admin/editOrder/'. $getResult['oId']) ?>" class="btn btn-info">
                            View
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteOrder/'.$getResult['oId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['oId']; ?>" data-text="<?php echo $getResult['oId'] ;?>" >
                            Delete
                            </a>
                        </td>
                    </tr>
                        
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
            <?php echo $pager->links();?>

        </div>
    </div>
</div>