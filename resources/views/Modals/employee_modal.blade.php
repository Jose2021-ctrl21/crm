{{-- add modal --}}
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="addEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addEmployeeLabel">Add employee information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('employees.create') }}">
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
                        <label for="company_id">Company</label>
                        <select class="list-unstyled mb-0 form-control" name="company_id">
                          <option selected>-Select-</option>
                            @foreach($companies as $company)
                            <option value="{{$company->id}}">
                              {{ $company->company_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="first_name">First name</label>
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="last_name">Last name</label>
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="phone">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn btn-primary btn-md" value="Save employee information">
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>



{{-- edit modal --}}
<div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="editEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="editEmployeeLabel">Edit Employee Information</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form method="POST" id="editEmployeeForm" action="{{route('employees.update')}}">
                @csrf
                @method('PUT')

                <div class="form-row">
                  <div class="form-group col-md-12">
                      <label for="company_id">Company</label>
                      <select class="form-control" name="company_id" id="edit_company_id">
                        <option selected>-Select-</option>
                        @foreach($companies as $company)
                        <option value="{{$company->id}}">
                          {{ $company->company_name }}
                        </option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="edit_first_name" name="first_name">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="edit_last_name" name="last_name">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="edit_email" name="email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="edit_phone" name="phone">
                  </div>
                </div>
                <input type="hidden" name="employee_id" id="edit_employee_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Update Employee Information">
                </div>
              </form>
          </div>
      </div>
  </div>
</div>


{{-- delete modal --}}
<div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteEmployeeLabel">Delete this employee?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <h5 id="delete_employee_name"></h5>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" id="confirmDelete">Confirm</button>
          </div>
      </div>
  </div>
</div>

{{-- PROFILE modal --}}
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 15px;">
      <div class="modal-body text-center">
        <div class="mt-3 mb-4">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava2-bg.webp"
               class="rounded-circle img-fluid" style="width: 100px;" />
        </div>
        <h4 class="mb-2" id="employee_name">Julie L. Arsenault</h4>
       <span class="mb-4" id="company"></span><br>
       <i class="text-muted">Employee</i><br>
        <div class="mb-4 pb-2 mt-5">
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
            <i class="fab fa-facebook-f fa-lg"></i>
          </button>
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
            <i class="fab fa-twitter fa-lg"></i>
          </button>
          <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-floating">
            <i class="fab fa-skype fa-lg"></i>
          </button>
        </div>
        <div class="d-flex justify-content-between text-center mt-5 mb-2">
          <div>
            <p class="mb-2 h5">ID</p>
            <p class="text-muted mb-0" id="id">Total Transactions</p>
          </div>
          <div>
            <p class="mb-2 h5" >Email</p>
            <p class="text-muted mb-0" id="email">Wallets Balance</p>
          </div>
          <div class="px-3">
            <p class="mb-2 h5" >Phone</p>
            <p class="text-muted mb-0" id="phone">Income amounts</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
