<style>
.order .order-message {
    max-width: 34rem;
    padding: 3rem;
    box-shadow: 0 5px 20px 0 rgb(0 0 0 / 10%);
    border-radius: 1rem;
},
</style>
<?php  $session = \Config\Services::session();?>
<style>
.order .order-results {
    display: flex;
    flex-wrap: wrap;
    margin: 4.8rem 0 1.9rem;
},
</style>

<style>
.order-results .overview-item span {
    text-transform: uppercase;
},
</style>

<style>
.order .overview-item strong {
    color: #222;
    font-weight: 600;
    font-size: 2rem;
}
</style>

<style>
    .order .title {
    font-size: 2rem;
}
</style>

<style>
    .order-details {
    border: 1px solid #e1e1e1;
    border-radius: 3px;
    padding: .4rem 3rem;
}
</style>

<style>
    .order .overview-item {
    display: flex;
    position: relative;
    flex-direction: column;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}
</style>

<style>
    .order .overview-item:not(:last-child)::after {
    content: '';
    position: absolute;
    right: 0;
    top: 50%;
    display: block;
    transform: translateY(-50%);
    width: 1px;
    height: 42px;
    background: #e1e1e1;
}
</style>

<style>
.order .overview-item:not(:last-child) {
    margin-right: 3rem;
    padding-right: 3.1rem;
}
</style>

<style>
.order-details-table thead .summary-subtitle {
    font-size: 1.8rem;
}
</style>

<style>
.summary-subtitle {
    font-size: 1.6rem;
    font-weight: 600;
    letter-spacing: -.01em;
    color: #222;
    margin-bottom: 0;
    padding: 2rem 0;
}
</style>

<style>
.order-details-table .product-name {
    padding: 1.6rem 0 1.8rem;
    font-size: 1.4rem;
    font-weight: 400;
    line-height: 1.42;
    color: #000;
    white-space: inherit;
}
</style>

<style>
    .order-details-table tbody tr:first-child td {
    padding-top: 3.2rem;
}
</style>

<style>
    .order-details-table .product-price {
    font-size: 1.4rem;
    color: #666;
    font-weight: 400;
    padding-top: 1.2rem;
}
</style>

<style>
    .product-price {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: block;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: .3rem;
    font-size: 1.6rem;
    font-weight: 600;
    line-height: 1.86;
    color: #222;
}
</style>

<style>
    .order-details-table .summary-subtotal-price, .order-details-table .product-price {
    text-align: right;
}
</style>

<style>
    .order-details-table .product-name span {
    font-weight: 700;
    color: #222;
}
</style>

<main class="main order">
			<div class="page-content pt-7 pb-10 mb-10">
				<div class="step-by pr-4 pl-4">
					<h3 class="title title-simple title-step"><a href="/shop/cart">1. Shopping Cart</a></h3>
					<h3 class="title title-simple title-step"><a href="/shop/checkout">2. Checkout</a></h3>
					<h3 class="title title-simple title-step active"><a href="#">3. Order Complete</a></h3>
				</div>
				<div class="container mt-8">
					<div class="order-message mr-auto ml-auto">
						<div class="icon-box d-inline-flex align-items-center">
							<div class="icon-box-icon mb-0">
                            <i style="padding-right:25px;color:#11a3bf" class="fas fa-check fa-1x"></i>
							</div>
							<div class="icon-box-content text-left">
								<h5 class="icon-box-title font-weight-bold lh-1 mb-1">Thank You!</h5>
								<p class="lh-1 ls-m">Your order has been received</p>
							</div>
						</div>
					</div>


					<div class="order-results">
						<div class="overview-item">
							<span>Order number:</span>
							<strong>
                            <?php if(isset($_SESSION['checkoutId'])):?>
								<?php echo $_SESSION['checkoutId'][0]; ?>
                            <?php endif; ?>
                            </strong>
						</div>
						<div class="overview-item">
							<span>Status:</span>
							<strong>Processing</strong>
						</div>
						<div class="overview-item">
							<span>Date:</span>
							<strong>
                            <?php if(isset($_SESSION['tempDate'])):?>
								<?php echo $_SESSION['tempDate'][0]; ?>
                            <?php endif; ?>
                            </strong>
						</div>
						<div class="overview-item">
							<span>Email:</span>
							<strong>
                            <?php if(isset($_SESSION['tempEmail'])):?>
								<?php echo $_SESSION['tempEmail'][0]; ?>
                            <?php endif; ?>
                        </strong>
						</div>
						<div class="overview-item">
							<span>Total:</span>
							<strong>
                                <?php if(isset($_SESSION['tempPrice'])):?>
                                <?php $sum = array_sum($_SESSION['tempPrice']);?>
								<?php echo '$'.$sum; ?>
                                <?php endif; ?>
                            </strong>
						</div>
						<div class="overview-item">
							<span>Payment method:</span>
							<strong>Credit Card</strong>
						</div>
					</div>

					<h2 class="title title-simple text-left pt-4 font-weight-bold text-uppercase">Order Details</h2>
					<div class="order-details">
						<table class="order-details-table">
							<thead>
								<tr class="summary-subtotal">
									<td>
										<h3 class="summary-subtitle">Product</h3>
									</td>
									<td></td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="product-name"><?php 
                                    $products = implode($_SESSION['tempOrder']);
                                    echo str_replace(";","<br><br>",$products); ?></td>
								</tr>

								<tr class="summary-subtotal">
									<td>
										<h4 class="summary-subtitle">Subtotal:</h4>
									</td>
									<td class="summary-subtotal-price">                 
                                <?php if(isset($_SESSION['tempPrice'])):?>
                                <?php $sum = array_sum($_SESSION['tempPrice']);?>
								<?php echo '$'.$sum; ?>
                                <?php endif; ?></td>
								</tr>
								<tr class="summary-subtotal">
									<td>
										<h4 class="summary-subtitle">Shipping:</h4>
									</td>
									<td class="summary-subtotal-price">Free shipping</td>
								</tr>
								<tr class="summary-subtotal">
									<td>
										<h4 class="summary-subtitle">Payment method:</h4>
									</td>
									<td class="summary-subtotal-price">Stripe Checkout</td>
								</tr>
								<tr class="summary-subtotal">
									<td>
										<h4 class="summary-subtitle">Total:</h4>
									</td>
									<td>
										<p class="summary-total-price">                              
                                <?php if(isset($_SESSION['tempPrice'])):?>
                                <?php $sum = array_sum($_SESSION['tempPrice']);?>
								<?php echo '$'.$sum; ?>
                                <?php endif; ?></td></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                    <?php $getInfo = getOrderDetails($_SESSION['checkoutId'][0]) ?>
                    <?php foreach ($getInfo as $row): ?>
					<h2 class="title title-simple text-left pt-10 mb-2">Billing Address</h2>
					<div class="address-info pb-8 mb-6">
						<p class="address-detail pb-2">
							<?php echo $row['billingFirst']; echo '&nbsp'.$row['billingLast']; ?><br>
							<?php if(isset($row['billingCompany'])) {
                                echo $row['billingCompany'].'<br>';
                            } else {
                                echo '<br>';
                            };?>
							<?php echo $row['billingAddress'] ;?> <br>
                            <?php echo $row['billingCity'].', '; echo $row['billingState']; echo ' '.$row['billingZip']?><br>
							<?php echo $row['billingPhone'] ;?>
						</p>
						<p class="email"><?php echo $row['billingEmail'] ;?></p>
					</div>
                    <?php endforeach; ?>

					<a href="/shop" class="btn btn-icon-left btn-dark btn-back btn-rounded btn-md mb-4"><i class="d-icon-arrow-left"></i> Back to List</a>
				</div>
			</div>
		</main>