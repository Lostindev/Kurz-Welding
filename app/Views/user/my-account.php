
<link rel="stylesheet" type="text/css" href="css/user/addressPopup.css">
<?php if(userLoggedIn()):?>
    <?php $userData = getUserInfo(); ?>
    <?php endif; ?>
<main class="main account">
			<nav class="breadcrumb-nav">
				<div class="container">
					<ul class="breadcrumb">
						<li><a href="/"><i class="d-icon-home"></i></a></li>
						<li>Account</li>
					</ul>
				</div>
			</nav>
			<div class="page-content mt-4 mb-10 pb-6">
				<div class="container">
					<h2 class="title title-center mb-10">My Account</h2>
					<div class="tab tab-vertical gutter-lg">
						<ul class="nav nav-tabs mb-4 col-lg-3 col-md-4" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" href="#dashboard">Dashboard</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#orders">Orders</a>
							</li>
							<!--<li class="nav-item">
								<a class="nav-link" href="#downloads">Downloads</a>
							</li>-->
							<li class="nav-item">
								<a class="nav-link" href="#address">Address</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#account">Account details</a>
							</li>
							<style>
							.tab-vertical .nav-linkk::after {
								content: '';
								display: block;
								position: absolute;
								right: 0;
								width: 2px;
								height: calc(100% - 6px);
								top: 50%;
								transform: translateY(-50%);
								background-color: transparent;
								z-index: 1;
							}
							.tab-vertical .nav-linkk {
								position: relative;
								margin-right: -2px;
								padding-left: 2rem;
								width: calc(100% + 2px);
								border: 0;
								text-align: left;
							}
							.nav-linkk {
								display: block;
								margin-bottom: -.1rem;
								padding: 1.6rem .2rem;
								font-size: 1.6rem;
								font-weight: 700;
								line-height: 1;
								letter-spacing: 0;
								text-align: center;
								border-radius: 0;
								border: 0;
								transition: border .35s, color .35s, background-color .35s;
							}
							

							</style>
							<li class="nav-item">
								<a class="nav-linkk" action="/users/log-out" href="/users/log-out">Logout</a>
							</li>
						</ul>
						<div class="tab-content col-lg-9 col-md-8">
							<div class="tab-pane active" id="dashboard">
								<p class="mb-0">
									Hello <span><?php if (isset($userData[0]['firstName'])) echo $userData[0]['firstName']; ?></span>
									 (not <span><?php if (isset($userData[0]['firstName'])) echo $userData[0]['firstName']; ?></span>? <a href="/users/log-out"
										class="text-primary">Log out</a>)
								</p>
								<p class="mb-8">
									From your account dashboard you can view your <a href="#orders"
										class="link-to-tab text-primary">recent orders</a>, manage your shipping and billing
										addresses,<br>and edit your password and account details</a>.
								</p>
								<a href="/shop" class="btn btn-dark btn-rounded">Go To Shop<i class="d-icon-arrow-right"></i></a>
							</div>
							<div class="tab-pane" id="orders">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th class="pl-2">Order</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th class="pr-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
										<?php $userId = $_SESSION['uId']; ?>
										<?php $getOrders = getUserOrders($userId); ?>
										<?php if ($getOrders == FALSE): ?>
										
											<p>You have no orders.</p>
							
										<?php else: ?>
										<?php foreach ($getOrders as $row): ?>
                                        <tr>
                                            <td class="order-number"><a href="#"><?php echo $row['tempId'] ?></a></td>
                                            <td class="order-date"><time><?php echo $row['oDate'] ?></time></td>
                                            <td class="order-status"><span><?php echo $row['oStatus'] ?></span></td>
											<?php $products = $row['oProducts'] ?>
        									<?php $order_array = explode(";", $products); ?>
        									<?php $result = count($order_array);?>
                                            <td class="order-total"><span>$<?php echo $row['oPrice'] ?></span></td>
                                            <td class="order-action"><button type="button" class="btn btn-primary btn-link btn-underline" data-toggle="modal" data-target="#exampleModalLong" >
												View
												</button></td>
                                        </tr>
										<?php endforeach; ?>
										<?php endif;?>
										
                                    </tbody>
                                </table>

							</div>
							<!--gone<div class="tab-pane" id="downloads">
								<p class="mb-4 text-body">No downloads available yet.</p>
								<a href="#" class="btn btn-primary btn-link btn-underline">Browser Products<i class="d-icon-arrow-right"></i></a>
							</div>-->
							<div class="tab-pane" id="address">
								<p class="mb-2">The following addresses will be used on the checkout page by default.
								</p>
								<div class="row">
									<div class="col-sm-6 mb-4">
										<div class="card card-address">
											<div class="card-body">
											<?php $billingAddress = getBillingAddress(); ?>
												<h5 class="card-title text-uppercase">Billing Address</h5>
												<p>
												<?php if (!empty($billingAddress)): ?>
												<?php foreach($billingAddress as $bSpec)
												{
													echo $bSpec['bFirstName']; echo '&nbsp'.$bSpec['bLastName'].'<br>';
													echo $bSpec['bCompany'].'<br>';
													echo $bSpec['bAddress'].'<br>';
													echo $bSpec['bCity'].','; echo '&nbsp'.$bSpec['bState'].'<br>';
													echo $bSpec['bCountry'].','; echo '&nbsp'.$bSpec['bZip'].'<br>';
												}
												?>
												<?php else: ?>
												You have not set up this type of address yet.
												<?php endif; ?>
												</p>
												<a href="#" id="editBilling" class="btn btn-link btn-secondary btn-underline">Edit <i
														class="far fa-edit"></i></a>
											</div>
										</div>
									</div>
									<!-- The Modal -->
									<div id="billingModal" class="modal">

									<!-- Modal content -->
									<div class="modal-content">
									<span class="close">&times;</span>
									<form action="/users/edit-billing" method="POST" class="form">
                                    <fieldset>
								
                                        <legend>Edit Billing Address</legend>
                                        <label>First Name</label>
                                        <input type="text" value="<?php if (isset($bSpec['bFirstName'])) echo $bSpec['bFirstName']; ?>" class="form-control" name="billing_first" required="">

                                        <label>Last Name</label>
                                        <input type="text" value="<?php if (isset($bSpec['bLastName'])) echo $bSpec['bLastName']; ?>" class="form-control" name="billing_last" required="">

                                        <label>Company Name</label>
                                        <input type="text" value="<?php if (isset($bSpec['bCompany'])) echo $bSpec['bCompany']; ?>" class="form-control" name="billing_company">

										<label>Street Address</label>
                                        <input type="text" value="<?php if (isset($bSpec['bAddress'])) echo $bSpec['bAddress']; ?>" class="form-control" name="billing_address">

										<label>Apartment/Suite</label>
                                        <input type="text" value="<?php if (isset($bSpec['bApt'])) echo $bSpec['bApt']; ?>" class="form-control" name="billing_apt">

										<div class="row">
										<div class="col-6">
										<label>Country</label>
                                        <select class="form-control" name="billing_country">
										<?php $country = getCountries(); ?>
										<?php foreach($country as $row)
										{
											echo '<option value="'.$row.'">'.$row.'</option>';
										}
										?>
											<?php if (isset($bSpec['bCountry'])):?>
												<option selected value="<?php if (isset($bSpec['bCountry'])) echo $bSpec['bCountry']; ?>"><?php echo $bSpec['bCountry']; ?> </option>
											<?php endif; ?>
											<option value="0">Select Country</option>
										</select>
										</div>

										<div class="col-6">
										<label>State/Province</label>
                                        <input type="text" value="<?php if (isset($bSpec['bState'])) echo $bSpec['bState']; ?>" class="form-control" name="billing_state">
										</div>

										<div class="col-6">
										<label>City</label>
                                        <input type="text" value="<?php if (isset($bSpec['bCity'])) echo $bSpec['bCity']; ?>" class="form-control" name="billing_city">
										</div>

										<div class="col-6">
										<label>Zip Code</label>
                                        <input type="text" value="<?php if (isset($bSpec['bZip'])) echo $bSpec['bZip']; ?>" class="form-control" name="billing_zip">
										</div>

										</row>
                                    </fieldset>
									<br>
									<button type="submit" class="btn btn-primary">SAVE CHANGES</button>
								</form>
									</div>

									</div>
										<div class="col-sm-6 mb-4">
										<div class="card card-address">
											<div class="card-body">
											<?php $shippingAddress = getShippingAddress(); ?>
												<h5 class="card-title text-uppercase">Shipping Address</h5>
												<p>
												<?php if (!empty($shippingAddress)): ?>
												<?php foreach($shippingAddress as $sSpec)
												{
													echo $sSpec['sFirstName']; echo '&nbsp'.$sSpec['sLastName'].'<br>';
													echo $sSpec['sCompany'].'<br>';
													echo $sSpec['sAddress'].'<br>';
													echo $sSpec['sCity'].','; echo '&nbsp'.$sSpec['sState'].'<br>';
													echo $sSpec['sCountry'].','; echo '&nbsp'.$sSpec['sZip'].'<br>';
												}
												?>
												<?php else: ?>
												You have not set up this type of address yet.
												<?php endif; ?><br>
												<a href="#" id="editShipping" class="btn btn-link btn-secondary btn-underline">Edit <i
														class="far fa-edit"></i></a>
											</div>
										</div>
									</div>

									<!-- Modal Shipping -->
									<div id="shippingModal" class="modal">

										<!-- Modal content -->
										<div class="modal-content">
										<span class="close close2">&times;</span>
										<form action="/users/edit-shipping" method="POST" class="form">
										<fieldset>

											<legend>Edit Shipping Address</legend>
											<label>First Name</label>
											<input type="text" value="<?php if (isset($sSpec['sFirstName'])) echo $sSpec['sFirstName']; ?>" class="form-control" name="shipping_first" required="">

											<label>Last Name</label>
											<input type="text" value="<?php if (isset($sSpec['sLastName'])) echo $sSpec['sLastName']; ?>" class="form-control" name="shipping_last" required="">

											<label>Company Name</label>
											<input type="text" value="<?php if (isset($sSpec['sCompany'])) echo $sSpec['sCompany']; ?>" class="form-control" name="shipping_company">

											<label>Street Address</label>
											<input type="text" value="<?php if (isset($sSpec['sAddress'])) echo $sSpec['sAddress']; ?>" class="form-control" name="shipping_address" required="">

											<label>Apartment/Suite</label>
											<input type="text" value="<?php if (isset($sSpec['sApt'])) echo $sSpec['sApt']; ?>" class="form-control" name="shipping_apt">

											<div class="row">
											<div class="col-6">
											<label>Country</label>
											<select class="form-control" name="shipping_country">
											<?php $country = getCountries(); ?>
											<?php foreach($country as $row)
											{
												echo '<option value="'.$row.'">'.$row.'</option>';
											}
											?>  
											<?php if (isset($sSpec['sCountry'])):?>
												<option selected value="<?php if (isset($sSpec['sCountry'])) echo $sSpec['sCountry']; ?>"><?php echo $sSpec['sCountry']; ?> </option>
											<?php endif; ?>
												<option value="0">Select Country</option>
											</select>
											</div>

											<div class="col-6">
											<label>State/Province</label>
											<input type="text" value="<?php if (isset($sSpec['sFirstName'])) echo $sSpec['sFirstName']; ?>" class="form-control" name="shipping_state" required="">
											</div>

											<div class="col-6">
											<label>City</label>
											<input type="text" value="<?php if (isset($sSpec['sCity'])) echo $sSpec['sCity']; ?>" class="form-control" name="shipping_city" required="">
											</div>

											<div class="col-6">
											<label>Zip Code</label>
											<input type="text" value="<?php if (isset($sSpec['sZip'])) echo $sSpec['sZip']; ?>" class="form-control" name="shipping_zip" required="">
											</div>

											</row>
										</fieldset>
										<br>
										<button type="submit" class="btn btn-primary">SAVE CHANGES</button>
										</form>
										</div>
									</div><!--End Modal 2-->


															
								</div>
							</div>
							<div class="tab-pane" id="account">
								<form action="/users/update-user" method="POST" class="form">
									<div class="row">
										<div class="col-sm-6">
											<label>First Name *</label>
											<input type="text" value="<?php if (isset($userData[0]['firstName'])) echo $userData[0]['firstName']; ?>" class="form-control" name="first_name" required="">
										</div>
										<div class="col-sm-6">
											<label>Last Name *</label>
											<input type="text" value="<?php if (isset($userData[0]['lastName'])) echo $userData[0]['lastName']; ?>" class="form-control" name="last_name" required="">
										</div>
									</div>

									<label>Email Address *</label>
									<input type="email" class="form-control" value="<?php if (isset($userData[0]['email'])) echo $userData[0]['email']; ?>" name="email" required="">
                                    <fieldset>
                                        <legend>Password Change</legend>
                                        <label>Current password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" name="current_password">

                                        <label>New password (leave blank to leave unchanged)</label>
                                        <input type="password" class="form-control" name="new_password">

                                        <label>Confirm new password</label>
                                        <input type="password" class="form-control" name="confirm_password">
                                    </fieldset>
									<br>
									<button type="submit" class="btn btn-primary">SAVE CHANGES</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<script type="text/javascript">
			// Get the <span> element that closes the modal
			var span2 = document.getElementsByClassName("close2");

			// Get the modal
			var shippingModal = document.getElementById("shippingModal");

			// When the user clicks on <span> (x), close the modal
				span2.onclick = function() {
				shippingModal.style.display = "none";
				}

			// Get the button that opens the modal
			var shippingBtn = document.getElementById("editShipping");

			// When the user clicks on the button, open the modal
			shippingBtn.onclick = function() {
			shippingModal.style.display = "block";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			if (event.target == shippingModal) {
				shippingModal.style.display = "none";
				
			}
			}
</script>
