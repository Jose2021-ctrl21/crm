@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
<button type="button" class="btn btn-info btn-md mt-5 btnTranslate" data-toggle="modal" data-target="#translate">Translate</button>
<h1>{{ __('adminlte::adminlte.full_name') }}</h1>
<h1>{{ __('adminlte::adminlte.email') }}</h1>

@include('Modals.languages_modal')
@endsection

@include('scripts')
<script>
    $(document).ready(function(){
        $('.btnTranslate').on('click',function(){
            $("#translate").modal('show');
        });
    });
</script>


{{-- @extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@endsection --}}
