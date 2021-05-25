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
											data-zoom-image="images/product/product-1-1-800x900.jpg"
											alt="Women's Brown Leather Backpacks" width="800" height="900">
									</figure>
									<figure class="product-image">
										<img src="/theme/images/product/product-1-2-580x652.jpg"
											data-zoom-image="images/product/product-1-2-800x900.jpg"
											alt="Women's Brown Leather Backpacks" width="800" height="900">
									</figure>
									<figure class="product-image">
										<img src="/theme/images/product/product-1-3-580x652.jpg"
											data-zoom-image="images/product/product-1-3-800x900.jpg"
											alt="Women's Brown Leather Backpacks" width="800" height="900">
									</figure>
									<figure class="product-image">
										<img src="/theme/images/product/product-1-4-580x652.jpg"
											data-zoom-image="images/product/product-1-4-800x900.jpg"
											alt="Women's Brown Leather Backpacks" width="800" height="900">
									</figure>
								</div>
								<div class="product-thumbs-wrap">
									<div class="product-thumbs">
										<div class="product-thumb active">
											<img src="<?php echo site_url('/img/products/'.$product[0]['pDp'])?>" alt="product thumbnail"
												width="109" height="122">
										</div>
										<div class="product-thumb">
											<img src="/theme/images/product/product-1-2-109x122.jpg" alt="product thumbnail"
												width="109" height="122">
										</div>
										<div class="product-thumb">
											<img src="/theme/images/product/product-1-3-109x122.jpg" alt="product thumbnail"
												width="109" height="122">
										</div>
										<div class="product-thumb">
											<img src="/theme/images/product/product-1-4-109x122.jpg" alt="product thumbnail"
												width="109" height="122">
										</div>
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

								<h1 class="product-name"><?php echo $product[0]['pName'];?></h1>
								<div class="product-meta">
									ID: <span class="product-sku"><?php echo $product[0]['pId'];?></span>
									BRAND: <span class="product-brand"></span>
								</div>
								<div class="product-price">$<?php echo $product[0]['pPrice'];?></div>
								<div class="ratings-container">
									<div class="ratings-full">
										<span class="ratings" style="width:80%"></span>
										<span class="tooltiptext tooltip-top"></span>
									</div>
									<a href="#product-tab-reviews" class="link-to-tab rating-reviews">( 11 reviews )</a>
								</div>
								<p class="product-short-desc"><?php echo $product[0]['pDescription'];?></p>
								<div class="product-form product-variations product-color">
									<label>Color:</label>
									<div class="select-box">
										<select name="color" class="form-control">
											<option value="" selected="selected">Choose an Option</option>
											<option value="white">Flat Black</option>
											<option value="black">Gloss Black</option>
											<option value="brown">White</option>
											<option value="red">Red</option>
											<option value="green">Teal</option>
											<option value="yellow">Bronze</option>
										</select>
									</div>
								</div>
								<div class="product-form product-variations product-size">
									<label>Size:</label>
									<?php $loadDimensions = getDimensions($product[0]['pId']); ?>
									<?php if (count($loadDimensions) > 0): ?>
									<div class="product-form-group">
										<div class="select-box">
											<select name="size" class="form-control">
												<option value="" selected="selected"><?php echo $loadDimensions[0]['spName'] ?></option>
												<?php $specValues = getDimensionValues($loadDimensions[0]['spId']); ?>
												
												<?php if (count($specValues) > 0): ?>
												<?php //print_r($specValues); ?>
												<?php foreach($specValues as $dimension):?>
												<option value=""><?php echo $dimension['spvName'];?> </option>
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
								</div>

								<hr class="product-divider">

								<div class="product-form product-qty">
									<div class="product-form-group">
										<div class="input-group mr-2">
											<button class="quantity-minus d-icon-minus"></button>
											<input class="quantity form-control" type="number" min="1" max="1000000">
											<button class="quantity-plus d-icon-plus"></button>
										</div>
										<a id="btn-cart" href="<?php echo '/shop/add-to-cart/'.$product[0]['pId']; ?>"
											class="btn-product text-normal ls-normal font-weight-semi-bold"><i
												class="d-icon-bag"></i>Add to
											Cart</a>
									</div>
								</div>

								<hr class="product-divider mb-3">

								<div class="product-footer">
									<div class="social-links mr-4">
										<a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
										<a href="#" class="social-link social-twitter fab fa-twitter"></a>
										<a href="#" class="social-link social-pinterest fab fa-pinterest-p"></a>
									</div>
									<span class="divider d-lg-show"></span>
									<a href="#" class="btn-product btn-wishlist mr-6"><i class="d-icon-heart"></i>Add to
										wishlist</a>
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
							<div class="product">
								<figure class="product-media">
									<a href="product.html">
										<img src="/theme/images/product/featured1.jpg" alt="product" width="280" height="315">
									</a>
									<div class="product-label-group">
										<label class="product-label label-new">new</label>
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
										<a href="shop-grid-3col.html">Clothing</a>
									</div>
									<h3 class="product-name">
										<a href="product.html">Solid Pattern in Summer Dress</a>
									</h3>
									<div class="product-price">
										<span class="price">$140.00</span>
									</div>
									<div class="ratings-container">
										<div class="ratings-full">
											<span class="ratings" style="width:100%"></span>
											<span class="tooltiptext tooltip-top"></span>
										</div>
										<a href="#" class="rating-reviews">( <span class="review-count">12</span>
											reviews
											)</a>
									</div>
								</div>
							</div>
							<div class="product">
								<figure class="product-media">
									<a href="product.html">
										<img src="/theme/images/product/featured2.jpg" alt="product" width="280" height="315">
									</a>
									<div class="product-label-group">
										<label class="product-label label-sale">27% off</label>
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
										<a href="shop-grid-3col.html">Bags & Backpacks</a>
									</div>
									<h3 class="product-name">
										<a href="product.html">Mackintosh Poket Backpack</a>
									</h3>
									<div class="product-price">
										<ins class="new-price">$125.99</ins><del class="old-price">$160.99</del>
									</div>
									<div class="ratings-container">
										<div class="ratings-full">
											<span class="ratings" style="width:60%"></span>
											<span class="tooltiptext tooltip-top"></span>
										</div>
										<a href="#" class="rating-reviews">( <span class="review-count">6</span> reviews
											)</a>
									</div>
								</div>
							</div>
							<div class="product">
								<figure class="product-media">
									<a href="product.html">
										<img src="/theme/images/product/featured3.jpg" alt="product" width="280" height="315">
									</a>
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
										<a href="shop-grid-3col.html">Clothing</a>
									</div>
									<h3 class="product-name">
										<a href="product.html">Fashionable Orginal Trucker</a>
									</h3>
									<div class="product-price">
										<span class="price">$78.64</span>
									</div>
									<div class="ratings-container">
										<div class="ratings-full">
											<span class="ratings" style="width:40%"></span>
											<span class="tooltiptext tooltip-top"></span>
										</div>
										<a href="#" class="rating-reviews">( <span class="review-count">2</span> reviews
											)</a>
									</div>
								</div>
							</div>
							<div class="product">
								<figure class="product-media">
									<a href="product.html">
										<img src="/theme/images/product/featured4.jpg" alt="product" width="280" height="315">
									</a>
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
										<a href="shop-grid-3col.html">Clothing</a>
									</div>
									<h3 class="product-name">
										<a href="product.html">Women Red Fur Overcoat</a>
									</h3>
									<div class="product-price">
										<span class="price">$184.00</span>
									</div>
									<div class="ratings-container">
										<div class="ratings-full">
											<span class="ratings" style="width:80%"></span>
											<span class="tooltiptext tooltip-top"></span>
										</div>
										<a href="#" class="rating-reviews">( <span class="review-count">6</span> reviews
											)</a>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
			</div>
		</main>