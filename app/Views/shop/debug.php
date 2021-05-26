<table class="shop-table cart-table">
								<thead>
									<tr>
										<th><span>Product</span></th>
										<th></th>
										<th><span>Price</span></th>
										<th><span>quantity</span></th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>
								<?php if (loadCart2()): ?>
                                <?php $cart = loadCart2() ;?>
                                <?php foreach ($cart as $row):?>
									<tr>
										<td class="product-thumbnail">
											<figure>
												<a href="product-simple.html">
													<img src="<?php echo site_url('/img/products/'.$row[0]['pDp']);?>" width="100" height="100"
														alt="product">
												</a>
											</figure>
										</td>
										<td class="product-name">
											<div class="product-name-section">
												<a href="/theme/product-simple.html"><?php echo $row[0]['pName']; ?></a>
											</div>
										</td>
										<td class="product-subtotal">
											<span class="amount"><?php echo $row[0]['pName']; ?></span>
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
											<span class="amount"><?php echo $row[0]['pPrice'][0]; ?></span>
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