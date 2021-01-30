

<!DOCTYPE html>
<html lang="en">
  @include('backend.include.head')


<body>
    <!-- wrapper -->
    <div class="wrapper">
        <!--sidebar-wrapper-->
          @include('backend.include.sidebar')
     
        <!--end sidebar-wrapper-->
        <!--header-->
           @include('backend.include.topbar')
        <!--end header-->
            <!--page-wrapper-->
          @yield('content')
        <!--end page-wrapper-->
        <!--start overlay-->
        <div class="overlay toggle-btn-mobile"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--><a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <!--footer -->
        @include('backend.include.footer')
        <!-- end footer -->
    </div>
    <!-- end wrapper -->
    <!--start switcher-->
      @include('backend.include.switcher')
    <!--end switcher-->
    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    @include('backend.include.js')
</body>


</html>