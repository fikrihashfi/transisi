<div class="modal fade" id="companyEdit" tabindex="-1" role="dialog" aria-labelledby="companyEdit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:orange;">
        <h5 class="modal-title text-white" id="companyEditTitle">Edit Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('companies.edit') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="editId" value="" name="id" hidden>
                        <div class="form-group row">
                            <label for="editNama" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="editNama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editEmail" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="editEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editWebsite" class="col-md-4 col-form-label text-md-right">Website</label>

                            <div class="col-md-6">
                                <input id="editWebsite" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website">

                                @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="editLogo" class="col-md-4 col-form-label text-md-right">Logo</label>

                            <div class="col-md-6">
                                <input  id="editLogo" name="logo" type="file" class="form-control @error('logo') is-invalid @enderror">
                                <span class="text-muted">max : 2mb</span>

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn text-white" style="background-color:orange">Save Change</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>