<?php $billingAddress = getBillingAddress(); ?>
<?php if (!empty($billingAddress)): ?>
<?php foreach($billingAddress as $bSpec): ?>
<?php endforeach; ?>
<?php endif;?>
<?php $shippingAddress = getShippingAddress(); ?>
<?php if (!empty($shippingAddress)): ?>
<?php foreach($shippingAddress as $sSpec): ?>
<?php endforeach; ?>
<?php endif;?>
<script src="https://js.stripe.com/v3/"></script>

<main class="main checkout">
			<div class="page-content pt-7 pb-10 mb-10">
				<div class="step-by pr-4 pl-4">
					<h3 class="title title-simple title-step"><a href="/shop/cart">1. Shopping Cart</a></h3>
					<h3 class="title title-simple title-step active"><a href="/shop/checkout">2. Checkout</a></h3>
					<h3 class="title title-simple title-step"><a href="#">3. Order Complete</a></h3>
				</div>
				<div class="container mt-7">
				<?php if(userLoggedIn()): ?>
                  
                <?php else:?>
					<div class="card accordion">
						<div class="alert alert-light alert-primary alert-icon mb-4 card-header">
							<i class="fas fa-exclamation-circle"></i>
							<span class="text-body">Returning customer?</span>
							<a href="#alert-body1" class="text-primary collapse">Click here to login</a>
						</div>
						<div class="alert-body collapsed" style="display:none;" id="alert-body1"> 
							<p>If you have shopped with us before, please enter your details below. 
								If you are a new customer, please proceed to the Billing section.</p>
						<form method="POST" action="/users/check-user">
							<div class="row cols-md-2">
								
									<label for="username">Username Or Email *</label>
									<input type="text" class="input-text form-control mb-0" name="email" id="email" autocomplete="email">
								
								
									<label for="password">Password *</label>
									<input class="input-text form-control mb-0" type="password" name="password" id="password" autocomplete="current-password"> 
								
							</div>
							<div class="checkbox d-flex align-items-center justify-content-between">
								<div class="form-checkbox pt-0 mb-0">
									<input type="checkbox" class="custom-checkbox" id="signin-remember"
										name="signin-remember" />
									<label class="form-control-label" for="signin-remember">Remember
										Me</label>
								</div>
								<a href="#" class="lost-link">Lost your password?</a>
							</div>
							<div class="link-group">
								<button class="btn btn-dark btn-rounded mb-4" type="submit">Login</button>
							</div>
						</form>
						</div>
					</div>
                <?php endif; ?>

					<div class="card accordion">
						<div class="alert alert-light alert-primary alert-icon mb-4 card-header">
							<i class="fas fa-exclamation-circle"></i>
							<span class="text-body">Have a coupon?</span>
							<a href="#alert-body2" class="text-primary">Click here to enter your code</a>
						</div>
						<div class="alert-body mb-4 collapsed" style="display:none;" id="alert-body2">
							<p>If you have a coupon code, please apply it below.</p>
							<div class="check-coupon-box d-flex">
								<input type="text" name="coupon_code" class="input-text form-control text-grey ls-m mr-4"
									id="coupon_code" value="" placeholder="Coupon code">
								<button type="submit" class="btn btn-dark btn-rounded btn-outline">Apply Coupon</button>
							</div>
						</div>
					</div>
					<form action="/shop/checkout-submit" method="POST" id="payment-form" class="form">
						<div class="row">
							<div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
								<h3 class="title title-simple text-left text-uppercase">Billing Details</h3>
								<div class="row">
									<div class="col-xs-6">
										<label>First Name *</label>
										<input type="text" class="form-control" name="first-name" required="" value="<?php if (isset($bSpec['bFirstName'])) echo $bSpec['bFirstName']; ?>" />
									</div>
									<div class="col-xs-6">
										<label>Last Name *</label>
										<input type="text" class="form-control" name="last-name" required="" value="<?php if (isset($bSpec['bLastName'])) echo $bSpec['bLastName']; ?>" />
									</div>
								</div>
								<label>Company Name (Optional)</label>
								<input type="text" class="form-control" name="company-name" value="<?php if (isset($bSpec['bCompany'])) echo $bSpec['bCompany']; ?>" />
								<label>Country / Region *</label>
								<div class="select-box">
										<select style="max-width: 100%;width:100%;    padding: 1rem 1.4rem .8rem;
										font-size: 1.4rem;
										color: #666;" name="country" class="form-control">
											<option value="us" selected>United States (US)</option>
											<option value="uk"> United Kingdom</option>
											<option value="fr">France</option>
											<option value="aus">Austria</option>
										</select>
									</div>
								<label>Street Address *</label>
								<input type="text" class="form-control" name="address1" required=""
									value="<?php if (isset($bSpec['bAddress'])) echo $bSpec['bAddress']; ?>" placeholder="House number and street name" />
								<input type="text" class="form-control" name="address2" value="<?php if (isset($bSpec['bApt'])) echo $bSpec['bApt']; ?>"
									placeholder="Apartment, suite, unit, etc. (optional)" />
								<div class="row">
									<div class="col-xs-6">
										<label>Town / City *</label>
										<input type="text" class="form-control" name="city" required="" value="<?php if (isset($bSpec['bCity'])) echo $bSpec['bCity']; ?>" />
									</div>
									<div class="col-xs-6">
										<label>State *</label>
										<input type="text" class="form-control" name="state" required="" value="<?php if (isset($bSpec['bState'])) echo $bSpec['bState']; ?>" />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<label>ZIP *</label>
										<input type="text" class="form-control" name="zip" required="" value="<?php if (isset($bSpec['bZip'])) echo $bSpec['bZip']; ?>" />
									</div>
									<div class="col-xs-6">
										<label>Phone *</label>
										<input type="text" class="form-control" name="phone" required="" />
									</div>
								</div>
								<label>Email Address *</label>
								<input type="text" class="form-control" name="email-address" required="" />
								<div class="form-checkbox mb-6">
									<input type="checkbox" class="custom-checkbox shipping-diff" id="different-address"
										name="different-address">
									<label class="form-control-label ls-s" for="different-address">Ship to a different
										address?</label>
								</div>
								<h2 class="title title-simple text-uppercase text-left">Additional Information</h2>
								<label>Order Notes (Optional)</label>
								<textarea name="order-notes" class="form-control pb-2 pt-2 mb-0" cols="30" rows="5"
									placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
							</div>
							<div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4 shipping_details" style="padding-top:20px;">
								<h3 class="title title-simple text-left text-uppercase">Shipping Details</h3>
								<div class="row">
									<div class="col-xs-6">
										<label>First Name *</label>
										<input type="text" class="form-control" name="shipping-first" value="<?php if (isset($sSpec['shippingFirstName'])) echo $sSpec['bFirstName']; ?>" />
									</div>
									<div class="col-xs-6">
										<label>Last Name *</label>
										<input type="text" class="form-control" name="shipping-last" value="<?php if (isset($sSpec['shippingLastName'])) echo $sSpec['shippingLastName']; ?>" />
									</div>
								</div>
								<label>Company Name (Optional)</label>
								<input type="text" class="form-control" name="shipping-company" value="<?php if (isset($sSpec['shippingCompany'])) echo $sSpec['shippingCompany']; ?>" />
								<label>Country / Region *</label>
								<div class="select-box">
										<select style="max-width: 100%;width:100%;    padding: 1rem 1.4rem .8rem;
										font-size: 1.4rem;
										color: #666;" name="shipping-country" class="form-control">
											<option value="us" selected>United States (US)</option>
											<option value="uk"> United Kingdom</option>
											<option value="fr">France</option>
											<option value="aus">Austria</option>
										</select>
									</div>
								<label>Street Address *</label>
								<input type="text" class="form-control" name="shipping-address1" 
									value="<?php if (isset($shippingSpec['shippingAddress'])) echo $shippingSpec['shippingAddress']; ?>" placeholder="House number and street name" />
								<input type="text" class="form-control" name="shipping-address2" value="<?php if (isset($shippingSpec['shippingApt'])) echo $shippingSpec['shippingApt']; ?>"
									placeholder="Apartment, suite, unit, etc. (optional)" />
								<div class="row">
									<div class="col-xs-6">
										<label>Town / City *</label>
										<input type="text" class="form-control" name="shipping-city" value="<?php if (isset($sSpec['shippingCity'])) echo $sSpec['shippingCity']; ?>" />
									</div>
									<div class="col-xs-6">
										<label>State *</label>
										<input type="text" class="form-control" name="shipping-state"  value="<?php if (isset($sSpec['shippingState'])) echo $sSpec['shippingState']; ?>" />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<label>ZIP *</label>
										<input type="text" class="form-control" name="shipping-zip"  value="<?php if (isset($sSpec['shippingZip'])) echo $sSpec['shippingZip']; ?>" />
									</div>
								</div>
							</div>
							<aside class="col-lg-5 sticky-sidebar-wrapper">
								<div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
									<div class="summary pt-5">
										<h3 class="title title-simple text-left text-uppercase">Your Order</h3>
										<table class="order-table">
											<thead>
												<tr>
													<th>Product</th>
													<th></th>
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
													<input type="hidden" name="<?php echo 'pHidden'.$a; ?>" value="<?php echo $_SESSION['varColor'][$a].', '; echo $row->pName; echo ' '.$_SESSION['varDimensions'][$a].';';  ?>"> 
													<td style="white-space: inherit!important;"class="product-name"><?php echo $_SESSION['varColor'][$a].', '; echo $row->pName; echo ', '.$_SESSION['varDimensions'][$a]; ?> <span
															class="product-quantity">×&nbsp;1</span></td>
													<td class="product-total text-body"><?php echo '$'.$_SESSION['varPrice'][$a]; ?></td>
												</tr>
												<?php endforeach; ?>
												<?php endif; ?>
												<tr class="summary-subtotal">
													<td>
														<h4 class="summary-subtitle">Subtotal</h4>
													</td>
													<td class="summary-subtotal-price pb-0 pt-0">$<?php if(isset($_SESSION['varPrice'])):?>
													<?php $sum = array_sum($_SESSION['varPrice']);?>
													<?php echo $sum; ?>
													<?php else:?>
													<?php echo "0.00";?></span>
													<?php endif; ?>
													</td>
												</tr>
												<!-- Shipping calculator 
												<tr class="sumnary-shipping shipping-row-last">
													<td colspan="2">
														<h4 class="summary-subtitle">Calculate Shipping</h4>
														<ul>
															<li>
																<div class="custom-radio">
																	<input type="radio" id="flat_rate"
																		name="shipping" class="custom-control-input" checked>
																	<label class="custom-control-label"
																		for="flat_rate">Flat rate</label>
																</div>
															</li>

															<li>
																<div class="custom-radio">
																	<input type="radio" id="free-shipping"
																		name="shipping" class="custom-control-input">
																	<label class="custom-control-label"
																		for="free-shipping">Free
																		shipping</label>
																</div>
															</li>
															
															<li>
																<div class="custom-radio">
																	<input type="radio" id="local_pickup"
																		name="shipping" class="custom-control-input">
																	<label class="custom-control-label"
																		for="local_pickup">Local pickup</label>
																</div>
															</li>
														</ul>
													</td>
												</tr>
													-->
												<tr class="summary-total">
													<td class="pb-0">
														<h4 class="summary-subtitle">Total</h4>
													</td>
													<td class=" pt-0 pb-0">
														<p class="summary-total-price ls-s text-primary"><?php if(isset($_SESSION['varPrice'])):?>
														<?php $sum = array_sum($_SESSION['varPrice']);?>
														<?php echo '$'.$sum; ?>
														<?php else:?>
														<?php echo "0.00";?></span>
														<?php endif; ?></p>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="form-checkbox mt-4 mb-5">
											<input type="checkbox" class="custom-checkbox" id="terms-condition"
												name="terms-condition" required />
											<label class="form-control-label" for="terms-condition">
												I have read and agree to the website <a href="#">terms and conditions </a>*
											</label>
										</div>

                                        <button type="submit" class="btn btn-dark btn-rounded btn-order" id="checkout-button">Place Order</button>
												
									</div>
								</div>
							</aside>
						</div>
					</form>
				</div>
			</div>
		</main>

		<script>
									  $(document).ready(function() {
										$(".shipping_details").hide();
											$(".shipping-diff").click(function() {
												if($(this).is(":checked")) {
													$(".shipping_details").show(300);
												} else {
													$(".shipping_details").hide(200);
												}
											});
									});
								</script>