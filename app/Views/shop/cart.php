<style>
.select-box select {
    height:auto!important;
}
</style>
<main class="main cart">
			<div class="page-content pt-7 pb-10">
				<div class="step-by pr-4 pl-4">
                    <h3 class="title title-simple title-step active"><a href="/shop/cart">1. Shopping Cart</a></h3>
                    <h3 class="title title-simple title-step"><a href="/shop/checkout">2. Checkout</a></h3>
					<h3 class="title title-simple title-step"><a href="/shop/order">3. Order Complete</a></h3>
				</div>
				<div class="container mt-7 mb-2">
					<div class="row">
						<div class="col-lg-8 col-md-12 pr-lg-4">
							<table class="shop-table cart-table">
								<thead>
									<tr>
										<th class="text-right"><span>Product</span></th>
										<th></th>
										<th><span>Price</span></th>
										<th><span>quantity</span></th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>
								<?php  $session = \Config\Services::session();?>
								<?php $a = -1 ?>
								<?php if (loadCart()): ?>
                                <?php $cart = loadCart() ;?>
                                <?php foreach ($cart->getResult() as $row):?>
								<?php $a++ ;?>
									
									<tr>
										<td class="product-thumbnail">
											<figure>
												<a href="product-simple.html">
													<img src="<?php echo site_url('/img/products/'.$row->pDp)?>" width="100" height="100"
														alt="product">
												</a>
											</figure>
										</td>
										<td class="product-name">
											<div style="white-space: normal;" class="product-name-section">
												<a href="#"><?php echo $row->pName; ?></a>
											</div>
										</td>
										<td class="product-subtotal">
											<span class="amount"><?php echo '$'.$_SESSION['varPrice'][$a]; ?></span>
										</td>
										<td class="product-quantity">
											<div class="input-group">
												<button class="quantity-minus d-icon-minus"></button>
												<input class="quantity form-control" type="number" min="1"
													max="1000000">
												<button class="quantity-plus d-icon-plus"></button>
											</div>
										</td>
										<td class="product-price">
											<span class="amount"></span>
										</td>
										<td class="product-close">
											<a href="#" class="product-remove" title="Remove this product">
												<i class="fas fa-times"></i>
											</a>
										</td>
									</tr>
                                    <?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
							<div class="cart-actions mb-6 pt-4">
								<a href="shop.html" class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"><i class="d-icon-arrow-left"></i>Continue Shopping</a>
								<button type="submit" class="btn btn-outline btn-dark btn-md btn-rounded btn-disabled">Update Cart</button>
							</div>
							<div class="cart-coupon-box mb-8">
								<h4 class="title coupon-title text-uppercase ls-m">Coupon Discount</h4>
								<input type="text" name="coupon_code" class="input-text form-control text-grey ls-m mb-4"
									id="coupon_code" value="" placeholder="Enter coupon code here...">
								<button type="submit" class="btn btn-md btn-dark btn-rounded btn-outline">Apply Coupon</button>
							</div>
						</div>
						<aside class="col-lg-4 sticky-sidebar-wrapper">
							<div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
								<div class="summary mb-4">
									<h3 class="summary-title text-left">Cart Totals</h3>
									<table class="shipping">
										<tr class="summary-subtotal">
											<td>
												<h4 class="summary-subtitle">Subtotal</h4>
											</td>
											<td>
												<p class="summary-subtotal-price">$<?php if(isset($_SESSION['varPrice'])):?>
                                    <?php $sum = array_sum($_SESSION['varPrice']);?>
                                    <?php echo $sum; ?>
                                    <?php else:?>
                                    <?php echo "0.00";?></span>
                                    <?php endif; ?></p>
											</td>												
										</tr>
									</table>

									<table class="total">
										<tr class="summary-subtotal">
											<td>
												<h4 class="summary-subtitle">Total</h4>
											</td>
											<td>
												<p class="summary-total-price ls-s">$<?php if(isset($_SESSION['varPrice'])):?>
                                    <?php $sum = array_sum($_SESSION['varPrice']);?>
                                    <?php echo $sum; ?>
                                    <?php else:?>
                                    <?php echo "0.00";?></span>
                                    <?php endif; ?></p>
											</td>												
										</tr>
									</table>
									<a href="/shop/checkout" class="btn btn-dark btn-rounded btn-checkout">Proceed to checkout</a>
								</div>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</main>
		<!-- End Main -->