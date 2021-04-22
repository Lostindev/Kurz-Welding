<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">

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

            <h1>All Sub Categories</h1>
            <table>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>

                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                        
                    <tr>
                        <td>
                            <?php echo $getResult['scId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['scName']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['scDp']  ;?>
                        </td>
                        


                        <td>
                            <a href="<?php echo site_url('admin/editSubCategory/'. $getResult['scId']) ?>" class="btn btn-info">
                            Edit
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteSubCategory/'.$getResult['scId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['scId']; ?>" data-text="<?php echo $getResult['scId'] ;?>" >
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