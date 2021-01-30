 <div class="row gutter-lg">
     <div class="col-lg-8 col-md-12">
         <table class="shop-table cart-table mt-2">
             <thead>
                 <tr>
                     <th><span>Product</span></th>
                     <th></th>
                     <th><span>MRP</span></th>
                     <th><span>quantity</span></th>
                     <th><span>Discount</span></th>
                     <th>Subtotal</th>
                 </tr>
             </thead>
             <tbody>
                 @php
                 $total_price=0;
                 @endphp
                 @foreach ($userCartItems as $item)
                     <?php $attributeprice =
                     App\Models\Product::getDiscountedAttributePrice($item['product_id'], $item['size']); ?>
                     <tr>
                         <td class="product-thumbnail">
                             <figure>
                                 @if (!empty($item['product']['main_image']) && file_exists('backend/assets/images/product/small/' . $item['product']['main_image']))
                                     <a href="{{ route('admin.productlisting.show', $item['product']['slug']) }}">
                                         <img src="{{ asset('backend/assets/images/product/small/' . $item['product']['main_image']) }}"
                                             alt="{{ $item['product']['product_name'] }}" width="100" height="100">
                                     </a>
                                 @else
                                     <a href="{{ route('admin.productlisting.show', $item['product']['slug']) }}">
                                         <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                             alt="{{ $item['product']['product_name'] }}" width="100" height="100">
                                     </a>
                                 @endif

                                 <a href="javascript:;" class="product-remove btnItemDelete" title="Remove this product" data-cartid="{{ $item['id'] }}">
                                     <i class="fas fa-times"></i>
                                 </a>
                             </figure>
                         </td>
                         <td class="product-name">
                             <div class="product-name-section">
                                 <a href="{{ route('admin.productlisting.show', $item['product']['slug']) }}">{{ $item['product']['product_name'] }}
                                 </a>
                                 </br>
                                 Size: {{ $item['size'] }}
                                 </br>
                                 Color: {{ $item['product']['product_color'] }}
                             </div>
                         </td>
                         <td class="product-subtotal">
                             <span class="amount">TK.{{ $attributeprice['proAttributePrice'] }}</span>
                         </td>
                         <td>
                             <div class="input-append">
                                 <button style="background: #0aa3d1;" class="btn btnItemUpdate qtnMinus" type="button"
                                     data-cartid="{{ $item['id'] }}">
                                     <i class="fas fa-minus"></i>
                                 </button>
                                 <input class="span1 box-shadow"
                                     style="max-width:34px;height: 30px;background-color: #e6e6e6; border-radius: 0px; border: 1px solid #c4b5b5;text-align: center;"
                                     placeholder="1" value="{{ $item['quantity'] }}" name="quantity" size="16"
                                     type="text">
                                 <button style="background: #0aa3d1;" class="btn btnItemUpdate qtnPlus" type="button"
                                     data-cartid="{{ $item['id'] }}">
                                     <i class="fas fa-plus"></i>
                                 </button>
                             </div>
                         </td>

                         <td class="product-price">
                             <del class="old-price"> <span
                                     class="amount">TK.{{ $attributeprice['discount_price'] * $item['quantity'] }}
                                 </span></del>
                         </td>
                         <td class="product-price">
                             <span class="amount">TK.{{ $attributeprice['final_price'] * $item['quantity'] }} </span>
                         </td>
                     </tr>
                     @php
                     $total_price=$total_price+($attributeprice['final_price']*$item['quantity']);
                     @endphp
                 @endforeach
             </tbody>
         </table>
         <div class="cart-actions mb-6 pt-6">
             <div class="coupon">
                 <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value=""
                     placeholder="Coupon code">
                 <button type="submit" class="btn btn-md">Apply Coupon</button>
             </div>
             <button type="submit" class="btn btn-md btn-icon-left"><i class="d-icon-refresh"></i>Update
                 Cart</button>
         </div>
     </div>
     <aside class="col-lg-4 sticky-sidebar-wrapper">
         <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
             <div class="summary mb-4">
                 <h3 class="summary-title text-left">Cart Totals</h3>
                 <table class="shipping">
                     <tr class="summary-subtotal">
                         <td>
                             <h4 class="summary-subtitle">Subtotal</h4>
                         </td>
                         <td>
                             <p class="summary-subtotal-price">TK.{{ $total_price }}</p>
                         </td>
                     </tr>
                     <tr class="sumnary-shipping shipping-row-last">
                         <td colspan="2">
                             <h4 class="summary-subtitle">Shipping</h4>
                             <ul>
                                 <li>
                                     <div class="custom-radio">
                                         <input type="radio" id="free-shipping" name="shipping"
                                             class="custom-control-input" checked>
                                         <label class="custom-control-label" for="free-shipping">Free
                                             Shipping</label>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="custom-radio">
                                         <input type="radio" id="standard_shipping" name="shipping"
                                             class="custom-control-input">
                                         <label class="custom-control-label" for="standard_shipping">Standard</label>
                                     </div>
                                 </li>
                                 <li>
                                     <div class="custom-radio">
                                         <input type="radio" id="express_shipping" name="shipping"
                                             class="custom-control-input">
                                         <label class="custom-control-label" for="express_shipping">Express</label>
                                     </div>
                                 </li>
                             </ul>
                         </td>
                     </tr>
                 </table>
                 <div class="shipping-address pb-4">

                     <div class="select-box">
                         <select name="country" class="form-control">
                             <option value="default" selected="selected">California</option>
                         </select>
                     </div>
                     <input type="text" class="form-control" name="code" placeholder="Town / city" />
                     <input type="text" class="form-control" name="code" placeholder="zip" />
                     <a href="#" class="btn btn-md">Update totals</a>
                 </div>
                 <table>
                     <tr class="summary-subtotal">
                         <td>
                             <h4 class="summary-subtitle">Total</h4>
                         </td>
                         <td>
                             <p class="summary-total-price">TK.{{ $total_price }}</p>
                         </td>
                     </tr>
                 </table>
                 <a href="checkout.html" class="btn btn-dark btn-checkout">Proceed to checkout</a>
             </div>
         </div>
     </aside>
 </div>
