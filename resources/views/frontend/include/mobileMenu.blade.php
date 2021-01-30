    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay">
        </div>
        <!-- End of Overlay -->
        <a class="mobile-menu-close" href="#"><i class="d-icon-times"></i></a>
        <!-- End of CloseButton -->
        <div class="mobile-menu-container scrollable">
            <form action="#" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off"
                    placeholder="Search your keyword..." required />
                <button class="btn btn-search" type="submit">
                    <i class="d-icon-search"></i>
                </button>
            </form>
            <!-- End of Search Form -->
            <ul class="mobile-menu mmenu-anim">
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
                                                      <a href="{{ route('admin.productlisting.index',$category['url']) }}">{{ $category['category_name'] }}</a>
                                                      @if (!empty($category['subcategories']))
                                                          <ul>
                                                              @foreach ($category['subcategories'] as $subcategory)
                                                                  <li><a href="{{ route('admin.productlisting.index',$subcategory['url']) }}">{{ $subcategory['category_name'] }}</a>
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
                <li><a href="#">Buy Donald!</a></li>
            </ul>
            <!-- End of MobileMenu -->
            <!-- <ul class="mobile-menu mmenu-anim">
                <li><a href="login.html">Login</a></li>
                <li><a href="cart.html">My Cart</a></li>
                <li><a href="wishlist.html">Wishlist</a></li>
            </ul> -->
            <!-- End of MobileMenu -->
        </div>
    </div>
