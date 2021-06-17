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
                <div class="container row justify-content-center" style="margin-right:auto!important;margin-left:auto!important;">
                <div class="col-md-6"><br><br>
                <h4 class="ls-m font-weight-bold">Custom Metal Art Design Process</h4>
                    <p>Kurz Metal Art specializes in custom metal work.<br><br>
                    We can accomplish almost anything you can think of!
                    With state-of-the-art plasma cutting technology that consistently produces clean, accurate lines, our friendly and skilled custom metal art sales team will assist you in bringing your idea to reality.<br><br> Our metal art is also manufactured with a high-quality metal printing method that brings bright images to life.<br>
After that, each component is powder coated for further durability and can be used both indoors and out. </p><br><br> <!--new content-->

                    <h4 class="ls-m font-weight-bold">What to expect - the process</h4>
                    <h5>Quote</h5>
                        <ol>
                            <li>You will receive a quote from a member of our sales team after submitting the form.</li>
                            <li>You may not receive an immediate response due to the high volume of personalized inquiries.</li>
                            <li>Kurz Metal Art will communicate that we can do this for you.</li>
                         </ol><br>

                        <h5>Invoice</h5>
                        <ol>
                            <li>We will send you an invoice for payment once you have approved the quote.</li>
                            <li>Once payment is received, the order is routed to a custom designer who will begin processing the order.</li>
                        </ol><br>

                        <h5>Mockup</h5>
                        <ol>
                            <li>During this process, you will receive two mockups.</li>
                            <li>You must respond to mockups within 24 hours of submission, or we will assume no changes are required and proceed with the order.</li>
                            <li>Mockups are typically delivered within 2-4 days of purchase.</li>
                            <li>We'll send you the first mockup for your feedback and approval.</li>
                            <li>If changes are required, we will send the second mockup for approval.</li>
                            <li>The piece is put into production once it has been approved.</li>
                        </ol><br>

                        <h5>Production</h5>
                        <ul>
                            <li>The average production time is 1-2 weeks.</li>
                            <li>Your piece is carefully packaged and shipped once it has been approved! Once your package enters the mail stream, you will receive an email with tracking information.</li>
                        </ul>
                 </div>
                <div class="col-md-6">
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
                </div><!--end container -->
                    </div>
                </div>
            </div>
        </main>