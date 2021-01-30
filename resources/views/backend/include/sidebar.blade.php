<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="">
            <img src="{{ asset('/') }}backend/assets/images/logo-icon.png" class="logo-icon-2" alt="" />
        </div>
        <div>
            <h4 class="logo-text">Syndash</h4>
        </div>
        <a href="javascript:;" class="toggle-btn ml-auto"> <i class="bx bx-menu"></i>
        </a>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.home') }}">
                <div class="parent-icon icon-color-1"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>

        <li class="menu-label">Information</li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon icon-color-10"><i class="bx bx-spa"></i>
                </div>
                <div class="menu-title">Shop Information</div>
            </a>
            <ul class="{{ Request::is('dashboard/*') ? 'menu-show' : '' }} ">
                {{-- Section --}}
                <li class="{{ Request::is('admin/section*') ? 'mm-active' : '' }}"> <a
                        href="{{ route('admin.section.index') }}"><i class="bx bx-right-arrow-alt"></i>Section</a>
                </li>
                {{-- Banner --}}
                <li> 
                    <a class="has-arrow" href="javascript:;">
                        <div class="icon-color-11"><i class="bx bx-spa"></i>
                        </div>
                        <div class="menu-title">Banner</div>
                    </a>
                    <ul class="{{ Request::is('admin/banner*') ? 'mm-show' : '' }}">
                        <li class="{{ Request::is('admin/banner/image/add-edit') ? 'mm-active' : '' }} {{ Request::is('admin/banner/image/add-edit/*') ? 'mm-active' : '' }}">
                            <a href="{{ route('admin.banner.addBannerImage') }}"><i class="bx bx-right-arrow-alt"></i>
                                @if (Request::is('admin/banner/image/add-edit/*'))
                                    Edit Benner
                                @else
                                    Add
                                @endif
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/banner/image') ? 'mm-active' : '' }} ">
                            <a href="{{ route('admin.banner.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage</a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('admin/brand*') ? 'mm-active' : '' }}"> <a
                        href="{{ route('admin.brand.index') }}"><i class="bx bx-right-arrow-alt"></i>Brand</a>
                </li>
                {{-- //Category Mange --}}
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="icon-color-11"><i class="bx bx-spa"></i>
                        </div>
                        <div class="menu-title">Category</div>
                    </a>
                    <ul class="{{ Request::is('admin/category*') ? 'mm-show' : '' }}">
                        <li
                            class="{{ Request::is('admin/category/add-edit-category') ? 'mm-active' : '' }} {{ Request::is('admin/category/add-edit-category/*') ? 'mm-active' : '' }}">
                            <a href="{{ url('/admin/category/add-edit-category') }}"><i
                                    class="bx bx-right-arrow-alt"></i>
                                @if (Request::is('admin/category/add-edit-category/*'))
                                    Edit Category
                                @else
                                    Add
                                @endif
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/category') ? 'mm-active' : '' }} ">
                            <a href="{{ route('admin.category.index') }}"><i
                                    class="bx bx-right-arrow-alt"></i>Manage</a>
                        </li>
                    </ul>
                </li>
                {{-- //Product Manage --}}
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="icon-color-11"><i class="bx bx-spa"></i>
                        </div>
                        <div class="menu-title">Product</div>
                    </a>
                    <ul class="{{ Request::is('admin/product*') ? 'mm-show' : '' }}">
                        <li @if (Request::is('admin/product/add-edit-product') || Request::is('admin/product/add-edit-product/*'))
                            class="mm-active"
                            @endif>
                            <a href="{{ url('/admin/product/add-edit-product') }}"><i class="bx bx-right-arrow-alt"></i>
                                @if (Request::is('admin/product/add-edit-product/*'))
                                    Edit product
                                @else
                                    Add
                                @endif
                            </a>
                        </li>
                        <li @if (Request::is('admin/product') || Request::is('admin/product/attribute/*') || Request::is('admin/product/image/*'))
                            class="mm-active"
                            @endif>
                            <a href="{{ route('admin.product.index') }}"><i class="bx bx-right-arrow-alt"></i>Manage</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
