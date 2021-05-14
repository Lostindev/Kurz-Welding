<main class="main">
<div class="page-header"
	style="background-image: url('/img/home/gallery.jpg'); background-color: #3C63A4;">
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
                <div class="container col-6 justify-content-center">
                    <div class="posts grid post-grid row" data-grid-options="{
                        'layoutMode': 'fitRows'
                    }">

                <div class="col-12 text-center">
                    <h2 style="padding-top:20px;padding-bottom:10px;">Custom Order Request</h2>  
                </div>
                    
                    <form>
                        <div class="row mb-4">
                            <div class="col-6">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example1">First name</label>
                                <input type="text" id="form6Example1" class="form-control" />
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-outline">
                                <label class="form-label" for="form6Example2">Last name</label>
                                <input type="text" id="form6Example2" class="form-control" />
                            </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                            <div class="form-outline">
                            <!-- Email input -->
                                <label class="form-label" for="form6Example5">Email</label>
                                <input type="email" value="<?php echo $userData[0]['email']; ?>" id="form6Example5" class="form-control" />
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-outline">
                            <!-- Number input -->
                            <label class="form-label" for="form6Example6">Phone</label>
                            <input type="number" id="form6Example6" class="form-control" />
                            </div>
                            </div>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example7">Describe your vision</label>
                            <textarea class="form-control" id="form6Example7" rows="4"></textarea>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Place order</button>
                    </form>
                </div>
                    </div>
                </div>
            </div>
        </main>