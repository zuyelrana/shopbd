@push('css')
    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/css/style.min.css">
    <style>
        /* Customize the label (the container) */
        .container1 {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container1 input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container1:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container1 input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container1 input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container1 .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

    </style>
@endpush

@extends('frontend.master')
@section('content')

    <main class="main">

        <div class="page-content mb-10">
            <div class="container">
                <nav class="breadcrumb-nav">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('admin.home.index') }}"><i class="d-icon-home"></i> Home</a>
                        </li>
                        <li>
                            <?php echo $categoryDetails['breadcrumbs']; ?>
                        </li>
                    </ul>
                </nav>
                <div class="row main-content-wrap gutter-lg">

                    @include('frontend.include.filter')
                    <div class="col-lg-9 main-content">

                        <nav class="toolbox sticky-toolbox sticky-content fix-top">
                            <form name="sortProduct" id="sortProduct">
                                <input type="hidden" name="url" id="url" value="{{ $url }}">
                                <div class="toolbox-left">
                                    <a href="#"
                                        class="toolbox-item left-sidebar-toggle btn btn-sm btn-outline btn-primary d-lg-none">Filters<i
                                            class="d-icon-arrow-right"></i></a>
                                    <div class="toolbox-item toolbox-sort select-box">
                                        <label>Sort By :</label>
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="">Default</option>
                                            <option value="product_latest" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_latest')
                                                selected @endif>Latest Product</option>
                                            <option value="product_name_a_to_z" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_name_a_to_z')
                                                selected @endif>Product name A - Z</option>
                                            <option value="product_name_z_to_a" @if (isset($_GET['sort']) && $_GET['sort'] == 'product_name_z_to_a')
                                                selected @endif>Product name Z - A</option>
                                            <option value="price_low" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_low') selected
                                                @endif>Low to Highest price</option>
                                            <option value="price_high" @if (isset($_GET['sort']) && $_GET['sort'] == 'price_high') selected
                                                @endif>Highest to Low price</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-show select-box">
                                    <label>Show :</label>
                                    <select name="count" class="form-control">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select>
                                </div>
                                <div class="toolbox-item toolbox-layout">
                                    <a class="d-icon-mode-grid btn-layout active"></a>
                                </div>
                            </div>
                        </nav>
                        @if (count($categoryProducts) > 0)
                            <div class="row cols-2 cols-sm-3 cols-md-4 product-wrapper filtter_product">

                                @include('frontend.listing.ajax_products')
                            </div>

                            <nav class="toolbox toolbox-pagination">
                                @if ($categoryProducts->count() < $categoryProducts->total())
                                    <p class="show-info">Showing <span>{{ $categoryProducts->count() }} of
                                            {{ $categoryProducts->total() }}</span> Products</p>
                                @else
                                    <p class="show-info">Showing <span>All product</span></p>

                                @endif

                                @if (isset($_GET['sort']) && !empty($_GET['sort']))
                                    {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                                @else
                                    {{ $categoryProducts->links() }}
                                @endif
                            </nav>
                        @else
                            <p>No Product Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
