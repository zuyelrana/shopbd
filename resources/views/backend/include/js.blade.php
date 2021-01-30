    <script src="{{ asset('/') }}backend/assets/js/jquery.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/js/popper.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/js/bootstrap.min.js"></script>

        <script src="{{ asset('/') }}backend/assets/js/jquery.validate.min.js"></script>
        <script src="{{ asset('/') }}backend/assets/js/additional-methods.min.js""></script>
    <!--plugins-->
    <script src="{{ asset('/') }}backend/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('/') }}backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!-- App JS -->
    <script src="{{ asset('/') }}backend/assets/js/app.js"></script>
   
@toastr_js
@toastr_render
<script>
    @if(count($errors) > 0)
        @foreach($errors->all()  as $error)
         toastr.error('{{ $error }}');
        @endforeach
    @endif
</script>

<script src="{{ asset('/') }}backend/assets/js/sweetalert2@10.min.js"></script>


{{-- Swete alert --}}
<script type="text/javascript">
    $(document).on("click",".delete-confirm",function(event){
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        buttons: ["Cancel", "Delete!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});

{{--  Unpublished  --}}
$(document).on("click",".published-confirm",function(event){
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be published .You can unpublished later!',
        icon: 'info',
        buttons: ["Cancel", "Pubsished!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});

{{--  Unpublished  --}}
$(document).on("click",".unpublished-confirm",function(event){
    event.preventDefault();
    const url = $(this).attr('href');
    swal({
        title: 'Are you sure?',
        text: 'This record and it`s details will be unpublished .You can published later!',
        icon: 'info',
        buttons: ["Cancel", "Unpubsished!"],
    }).then(function(value) {
        if (value) {
            window.location.href = url;
        }
    });
});
</script>

<script type="text/javascript">

</script>

{{--  End Toastr  --}}
@stack('js')
