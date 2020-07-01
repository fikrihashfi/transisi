<div class="modal fade" id="companyDelete" tabindex="-1" role="dialog" aria-labelledby="companyDelete" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#e3342f;">
        <h5 class="modal-title text-white" id="companyDeleteTitle">Delete Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('companies.delete') }}" enctype="multipart/form-data">
                @csrf
                <h5>Do you want to proceed?</h5>
                <input name="id" value="" id="deleteId" hidden></input>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>