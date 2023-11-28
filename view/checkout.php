<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<form class="section" method="POST" action="">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <?php if($message){echo $message;}?>
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Billing address</h3>
                    </div>
                    <?php if ($_SESSION['user']) : ?>
                        <input type="hidden" name="id_user" value="<?= $_SESSION['user']['id'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <input class="input" type="text" name="name" placeholder="Họ và tên">
                    </div>
                    <div class="form-group">
                        <input class="input" type="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="address" placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="city" placeholder="Thành phố">
                    </div>
                    <div class="form-group">
                        <input class="input" type="tel" name="phone" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <div class="input-checkbox">
                            <input type="checkbox" id="create-account">
                            <label for="create-account">
                                <span></span>
                                Create Account?
                            </label>
                            <div class="caption">

                                <input class="input" type="password" name="password" placeholder="Enter Your Password">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Billing Details -->



                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" name="note" placeholder="Ghi chú đặt hàng"></textarea>
                </div>
                <!-- /Order notes -->
            </div>

            <!-- Order Details -->
            <div class="col-md-5 order-details">
                <div class="section-title text-center">
                    <h3 class="title">Your Order</h3>
                </div>
                <div class="order-summary">
                    <div class="order-col">
                        <div><strong>PRODUCT</strong></div>
                        <div><strong>TOTAL</strong></div>
                    </div>
                    <div class="order-products">
                        <script>
                            const listProductCheckout = document.querySelector('.order-products');
                            const cart = JSON.parse(localStorage.getItem("cartProducts")) || [];
                            cart.forEach((product, index) => {
                                listProductCheckout.innerHTML += `<div class="order-col list-order">
                                                    <div class="nameProduct">${product.name}</div>
                                                    <span>x<span class="quantityProduct">${product.quantity}</span></span>
                                                    <div class="priceProduct">${product.price}</div>
                                                </div>
                                                <input type="hidden" name="products[${index}][id]" value="${product.id}">
                                                <input type="hidden" name="products[${index}][name]" value="${product.name}">
                                                <input type="hidden" name="products[${index}][quantity]" value="${product.quantity}">  
                                                <input type="hidden" name="products[${index}][price]" value="${parseInt(product.price.replace("đ", "").replace(/\./g, ""))}">`;
                            });
                        </script>
                        <form action=""></form>
                        <div class="order-col">
                            <input type="hidden" name="total-order">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total"></strong></div>

                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1" value="Chuyển khoản trực tiếp">
                            <label for="payment-1">
                                <span></span>
                                Chuyển khoản trực tiếp
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2" value="Thanh toán khi nhận hàng">
                            <label for="payment-2">
                                <span></span>
                                Thanh toán khi nhận hàng
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3" value="Thanh toán khi nhận hàng">
                            <label for="payment-3">
                                <span></span>
                                Paypal System
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            I've read and accept the <a href="#">terms & conditions</a>
                        </label>
                    </div>
                    <button type="submit" name="submit-checkout" class="primary-btn order-submit">thanh toán</button>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</form>
<!-- /SECTION -->