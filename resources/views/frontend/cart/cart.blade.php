@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/css/front.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    {{-- <style>
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
            margin: 15px 0;
            position: relative;
        }

        .input-group input[type='button'] {
            background-color: Lime;
            min-width: 38px;
            width: auto;
            transition: all 300ms ease;
        }

        .input-group .button-minus,
        .input-group .button-plus {
            font-weight: bold;
            height: 38px;
            padding: 0;
            width: 38px;
            position: relative;
        }

         .input-group .button-minus,
        .input-group .button-plus {
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

        .button-plus {
            left: -13px;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

    </style> --}}
@endpush
@extends('frontend.master')
@section('content')

    <main class="main cart">
        @empty($userCartItems)
            <div class="container">
                <p>No Proudct in your cart</p> Go back to <span><a style="margin-bottom: 2px;" class="btn btn-secondary"
                        href="{{ route('admin.home.index') }}">Home</a></span>
            </div>
        @else
            <div class="page-content pt-10 pb-10">
                <div class="step-by pt-2 pb-2 pr-4 pl-4">
                    <h3 class="title title-simple title-step active"><a href="{{ route('admin.productlisting.cart') }}">1.
                            Shopping Cart</a></h3>
                    <h3 class="title title-simple title-step"><a href="checkout.html">2. Checkout</a></h3>
                    <h3 class="title title-simple title-step"><a href="order.html">3. Order Complete</a></h3>
                </div>
                <div class="container mt-8 mb-4">
                    <div  id="appentCartItem">
                        @include('frontend.cart.cart_item')
                    </div>
                </div>
            </div>
        @endempty
    </main>

@endsection

@push('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endpush
