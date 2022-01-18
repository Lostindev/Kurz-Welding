<?php $billingAddress = getBillingAddress(); ?>
<?php if (!empty($billingAddress)) : ?>
	<?php foreach ($billingAddress as $bSpec) : ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php $shippingAddress = getShippingAddress(); ?>
<?php if (!empty($shippingAddress)) : ?>
	<?php foreach ($shippingAddress as $sSpec) : ?>
	<?php endforeach; ?>
<?php endif; ?>

<?php $userInfo = getUserInfo(); ?>
<?php if (!empty($userInfo)) : ?>
	<?php foreach ($userInfo as $user) : ?>
	<?php endforeach; ?>
<?php endif; ?>

<script src="https://js.stripe.com/v3/"></script>

<main class="main checkout">
	<div class="page-content pt-7 pb-10 mb-10">
		<div class="step-by pr-4 pl-4">
			<h3 class="title title-simple title-step"><a href="/shop/cart">1. Shopping Cart</a></h3>
			<h3 class="title title-simple title-step active"><a href="/shop/checkout">2. Checkout</a></h3>
			<h3 class="title title-simple title-step"><a href="#">3. Order Complete</a></h3>
		</div>
		<div class="container mt-7">
<!--Coupon Section
			<div class="card accordion">
				<div class="alert alert-light alert-primary alert-icon mb-4 card-header">
					<i class="fas fa-exclamation-circle"></i>
					<span class="text-body">Have a coupon?</span>
					<a href="#alert-body2" class="text-primary">Click here to enter your code</a>
				</div>
				<div class="alert-body mb-4 collapsed" style="display:none;" id="alert-body2">
					<p>If you have a coupon code, please apply it below.</p>
					<div class="check-coupon-box d-flex">
						<input type="text" name="coupon_code" class="input-text form-control text-grey ls-m mr-4" id="coupon_code" value="" placeholder="Coupon code">
						<button type="submit" class="btn btn-dark btn-rounded btn-outline">Apply Coupon</button>
					</div>
				</div>
			</div>
-->
			<form action="<?= base_url() ?>/shop/checkout_submit" method="POST" id="payment-form" class="form">
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
						<input type="hidden" value="" id="country-billing" name="country-billing"/>
						<div class="select-box">
							<select style="max-width: 100%;width:100%;    padding: 1rem 1.4rem .8rem;
										font-size: 1.4rem;
										color: #666;" name="country" id="country" class="form-control">
								<option value="60">Canada</option>
								<option value="45" selected>United States</option>
								<option value="90">United Kingdom</option>
								<option value="95">France</option>
								<option value="55">Austria</option>
								<option value="65">Mexico</option>
								
							</select>
						</div>
						<label>Street Address *</label>
						<input type="text" class="form-control" name="address1" required="" value="<?php if (isset($bSpec['bAddress'])) echo $bSpec['bAddress']; ?>" placeholder="House number and street name" />
						<input type="text" class="form-control" name="address2" value="<?php if (isset($bSpec['bApt'])) echo $bSpec['bApt']; ?>" placeholder="Apartment, suite, unit, etc. (optional)" />
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
						<input type="text" class="form-control" name="email-address" value="<?php if (isset($user['email'])) echo $user['email']; ?>" required="" />
						<div class="form-checkbox mb-6">
							<input type="checkbox" class="custom-checkbox shipping-diff" id="different-address" name="different-address">
							<label class="form-control-label ls-s" for="different-address">Ship to a different
								address?</label>
						</div>
						<h2 class="title title-simple text-uppercase text-left">Additional Information</h2>
						<label>Order Notes (Optional)</label>
						<textarea name="order-notes" class="form-control pb-2 pt-2 mb-0" cols="30" rows="5" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
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
						<input type="hidden" name="shipping-country" id="shipping-country" value=""></input>
						<div class="select-box">
							<select style="max-width: 100%;width:100%;    padding: 1rem 1.4rem .8rem;
										font-size: 1.4rem;
										color: #666;" id="countryShip" name="countryShip" class="form-control">
								<option value="60">Canada</option>
								<option value="45" selected>United States</option>
								<option value="63">United Kingdom</option>
								<option value="66">France</option>
								<option value="55">Austria</option>
								<option value="65">Mexico</option>
							</select>
						</div>
						<label>Street Address *</label>
						<input type="text" class="form-control" name="shipping-address1" value="<?php if (isset($shippingSpec['shippingAddress'])) echo $shippingSpec['shippingAddress']; ?>" placeholder="House number and street name" />
						<input type="text" class="form-control" name="shipping-address2" value="<?php if (isset($shippingSpec['shippingApt'])) echo $shippingSpec['shippingApt']; ?>" placeholder="Apartment, suite, unit, etc. (optional)" />
						<div class="row">
							<div class="col-xs-6">
								<label>Town / City *</label>
								<input type="text" class="form-control" name="shipping-city" value="<?php if (isset($sSpec['shippingCity'])) echo $sSpec['shippingCity']; ?>" />
							</div>
							<div class="col-xs-6">
								<label>State *</label>
								<input type="text" class="form-control" name="shipping-state" value="<?php if (isset($sSpec['shippingState'])) echo $sSpec['shippingState']; ?>" />
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<label>ZIP *</label>
								<input type="text" class="form-control" name="shipping-zip" value="<?php if (isset($sSpec['shippingZip'])) echo $sSpec['shippingZip']; ?>" />
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
										<?php


										$session = \Config\Services::session();

										$varDimensions = array_values($_SESSION['varDimensions']);
										$varPrice = array_values($_SESSION['varPrice']);
										$varColor = array_values($_SESSION['varColor']);
										
										$colorName = array_values($_SESSION['varColorName']);
										$sizeName = array_values($_SESSION['varDimensionName']);
										?>
										<?php $a = -1 ?>
										<?php if (loadCart()) : ?> 
											<?php $cart = loadCart(); ?>
											<?php foreach ($cart->getResult() as $row) : ?>
												<?php $a++; ?>
												<tr>
													<input type="hidden" name="pHidden<?= $a ?>" value="<?php echo $colorName[$a] ;
														echo $row->pName . '&nbsp'; echo $sizeName[$a] ?>">
													<input type="hidden" name="<?php echo 'cHidden' . $a; ?>" value="<?php echo $_SESSION['varCustom'][$a] . ';';  ?>">
													<td style="white-space: inherit!important;" class="product-name">
													<?php echo $colorName[$a] ;
													echo $row->pName;
													?> <span class="product-quantity">×&nbsp;<?= $_SESSION["quantity"][$row->pId] ?></span></td>
													<td class="product-total text-body"><?php echo '$' . $varPrice[$a] * $_SESSION["quantity"][$row->pId] ?></td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
										<tr class="summary-subtotal">
											<td>
												<h4 class="summary-subtitle">Subtotal</h4>
											</td>
											<td class="summary-subtotal-price pb-0 pt-0"><?php if (isset($_SESSION['varPrice'])) : ?>
												<?php 
												    $sum = 0;
													foreach ($_SESSION['varPrice'] as $k => $price) {
														$sum += $price * $_SESSION["quantity"][$k];
														// echo $k;
													} ?>
												<?php echo $sum; ?>
											<?php else : ?>
												<?php echo "0.00"; ?></span>
											<?php endif; ?>
											</td>
										</tr>
												<tr class="sumnary-shipping shipping-row-last">
													<td colspan="2">
														<h4 class="summary-subtitle">Calculate Shipping</h4>
														<ul >
															<li>
																<div class="custom-radio">
																	<input type="radio" id="flat_rate"
																		name="shipping" class="custom-control-input" checked>
																	<label id="total-price-ship" class="custom-control-label"
																		for="flat_rate">
																		<?php if (isset($_SESSION['varPrice'])) : ?>
																		<?php 
																			$sum = 0;
																			foreach ($_SESSION['varPrice'] as $k => $price) {
																				$sum += $price * $_SESSION["quantity"][$k];
																				// echo $k;
																			} ?>
																			<?php $shipVar = $sum * .20 + 45; ?>
																		<?php echo '$' .  $shipVar; ?>
																	<?php else : ?>
																		<?php echo "0.00"; ?></span>
																	<?php endif; ?>
																		
																		Flat rate Shipping</label>
																</div>
															</li>
														<!--
															<li>
																<div class="custom-radio">
																	<input type="radio" id="free-shipping"
																		name="shipping" class="custom-control-input">
																	<label class="custom-control-label"
																		for="free-shipping">Free
																		shipping</label>
																</div>
															</li>
														-->
														</ul>
													</td>
												</tr>
												
										<tr class="summary-total">
											<td class="pb-0">
												<h4 class="summary-subtitle">Total</h4>
											</td>
											<td class=" pt-0 pb-0">
												<p class="summary-total-price ls-s text-primary"><?php if (isset($_SESSION['varPrice'])) : ?>
													<?php
																				$sum = 0;
																				foreach ($_SESSION['varPrice'] as $k => $price) {
																					$sum += $price * $_SESSION["quantity"][$k];
																				}
													?>
														<?php echo '$' . $sum+$shipVar; ?>
													<?php else : ?>
														<?php echo "0.00"; ?></span>
													<?php endif; ?></p>
											</td>
										</tr>
									</tbody>
								</table>
								<div class="form-checkbox mt-4 mb-5">
									<input type="checkbox" class="custom-checkbox" id="terms-condition" name="terms-condition" required />
									<label class="form-control-label" for="terms-condition">
										I have read and agree to the website <a href="/home/terms-and-conditions" target="_BLANK">terms and conditions </a>*
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
			if ($(this).is(":checked")) {
				$(".shipping_details").show(300);
			} else {
				$(".shipping_details").hide(200);
			}
		});
	});
</script>

<script>
$('#country').change(function()
    {
        var selected = $(this).find('option:selected').text();
        $('input[name="country-billing"]').val(selected);

		var subTotal = parseInt($(".summary-subtotal-price").text());
		var countryVal = parseInt($("#country option:selected").val());

		var percentAmt = subTotal*.20;

		var shipTotal = countryVal+percentAmt;
		
		var finalTotal = subTotal+shipTotal;

		$("#total-price-ship").text('$'+shipTotal+' Flat Rate Shipping');
		$(".summary-total-price").text('$'+finalTotal);

		

    });

$('#countryShip').change(function()
{
    var selected = $(this).find('option:selected').text();	 
    $('input[name="shipping-country"]').val(selected);
 });

</script>