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

            <h1>All Custom Orders</h1>
            <table class="dataTable">
                <th>ID</th>
                <th>Vision</th>
                <th>Size</th>
                <th>Full Name</th>
                <th>Status</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Uploads</th>
                <th>Update</th>

                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                        
                    <tr>
                        <td>
                            <?php echo $getResult['coId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coMessage']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coSize']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coFirst'].' '; echo $getResult['coLast']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coStatus']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coEmail']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coPhone']  ;?>
                        </td>



                        
                        <td>
                            <a href="<?php echo site_url('admin/editCustomOrder/'. $getResult['coId']) ?>" class="btn btn-info">
                            View
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteGallery/'.$getResult['coId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['coId']; ?>" data-text="<?php echo $getResult['coId'] ;?>" >
                            Update
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