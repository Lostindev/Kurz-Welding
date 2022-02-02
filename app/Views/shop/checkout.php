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
								<option value="25" selected>United States</option>
								<option value="33">Canada</option>
								<option disabled="disabled" value="---">---</option>
								<option value="30">Afghanistan</option>
								<option value="63">Albania</option>
								<option value="80">Algeria</option>
								<option value="40">Andorra</option>
								<option value="51">Angola</option>
								<option value="45">Antigua and Barbuda</option>
								<option value="38">Argentina</option>
								<option value="60">Armenia</option>
								<option value="45">Aruba</option>
								<option value="33">Australia</option>
								<option value="39">Austria</option>
								<option value="56">Azerbaijan</option>
								<option value="45">Bahamas</option>
								<option value="42">Bahrain</option>
								<option value="40">Bangladesh</option>
								<option value="50">Barbados</option>
								<option value="56">Belarus</option>
								<option value="38">Belgium</option>
								<option value="55">Belize</option>
								<option value="55">Benin</option>
								<option value="50">Bermuda</option>
								<option value="52">Bhutan</option>
								<option value="56">Bolivia</option>
								<option value="52">Bosnia &amp; Herzegovina</option>
								<option value="50">Botswana</option>
								<option value="40">Brazil</option>
								<option value="49">British Indian Ocean Territory</option>
								<option value="90">Brunei</option>
								<option value="40">Bulgaria</option>
								<option value="55">Burkina Faso</option>
								<option value="55">Burundi</option>
								<option value="KH">Cambodia</option>
								<option value="CM">Cameroon</option>
								<option value="CV">Cape Verde</option>
								<option value="BQ">Caribbean Netherlands</option>
								<option value="KY">Cayman Islands</option>
								<option value="CF">Central African Republic</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CN">China</option>
								<option value="CX">Christmas Island</option>
								<option value="CC">Cocos (Keeling) Islands</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros</option>
								<option value="CG">Congo - Brazzaville</option>
								<option value="CD">Congo - Kinshasa</option>
								<option data-code="CK" value="Cook Islands">Cook Islands</option>
								<option data-code="CR" value="Costa Rica">Costa Rica</option>
								<option data-code="HR" value="Croatia">Croatia</option>
								<option data-code="CW" value="Curaçao">Curaçao</option>
								<option data-code="CY" value="Cyprus">Cyprus</option>
								<option data-code="CZ" value="Czech Republic">Czechia</option>
								<option data-code="CI" value="Côte d'Ivoire">Côte d’Ivoire</option>
								<option data-code="DK" value="Denmark">Denmark</option>
								<option data-code="DJ" value="Djibouti">Djibouti</option>
								<option data-code="DM" value="Dominica">Dominica</option>
								<option data-code="DO" value="Dominican Republic">Dominican Republic</option>
								<option data-code="EC" value="Ecuador">Ecuador</option>
								<option data-code="EG" value="Egypt">Egypt</option>
								<option data-code="SV" value="El Salvador">El Salvador</option>
								<option data-code="GQ" value="Equatorial Guinea">Equatorial Guinea</option>
								<option data-code="ER" value="Eritrea">Eritrea</option>
								<option data-code="EE" value="Estonia">Estonia</option>
								<option data-code="SZ" value="Eswatini">Eswatini</option>
								<option data-code="ET" value="Ethiopia">Ethiopia</option>
								<option data-code="FK" value="Falkland Islands (Malvinas)">Falkland Islands</option>
								<option data-code="FO" value="Faroe Islands">Faroe Islands</option>
								<option data-code="FJ" value="Fiji">Fiji</option>
								<option data-code="FI" value="Finland">Finland</option>
								<option data-code="FR" value="France">France</option>
								<option data-code="GF" value="French Guiana">French Guiana</option>
								<option data-code="PF" value="French Polynesia">French Polynesia</option>
								<option data-code="TF" value="French Southern Territories">French Southern Territories</option>
								<option data-code="GA" value="Gabon">Gabon</option>
								<option data-code="GM" value="Gambia">Gambia</option>
								<option data-code="GE" value="Georgia">Georgia</option>
								<option data-code="DE" value="Germany">Germany</option>
								<option data-code="GH" value="Ghana">Ghana</option>
								<option data-code="GI" value="Gibraltar">Gibraltar</option>
								<option data-code="GR" value="Greece">Greece</option>
								<option data-code="GL" value="Greenland">Greenland</option>
								<option data-code="GD" value="Grenada">Grenada</option>
								<option data-code="GP" value="Guadeloupe">Guadeloupe</option>
								<option data-code="GT" value="Guatemala">Guatemala</option>
								<option data-code="GG" value="Guernsey">Guernsey</option>
								<option data-code="GN" value="Guinea">Guinea</option>
								<option data-code="GW" value="Guinea Bissau">Guinea-Bissau</option>
								<option data-code="GY" value="Guyana">Guyana</option>
								<option data-code="HT" value="Haiti">Haiti</option>
								<option data-code="HN" value="Honduras">Honduras</option>
								<option data-code="HK" value="Hong Kong">Hong Kong SAR</option>
								<option data-code="HU" value="Hungary">Hungary</option>
								<option data-code="IS" value="Iceland">Iceland</option>
								<option data-code="IN" value="India">India</option>
								<option data-code="ID" value="Indonesia">Indonesia</option>
								<option data-code="IQ" value="Iraq">Iraq</option>
								<option data-code="IE" value="Ireland">Ireland</option>
								<option data-code="IM" value="Isle Of Man">Isle of Man</option>
								<option data-code="IL" value="Israel">Israel</option>
								<option data-code="IT" value="Italy">Italy</option>
								<option data-code="JM" value="Jamaica">Jamaica</option>
								<option data-code="JP" value="Japan">Japan</option>
								<option data-code="JE" value="Jersey">Jersey</option>
								<option data-code="JO" value="Jordan">Jordan</option>
								<option data-code="KZ" value="Kazakhstan">Kazakhstan</option>
								<option data-code="KE" value="Kenya">Kenya</option>
								<option data-code="KI" value="Kiribati">Kiribati</option>
								<option data-code="XK" value="Kosovo">Kosovo</option>
								<option data-code="KW" value="Kuwait">Kuwait</option>
								<option data-code="KG" value="Kyrgyzstan">Kyrgyzstan</option>
								<option data-code="LA" value="Lao People's Democratic Republic">Laos</option>
								<option data-code="LV" value="Latvia">Latvia</option>
								<option data-code="LB" value="Lebanon">Lebanon</option>
								<option data-code="LS" value="Lesotho">Lesotho</option>
								<option data-code="LR" value="Liberia">Liberia</option>
								<option data-code="LY" value="Libyan Arab Jamahiriya">Libya</option>
								<option data-code="LI" value="Liechtenstein">Liechtenstein</option>
								<option data-code="LT" value="Lithuania">Lithuania</option>
								<option data-code="LU" value="Luxembourg">Luxembourg</option>
								<option data-code="MO" value="Macao">Macao SAR</option>
								<option data-code="MG" value="Madagascar">Madagascar</option>
								<option data-code="MW" value="Malawi">Malawi</option>
								<option data-code="MY" value="Malaysia">Malaysia</option>
								<option data-code="MV" value="Maldives">Maldives</option>
								<option data-code="ML" value="Mali">Mali</option>
								<option data-code="MT" value="Malta">Malta</option>
								<option data-code="MQ" value="Martinique">Martinique</option>
								<option data-code="MR" value="Mauritania">Mauritania</option>
								<option data-code="MU" value="Mauritius">Mauritius</option>
								<option data-code="YT" value="Mayotte">Mayotte</option>
								<option data-code="MX" value="Mexico">Mexico</option>
								<option data-code="MD" value="Moldova, Republic of">Moldova</option>
								<option data-code="MC" value="Monaco">Monaco</option>
								<option data-code="MN" value="Mongolia">Mongolia</option>
								<option data-code="ME" value="Montenegro">Montenegro</option>
								<option data-code="MS" value="Montserrat">Montserrat</option>
								<option data-code="MA" value="Morocco">Morocco</option>
								<option data-code="MZ" value="Mozambique">Mozambique</option>
								<option data-code="MM" value="Myanmar">Myanmar (Burma)</option>
								<option data-code="NA" value="Namibia">Namibia</option>
								<option data-code="NR" value="Nauru">Nauru</option>
								<option data-code="NP" value="Nepal">Nepal</option>
								<option data-code="NL" value="Netherlands">Netherlands</option>
								<option data-code="NC" value="New Caledonia">New Caledonia</option>
								<option data-code="NZ" value="New Zealand">New Zealand</option>
								<option data-code="NI" value="Nicaragua">Nicaragua</option>
								<option data-code="NE" value="Niger">Niger</option>
								<option data-code="NG" value="Nigeria">Nigeria</option>
								<option data-code="NU" value="Niue">Niue</option>
								<option data-code="NF" value="Norfolk Island">Norfolk Island</option>
								<option data-code="MK" value="North Macedonia">North Macedonia</option>
								<option data-code="NO" value="Norway">Norway</option>
								<option data-code="OM" value="Oman">Oman</option>
								<option data-code="PK" value="Pakistan">Pakistan</option>
								<option data-code="PS" value="Palestinian Territory, Occupied">Palestinian Territories</option>
								<option data-code="PA" value="Panama">Panama</option>
								<option data-code="PG" value="Papua New Guinea">Papua New Guinea</option>
								<option data-code="PY" value="Paraguay">Paraguay</option>
								<option data-code="PE" value="Peru">Peru</option>
								<option data-code="PH" value="Philippines">Philippines</option>
								<option data-code="PN" value="Pitcairn">Pitcairn Islands</option>
								<option data-code="PL" value="Poland">Poland</option>
								<option data-code="PT" value="Portugal">Portugal</option>
								<option data-code="QA" value="Qatar">Qatar</option>
								<option data-code="RE" value="Reunion">Réunion</option>
								<option data-code="RO" value="Romania">Romania</option>
								<option data-code="RU" value="Russia">Russia</option>
								<option data-code="RW" value="Rwanda">Rwanda</option>
								<option data-code="WS" value="Samoa">Samoa</option>
								<option data-code="SM" value="San Marino">San Marino</option>
								<option data-code="ST" value="Sao Tome And Principe">São Tomé &amp; Príncipe</option>
								<option data-code="SA" value="Saudi Arabia">Saudi Arabia</option>
								<option data-code="SN" value="Senegal">Senegal</option>
								<option data-code="RS" value="Serbia">Serbia</option>
								<option data-code="SC" value="Seychelles">Seychelles</option>
								<option data-code="SL" value="Sierra Leone">Sierra Leone</option>
								<option data-code="SG" value="Singapore">Singapore</option>
								<option data-code="SX" value="Sint Maarten">Sint Maarten</option>
								<option data-code="SK" value="Slovakia">Slovakia</option>
								<option data-code="SI" value="Slovenia">Slovenia</option>
								<option data-code="SB" value="Solomon Islands">Solomon Islands</option>
								<option data-code="SO" value="Somalia">Somalia</option>
								<option data-code="ZA" value="South Africa">South Africa</option>
								<option data-code="GS" value="South Georgia And The South Sandwich Islands">South Georgia &amp; South Sandwich Islands</option>
								<option data-code="KR" value="South Korea">South Korea</option>
								<option data-code="SS" value="South Sudan">South Sudan</option>
								<option data-code="ES" value="Spain">Spain</option>
								<option data-code="LK" value="Sri Lanka">Sri Lanka</option>
								<option data-code="BL" value="Saint Barthélemy">St. Barthélemy</option>
								<option data-code="SH" value="Saint Helena">St. Helena</option>
								<option data-code="KN" value="Saint Kitts And Nevis">St. Kitts &amp; Nevis</option>
								<option data-code="LC" value="Saint Lucia">St. Lucia</option>
								<option data-code="MF" value="Saint Martin">St. Martin</option>
								<option data-code="PM" value="Saint Pierre And Miquelon">St. Pierre &amp; Miquelon</option>
								<option data-code="VC" value="St. Vincent">St. Vincent &amp; Grenadines</option>
								<option data-code="SD" value="Sudan">Sudan</option>
								<option data-code="SR" value="Suriname">Suriname</option>
								<option data-code="SJ" value="Svalbard And Jan Mayen">Svalbard &amp; Jan Mayen</option>
								<option data-code="SE" value="Sweden">Sweden</option>
								<option data-code="CH" value="Switzerland">Switzerland</option>
								<option data-code="TW" value="Taiwan">Taiwan</option>
								<option data-code="TJ" value="Tajikistan">Tajikistan</option>
								<option data-code="TZ" value="Tanzania, United Republic Of">Tanzania</option>
								<option data-code="TH" value="Thailand">Thailand</option>
								<option data-code="TL" value="Timor Leste">Timor-Leste</option>
								<option data-code="TG" value="Togo">Togo</option>
								<option data-code="TK" value="Tokelau">Tokelau</option>
								<option data-code="TO" value="Tonga">Tonga</option>
								<option data-code="TT" value="Trinidad and Tobago">Trinidad &amp; Tobago</option>
								<option data-code="TA" value="Tristan da Cunha">Tristan da Cunha</option>
								<option data-code="TN" value="Tunisia">Tunisia</option>
								<option data-code="TR" value="Turkey">Turkey</option>
								<option data-code="TM" value="Turkmenistan">Turkmenistan</option>
								<option data-code="TC" value="Turks and Caicos Islands">Turks &amp; Caicos Islands</option>
								<option data-code="TV" value="Tuvalu">Tuvalu</option>
								<option data-code="UM" value="United States Minor Outlying Islands">U.S. Outlying Islands</option>
								<option data-code="UG" value="Uganda">Uganda</option>
								<option data-code="UA" value="Ukraine">Ukraine</option>
								<option data-code="AE" value="United Arab Emirates">United Arab Emirates</option>
								<option data-code="GB" value="United Kingdom">United Kingdom</option>
								<option data-code="US" value="United States">United States</option>
								<option data-code="UY" value="Uruguay">Uruguay</option>
								<option data-code="UZ" value="Uzbekistan">Uzbekistan</option>
								<option data-code="VU" value="Vanuatu">Vanuatu</option>
								<option data-code="VA" value="Holy See (Vatican City State)">Vatican City</option>
								<option data-code="VE" value="Venezuela">Venezuela</option>
								<option data-code="VN" value="Vietnam">Vietnam</option>
								<option data-code="WF" value="Wallis And Futuna">Wallis &amp; Futuna</option>
								<option data-code="EH" value="Western Sahara">Western Sahara</option>
								<option data-code="YE" value="Yemen">Yemen</option>
								<option data-code="ZM" value="Zambia">Zambia</option>
								<option data-code="ZW" value="Zimbabwe">Zimbabwe</option>




								<option value="63">United Kingdom</option>
								<option value="66">France</option>
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
								<option value="45" selected>United States</option>
								<option value="84">Afghanistan</option>
								<option value="70">Albania</option>
								<option value="80">Algeria</option>
								<option value="64">Andorra</option>
								<option value="68">Angola</option>
								<option value="69">Antigua and Barbuda</option>
								<option value="60">Canada</option>
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
														<ul style="list-style-type:none;" >
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
																			<?php $shipVar = $sum * .10 + 45; ?>
																		<?php echo '$' .  $shipVar; ?>
																	<?php else : ?>
																		<?php echo "0.00"; ?></span>
																	<?php endif; ?>
																		
																		Flat Rate Shipping</label>
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