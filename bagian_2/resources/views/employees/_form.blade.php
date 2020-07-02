<div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="employeeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="employeeTitle">employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="employeeForm" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <input id="employeeId" value="" name="id" hidden>
                        <div class="form-group row">
                            <label for="employeeNama" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="employeeNama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="employeeEmail" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="employeeEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="employeeCompany" class="col-md-4 col-form-label text-md-right">Company</label>

                            <div class="col-md-6">
                            <select id="employeeCompany" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company') }}" required>
                                <option value="">Select Company</option>
                            </select>

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="employeeBtnSubmit" type="submit" class="btn btn-success">Save Change</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>