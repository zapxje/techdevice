<div class="untree_co-section before-footer-section">
	<div class="container">
		<div class="row mb-5">
			<form class="col-md-12" method="post">
				<div class="site-blocks-table">
					<table class="table">
						<thead>
							<tr>
								<th class="product-thumbnail">Image</th>
								<th class="product-name">Product</th>
								<th class="product-price">Price</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-total">Total</th>
								<th class="product-remove">Remove</th>
							</tr>
						</thead>
						<tbody class="view-cart" >
							
						</tbody>
					</table>
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