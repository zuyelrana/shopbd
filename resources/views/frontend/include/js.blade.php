
    <script src="{{ asset('/') }}frontend/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/parallax/parallax.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/elevatezoom/jquery.elevatezoom.min.js"></script>
    <script src="{{ asset('/') }}frontend/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <script src="{{ asset('/') }}frontend/vendor/owl-carousel/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('/') }}frontend/js/main.js"></script>
    <script src="{{ asset('/') }}frontend/js/script.js"></script>
    <script src="{{ asset('/') }}backend/assets/js/sweetalert2@10.min.js"></script>

    @toastr_js
    @toastr_render
    <script>
        @if(count($errors) > 0)
            @foreach($errors->all()  as $error)
            toastr.error('{{ $error }}');
            @endforeach
        @endif
    </script>
    @stack('js')

    