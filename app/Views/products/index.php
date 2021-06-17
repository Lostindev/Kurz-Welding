<link rel="stylesheet" type="text/css" href="vendor/photoswipe/photoswipe.min.css">
<link rel="stylesheet" type="text/css" href="vendor/photoswipe/default-skin/default-skin.min.css">
<style>
#btn-cart {
	border: 0;
    flex: 1;
    min-width: 13rem;
    font-size: 1.4rem;
    border-radius: .3rem;
    background-color: #26c;
    color: #fff;
    cursor: pointer;
    max-width: 20.7rem;
    height: 4.5rem;
	}
</style>
<main class="main mt-6 single-product">
			<div class="page-content mb-10 pb-6">
				<div class="container">
					<div class="product product-single row mb-7">
						<div class="col-md-6 sticky-sidebar-wrapper">
							<div class="product-gallery pg-vertical sticky-sidebar"
								data-sticky-options="{'minWidth': 767}">
								<div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
									<figure class="product-image">
										<img src="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>"
											data-zoom-image="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>"
											alt="<?php echo $product[0]['pDp'];?>" width="800" height="900">
									</figure>
									<?php if (isset($product[0]['pDp2'])) :?>
										<figure class="product-image">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp2'])?>"
											data-zoom-image="<?php echo site_url('/img/products/'.$product[0]['pDp2'])?>"
											alt="<?php echo $product[0]['pDp2'];?>" width="800" height="900">
										</figure>
									<?php endif; ?>
									<?php if (isset($product[0]['pDp3'])) :?>
										<figure class="product-image">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp3'])?>"
											data-zoom-image="<?php echo site_url('/img/products/'.$product[0]['pDp3'])?>"
											alt="<?php echo $product[0]['pDp3'];?>" width="800" height="900">
										</figure>
									<?php endif; ?>
									<?php if (isset($product[0]['pDp4'])) :?>
										<figure class="product-image">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp4'])?>"
											data-zoom-image="<?php echo site_url('/img/products/'.$product[0]['pDp4'])?>"
											alt="<?php echo $product[0]['pDp4'];?>" width="800" height="900">
										</figure>
									<?php endif; ?>
								</div>
								<div class="product-thumbs-wrap">
									<div class="product-thumbs">
										<!--Load all thumbnails if they exists-->
										<div class="product-thumb active">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>" alt="product thumbnail"
												width="109" height="122">
										</div>
										<?php if (isset($product[0]['pDp2'])) :?>
										<div class="product-thumb">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp2'])?>" alt="product thumbnail"
												width="109" height="122">
										</div>
										<?php endif; ?>
										<?php if (isset($product[0]['pDp3'])) :?>
										<div class="product-thumb">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp3'])?>" alt="product thumbnail"
												width="109" height="122">
										</div>
										<?php endif; ?>
										<?php if (isset($product[0]['pDp4'])) :?>
										<div class="product-thumb">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp4'])?>" alt="product thumbnail"
												width="109" height="122">
										</div>
										<?php endif; ?>
									</div>
									<button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
									<button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
								</div>
								<div class="product-label-group">
									<label class="product-label label-new">new</label>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="product-details">
								<div class="product-navigation">
									<ul class="breadcrumb breadcrumb-lg">
										<li><a href="demo1.html"><i class="d-icon-home"></i></a></li>
										<li><a href="#" class="active">Products</a></li>
										<li>Detail</li>
									</ul>
<!-- Product Next/previous
									<ul class="product-nav">
										<li class="product-nav-prev">
											<a href="#">
												<i class="d-icon-arrow-left"></i> Prev
												<span class="product-nav-popup">
													<img src="/theme/images/product/product-thumb-prev.jpg"
														alt="product thumbnail" width="110" height="123">
													<span class="product-name">Sed egtas Dnte Comfort</span>
												</span>
											</a>
										</li>
										<li class="product-nav-next">
											<a href="#">
												Next <i class="d-icon-arrow-right"></i>
												<span class="product-nav-popup">
													<img src="/theme/images/product/product-thumb-next.jpg"
														alt="product thumbnail" width="110" height="123">
													<span class="product-name">Sed egtas Dnte Comfort</span>
												</span>
											</a>
										</li>
									</ul>
-->
								</div>
								<?php $loadDimensions = getDimensions($product[0]['pId']); ?>
								<h1 class="product-name"><?php echo $product[0]['pName'];?></h1>
								<div class="product-meta">
									ID: <span class="product-sku"><?php echo $product[0]['pId'];?></span>
								</div>
								<div id="pre-price" class="product-price">$<?php echo $product[0]['pPrice'];?></div>
								<div class="ratings-container">
									<div class="ratings-full">
										<span class="ratings" style="width:100%"></span>
										<span class="tooltiptext tooltip-top"></span>
									</div>
									<a href="#product-tab-reviews" class="link-to-tab rating-reviews">( 4+ reviews )</a>
								</div>
								<form action="<?php echo '/shop/add-to-cart/'.$product[0]['pId']; ?>" method="POST">
								<p class="product-short-desc"><?php echo $product[0]['pDescription'];?></p>
								<div class="product-form product-variations product-color">
									<label>Color:</label>
									<div class="select-box">
										<select name="color" class="form-control">
											<option value="" selected="selected">Choose an Option</option>
											<option value="Flat Black">Flat Black</option>
											<option value="Gloss Black">Gloss Black</option>
											<option value="White">White</option>
											<option value="Red">Red</option>
											<option value="Teal">Teal</option>
											<option value="Bronze">Bronze</option>
										</select>
									</div>
								</div>
								<div class="product-form product-variations product-size">
									<label>Size:</label>
							
									<?php if (count($loadDimensions) > 0): ?>
									<div class="product-form-group">
										<div class="select-box">
											<select id="sizeSelect" name="sizeSelect" class="form-control">
												<option value="" selected="selected"><?php echo $loadDimensions[0]['spName'] ?></option>
												<?php $specValues = getDimensionValues($loadDimensions[0]['spId']); ?>
												
												<?php if (count($specValues) > 0): ?>
												<?php foreach($specValues as $dimension):?>
												<option value="<?php echo $dimension['spvPrice'];?>"><?php echo $dimension['spvName'].'&nbsp(+$'.$dimension['spvPrice'].')';?> </option>
												<?php endforeach; ?>
												<?php endif;?>
											</select>
										</div>
										<a href="#" class="product-variation-clean">Clear All</a>
									</div>
									<?php endif; ?>
								</div>
								<div class="product-variation-price">
									<span>$79</span>
									<input type="hidden" name="var-price" id="var-price"></input>
								</div>

								<hr class="product-divider">

								<div class="product-form product-qty">
									<div class="product-form-group">
										<button type="submit" id="btn-cart" href=""
											class="btn-product text-normal ls-normal font-weight-semi-bold"><i
												class="d-icon-bag"></i>&nbsp Add to
											Cart</button>
											<div style="padding-top:5px" class="social-links mr-4">
										<a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
										<a href="#" class="social-link social-twitter fab fa-twitter"></a>
										<a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
									</div>
									</div>
								</div>
								</form>

								<hr class="product-divider mb-3">

								<div class="product-footer">
								
								</div>
							</div>
						</div>
					</div>
					<section class="pt-3 mt-10">
						<h2 class="title justify-content-center">Related Products</h2>

						<div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
							data-owl-options="{
							'items': 5,
							'nav': false,
							'loop': false,
							'dots': true,
							'margin': 20,
							'responsive': {
								'0': {
									'items': 2
								},
								'768': {
									'items': 3
								},
								'992': {
									'items': 4,
									'dots': false,
									'nav': true
								}
							}
						}">
						<?php if(isset($allProducts)): ?>
                        <?php $i=1; ?>
                        <?php foreach($allProducts as $product): 
                            if ($i++ == 5) break;
                        ?>
                        <?php $pUrl = (str_replace(' ', '-', strtolower($product['pName']))); ?>
							<div class="product">
								<figure class="product-media">
									<a href="<?php echo base_url('/shop/custom-metal-art/'.$pUrl) ; ?>">
										<img src="<?php echo base_url('/img/products/'.$product['pDp']); ?>" alt="product" style="height:230px;width:330px;">
									</a>
									<div class="product-label-group">
                                    	<label class="product-label label-sale">25% off</label>
                                	</div>
									<div class="product-action-vertical">
										<a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
											data-target="#addCartModal" title="Add to cart"><i
												class="d-icon-bag"></i></a>
										<a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"><i
												class="d-icon-heart"></i></a>
									</div>
									<div class="product-action">
										<a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
									</div>
								</figure>
								<div class="product-details">
									<div class="product-cat">
										<a href="/shop">Clothing</a>
									</div>
									<h3 class="product-name">
										<a href="<?php echo base_url('/shop/custom-metal-art/'.$product['pName']) ?>"><?php echo $product['pName']; ?></a>
									</h3>
									<div class="product-price">
										<span class="price">$<?php echo $product['pPrice'] ?></span>
									</div>
									<div class="ratings-container">
										<div class="ratings-full">
											<span class="ratings" style="width:100%"></span>
											<span class="tooltiptext tooltip-top"></span>
										</div>
										<a href="#" class="rating-reviews">( <span class="review-count">4+</span>
											reviews
											)</a>
									</div>
								</div>
							</div>
							<?php endforeach;?>
                       		<?php endif; ?>

						</div>
					</section>
				</div>
			</div>
		</main>