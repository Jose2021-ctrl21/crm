@extends('adminlte::page')

@section('title', 'My Table Page')

@section('content_header')
    <h1>My Data Table</h1>
    <button type="button" class="btn btn-info btn-md mt-5 btnTranslate" data-toggle="modal" data-target="#translate">{{__('adminlte::adminlte.Translate')}}</button>
@endsection

@section('content')
    <div class="card">
        {{-- ERROR show --}}
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error){
                    <li>{{$error}}</li>
                }
                @endforeach
            </ul>
        @endif
          {{-- SESSION MeSSAge--}}
          @if(session()->has('success'))
          <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
      @endif
        <div class="card-header">
            {{-- <h3 class="card-title">Data Table Example</h3> --}}
            <button type="button" data-toggle="modal" data-target="#addCompany" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                &nbsp;{{__('adminlte::adminlte.Add company information')}}
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="overflow-x:auto">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{__('adminlte::adminlte.Logo')}}</th>
                        <th>{{__('adminlte::adminlte.Name')}}</th>
                        <th>{{__('adminlte::adminlte.Email')}}</th>
                        <th>{{__('adminlte::adminlte.Website')}}</th>
                        <th>{{__('adminlte::adminlte.Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <td>
                            <img src="{{Storage::url($company->logo) }}" width="100px" height="100px">
                        </td>
                        <td>{{$company->company_name}}</td>
                        <td>{{$company->email}}</td>
                        <td>{{$company->website}}</td>
                        <td>
                            <button type="button" data-id="{{$company->id}}" class="btn btn-info btn-sm btnView">{{__('adminlte::adminlte.View')}}</button>              
                            <button type="button" value="{{$company->id}}" class="btn btn-warning btn-sm btnEdit">{{__('adminlte::adminlte.Edit')}}</button>              
                            <button type="button" data-id="{{$company->id}}" data-name="{{$company->company_name }}" class="btn btn-danger btn-sm btnDelete">{{__('adminlte::adminlte.Delete')}}</button>  
                        </td>
                    </tr>
                    @endforeach

                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    
    {{-- Modals --}}
    @include('Modals.companies_modal')
    @include('Modals.languages_modal')

@endsection



{{-- This scripts includes css and js scripts --}}
@include('scripts')
<script>
    // Fetching for update
    $(document).ready(function(){
        $('.btnEdit').on('click',function(){
            let id = $(this).val();
            $('#editCompany').modal('show');

            $.ajax({
                type:'GET',
                url:'/companies/'+id,
                success: function (response) {
                    console.log(response);
                $('#edit_company_name').val(response.companies.company_name);
                $('#edit_email').val(response.companies.email);
                $('#edit_website').val(response.companies.website);
                $('#edit_phone').val(response.companies.phone);
                $('#edit_company_id').val(response.companies.id);
                }
            });
        });
    });

      // For delete
      $(document).ready(function(){
        $('.btnDelete').on('click',function(){
            let id = $(this).data('id');
            let company_name = $(this).data('name');
            $('#deleteCompany').modal('show');

            $('#deleteCompany').data('id', id);
            $('#delete_company_name').text(company_name);
            $('#company_id').text(id);
            
            console.log(id);
        });

        $('#confirmDelete').on('click',function(){
            let id = $('#deleteCompany').data('id');
            console.log("This is working" + id);
            $.ajax({
                url: '/companies/' + id, // URL to the delete route
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(result) {
                    location.reload();
                },
                error: function(xhr) {
                    // Handle error
                    alert('Failed to delete employee.');
                }
            });

        });
    });

</script>
@endsection
