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

            <h1>All Specs</h1>
            <table class="dataTable">
                <th>ID</th>
                <th>Name</th>
                <th>Product Id</th>
                <th>Product name</th>
                <th>Edit</th>
                <th>Delete</th>
                

                <?php if(count($results) > 0): ?>
                    <?php foreach ($results as $getResult):  ?>
                        <?php foreach ($products as $getProduct):  ?>
                        
                    <tr>
                        <td>
                            <?php echo $getResult['spId']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['spName']  ;?>
                        </td>
                        <td>
                            <?php echo $getResult['productId']  ;?>
                        </td>

                        <td>
                            <?php if($getProduct['pId'] == $getResult['productId']): ?>
                            <?php echo $getProduct['pName'];?>
                            <?php endif; ?>

                        </td>
                        
                        <td>
                            <a href="<?php echo site_url('admin/editProduct/'. $getResult['spId']) ?>" class="btn btn-info">
                            Edit
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url('/admin/deleteProduct/'.$getResult['spId'])?>" class="btn btn-danger deleteCat" data-id="<?php echo $getResult['spId']; ?>" data-text="<?php echo $getResult['spId'] ;?>" >
                            Delete
                            </a>
                        </td>
                    </tr>
                        
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                
            </table>
            <?php echo $pager->links();?>
        </div>
    </div>
</div>