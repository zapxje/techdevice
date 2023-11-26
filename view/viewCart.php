<div class="untree_co-section before-footer-section">
	<div class="container">
		<div class="row mb-5">
			<form class="col-md-12" method="post">
				<div class="site-blocks-table">
					<?php if (empty($_SESSION['cart'])) : ?>
						<p>Trống</p>
					<?php else : ?>
						<table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Hình ảnh</th>
									<th class="product-name">Sản phẩm</th>
									<th class="product-price">Đơn giá</th>
									<th class="product-quantity">Số lượng</th>
									<th class="product-total">Tổng</th>
									<th class="product-remove">Xóa</th>
								</tr>
							</thead>
							<tbody class="view-cart">

								<?php foreach ($_SESSION['cart'] as $product) : ?>
									<tr class="listProduct">
										<td class="product-thumbnail">
											<img src="view/assets/img/product/<?= $product[3] ?>" alt="Image" class="img-fluid">
										</td>
										<td class="product-name w-50">
											<h4 class=" text-black name"><?= mb_strimwidth($product[1], 0, 80, "...")  ?></h4>
										</td>
										<td class="price "><?= number_format($product[2], 0, ',', '.') ?>đ</td>
										<td>
											<div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
												<div class="input-group-prepend">
													<button class="btn decrease" type="button">&minus;</button>
												</div>
												<input type="text" class=" text-center quantity-amount" value="<?= $product[4] ?>">
												<div class="input-group-append">
													<button class="btn increase" type="button">&plus;</button>
												</div>
											</div>

										</td>
										<td class="total" class="h6"><?= $product[2] * $product[4] ?></td>
										<td><a href="index.php?act=delToViewCart&id=<?= $product[0] ?>" class="btn btn-black  close"><i class="fa-solid fa-xmark"></i></a></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
			</form>
		</div>

		<div class="row sub-cart">
			<div class="col-md-6 ">
				<div class="row mb-5">

					<div class="col-md-6">
						<a href="?act=products"><button class="primary-btn order-submit">Continue Shopping</button></a>
					</div>
				</div>
				<div class="row coupon">
					<div class="col-md-12">
						<label class="text-black h4" for="coupon">Coupon</label>
						<p>Enter your coupon code if you have one.</p>
					</div>
					<div class="col-md-8 mb-3 mb-md-0">
						<input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
					</div>
					<div class="col-md-4">
						<button class="primary-btn order-submit" id="apply">Apply Coupon</button>
					</div>
				</div>
			</div>
			<div class="col-md-6 pl-5">
				<div class="row cart__total">
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-12 text-right border-bottom mb-5">
								<h3 class="text-black h4 text-uppercase">Cart Totals</h3>
							</div>
						</div>
						<div class="row mb-3 cart__total-sub ">
							<div class="col-md-6">
								<span class="text-black">Subtotal</span>
							</div>
							<div class="col-md-6 text-right">
								<strong class="text-black" id="subTotal"></strong>
							</div>
						</div>
						<div class="row mb-5 cart__total-main ">
							<div class="col-md-6">
								<span class="text-black">Total</span>
							</div>
							<div class="col-md-6 text-right">
								<strong class="text-black" id="priceTotal"></strong>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<a href="index.php?act=checkout" id="checkoutBtn" class="primary-btn order-submit">
									Proceed To Checkout
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>