<div class="modal fade" id="companyDetail" tabindex="-1" role="dialog" aria-labelledby="companyDetail" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:orange;">
        <h5 class="modal-title text-white" id="companyDetailTitle">Detail Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="detailNama" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="detailNama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detailEmail" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="detailEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="detailWebsite" class="col-md-4 col-form-label text-md-right">Website</label>

                            <div class="col-md-6">
                                <input id="detailWebsite" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="detailLogo" class="col-md-4 col-form-label text-md-right">Logo</label>

                            <div class="col-md-6">
                                
                            </div>
                        </div>
                         -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
  </div>
</div>