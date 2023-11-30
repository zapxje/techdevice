<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li class="active">Sản Phẩm</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Danh mục sản phẩm</h3>
					<div class="checkbox-filter ">
						<?php foreach ($listCategories as $category) : ?>
							<div class="input-checkbox">
								<input type="checkbox" id="<?= $category['name'] ?>" value="<?= $category['id'] ?>">
								<label for="<?= $category['name'] ?>">
									<span></span>
									<?= $category['name'] ?>
									<small>(<?= count(getProductByCategory($category['id'])) ?>)</small>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<!-- <div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div id="price-slider"></div>
						<div class="input-number price-min">
							<input id="price-min" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div> -->
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Thương hiệu</h3>
					<div class="checkbox-filter">
						<?php foreach ($listBrands as $brand) : ?>
							<div class="input-checkbox">
								<input type="checkbox" id="brand-1">
								<label for="brand-1">
									<span></span>
									<?= $brand['name'] ?>
									<small>(<?= count(getProductByBrand($brand['id'])) ?>)</small>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Top selling</h3>
					<?php
					$listProductByTop = getProductTopselling();
					foreach ($listProductByTop as $product) : ?>
						<a href="">
							<div class="product-widget">
								<div class="product-img">
									<img src="view/assets/img/product/<?= $product['image'] ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-name"><a href="#"><?= mb_strimwidth($product['name'], 0, 40, "...") ?></a></h3>
									<p class="product-category"><?= $product['category_name'] ?> | <?= $product['brand_name'] ?></p>
									<h4 class="product-price">
										<?= $product['price_sale'] > 0 ? number_format($product['price_sale'], 0, ',', '.') : number_format($product['price'], 0, ',', '.') ?>
										<del class="product-old-price"><?= $product['price_sale'] > 0 ? number_format($product['price'], 0, ',', '.') : '' ?></del>
									</h4>
								</div>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
						<label>
							Sort By:
							<select class="input-select">
								<option value="0">Popular</option>
								<option value="1">Position</option>
							</select>
						</label>

						<label>
							Show:
							<select class="input-select">
								<option value="0">20</option>
								<option value="1">50</option>
							</select>
						</label>
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row" id="products">
					<?php foreach ($listProducts as $product) :     ?>
						<!-- product -->
						<div class="col-md-4 col-xs-6">
							<div class="product" data-id="<?= $product['id'] ?>">
								<a href="index.php?act=singleProduct&id=<?= $product['id'] ?>">
									<div class="product-img">
										<img src="view/assets/img/product/<?= $product['image'] ?>" alt="">
										<div class="product-label">
											<?php if (isSale($product) == 1) : ?>
												<span class="sale">-<?= round(($product['price'] - $product['price_sale']) / $product['price'] * 100) ?>%</span>
											<?php endif; ?>
											<?php if (isNew($product['id_category'], $product) == 1) : ?>
												<span class="new">NEW</span>
											<?php endif; ?>
										</div>
									</div>
								</a>
								<div class="product-body">
									<p class="product-category"><?= $product['category_name'] ?> | <?= $product['brand_name'] ?></p>
									<h3 class="product-name">
										<a href="index.php?act=singleProduct&id=<?= $product['id'] ?>">
											<?= mb_strimwidth($product['name'], 0, 45, "...") ?>
										</a>
									</h3>
									<h4 class="product-price">
										<?= $product['price_sale'] > 0 ? number_format($product['price_sale'], 0, ',', '.') . 'đ' : number_format($product['price'], 0, ',', '.') . 'đ' ?>
										<del class="product-old-price"><?= $product['price_sale'] > 0 ? number_format($product['price'], 0, ',', '.') . 'đ' : '' ?></del>
									</h4>
								</div>
								<div class="add-to-cart">
									<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
								</div>
							</div>
						</div>
						<!-- /product -->
					<?php endforeach; ?>
				</div>
				<!-- /store products -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<span class="store-qty">Showing 20-100 products</span>
					<ul class="store-pagination">
						<li class="active">1</li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
					</ul>
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->