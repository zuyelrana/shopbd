@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('/') }}backend/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}backend/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    @section('title')
        Category Management
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
                                <li class="breadcrumb-item active" aria-current="page">Category</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="card  radius-15 border-lg-top-primary">
                    <div class="card-body">
                        <div class="card-title">
                            <h4 class="mb-0">Category<span> <a class="btn btn-primary"
                                        href="{{ route('admin.category.add_edit_category') }}">Add</a></span></h4>
                        </div>
                        <hr />
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Category Name</th>
                                        <th>Category Level</th>
                                        <th>Section Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('/') . $category->category_image }}"
                                                    class="rounded ml-3 shadow" alt="" width="80" height="80">
                                            </td>
                                            <td>

                                                @if ($category->status)
                                                    <a class="badge-info updateCategoryStatus"
                                                        id="category-{{ $category->id }}" category_id="{{ $category->id }}"
                                                        href="javascript:;">Active</a>
                                                @else
                                                    <a class="badge-warning updateCategoryStatus"
                                                        id="category-{{ $category->id }}" category_id="{{ $category->id }}"
                                                        href="javascript:;">Inactive</a>
                                                @endif

                                            </td>
                                            <td>{{ $category->category_name }}</td>
                                             <td>
                                                @isset($category->parentcategory->category_name)
                                                    {{ $category->parentcategory->category_name }}
                                                @else
                                                    Root
                                                @endisset
                                            </td>
                                            <td>{{ $category->section['name'] }}</td>

                                            <td>

                                                <a class="btn btn-sm btn-info"
                                                    href="{{ route('admin.category.add_edit_category', $category->id) }}"><i
                                                        class="fadeIn animated bx bx-edit"></i></a>

                                                <a href="{{ route('admin.category.destroy',$category->id) }}" class="btn btn-sm btn-danger  delete-confirm">
                                                    <i class="fadeIn animated bx bx-trash"></i>
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Category Name</th>
                                        <th>Category Level</th>
                                        <th>Section Name</th>
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
        $(".updateCategoryStatus").click(function() {
            var status = $(this).text();
            var category_id = $(this).attr("category_id");
            $.ajax({
                type: "POST",
                url: "/admin/category/update-status",
                data: {
                    status: status,
                    category_id: category_id
                },
                success: function(resp) {
                    if (resp['status'] == false) {
                        $("#category-" + category_id).html(
                            "<a class='badge-warning updateCategoryStatus'  href='javascript:void(0)'>Inactive</a>"
                        );
                    } else {
                        $("#category-" + category_id).html(
                            "<a class='badge-info updateCategoryStatus'  href='javascript:void(0)'>Active</a>"
                        );
                    }
                },
                error: function() {
                    alert("Somethig Gone wrong Here");
                }
            });
        });

    </script>

@endpush
