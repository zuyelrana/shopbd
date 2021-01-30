<!DOCTYPE html>
<html lang="en">

@include('frontend.include.head')
<body class="home">
    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
            <div class="bounce4"></div>
        </div>
    </div>
    <div class="page-wrapper">
        <h1 class="d-none">Advance Ecommerce Website</h1>
        @include('frontend.include.header')
        <!-- End of Header -->
        @yield('content')
        <!-- End of Main -->
         @include('frontend.include.footer')
        <!-- End of Footer -->
    </div>
    <!-- Sticky Footer -->
    @include('frontend.include.sticky-footer')
    <!-- Scroll Top -->
    <a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	
		<div class="pswp__bg"></div>

		<!-- Slides wrapper with overflow:hidden. -->
		<div class="pswp__scroll-wrap">

			<!-- Container that holds slides.
	
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<!--  Controls are self-explanatory. Order can be changed. -->

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
					<button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

					<div class="pswp__preloader">
						<div class="loading-spin"></div>
					</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>

				<button class="pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
				<button class="pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>
			</div>
		</div>
	</div>

    <!-- MobileMenu -->
      @include('frontend.include.mobileMenu')
    @include('frontend.include.js')
</body>

</html>

