<div class="bounce-loader" style="display: none">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
    <div class="bounce4"></div>
</div>
@foreach ($categoryProducts as $categoryproduct)
    <div class="product-wrap " id="filter_display1">

        <div class="product shadow-media">
            <figure class="product-media">
                @if (!empty($categoryproduct['main_image']) && file_exists('backend/assets/images/product/medium/' . $categoryproduct['main_image']))
                    <a href="{{ route('admin.productlisting.show', $categoryproduct['slug']) }}">
                        <img src="{{ asset('backend/assets/images/product/medium/' . $categoryproduct['main_image']) }}"
                            alt="{{ $categoryproduct['product_name'] }}" width="280" height="315">
                    </a>
                @else
                    <a href="{{ route('admin.productlisting.show', $categoryproduct['slug']) }}">
                        <img src="{{ asset('backend/assets/images/no_image.png') }}"
                            alt="{{ $categoryproduct['product_name'] }}" width="280" height="315">
                    </a>
                @endif

                </a>
                <div class="product-label-group">
                    <label class="product-label label-new">{{ $categoryproduct['brand']['name'] }}</label>
                </div>
                <div class="product-action-vertical">
                    <a href="#" class="btn-product-icon btn-cart" data-toggle="modal" data-target="#addCartModal"
                        title="Add to cart"><i class="d-icon-bag"></i></a>
                </div>
                {{-- <div class="product-action">
                    <a href="#" class="btn-product btn-quickview" title="Quick View">Quick
                        View</a>
                </div> --}}
            </figure>
            <div class="product-details">
                <a href="#" class="btn-wishlist" title="Add to wishlist"><i class="d-icon-heart"></i></a>
                <div class="product-cat">
                    <a href="">categories</a>
                </div>
                <h3 class="product-name">
                    <a
                        href="{{ route('admin.productlisting.show', $categoryproduct['slug']) }}">{{ $categoryproduct['product_name'] }}</a>

                </h3>
                <?php $discount_price = App\Models\Product::getDiscountPrice($categoryproduct['id']); ?>
                <div class="product-price">
                    @if ($discount_price > 0)
                        <ins class="new-price">TK. {{ $discount_price }}</ins>
                        <del class="old-price oldPrice">Tk.{{ $categoryproduct['product_price'] }}</del>
                    @else
                        <ins class="new-price">TK. {{ $categoryproduct['product_price'] }}</ins>
                    @endif
                </div>
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width:100%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="" class="rating-reviews">( j )</a>
                </div>
            </div>
        </div>
    </div>
@endforeach
