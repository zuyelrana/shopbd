@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    @section('title')
        Product Attribute Management
    @endsection
@endpush
@extends('backend.master')
@section('content')
    <div class="page-wrapper">
        <!--page-content-wrapper-->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pr-3">Dashboard</div>
                    <div class="pl-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product Attribute</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                @if (!empty($product))
                    <div class="card radius-15 border-lg-top-danger">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-5 border-right ml-auto">
                                    <div class="d-md-flex align-items-center">
                                        <div class="">
                                            @php
                                            $img_path="backend/assets/images/product/medium/".$product->main_image;
                                            @endphp
                                            @if (!empty($product->main_image) && file_exists($img_path))
                                                <img src="{{ asset('backend/assets/images/product/medium/' . $product->main_image) }}"
                                                    class="rounded ml-3 shadow" alt="" width="200" height="200">
                                            @else
                                                <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                                    class="rounded ml-3 shadow" alt="" width="200" height="200">
                                            @endif

                                        </div>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-7 ml-auto">
                                    <table class="table table table-borderless mt-md-0 mt-3">
                                        <tbody>
                                            <tr>
                                                <th>Product Name:</th>
                                                <td>{{ $product->product_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Code:</th>
                                                <td>{{ $product->product_code }}</td>
                                            </tr>
                                            <tr>
                                                <th>Price($):</th>
                                                <td>{{ $product->product_price }}</td>

                                            </tr>
                                            <tr>
                                                <th>Discount($):</th>
                                                <td>{{ $product->product_discount }}</td>

                                            </tr>
                                            <tr>
                                                <th>Weight(Kg):</th>
                                                <td>{{ $product->product_weight }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!--end row-->

                            <div class="bs-example mt-2 ">
                                <form action="{{ route('admin.productattribute.addAttribute', $product->id) }}"
                                    method="POST">
                                    @csrf
                                    <div class="add_item">
                                        <div class="row p-1">
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="text" name="size[]" class="form-control" required
                                                        placeholder="Size">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" name="price[]"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        class="form-control" required placeholder="Price">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <input type="text" name="stock[]"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        class="form-control" required placeholder="Stock">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group">
                                                    <span class="btn btn-primary  addeventmore"><i
                                                            class="lni lni-circle-plus"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-success mt-2">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <hr />
                            <div class="table-responsive">
                                <form action="{{ route('admin.productattribute.update', $product->id) }}"
                                    method="POST">
                                    @csrf
                                   
                                    <table id="example" class="table text-center table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>SKU</th>
                                                <th>Staus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->attributes as $key => $attribute)
                                             <input style="display: none" name="attribute_id[]" value="{{ $attribute->id }}">
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $attribute->size }}</td>

                                                    <td>
                                                        <input type="text" name="price[]"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                            value="{{ $attribute->price }}" required placeholder="Price">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="stock[]"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                            value="{{ $attribute->stock }}" required placeholder="Stock">
                                                    </td>

                                                    <td>{{ $attribute->sku }}</td>
                                                    <td>
                                                        @if ($attribute->status)
                                                            <a class="badge-info updateAttributeStatus"
                                                                href="javascript:;">Active</a>
                                                        @else
                                                            <a class="badge-warning updateAttributeStatus"
                                                                href="javascript:;">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($attribute->status)
                                                            <a href="{{ route('admin.productattribute.unpublished', $attribute->id) }}"
                                                                class="btn btn-sm btn-success unpublished-confirm">
                                                                <i class="fadeIn animated bx bx-chevron-up-square"></i>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.productattribute.published', $attribute->id) }}"
                                                                class="btn btn-sm btn-warning  published-confirm">
                                                                <i class="fadeIn animated bx bx-chevron-down-square"></i>
                                                            </a>

                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>SL</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>SKU</th>
                                                <th>Staus</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>

                                    </table>
                                    <button class="btn btn-info" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <p>No Product found</p>
                @endif
            </div>
        </div>

    </div>
    <div style="visibility: hidden;">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="row p-1">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" name="size[]" class="form-control" required placeholder="Size">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="price[]"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control" required placeholder="Price">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" name="stock[]"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                class="form-control" required placeholder="Stock">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                            <span class="btn  btn-danger  removeeventmore"><i class="lni lni-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @push('js')
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('/') }}backend/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('/') }}backend/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(function() {
                $("#example").DataTable();
            });

        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                var counter = 0;
                $(document).on("click", ".addeventmore", function() {
                    var whole_extra_item_add = $("#whole_extra_item_add").html();
                    $(this).closest(".add_item").append(whole_extra_item_add);
                    counter++;
                });
                $(document).on("click", ".removeeventmore", function() {
                    var delete_whole_extra_item_add = $("#delete_whole_extra_item_add").html();
                    $(this).closest(".delete_whole_extra_item_add").remove();
                    counter--;
                });
            });

        </script>

    @endpush
