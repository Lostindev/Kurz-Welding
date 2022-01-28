

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

            <h1>All Reviews</h1>
            <table class="dataTable">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                    <tr>
                        <td>
                            <?php echo $getResult['rId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['rFirstName']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['rEmail']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['rDate']  ;?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('admin/editReview/'. $getResult['rId']) ?>" class="btn btn-info">
                            View
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteReview/'.$getResult['rId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['rId']; ?>" data-text="<?php echo $getResult['rId'] ;?>" >
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