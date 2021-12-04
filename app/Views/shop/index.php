<main class="main">
			<div class="page-header"
				style="background-image: url('/img/home/shop.jpg'); background-color: #3C63A4;">
				<h1 class="page-title">Shop</h1>
				<ul class="breadcrumb">
					<li><a href="/"><i class="d-icon-home"></i></a></li>
					<li class="delimiter">/</li>
					<li>Shop</li>
				</ul>
			</div>
			<nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="/"><i class="d-icon-home"></i></a></li>
                        <li><a href="/" class="active">Home</a></li>
                        <li>Shop</li>
                    </ul>
                </div>
            </nav>
			<!-- End PageHeader -->
			<div class="page-content mb-10 pb-3">
				<div class="container">
					<div class="row main-content-wrap gutter-lg">
						<aside
							class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
							<div class="sidebar-overlay"></div>
							<a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
							<div class="sidebar-content">
								<div class="sticky-sidebar" data-sticky-options="{'top': 10}">
									<div class="filter-actions mb-4">
										<a href="#"
											class="sidebar-toggle-btn toggle-remain btn btn-outline btn-primary btn-icon-right btn-rounded">Filter<i
												class="d-icon-arrow-left"></i></a><br>
									</div>
									<div class="widget widget-collapsible">
										<h3 class="widget-title">All Categories</h3>
										<ul class="widget-body filter-items search-ul"> 
                                            <?php $getCategories = fetchCategories(); ?>
                                            <?php if(count($getCategories) > 0):?>
                                                <?php foreach($getCategories as $category):?>
                                                <li>
                                                    <?php $cUrl = (str_replace(' ', '-', strtolower($category['cName'])));?>
                                                    <a href="<?php echo base_url('/'.'categories/'.$category['cId'].'/'.$cUrl); ?>"><?php echo $category['cName']; ?></a>

                                                    <!--Check for sub categories-->
                                                    <?php $getSubCategories = fetchSubCategories($category['cId']); ?>
                                                    <?php if(count($getSubCategories) > 0):?>
                                                        <ul>
                                                        <?php foreach($getSubCategories as $subCategory):?>
                                                            <?php $cUrl = (str_replace(' ', '-', strtolower($category['cName'])));?>
                                                            <?php $scUrl = (str_replace(' ', '-', strtolower($subCategory['scName'])));?>
                                                            <li><a href="<?php echo base_url('/'.'categories/'.$category['cId'].'/'.$cUrl.'/'.$subCategory['scId'].'/'.$scUrl.'/'); ?>"><?php echo $subCategory['scName']; ?></a></li>
                                                        <?php endforeach;?>
                                                        </ul>
                                                    <?php endif; ?>
                                                </li>
                                                <?php endforeach;?>
                                            <?php endif; ?>
										</ul>
									</div>
								</div>
							</div>
						</aside>
						<div class="col-lg-9 main-content">
							<nav class="toolbox sticky-toolbox sticky-content fix-top">
								<div class="toolbox-left">
									<a href="#"
										class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right d-lg-none">Filter<i
											class="d-icon-arrow-right"></i></a>
									<!--<div class="toolbox-item toolbox-sort select-box text-dark">
										<label>Sort By :</label>
										<select name="orderby" class="form-control">
											<option value="default">Default</option>
											<option value="popularity" selected="selected">Most Popular</option>
											<option value="rating">Average rating</option>
											<option value="date">Latest</option>
											<option value="price-low">Sort forward price low</option>
											<option value="price-high">Sort forward price high</option>
											<option value="">Clear custom sort</option>
										</select>
									</div>
								</div>
								<div class="toolbox-right">
									<div class="toolbox-item toolbox-show select-box text-dark">
										<label>Show :</label>
										<select name="count" class="form-control">
											<option value="12">12</option>
											<option value="24">24</option>
											<option value="36">36</option>
										</select>
									</div>
									<div class="toolbox-item toolbox-layout">
										<a href="shop-list.html" class="d-icon-mode-list btn-layout"></a>
										<a href="shop.html" class="d-icon-mode-grid btn-layout active"></a>
									</div>
								</div>
								-->
							</nav>
							<div class="row cols-2 cols-sm-3 product-wrapper">
                            <?php //load store products based on category?>
                            <?php $getProducts = loadStoreProducts($catId); ?>
                                <?php if(count($getProducts) > 0):?>
                                <?php foreach($getProducts as $product):?>
                                <?php $pUrl = (str_replace(' ', '-', strtolower($product['pName']))); ?>
								<div class="product-wrap">
									<div class="product">
										<figure class="product-media">
											<a href="<?php echo base_url('/shop/custom-metal-art/'.$pUrl) ; ?>">
												<img style="height:200px;width:auto;margin:auto;" src="<?php echo base_url('./img/products/'.$product['pDp']); ?>" alt="product" width="280" height="315">
											</a>
											<!--
											<div class="product-label-group">
												<label class="product-label label-sale">25% off</label>
											</div>
											<div class="product-action-vertical">
												<a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
													data-target="#addCartModal" title="Add to cart"><i
														class="d-icon-bag"></i></a>
												<a href="#" class="btn-product-icon btn-wishlist"
													title="Add to wishlist"><i class="d-icon-heart"></i></a>
											</div>-->
											<div class="product-action">
												<a href="<?php echo base_url('/shop/custom-metal-art/'.$pUrl) ; ?>" class="btn-product" title="Quick View">View</a>
											</div>
										</figure>
										<div class="product-details">
											<div class="product-cat">
												<a href="#">Custom Metal Art</a>
											</div>
											<h3 class="product-name">
												<a href="<?php echo base_url('/shop/custom-metal-art/'.$pUrl) ; ?>"><?php echo $product['pName'];?></a>
											</h3>
											<div class="product-price">
											<?php  $lightPrice =  $product['pPrice']*1.25  ?>
												<ins class="new-price">$<?php echo $product['pPrice'];?></ins><del class="old-price">$<?php echo $lightPrice ?></del>
											</div>
											<div class="ratings-container">
												<div class="ratings-full">
													<span class="ratings" style="width:100%"></span>
													<span class="tooltiptext tooltip-top"></span>
												</div>
												<a href="#" class="rating-reviews">( 4+ reviews )</a>
											</div>
										</div>
									</div>
								</div>
                                <?php endforeach; ?>
                                <?php endif; ?>
								</div>
							</div><!--
							<nav class="toolbox toolbox-pagination">
								<p class="show-info">Showing <span>12 of 56</span> Products</p>
                                
							</nav>-->
						</div>
					</div>
				</div>
			</div>
		</main>