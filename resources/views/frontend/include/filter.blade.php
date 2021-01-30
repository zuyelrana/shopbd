   <aside class="col-lg-3 sidebar sidebar-fixed sidebar-toggle-remain shop-sidebar sticky-sidebar-wrapper">
       <div class="sidebar-overlay">
           <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
       </div>
       <div class="sidebar-content">
           <div class="sticky-sidebar" data-sticky-options="{'top': 10}">
               <div class="filter-actions">
                   <a href="#" class="sidebar-toggle-btn toggle-remain btn btn-sm btn-outline btn-primary">Filters<i
                           class="d-icon-arrow-left"></i></a>
                   <a href="#" class="filter-clean text-primary">Clean All</a>
               </div>
               <div class="widget widget-collapsible">
                   @if (!empty($sections))
                       @foreach ($sections as $section)
                           <h3 class="widget-title">{{ $section['name'] }}</h3>
                           @if (!empty($section['categories']))
                               <ul class="widget-body filter-items search-ul">
                                   @foreach ($section['categories'] as $category)
                                       <li class="with-ul
                                        {{ Request::is($category['url']) ? 'show' : '' }}
                                       ">
                                           <a
                                               href="{{ route('admin.productlisting.index', $category['url']) }}">{{ $category['category_name'] }}</a>
                                           @if (!empty($category['subcategories']))
                                               <ul @if (Request::is($category['url']))
                                                   style="display: block"
                                           @endif >
                                           @foreach ($category['subcategories'] as $subcategory)
                                       <li class="">
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
                   @endforeach
                   @endif
               </div>
               <div class="widget widget-collapsible">
                   <h3 class="widget-title">Fabric</h3>
                   <ul class="widget-body">
                       <fieldset>
                           <legend>Choose your interests</legend>
                           <div>
                               @foreach ($FabricArray as $key => $fabric)
                                   <label class="container1">{{ $fabric }}
                                       <input class="fabric" type="checkbox" value="{{ $fabric }}" id="{{ $fabric }}"
                                           name="fabric[]" />
                                       <span class="checkmark"></span>
                                   </label>
                               @endforeach
                           </div>

                       </fieldset>
                   </ul>
               </div>
               <div class="widget widget-collapsible">
                   <h3 class="widget-title">Sleeve</h3>
                   <ul class="widget-body">
                       <fieldset>
                           <legend>Choose your interests</legend>
                           <div>
                               @foreach ($SleeveArray as $key => $sleeve)
                                   <label class="container1">{{ $sleeve }}
                                       <input class="sleeve" type="checkbox" value="{{ $sleeve }}" id="{{ $sleeve }}"
                                           name="sleeve[]" />
                                       <span class="checkmark"></span>
                                   </label>
                               @endforeach
                           </div>
                       </fieldset>
                   </ul>
               </div>
               <div class="widget widget-collapsible">
                   <h3 class="widget-title">Pattern</h3>
                   <ul class="widget-body filter-items">
                       <fieldset>
                           <legend>Choose your interests</legend>
                           <div>
                               @foreach ($PatternArray as $key => $pattern)
                                   <label class="container1">{{ $pattern }}
                                       <input class="pattern" type="checkbox" value="{{ $pattern }}" id="{{ $pattern }}"
                                           name="pattern[]" />
                                       <span class="checkmark"></span>
                                   </label>
                               @endforeach
                           </div>
                       </fieldset>
                   </ul>
               </div>
               <div class="widget widget-collapsible">
                   <h3 class="widget-title">Fit</h3>
                   <ul class="widget-body filter-items">
                       <fieldset>
                           <legend>Choose your interests</legend>
                           <div>
                               @foreach ($FitArray as $key => $fit)
                                   <label class="container1">{{ $fit }}
                                       <input class="fit" type="checkbox" value="{{ $fit }}" id="{{ $fit }}"
                                           name="fit[]" />
                                       <span class="checkmark"></span>
                                   </label>
                               @endforeach
                           </div>
                       </fieldset>
                   </ul>
               </div>
               <div class="widget widget-collapsible">
                   <h3 class="widget-title">OcassionArray</h3>
                   <ul class="widget-body filter-items">
                       <fieldset>
                           <legend>Choose your interests</legend>
                           <div>
                               @foreach ($OcassionArray as $key => $ocassion)
                                   <label class="container1">{{ $ocassion }}
                                       <input class="ocassion" type="checkbox" value="{{ $ocassion }}"
                                           id="{{ $ocassion }}" name="ocassion[]" />
                                       <span class="checkmark"></span>
                                   </label>
                               @endforeach
                           </div>
                       </fieldset>
                   </ul>
               </div>

               <div class="widget widget-products mt-2">
                   <h4 class="widget-title">Our Featured</h4>
                   <div class="widget-body">
                       <div class="owl-carousel owl-nav-top row cols-1" data-owl-options="{
                                                      'items': 1,
                                                      'loop': true,
                                                      'nav': true,
                                                      'dots': false,
                                          'margin': 20											}">
                           <div class="products-col">
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget1.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html">Fashion Hiking Hat</a>
                                       </h3>
                                       <div class="product-price">
                                           <span class="price">$199.00</span>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget2.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html"> Fashion Hood</a>
                                       </h3>
                                       <div class="product-price">
                                           <span class="price">$19.00</span>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget3.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html">Women Summer Clothing</a>
                                       </h3>
                                       <div class="product-price">
                                           <ins class="new-price">$99.00</ins><del class="old-price">$150.00</del>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <!-- End Products Col -->
                           <div class="products-col">
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget1.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html">Fashion Hiking Hat</a>
                                       </h3>
                                       <div class="product-price">
                                           <span class="price">$199.00</span>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget2.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html">Men Fashion Hood</a>
                                       </h3>
                                       <div class="product-price">
                                           <span class="price">$19.00</span>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="product product-list-sm">
                                   <figure class="product-media">
                                       <a href="product.html">
                                           <img src="{{ asset('/') }}frontend/images/shop/product-widget3.jpg"
                                               alt="product" width="100" height="100">
                                       </a>
                                   </figure>
                                   <div class="product-details">
                                       <h3 class="product-name">
                                           <a href="product.html"> Summer Clothing</a>
                                       </h3>
                                       <div class="product-price">
                                           <ins class="new-price">$99.00</ins><del class="old-price">$150.00</del>
                                       </div>
                                       <div class="ratings-container">
                                           <div class="ratings-full">
                                               <span class="ratings" style="width:100%"></span>
                                               <span class="tooltiptext tooltip-top"></span>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <!-- End Products Col -->
                       </div>
                   </div>
               </div>
               <!-- End Widget Products -->
           </div>
       </div>
   </aside>
