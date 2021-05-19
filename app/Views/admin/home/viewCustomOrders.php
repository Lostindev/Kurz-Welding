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
                <th>Full Name</th>
                <th>Status</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Vision</th>

                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                        
                    <tr>
                        <td>
                            <?php echo $getResult['coId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['coFirst']; echo $getResult['coLast']  ;?>
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
                            <?php echo $getResult['coMessage']  ;?>
                        </td>


                        
                        <td>
                            <a href="<?php echo site_url('admin/editGallery/'. $getResult['gId']) ?>" class="btn btn-info">
                            Edit
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteGallery/'.$getResult['gId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['gId']; ?>" data-text="<?php echo $getResult['gId'] ;?>" >
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