@push('css')
    <link href="{{ asset('/') }}backend/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}backend/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    @section('title')
        {{ $title }} Management
    @endsection
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

    </style>
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
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                            class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.banner.index') }}"><i
                                            class='bx bx-home-alt'></i> Banner</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col-12 col-lg-12 mx-auto">
                        <div class="card radius-15">
                            <div class="card-body">
                                <div class="card-title">

                                    <h4 class="mb-0">{{ $title }}<span> <a class="btn btn-primary"
                                                href="{{ route('admin.banner.index') }}">Banner Manage</a></span></h4>
                                </div>
                                <hr />
                                <form @if (!empty($banner->id))
                                    action="{{ route('admin.banner.update', $banner->id) }}"
                                @else
                                    action="{{ route('admin.banner.addBannerImage') }}"
                                    @endif method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Banner Title</label>
                                            <div class="col-sm-4">
                                                <input type="text"
                                                    class="form-control  @error('title') is-invalid @enderror" name="title"
                                                    value="{{ $banner->title ?? old('title') }}" placeholder="Banner title"
                                                    required>
                                                @error('title')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Alt title</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control  @error('alt') is-invalid @enderror"
                                                    name="alt" value="{{ $banner->alt ?? old('alt') }}" placeholder="Alt"
                                                    required>
                                                @error('alt')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Banner Link</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="link"
                                                    class="form-control @error('link') is-invalid @enderror"
                                                    placeholder="Enter Link" value="{{ $banner->link ?? old('link') }}">
                                                @error('link')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Banner Image</label>

                                            <div class="col-sm-10">
                                                <input type="file" name="image"
                                                    class="dropify @error('image') is-invalid @enderror"
                                                    data-max-file-size-preview="8M" @if (isset($banner->image) && file_exists('backend/assets/images/banner/' . $banner->image))
                                                data-default-file="/backend/assets/images/banner/{{ $banner->image }}"
                                                @endif
                                                {{ !isset($banner->id) ? 'required' : '' }} />
                                                @error('main_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="status"
                                                        name="status" value="1" @if (!empty(old('status')) && old('status') == 1)
                                                    checked
                                                @elseif(!empty($banner->status) && $banner->status===1)
                                                    checked
                                                    @endif>
                                                    <label class="form-check-label" for="status">Status</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary px-4">
                                                    @if (isset($banner->id))
                                                        Update
                                                    @else
                                                        Add
                                                    @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->

            </div>
        </div>
        <!--end page-content-wrapper-->
    </div>
@endsection
@push('js')
    <script src="{{ asset('/') }}backend/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

    </script>
    <script>
        $('.single-select1').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

    </script>
    <!-- Ckeditor JS -->
    <script src="{{ asset('backend/assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description', {

            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",

            filebrowserUploadMethod: 'form'

        });

    </script>
@endpush
