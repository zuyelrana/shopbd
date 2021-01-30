   <div class="sticky-footer sticky-content fix-bottom">
        <a href="demo1.html" class="sticky-link active">
            <i class="d-icon-home"></i>
            <span>Home</span>
        </a>
        <a href="shop.html" class="sticky-link">
            <i class="d-icon-volume"></i>
            <span>Categories</span>
        </a>
        <a href="wishlist.html" class="sticky-link">
            <i class="d-icon-heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="account.html" class="sticky-link">
            <i class="d-icon-user"></i>
            <span>Account</span>
        </a>
        <div class="dropdown cart-dropdown dir-up">
            <a href="javascript:;" class="sticky-link cart-toggle">
                <i class="d-icon-bag"></i>
                <span>Cart</span>
            </a>
            <!-- End of Cart Toggle -->
            <div class="dropdown-box">
                <div class="product product-cart-header">
                    <span class="product-cart-counts">2 items</span>
                    <span><a href="cart.html">View cart</a></span>
                </div>
                <div class="products scrollable">
                    <div class="product product-cart">
                        <div class="product-detail">
                            <a href="product.html" class="product-name">Solid Pattern In Fashion Summer Dress</a>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$129.00</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="#">
                                <img src="{{ asset('/') }}frontend/images/cart/product-1.jpg" alt="product" width="90" height="90" />
                            </a>
                            <button class="btn btn-link btn-close">
                                <i class="fas fa-times"></i>
                            </button>
                        </figure>
                    </div>
                    <!-- End of Cart Product -->
                    <div class="product product-cart">
                        <div class="product-detail">
                            <a href="product.html" class="product-name">Mackintosh Poket Backpack</a>
                            <div class="price-box">
                                <span class="product-quantity">1</span>
                                <span class="product-price">$98.00</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="#">
                                <img src="{{ asset('/') }}frontend/images/cart/product-2.jpg" alt="product" width="90" height="90" />
                            </a>
                            <button class="btn btn-link btn-close">
                                <i class="fas fa-times"></i>
                            </button>
                        </figure>
                    </div>
                    <!-- End of Cart Product -->
                </div>
                <!-- End of Products  -->
                <div class="cart-total">
                    <label>Subtotal:</label>
                    <span class="price">$42.00</span>
                </div>
                <!-- End of Cart Total -->
                <div class="cart-action">
                    <a href="checkout.html" class="btn btn-dark"><span>Checkout</span></a>
                </div>
                <!-- End of Cart Action -->
            </div>
            <!-- End of Dropdown Box -->
        </div>
    </div>