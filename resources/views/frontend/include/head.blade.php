<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Shopbd eCommerce Project</title>

    <meta name="keywords" content="Advance Ecommerce project" />
    <meta name="description" content="Shopbd eCommerce Project">
    <meta name="author" content="Zuyel Rana">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/') }}frontend/images/icons/favicon.png">

    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:400,600,700', 'Poppins:400,600,700']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset('/') }}frontend/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/vendor/animate/animate.min.css">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/vendor/owl-carousel/owl.carousel.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}frontend/css/style.min.css">
      @toastr_css
    @stack('css')
</head>
