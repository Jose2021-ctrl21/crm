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
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
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
            <button type="button" data-toggle="modal" data-target="#addEmployee" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i>
                &nbsp;{{__('adminlte::adminlte.Add company information')}}
            </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('adminlte::adminlte.Company') }}</th>
                        <th>{{ __('adminlte::adminlte.Employee name') }}</th>
                        <th>{{ __('adminlte::adminlte.Email') }}</th>
                        <th>{{ __('adminlte::adminlte.Phone') }}</th>
                        <th>{{ __('adminlte::adminlte.Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->company->company_name}}</td>
                        <td>{{$employee->first_name . ' ' . $employee->last_name }}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>
                           
                            <button type="button" data-id="{{$employee->id}}" class="btn btn-info btn-sm btnView">{{__('adminlte::adminlte.View')}}</button>              
                            <button type="button" value="{{$employee->id}}" class="btn btn-warning btn-sm btnEdit">{{__('adminlte::adminlte.Edit')}}</button>              
                            <button type="button" data-id="{{$employee->id}}" data-name="{{$employee->first_name . ' ' . $employee->last_name }}" class="btn btn-danger btn-sm btnDelete">{{__('adminlte::adminlte.Delete')}}</button>              
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
 @include('Modals.employee_modal')
 @include('Modals.languages_modal')

@endsection



{{-- This scripts includes css and js scripts --}}
@include('scripts')
<script>
    // Fetching for update
    $(document).ready(function(){
        $('.btnEdit').on('click',function(){
            let id = $(this).val();
            $('#editEmployee').modal('show');

            $.ajax({
                type:'GET',
                url:'/employees/'+id,
                success: function (response) {
                    console.log(response);
                   $('#edit_employee_id').val(response.employees.id);
                   $('#edit_first_name').val(response.employees.first_name);
                   $('#edit_last_name').val(response.employees.last_name);
                   $('#edit_email').val(response.employees.email);
                   $('#edit_phone').val(response.employees.phone);
                   $('#edit_company_id').val(response.employees.company_id);
                }
            });
        });
    });

    // For delete
    $(document).ready(function(){
        $('.btnDelete').on('click',function(){
            let id = $(this).data('id');
            let name = $(this).data('name');
            $('#deleteEmployee').modal('show');

            $('#deleteEmployee').data('id', id);
            $('#delete_employee_name').text(name);
            
            console.log(id);
        });

        $('#confirmDelete').on('click',function(){
            let id = $('#deleteEmployee').data('id');
            console.log("This is working" + id);
            $.ajax({
                url: '/employees/' + id, // URL to the delete route
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

    // For view profile
    $(document).ready(function(){
        $('.btnView').on('click',function(){
            let id = $(this).data('id');

            $('#profileModal').modal('show');
            console.log("profile" + id);

            $.ajax({
                type:'GET',
                url:'/employees/'+id,
                success:function(response){
                    console.log(response);
                   $('#employee_name').html(response.employees.first_name+' '+response.employees.last_name);
                   $('#company').html(response.company_name);
                   $('div #email').html(response.employees.email);
                   $('div #phone').html(response.employees.phone);
                   $('div #id').html(response.employees.id);
                }
            });
        });
    })
</script>
@endsection
