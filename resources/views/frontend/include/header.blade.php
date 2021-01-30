  <header class="header">
      <div class="header-top">
          <div class="container">
              <div class="header-left">
                  <p class="welcome-msg">Welcome to Donald store message or remove it!</p>
              </div>
              <div class="header-right">
                  <div class="dropdown">
                      <a href="#currency">USD</a>
                      <ul class="dropdown-box">
                          <li><a href="#USD">USD</a></li>
                          <li><a href="#EUR">EUR</a></li>
                      </ul>
                  </div>
                  <!-- End of DropDown Menu -->
                  <div class="dropdown">
                      <a href="#language"><img src="{{ asset('/') }}frontend/images/flags/en.png" alt="USA Flag"
                              class="dropdown-image" />ENG</a>
                      <ul class="dropdown-box">
                          <li>
                              <a href="#USD">
                                  <img src="{{ asset('/') }}frontend/images/flags/en.png" alt="USA Flag"
                                      class="dropdown-image" />ENG
                              </a>
                          </li>
                          <li>
                              <a href="#EUR">
                                  <img src="{{ asset('/') }}frontend/images/flags/fr.png" alt="France Flag"
                                      class="dropdown-image" />FRH
                              </a>
                          </li>
                      </ul>
                  </div>
                  <!-- End of DropDown Menu -->
                  <div class="dropdown dropdown-expanded d-lg-show">
                      <a href="#dropdown">Links</a>
                      <ul class="dropdown-box">
                          <li><a href="about-us.html">About</a></li>
                          <li><a href="#">Blog</a></li>
                          <li><a href="#">FAQ</a></li>
                          <li><a href="#">Newsletter</a></li>
                          <li><a href="#">Contact</a></li>
                          <li><a href="wishlist.html">Wishlist</a></li>
                      </ul>
                  </div>
                  <!-- End of DropDownExpanded Menu -->
              </div>
          </div>
      </div>
      <!-- End of HeaderTop -->
      <div class="header-middle sticky-header fix-top sticky-content">
          <div class="container">
              <div class="header-left">
                  <a href="#" class="mobile-menu-toggle">
                      <i class="d-icon-bars2"></i>
                  </a>
              </div>
              <div class="header-center">
                  <a href="{{ route('admin.home.index') }}" class="logo">
                      <img src="{{ asset('/') }}frontend/images/logo.png" alt="logo" width="163" height="39" />
                  </a>
                  <!-- End of Logo -->
                  <nav class="main-nav">
                      <ul class="menu">
                          <li class="active">
                              <a href="{{ route('admin.home.index') }}">Home</a>
                          </li>
                          @if (!empty($sections))
                              @foreach ($sections as $section)
                                  <li>
                                      <a href="#">{{ $section['name'] }}</a>
                                      @if (!empty($section['categories']))
                                          <ul>
                                              @foreach ($section['categories'] as $category)
                                                  <li>
                                                      <a
                                                          href="{{ route('admin.productlisting.index', $category['url']) }}">{{ $category['category_name'] }}</a>
                                                      @if (!empty($category['subcategories']))
                                                          <ul>
                                                              @foreach ($category['subcategories'] as $subcategory)
                                                                  <li>
                                                                      <a
                                                                          href="{{ route('admin.productlisting.index', $subcategory['url']) }}">{{ $subcategory['category_name'] }}</a>
                                                                  </li>
                                                              @endforeach
                                                          </ul>
                                                      @endif
                                                  </li>
                                              @endforeach
                                          </ul>
                                      @endif
                                  </li>
                              @endforeach
                          @endif
                          <li>

                              <a href="#">Buy Donald!</a>
                          </li>
                      </ul>
                  </nav>
                  <span class="divider"></span>
                  <!-- End of Divider -->
                  <div class="header-search hs-toggle">
                      <a href="#" class="search-toggle">
                          <i class="d-icon-search"></i>
                      </a>
                      <form action="#" class="input-wrapper">
                          <input type="text" class="form-control" name="search" autocomplete="off"
                              placeholder="Search your keyword..." required />
                          <button class="btn btn-search" type="submit">
                              <i class="d-icon-search"></i>
                          </button>
                      </form>
                  </div>
                  <!-- End of Header Search -->
              </div>
              <div class="header-right">
                  <a class="login" href="">
                      <i class="d-icon-user"></i>
                      <span>Login</span>
                  </a>
                  <!-- End of Login -->
                  <span class="divider"></span>




                  <div class="dropdown cart-dropdown">
                      @if (empty($userCartItems))
                          <a href="#" class="cart-toggle">
                              <span class="cart-label">
                                  <span class="cart-name">My Cart</span>
                                  <span class="cart-price">TK0.00</span>
                              </span>
                              <i class="minicart-icon">
                                  <span class="cart-count">{{ count($userCartItems) }}</span>
                              </i>
                          </a>
                      @else
                          @php
                          $total_price1=0;
                          $total_price=0;
                          @endphp
                          @foreach ($userCartItems as $item)
                             <?php $attributeprice =App\Models\Product::getDiscountedAttributePrice($item['product_id'], $item['size']) ?>
                           <?php  $total_price1=$total_price1+($attributeprice['final_price']*$item['quantity']);?>
                          @endforeach

                          <a href="#" class="cart-toggle">
                              <span class="cart-label">
                                  <span class="cart-name">My Cart</span>
                                  <span class="cart-price">TK {{ $total_price1 }}</span>
                              </span>
                              <i class="minicart-icon">
                                  <span class="cart-count">{{ count($userCartItems) }}</span>
                              </i>
                          </a>
                          <!-- End of Cart Toggle -->
                          <div class="dropdown-box">
                              <div class="product product-cart-header">
                                  <span class="product-cart-counts">{{ count($userCartItems) }} items</span>
                                  <span><a href="{{ route('admin.productlisting.cart') }}">View cart</a></span>
                              </div>
                              @foreach ($userCartItems as $item)
                                  <?php $attributeprice =App\Models\Product::getDiscountedAttributePrice($item['product_id'], $item['size']) ?>
                                  <div class="products scrollable">
                                      <div class="product product-cart">
                                          <div class="product-detail">
                                              <a href="{{ route('admin.productlisting.show', $item['product']['slug']) }}"
                                                  class="product-name">{{ $item['product']['product_name'] }}</a>
                                              <div class="price-box">
                                                  <span class="product-quantity">{{ $item['quantity'] }}</span>
                                                  <span class="product-price">{{ $attributeprice['final_price'] }} <del class="old-price"> &nbsp; {{ $attributeprice['proAttributePrice'] }}</del></span>
                                              </div>
                                          </div>
                                          <figure>
                                              @if (!empty($item['product']['main_image']) && file_exists('backend/assets/images/product/small/' . $item['product']['main_image']))
                                                  <a
                                                      href="{{ route('admin.productlisting.show', $item['product']['slug']) }}">
                                                      <img src="{{ asset('backend/assets/images/product/small/' . $item['product']['main_image']) }}"
                                                          alt="{{ $item['product']['product_name'] }}" width="90"
                                                          height="90">
                                                  </a>
                                                  <button class="btn btn-link btn-close">
                                                      <i class="fas fa-times"></i>
                                                  </button>
                                              @else
                                                  <a
                                                      href="{{ route('admin.productlisting.show', $item['product']['slug']) }}">
                                                      <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                                          alt="{{ $item['product']['product_name'] }}" width="100"
                                                          height="100">
                                                  </a>
                                                  <button class="btn btn-link btn-close">
                                                      <i class="fas fa-times"></i>
                                                  </button>
                                              @endif


                                          </figure>
                                      </div>

                                  </div>
                                  @php
                                  $total_price=$total_price+($attributeprice['final_price']*$item['quantity']);
                                  @endphp
                              @endforeach
                              <!-- End of Products  -->
                              <div class="cart-total">
                                  <label>Subtotal:</label>
                                  <span class="price">TK {{ $total_price }}</span>
                              </div>
                              <!-- End of Cart Total -->
                              <div class="cart-action">
                                  <a href="checkout.html" class="btn btn-dark"><span>Checkout</span></a>
                              </div>
                              <!-- End of Cart Action -->
                          </div>
                      @endif
                      <!-- End of Dropdown Box -->
                  </div>


                  <div class="header-search hs-toggle mobile-search">
                      <a href="#" class="search-toggle">
                          <i class="d-icon-search"></i>
                      </a>
                      <form action="#" class="input-wrapper">
                          <input type="text" class="form-control" name="search" autocomplete="off"
                              placeholder="Search your keyword..." required />
                          <button class="btn btn-search" type="submit">
                              <i class="d-icon-search"></i>
                          </button>
                      </form>
                  </div>
                  <!-- End of Header Search -->
              </div>
          </div>
      </div>
  </header>
