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

<!-- ALERT SEARCH -->
<div class="container">
	<?php if (isset($messageStore) && !empty($messageStore)) : ?>
		<p class="text-center"><?= $messageStore ?></p>
	<?php endif; ?>
</div>
<!-- /ALERT SEARCH -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">

				<!-- aside Widget -->
				<form action="<?= $currentURL ?>&filterPrice" method="post">
					<?php if (isset($minPriceProduct) && isset($maxPriceProduct) && !empty($minPriceProduct)) : ?>
						<div class="aside">
							<h3 class="aside-title">Giá sản phẩm</h3>
							<div class="row">
								<div class="col-md-8">
									<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
									<div id="slider-range"></div>
									<input type="hidden" class="price_from" name="from">
									<input type="hidden" class="price_to" name="to">
								</div>
								<div class="col-md-4">
									<button type="submit" class="btn btn-main mb-2">Lọc</button>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</form>
				<!-- /aside Widget -->


				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Danh mục sản phẩm</h3>
					<div class="checkbox-filter categories">
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
				<div class="aside">
					<h3 class="aside-title">Thương hiệu</h3>
					<div class="checkbox-filter brand ">
						<?php foreach ($listBrands as $brand) : ?>
							<div class="input-checkbox">
								<input type="checkbox" id="<?= $brand['name'] ?>" value="<?= $brand['id'] ?>">
								<label for="<?= $brand['name'] ?>">
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
				<!-- <div class="store-filter clearfix">
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
				</div> -->
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
					<span class="store-qty">Hiện <?= count($listProducts) ?> - <?= $totalItems ?> sản phẩm</span>
					<!-- Số Phân Trang  -->
					<ul class="store-pagination">
						<!-- Nút Prev Trang  -->
						<?php if ($current_page != 1) : ?>
							<li><a href="<?= $currentURL ?>&page=<?= $current_page - 1; ?>"><i class="fa fa-angle-left"></i></a></li>
						<?php endif; ?>
						<?php for ($page = 1; $page <= $totalPages; $page++) : ?>
							<li class="<?= ($page == $current_page) ? 'active' : '' ?>"><a href="<?= $currentURL ?>&page=<?= $page ?>"><?= $page ?></a></li>
						<?php endfor; ?>
						<!-- Nút Next Trang  -->
						<?php if ($current_page != $totalPages) : ?>
							<li><a href="<?= $currentURL ?>&page=<?= $current_page + 1; ?>"><i class="fa fa-angle-right"></i></a></li>
						<?php endif; ?>
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