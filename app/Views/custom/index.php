<main class="main">
<div class="page-header"
	style="background-image: url('/img/home/custom.jpg'); background-color: #3C63A4;">
	<h1 class="page-title">Custom Request</h1>
    <?php if(userLoggedIn()):?>
    <?php $userData = getUserInfo(); ?>
    <?php endif; ?>
	<ul class="breadcrumb">
		<li><a href="/"><i class="d-icon-home"></i></a></li>
		<li class="delimiter">/</li>
		<li>Custom</li>
	</ul>
</div>
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="d-icon-home"></i></a></li>
                        <li>Custom</li>
                    </ul>
                </div>
            </nav>
            <div class="page-content pb-10 mb-10">
                <div class="container col-md-6 justify-content-center">
                    <div class="posts grid post-grid row" data-grid-options="{
                        'layoutMode': 'fitRows'
                    }">

                <div class="col-12 text-center">
                    <h2 style="padding-top:20px;padding-bottom:10px;">Custom Order Request</h2>  
                </div>
                <?php echo form_open_multipart('/custom/send-custom-order','')?>
                        <div class="row mb-4">
                            <div class="col-6">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">First name</label>
                                <input type="text" name="co_first" value="<?php if (isset($userData[0]['firstName'])) echo $userData[0]['firstName']; ?>" id="form6Example1" class="form-control" required="" />
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example2">Last name</label>
                                <input type="text" name="co_last" value="<?php if (isset($userData[0]['lastName'])) echo $userData[0]['lastName']; ?>" id="form6Example2" class="form-control" required=""/>
                            </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                            <div class="form-outline">
                            <!-- Email input -->
                                <label class="form-label" for="co_email">Email</label>
                                <input type="email" name="co_email" value="<?php if (isset($userData[0]['email'])) echo $userData[0]['email']; ?>" id="form6Example5" class="form-control" required=""/>
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-outline">
                            <!-- Number input -->
                            <label class="form-label" for="co_phone">Phone</label>
                            <input type="number" name="co_phone" id="co_phone" class="form-control" required=""/>
                            </div>
                            </div>
                        </div>

                        <!-- Size input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="co_size">Size</label>
                            <input type="text" name="co_size" id="co_size" class="form-control" required="" />
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="co_message">Describe your vision</label>
                            <textarea class="form-control" name="co_message" id="co_message" rows="4" required=""></textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group col">
                        <label class="form-label" for="userFile">Image 1:</label>
                            <?php echo form_upload('userFile','',''); ?>
                        </div><br>
                        <div class="form-group col">
                        <label class="form-label" for="co_message">Image 2:</label>
                            <input type="file" name="coDp2">
                        </div><br>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Place order</button>
                        <?php echo form_close()?>
                </div>
                    </div>
                </div>
            </div>
        </main>