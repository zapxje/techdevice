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
<form class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-7">
                <!-- Billing Details -->
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Billing address</h3>
                    </div>
                    <div class="form-group">
                        <input class="input" type="text" name="first-name" placeholder="Họ và tên">
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
                        <input class="input" type="tel" name="tel" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <div class="input-checkbox">
                            <input type="checkbox" id="create-account">
                            <label for="create-account">
                                <span></span>
                                Create Account?
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                                <input class="input" type="password" name="password" placeholder="Enter Your Password">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Billing Details -->

                

                <!-- Order notes -->
                <div class="order-notes">
                    <textarea class="input" placeholder="Ghi chú đặt hàng"></textarea>
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
                            cart.forEach(product => {
                                listProductCheckout.innerHTML += `<div class="order-col">
                                                                    <div class="nameProduct">${product.name}</div>
                                                                    <span class="quantityProduct">x${product.quantity}</span>
                                                                    <div class="priceProduct">${product.total}</div>
                                                                </div>`
                            });
                        </script>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total"></strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Chuyển khoản trực tiếp
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-2">
                            <label for="payment-2">
                                <span></span>
                                Thanh toán khi nhận hàng
                            </label>
                            <div class="caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                            </div>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-3">
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
                    <button type="submit" class="primary-btn order-submit">thanh toán</button>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</form>
<!-- /SECTION -->