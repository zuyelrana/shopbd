@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/vendor/photoswipe/photoswipe.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/') }}frontend/vendor/photoswipe/default-skin/default-skin.min.css">
    <style>
        input,
        textarea {
            border: 1px solid #e5ff00;
            box-sizing: border-box;
            margin: 0;
            outline: none;
            padding: 10px;
        }

        input[type="button"] {
            -webkit-appearance: button;
            cursor: pointer;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: none;
        }

        .input-group {
            clear: both;
            margin: 5px 0;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: Lime;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus1,
        .input-group .button-plus1 {
            font-weight: bold;
            height: 38px;
            padding: 0;
            width: 38px;
            position: relative;
        }

        .input-group .quantity-field {
            position: relative;
            height: 38px;
            left: -6px;
            text-align: center;
            width: 62px;
            display: inline-block;
            font-size: 13px;
            margin: 0 0 5px;
            resize: vertical;
        }

        .button-plus1 {
            left: -13px;
        }



        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>
@endpush

@extends('frontend.master')
@section('content')
    <main class="main mt-4">
        <div class="page-content mb-10">
            <div class="container">
                <div class="product product-single row mb-4">
                    <div class="col-md-6">
                        <div class="product-gallery pg-vertical">
                            <div class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1">
                                <figure class="product-image">
                                    <img @if (!empty($productDetails['main_image']) && file_exists('backend/assets/images/product/medium/' . $productDetails['main_image']))

                                    src="{{ asset('backend/assets/images/product/medium/' . $productDetails['main_image']) }}"
                                    data-zoom-image="{{ asset('backend/assets/images/product/medium/' . $productDetails['main_image']) }}"
                                @else
                                    src="{{ asset('backend/assets/images/no_image.png') }}"
                                    data-zoom-image="{{ asset('backend/assets/images/no_image.png') }}"
                                    @endif
                                    alt=" Brown Leather Backpacks" width="800" height="900">
                                </figure>

                                @foreach ($productDetails['images'] as $Productimage)

                                    <figure class="product-image">
                                        <img @if (!empty($Productimage['name']) && file_exists('backend/assets/images/product/medium/' . $Productimage['name']))
                                        src="{{ asset('backend/assets/images/product/medium/' . $Productimage['name']) }}"
                                        data-zoom-image="{{ asset('backend/assets/images/product/medium/' . $Productimage['name']) }}"
                                    @else
                                        src="{{ asset('backend/assets/images/no_image.png') }}"
                                        data-zoom-image="{{ asset('backend/assets/images/no_image.png') }}"
                                @endif
                                alt=" Brown Leather Backpacks" width="800" height="900">
                                </figure>
                                @endforeach


                            </div>

                            <div class="product-thumbs-wrap">
                                <div class="product-thumbs">
                                    <div class="product-thumb active">
                                        <img @if (!empty($productDetails['main_image']) && file_exists('backend/assets/images/product/small/' . $productDetails['main_image']))
                                        src="{{ asset('backend/assets/images/product/small/' . $productDetails['main_image']) }}"
                                        data-zoom-image="{{ asset('backend/assets/images/product/small/' . $productDetails['main_image']) }}"
                                    @else
                                        src="{{ asset('backend/assets/images/no_image.png') }}"
                                        data-zoom-image="{{ asset('backend/assets/images/no_image.png') }}"
                                        @endif
                                        alt=" Brown Leather Backpacks" width="109" height="122">
                                    </div>
                                    @foreach ($productDetails['images'] as $Productimage)
                                        <div class="product-thumb">
                                            <img @if (!empty($Productimage['name']) && file_exists('backend/assets/images/product/small/' . $Productimage['name']))
                                            src="{{ asset('backend/assets/images/product/small/' . $Productimage['name']) }}"
                                            data-zoom-image="{{ asset('backend/assets/images/product/small/' . $Productimage['name']) }}"
                                        @else
                                            src="{{ asset('backend/assets/images/no_image.png') }}"
                                            data-zoom-image="{{ asset('backend/assets/images/no_image.png') }}"
                                    @endif
                                    alt=" Brown Leather Backpacks" width="109" height="122">
                                </div>
                                @endforeach
                            </div>
                            <button class="thumb-up disabled"><i class="fas fa-chevron-left"></i></button>
                            <button class="thumb-down disabled"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details">
                        <div class="product-navigation">
                            <ul class="breadcrumb breadcrumb-lg">
                                <li><a href="{{ route('admin.home.index') }}"><i class="d-icon-home"></i></a></li>
                                <li><a href="{{ route('admin.productlisting.index', $productDetails['category']['url']) }}"
                                        class="active">{{ $productDetails['category']['category_name'] }}</a></li>
                                <li>{{ $productDetails['product_name'] }}</li>
                            </ul>

                            <ul class="product-nav">
                                <li class="product-nav-prev">
                                    <a href="#">
                                        <i class="d-icon-arrow-left"></i> Prev
                                        <span class="product-nav-popup">
                                            <img src="{{ asset('/') }}frontend/images/product/product-thumb-prev.jpg"
                                                alt="product thumbnail" width="110" height="123">
                                            <span class="product-name">Sed egtas Dnte Comfort</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="product-nav-next">
                                    <a href="#">
                                        Next <i class="d-icon-arrow-right"></i>
                                        <span class="product-nav-popup">
                                            <img src="{{ asset('/') }}frontend/images/product/product-thumb-next.jpg"
                                                alt="product thumbnail" width="110" height="123">
                                            <span class="product-name">Sed egtas Dnte Comfort</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <h1 class="product-name"> {{ $productDetails['product_name'] }}</h1>
                        <div class="product-meta">
                            STOCK: <span class="product-sku">{{ $produt_stock }}</span>
                            BRAND: <span class="product-brand">{{ $productDetails['brand']['name'] }}</span>
                        </div>
                        <p class="product-short-desc">{!! Str::limit($productDetails['description'], 100) !!}</p>

                        <form action="{{ route('admin.productlisting.add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                                     <?php $discount_price = App\Models\Product::getDiscountPrice($productDetails['id']); ?>
                           
                                    @if ($discount_price > 0)
                                                <div class="product-price getAttPrice">Tk.{{ $discount_price }}  <del class="old-price">Tk.{{ $productDetails['product_price'] }}</del></div>
                                               
                                    @else
                                        <ins class="new-price">TK. {{ $productDetails['product_price'] }}</ins>
                                    @endif
                            
                            @if (!empty($productDetails['attributes']))
                                <div class="product-form product-variations product-size">
                                    <label>Size:</label>
                                    <div class="product-form-group">
                                        <div class="select-box">
                                            <select name="size" id="getPrice" product_id={{ $productDetails['id'] }}
                                                class="form-control" required>
                                                <option value="" selected="selected">Choose an Option</option>
                                                @foreach ($productDetails['attributes'] as $attribute)

                                                    <option value="{{ $attribute['size'] }}">{{ $attribute['size'] }}
                                                    </option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <hr class="product-divider">

                            <div class="product-form product-qty">
                                <label>QTY:</label>
                                <div class="product-form-group">
                                      <div class="input-group cartaddbtn">
                                                <input type="button" value="-" class="button-minus1 " data-field="quantity">
                                                <input type="number" step="1" max="" value="1" name="quantity"
                                                    class="quantity-field">
                                                <input type="button" value="+" class="button-plus1 " data-field="quantity">
                                                 <button  class="btn btn-outline-secondary"   type="submit" style="min-width: 200px;padding: 0 10px;height: 39px;"><i class="d-icon-bag"></i> Add To
                                        Cart</button>
                                            </div>
                                   
                                </div>
                            </div>
                        </form>
                        <hr class="product-divider mb-3">

                        <div class="product-footer">
                            <div class="social-links">
                                <a href="#" class="social-link social-facebook fab fa-facebook-f"></a>
                                <a href="#" class="social-link social-twitter fab fa-twitter"></a>
                                <a href="#" class="social-link social-vimeo fab fa-vimeo-v"></a>
                            </div>
                            <div class="product-action">
                                <a href="#" class="btn-product btn-wishlist"><i class="d-icon-heart"></i>Add To
                                    Wishlist</a>
                                <span class="divider"></span>
                                <a href="#" class="btn-product btn-compare"><i class="d-icon-random"></i>Add To
                                    Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab tab-nav-simple product-tabs mb-4">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#product-tab-description">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#product-tab-additional">Additional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#product-tab-shipping-returns">Shipping &amp; Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#product-tab-reviews">Reviews (8)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active in" id="product-tab-description">
                        <p>{!! $productDetails['description'] !!}</p>

                    </div>
                    <div class="tab-pane" id="product-tab-additional">
                        <ul class="list-none">
                            <li><label>Product Name:</label>
                                <p>{{ $productDetails['product_name'] }}</p>
                            </li>
                            <li><label>Color:</label>
                                <p>{{ $productDetails['product_color'] }}</p>
                            </li>
                            @if (!empty($productDetails['product_discount']))
                                <li><label>Product Discount:</label>
                                    <p>{{ $productDetails['product_discount'] }} %</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['product_weight']))
                                <li><label>Product Weight:</label>
                                    <p>{{ $productDetails['product_weight'] }} Kilo</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['wash_care']))
                                <li><label>Product Wash care:</label>
                                    <p>{{ $productDetails['wash_care'] }}</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['fabric']))
                                <li><label>Fabric:</label>
                                    <p>{{ $productDetails['fabric'] }}</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['pattern']))
                                <li><label>Pattern:</label>
                                    <p>{{ $productDetails['pattern'] }}</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['sleeve']))
                                <li><label>Sleeve:</label>
                                    <p>{{ $productDetails['sleeve'] }}</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['fit']))
                                <li><label>Fit:</label>
                                    <p>{{ $productDetails['fit'] }}</p>
                                </li>
                            @endif
                            @if (!empty($productDetails['attributes']))
                                <li><label>Size Availble:</label>
                                    <p>
                                        @foreach ($productDetails['attributes'] as $attribute)
                                            {{ $attribute['size'] }} ,
                                        @endforeach
                                    </p>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="tab-pane " id="product-tab-shipping-returns">
                        <h6 class="mb-2">Free Shipping</h6>
                        <p class="mb-0">We deliver to over 100 countries around the world. For full details of
                            the delivery options we offer, please view our <a href="#" class="text-primary">Delivery
                                information</a><br />We hope you’ll love every
                            purchase, but if you ever need to return an item you can do so within a month of
                            receipt. For full details of how to make a return, please view our <br /><a href="#"
                                class="text-primary">Returns information</a></p>
                    </div>
                    <div class="tab-pane " id="product-tab-reviews">
                        <div class="d-flex align-items-center mb-5">
                            <h4 class="mb-0 mr-2">Average Rating:</h4>
                            <div class="ratings-container average-rating mb-0">
                                <div class="ratings-full">
                                    <span class="ratings" style="width:80%"></span>
                                    <span class="tooltiptext tooltip-top">4.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="comments mb-6">
                            <ul>
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a href="#">
                                                <img src="{{ asset('/') }}frontend/images/blog/comments/1.jpg" alt="avatar">
                                            </a>
                                        </figure>
                                        <div class="comment-body">
                                            <div class="comment-rating ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width:80%"></span>
                                                    <span class="tooltiptext tooltip-top">4.00</span>
                                                </div>
                                            </div>
                                            <div class="comment-user">
                                                <h4><a href="#">Jimmy Pearson</a></h4>
                                                <span class="comment-date">November 9, 2018 at 2:19 pm</span>
                                            </div>

                                            <div class="comment-content">
                                                <p>Sed pretium, ligula sollicitudin laoreet viverra, tortor
                                                    libero sodales leo, eget blandit nunc tortor eu nibh. Nullam
                                                    mollis. Ut justo. Suspendisse potenti.
                                                    Sed egestas, ante et vulputate volutpat, eros pede semper
                                                    est, vitae luctus metus libero eu augue. Morbi purus libero,
                                                    faucibus adipiscing, commodo quis, avida id, est. Sed
                                                    lectus. Praesent elementum hendrerit tortor. Sed semper
                                                    lorem at felis. Vestibulum volutpat.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="comment">
                                        <figure class="comment-media">
                                            <a href="#">
                                                <img src="{{ asset('/') }}frontend/images/blog/comments/3.jpg" alt="avatar">
                                            </a>
                                        </figure>

                                        <div class="comment-body">
                                            <div class="comment-rating ratings-container mb-0">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width:80%"></span>
                                                    <span class="tooltiptext tooltip-top">4.00</span>
                                                </div>
                                            </div>
                                            <div class="comment-user">
                                                <h4><a href="#">Johnathan Castillo</a></h4>
                                                <span class="comment-date">November 9, 2018 at 2:19 pm</span>
                                            </div>

                                            <div class="comment-content">
                                                <p>Vestibulum volutpat, lacus a ultrices sagittis, mi neque
                                                    euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus
                                                    pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- End Comments -->
                        <div class="reply">
                            <div class="title-wrapper text-left">
                                <h3 class="title title-simple text-left text-normal">Add a Review</h3>
                                <p>Your email address will not be published. Required fields are marked *</p>
                            </div>
                            <div class="rating-form">
                                <label for="rating">Your rating: </label>
                                <span class="rating-stars selected">
                                    <a class="star-1" href="#">1</a>
                                    <a class="star-2" href="#">2</a>
                                    <a class="star-3" href="#">3</a>
                                    <a class="star-4 active" href="#">4</a>
                                    <a class="star-5" href="#">5</a>
                                </span>

                                <select name="rating" id="rating" required="" style="display: none;">
                                    <option value="">Rate…</option>
                                    <option value="5">Perfect</option>
                                    <option value="4">Good</option>
                                    <option value="3">Average</option>
                                    <option value="2">Not that bad</option>
                                    <option value="1">Very poor</option>
                                </select>
                            </div>
                            <form action="#">
                                <textarea id="reply-message" cols="30" rows="4" class="form-control mb-4"
                                    placeholder="Comment *" required></textarea>
                                <div class="row">
                                    <div class="col-md-6 mb-5">
                                        <input type="text" class="form-control" id="reply-name" name="reply-name"
                                            placeholder="Name *" required />
                                    </div>
                                    <div class="col-md-6 mb-5">
                                        <input type="email" class="form-control" id="reply-email" name="reply-email"
                                            placeholder="Email *" required />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-md">Submit<i
                                        class="d-icon-arrow-right"></i></button>
                            </form>
                        </div>
                        <!-- End Reply -->
                    </div>
                </div>
            </div>

            @if (count($relateProducts) > 0)


                <section>
                    <h2 class="title">Related Product</h2>

                    <div class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4" data-owl-options="{
                           'items': 5,
                           'nav': false,
                           'loop': false,
                           'dots': true,
                           'margin': 20,
                           'responsive': {
                            '0': {
                             'items': 2
                            },
                            '768': {
                             'items': 3
                            },
                            '992': {
                             'items': 4,
                             'dots': false,
                             'nav': true
                            }
                           }
                          }">
                        @foreach ($relateProducts as $related)
                            <div class="product shadow-media">
                                <figure class="product-media">
                                    <a href="{{ route('admin.productlisting.show', $related['slug']) }}">
                                        @if (!empty($related->main_image) && file_exists('backend/assets/images/product/small/' . $related->main_image))
                                            <img src="{{ asset('backend/assets/images/product/small/' . $related->main_image) }}"
                                                alt="{{ $related }}" width="280" height="315">
                                        @else
                                            <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                                alt="{{ $related }}" width="280" height="315">
                                        @endif
                                    </a>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-cart" data-toggle="modal"
                                            data-target="#addCartModal" title="Add to cart"><i class="d-icon-bag"></i></a>
                                    </div>
                                    {{-- <div class="product-action">
                                        <a href="#" class="btn-product btn-quickview" title="Quick View">Quick View</a>
                                    </div> --}}
                                </figure>
                                <div class="product-details">
                                    <a href="#" class="btn-wishlist" title="Add to wishlist"><i
                                            class="d-icon-heart"></i></a>
                                    <div class="product-cat">
                                        <a
                                            href="{{ route('admin.productlisting.index', $related['category']['url']) }}">{{ $related['category']['category_name'] }}</a>
                                    </div>
                                    <h3 class="product-name">
                                        <a
                                            href="{{ route('admin.productlisting.show', $related['slug']) }}">{{ $related['product_name'] }}</a>
                                    </h3>
                                    <div class="product-price">
                                        <span class="price">Tk.{{ $related['product_price'] }}</span>
                                    </div>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width:100%"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </main>



@endsection
@push('js')
    <script src="{{ asset('/') }}frontend/vendor/sticky/sticky.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/photoswipe/photoswipe.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/photoswipe/photoswipe-ui-default.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('/') }}frontend/js/main.js"></script>
    <script>
        $(document).ready(function() {
                function incrementValue(e) {
                    e.preventDefault();
                    var fieldName = $(e.target).data('field');
                    var parent = $(e.target).closest('div');
                    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                    if (!isNaN(currentVal)) {
                        parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
                    } else {
                        parent.find('input[name=' + fieldName + ']').val(1);
                    }
                }

                function decrementValue(e) {
                    e.preventDefault();
                    var fieldName = $(e.target).data('field');
                    var parent = $(e.target).closest('div');
                    var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

                    if (!isNaN(currentVal) && currentVal > 1) {
                        parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                        parent.find('input[name=' + fieldName + ']').val(1);
                    }
                }

                $('.cartaddbtn').on('click', '.button-plus1', function(e) {
                    incrementValue(e);
                });

                $('.cartaddbtn').on('click', '.button-minus1', function(e) {
                    decrementValue(e);
                });
            })
    </script>
   
@endpush
