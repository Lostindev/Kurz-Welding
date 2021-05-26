<?php if (loadCart()): ?>
                                <?php $cart = loadCart() ;?>
                                <?php foreach ($cart->getResult() as $row):?>
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
											<div class="product-name-section">
												<a href="/theme/product-simple.html"><?php echo $row->pName; ?></a>
											</div>
										</td>
										<td class="product-subtotal">
											<span class="amount">$129.99</span>
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
											<span class="amount">$129.99</span>
										</td>
										<td class="product-close">
											<a href="#" class="product-remove" title="Remove this product">
												<i class="fas fa-times"></i>
											</a>
										</td>
									</tr>
                                    <?php endforeach; ?>
									<?php endif; ?>