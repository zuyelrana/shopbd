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
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}"><i
                                            class='bx bx-home-alt'></i> Product</a>
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
                                                href="{{ route('admin.product.index') }}">Product Manage</a></span></h4>
                                </div>
                                <hr />
                                <form @if (!empty($product->id))
                                    action="{{ route('admin.product.update',$product->id) }}"
                                    @else
                                      action="{{ route('admin.product.store') }}"
                                @endif method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Select Category</label>
                                            <div class="col-sm-4">
                                                <select class="single-select1 @error('category_id') is-invalid @enderror"
                                                    id="category_id" name="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $section)
                                                        <optgroup label="{{ $section->name }}"></optgroup>
                                                        @foreach ($section->categories as $category)
                                                            <option value="{{ $category->id }}" @if (!empty(old('category_id')) && old('category_id') == $category->id)
                                                                selected
                                                            @elseif(!empty($product->category_id) && $category->id==$product->category_id)
                                                            selected
                                                        @endif > &nbsp; &nbsp;&nbsp;&rArr;
                                                        {{ $category->category_name }}
                                                        </option>
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <option value="{{ $subcategory->id }}" @if (!empty(old('category_id')) && old('category_id') == $subcategory->id)
                                                                selected
                                                             @elseif(!empty($product->category_id) && $subcategory->id==$product->category_id)
                                                            selected
                                                        @endif> &nbsp; &nbsp;&nbsp;
                                                        &nbsp; &nbsp;&nbsp;&rArr;
                                                        {{ $subcategory->category_name }}
                                                        </option>
                                                    @endforeach
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                                @error('section_id')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                             <label class="col-sm-2 col-form-label">Brands</label>
                                            <div class="col-sm-4">
                                                <select class="single-select @error('brand_id') is-invalid @enderror"
                                                    id="brand_id" name="brand_id">
                                                    <option value="" >Select Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand['id'] }}" @if (!empty(old('brand_id')) && old('brand_id') == $brand['id'])
                                                            selected
                                                       @elseif(!empty($product->brand_id) && $product->brand_id=== $brand['id'])
                                                       selected
                                                    @endif>{{ $brand['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('fabric')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                          <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Product Name</label>
                                            <div class="col-sm-4">
                                                <input type="text"
                                                    class="form-control  @error('product_name') is-invalid @enderror"
                                                    name="product_name"
                                                    value="{{ $product->product_name ?? old('product_name') }}"
                                                    placeholder="Product Name" required>
                                                @error('product_name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                             <label class="col-sm-2 col-form-label">Product Weight(KG)</label>
                                            <div class="col-sm-4">
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                    class="form-control  @error('product_weight') is-invalid @enderror"
                                                    name="product_weight"
                                                    value="{{ $product->product_weight ?? old('product_weight') }}"
                                                    placeholder="Product Weight" required>
                                                @error('product_weight')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Product Code</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="product_code"
                                                    class="form-control @error('product_code') is-invalid @enderror"
                                                    placeholder="Enter Product Code"
                                                    value="{{ $product->product_code ?? old('product_code') }}">
                                                @error('product_code')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Product Color</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="product_color"
                                                    class="form-control @error('product_color') is-invalid @enderror"
                                                    placeholder="Enter Product Color"
                                                    value="{{ $product->product_color ?? old('product_color') }}">
                                                @error('product_color')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Price</label>
                                            <div class="col-sm-4">
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="product_price"
                                                    class="form-control  @error('product_price') is-invalid @enderror"
                                                    placeholder="Enter Product Price"
                                                    value="{{ $product->product_price ?? old('product_price') }}">
                                                @error('product_price')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Discount(%)</label>
                                            <div class="col-sm-4">
                                                <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  name="product_discount"
                                                    class="form-control @error('product_discount') is-invalid @enderror"
                                                    placeholder="Enter Product Discount"
                                                    value="{{ $product->product_discount ?? old('product_discount') }}">
                                                @error('product_discount')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Product Image</label>
                                      
                                            <div class="col-sm-10">
                                                <input type="file" name="main_image"
                                                    class="dropify @error('main_image') is-invalid @enderror"
                                                    data-max-file-size-preview="8M"
                                                    @if(isset($product->main_image) && file_exists("backend/assets/images/product/large/".$product->main_image))
                                                         data-default-file="/backend/assets/images/product/large/{{ $product->main_image }}"
                                                    @endif
                                                    {{ !isset($product->id) ? 'required' : '' }} />
                                                    @error('main_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control @error('description') is-invalid @enderror"
                                                    id="body" name="description">{{ $product->description ?? old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Wash Care</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="wash_care"
                                                    class="form-control @error('wash_care') is-invalid @enderror"
                                                    placeholder="Enter Wash care"
                                                    value="{{ $product->wash_care ?? old('wash_care') }}">
                                                @error('wash_care')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Fabric</label>
                                            <div class="col-sm-4">
                                                <select class="single-select @error('fabric') is-invalid @enderror"
                                                    id="fabric" name="fabric">
                                                    <option value="" >Select Fabric</option>
                                                    @foreach ($FabricArray as $fabric)
                                                        <option value="{{ $fabric }}" @if (!empty(old('fabric')) && old('fabric') == $fabric)
                                                            selected
                                                       @elseif(!empty($product->fabric) && $product->fabric===$fabric)
                                                       selected
                                                    @endif>{{ $fabric }}</option>
                                                    @endforeach
                                                </select>
                                                @error('fabric')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Pattern</label>
                                            <div class="col-sm-4">
                                                <select class="single-select1 @error('pattern') is-invalid @enderror"
                                                    id="pattern" name="pattern">
                                                    <option value="" >Select Pattern</option>
                                                    @foreach ($PatternArray as $pattern)
                                                        <option value="{{ $pattern }}" @if (!empty(old('pattern')) && old('pattern') == $pattern)
                                                            selected
                                                           @elseif(!empty($product->pattern) && $product->pattern===$pattern)
                                                            selected
                                                    @endif>{{ $pattern }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pattern')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Sleeve</label>
                                            <div class="col-sm-4">
                                                <select class="single-select @error('sleeve') is-invalid @enderror"
                                                    id="sleeve" name="sleeve">
                                                    <option value="" >Select Sleeve</option>
                                                    @foreach ($SleeveArray as $sleeve)
                                                        <option value="{{ $sleeve }}" @if (!empty(old('sleeve')) && old('sleeve') == $sleeve)
                                                            selected
                                                         @elseif(!empty($product->sleeve) && $product->sleeve===$sleeve)
                                                            selected
                                                    @endif>{{ $sleeve }}</option>
                                                    @endforeach
                                                </select>
                                                @error('sleeve')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Fit</label>
                                            <div class="col-sm-4">
                                                <select class="single-select1 @error('fit') is-invalid @enderror" id="fit"
                                                    name="fit">
                                                    <option value="" >Select Fit</option>
                                                    @foreach ($FitArray as $fit)
                                                        <option value="{{ $fit }}" @if (!empty(old('fit')) && old('fit') == $fit) selected
                                                        @elseif(!empty($product->fit) && $product->fit===$fit)
                                                            selected
                                                    @endif>{{ $fit }}</option>
                                                    @endforeach
                                                </select>
                                                @error('pattern')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Ocassion</label>
                                            <div class="col-sm-4">
                                                <select class="single-select @error('ocassion') is-invalid @enderror"
                                                    id="ocassion" name="ocassion">
                                                    <option value="" >Select Ocassion</option>
                                                    @foreach ($OcassionArray as $ocassion)
                                                        <option value="{{ $ocassion }}" @if (!empty(old('ocassion')) && old('ocassion') == $ocassion)
                                                            selected
                                                         @elseif(!empty($product->ocassion) && $product->ocassion===$ocassion)
                                                       selected
                                                    @endif>{{ $ocassion }}</option>
                                                    @endforeach
                                                </select>
                                                @error('ocassion')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <label class="col-sm-2 col-form-label">Meta title</label>
                                            <div class="col-sm-4">
                                                <input class="form-control @error('meta_title') is-invalid @enderror"
                                                    type="text" id="meta_title" name="meta_title"
                                                    value="{{ $product->meta_title ?? old('meta_title') }}"
                                                    placeholder="Meta Title">
                                                @error('meta_title')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Meta Keywords</label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('meta_keywords') is-invalid @enderror"
                                                    type="text" id="meta_keywords" name="meta_keywords"
                                                     value="{{ $product->meta_keywords ?? old('meta_keywords') }}"
                                                    placeholder="Meta Keywords">
                                                @error('meta_keywords')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Meta Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="meta_description" name="meta_description"
                                                    class="form-control @error('meta_description') is-invalid @enderror"
                                                    placeholder="Meta Description">{{ $product->meta_description ?? old('meta_description') }}</textarea>
                                                @error('meta_description')
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
                                                    <input class="form-check-input" type="checkbox" id="is_featured"
                                                        name="is_featured" value="1" @if (!empty(old('is_featured')) && old('is_featured') == 1)
                                                    checked
                                                     @elseif(!empty($product->is_featured) && $product->is_featured==='Yes')
                                                       checked
                                                    @endif>
                                                    <label class="form-check-label" for="is_featured">Featured Item</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary px-4">
                                                  @if (isset($product->id))
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
