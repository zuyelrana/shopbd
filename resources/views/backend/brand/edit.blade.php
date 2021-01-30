<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content radius-15">
            <div class="modal-header">
                <h5 class="modal-title">Edit Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.brand.update') }}" method="POST">

                @csrf
                <div class="modal-body">
                    <div class="input-group">
                        <input name="name" id="name" type="text"
                            class="form-control  @error('name') is-invalid @enderror" placeholder="Brand Name">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                     <input type="hidden" id="id" name="id" value="">
                </div>
                <div class="modal-footer">

                </div>
               
            </form>
        </div>

    </div>
</div>
