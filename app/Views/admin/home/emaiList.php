

<div class="content-wrapper" >
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

            <h1>Newsletter Email List</h1>
            <table class="dataTable">
                <th>ID</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
                <th>Delete</th>
                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                    <tr>
                        <td>
                            <?php echo $getResult['nId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['nEmail']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['nDate']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['nActive']  ;?>
                        </td>

                        <td>
                            <a href="<?php echo site_url('/admin/deleteEmail/'.$getResult['nId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['nId']; ?>" data-text="<?php echo $getResult['nId'] ;?>" >
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