@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('/') }}backend/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    @section('title')
        Product Images Management
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
                                <li class="breadcrumb-item active" aria-current="page">Product Images</li>
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
                            <div class="col-12 col-lg-5 ml-auto">
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
                        <div class="bs-example mt-2 ">
                            <form action="{{ route('admin.productimages.addProductImage', $product->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">

                                    <div class="col-sm-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend"> <span class="input-group-text"
                                                    id="inputGroupFileAddon01">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" name="name[]" class="custom-file-input" id="fileupload"
                                                    aria-describedby="inputGroupFileAddon01" multiple="multiple" required>
                                                <label class="custom-file-label" for="fileupload">Choose file</label>
                                            </div>
                                        </div>
                                        <b>Live Preview</b>
                                        <br />
                                        <div id="dvPreview">
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
                            <table id="example" class="table text-center table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->images as $key => $image)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @php
                                                $img_path="backend/assets/images/product/medium/".$image->name;
                                                @endphp
                                                @if (!empty($image->name) && file_exists($img_path))
                                                    <img src="{{ asset('backend/assets/images/product/medium/' . $image->name) }}"
                                                        class="rounded ml-3 shadow" alt="" width="80" height="80">
                                                @else
                                                    <img src="{{ asset('backend/assets/images/no_image.png') }}"
                                                        class="rounded ml-3 shadow" alt="" width="80" height="80">
                                                @endif
                                            </td>
                                            <td>
                                                @if ($image->status)
                                                    <a class="badge-info " href="javascript:;">Active</a>
                                                @else
                                                    <a class="badge-warning " href="javascript:;">Inactive</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($image->status)
                                                    <a href="{{ route('admin.productimages.unpublished', $image->id) }}"
                                                        class="btn btn-sm btn-success unpublished-confirm">
                                                        <i class="fadeIn animated bx bx-chevron-up-square"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.productimages.published', $image->id) }}"
                                                        class="btn btn-sm btn-warning  published-confirm">
                                                        <i class="fadeIn animated bx bx-chevron-down-square"></i>
                                                    </a>

                                                @endif
                                                <a title="Delete"
                                                    href="{{ route('admin.productimages.destroy', $image->id) }}"
                                                    class="btn btn-sm btn-danger  delete-confirm">
                                                    <i class="fadeIn animated bx bx-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                   
                </div> 
                @else
                <p>No peoduct found</p>
                @endif
            </div>
        </div>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        });

    </script>

    <script language="javascript" type="text/javascript">
        $(function() {
            $("#fileupload").change(function() {
                if (typeof(FileReader) != "undefined") {
                    var dvPreview = $("#dvPreview");
                    dvPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function() {
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var img = $("<img />");
                                img.attr("style",
                                    "height:100px;width: 100px;border: 1px solid black; margin-right: 2px;"
                                );
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                            alert(file[0].name + " is not a valid image file.");
                            dvPreview.html("");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });

    </script>

@endpush
