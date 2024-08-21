{{-- language modal --}}
<div class="modal fade" id="translate" tabindex="-1" role="dialog" aria-labelledby="translateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="translateLabel">Select Language</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form method="POST" action="{{ route('adminlte.language') }}">
                @csrf
      
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <select class="form-control" id="language" name="language">
                        @foreach(config('adminlte.languages') as $langKey => $langName)
                          <option value="{{ $langKey }}">{{ $langName }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <input type="submit" class="btn btn-primary btn-md" value="Apply">
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
