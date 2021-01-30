@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('/') }}backend/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    @section('title')
        Product Management
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
                                <li class="breadcrumb-item active" aria-current="page">Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="card  radius-15 border-lg-top-primary">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="mb-0">Product<span> <a class="btn btn-primary"
                                        href="{{ route('admin.product.add_edit_product') }}">Add</a></span></h4>
                        </div>
                        <hr />
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Category</th>
                                        <th>Section</th>
                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                @php
                                                $img_path="backend/assets/images/product/small/".$product->main_image;
                                                @endphp
                                                @if (!empty($product->main_image) && file_exists($img_path))
                                                    <img src="{{ asset('backend/assets/images/product/small/' . $product->main_image) }}"
                                                        class="rounded ml-3 shadow" alt="" width="80" height="80">
                                                    <a href="{{ route('admin.productimages.addProductImage', $product->id) }}"
                                                        title="Add More Image"><span class="text-success"><i
                                                                class="fadeIn animated bx bx-plus"></i></span></a>
                                                @else
                                                    <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                                        class="rounded ml-3 shadow" alt="" width="80" height="80">
                                                    <a href="{{ route('admin.productimages.addProductImage', $product->id) }}"
                                                        title="Add More Image"><span class="text-success"><i
                                                                class="fadeIn animated bx bx-plus"></i></span></a>
                                                @endif


                                            </td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>
                                                @if ($product->status)
                                                    <a class="badge-info updateProductstatus"
                                                        id="product-{{ $product->id }}" product_id="{{ $product->id }}"
                                                        href="javascript:;">Active</a>
                                                @else
                                                    <a class="badge-warning updateProductstatus"
                                                        id="product-{{ $product->id }}" product_id="{{ $product->id }}"
                                                        href="javascript:;">Inactive</a>
                                                @endif
                                              
                                            </td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                         
                                            <td>
                                                <a title="Attribute" class="btn btn-sm btn-success"
                                                    href="{{ route('admin.productattribute.addAttribute', $product->id) }}"><i
                                                        class="fadeIn animated bx bx-comment-edit"></i></a>

                                                <a title="Edit" class="btn btn-sm btn-info"
                                                    href="{{ route('admin.product.add_edit_product', $product->id) }}"><i
                                                        class="fadeIn animated bx bx-edit"></i></a>

                                                <a title="Delete" href="{{ route('admin.product.destroy', $product->id) }}"
                                                    class="btn btn-sm btn-danger  delete-confirm">
                                                    <i class="fadeIn animated bx bx-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>#SL</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Code</th>
                                        <th>Color</th>
                                        <th>Category</th>
                                        <th>Section</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page-content-wrapper-->
    </div>
@endsection
@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/') }}backend/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });

    </script>
    <script>
        $(document).on("click", ".updateProductstatus", function(event) {
            var status = $(this).text();
            var product_id = $(this).attr("product_id");
            $.ajax({
                type: "POST",
                url: "/admin/product/update-status",
                data: {
                    status: status,
                    product_id: product_id
                },
                success: function(resp) {
                    if (resp['status'] == false) {
                        $("#product-" + product_id).html(
                            "<a class='badge-warning updateProductstatus'  href='javascript:void(0)'>Inactive</a>"
                        );
                    } else {
                        $("#product-" + product_id).html(
                            "<a class='badge-info updateProductstatus'  href='javascript:void(0)'>Active</a>"
                        );
                    }
                },
                error: function() {
                  
                }
            });
        });

    </script>

@endpush
