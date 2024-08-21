{{-- add modal --}}
<div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="addCompanyLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCompanyLabel">Add employee information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('companies.create') }}" enctype="multipart/form-data">
                  @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                    @csrf
                    @method('post')
        
                    <div class="form-row">
                      <div class="form-group col-md-12">
                          <label for="company_id">Company Logo</label>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Upload logo</span>
                            </div>
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo" accept="image/*">
                              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="company_name">Company name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company name">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="ex: https://getbootstrap.com/">
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary btn-md" value="Save company information">
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  

  {{-- edit modal --}}
<div class="modal fade" id="editCompany" tabindex="-1" role="dialog" aria-labelledby="editCompanyLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editCompanyLabel">Edit company information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{route('companies.update')}}">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                  @csrf
                  @method('put')
      
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        {{-- <label for="company_id">Company</label> --}}
                        {{-- <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Upload logo</span>
                          </div>
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo" accept="image/*">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                          </div>
                        </div> --}}
                    </div>
                    <div class="form-group col-md-6">
                      <label for="edit_company_name">Company name</label>
                      <input type="text" class="form-control" id="edit_company_name" name="company_name" placeholder="Company name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="edit_email">Email</label>
                      <input type="text" class="form-control" id="edit_email" name="email" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="edit_website">Website</label>
                      <input type="text" class="form-control" id="edit_website" name="website" placeholder="ex: https://getbootstrap.com/">
                      <input type="text" class="form-control" id="edit_company_id" name="company_id">
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary btn-md" value="Save company information">
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- delete modal --}}
<div class="modal fade" id="deleteCompany" tabindex="-1" role="dialog" aria-labelledby="deleteCompanyLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteCompanyLabel">Delete this employee?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <h5 id="delete_company_name"></h5>
            <h3 id="company_id"></h3>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="confirmDelete">Confirm</button>
          </div>
      </div>
  </div>
</div>

