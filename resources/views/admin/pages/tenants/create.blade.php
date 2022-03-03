@extends('adminlte::page')

@section('title', 'Cadastrar nova Empresa')

@section('content_header')
    <h1>Cadastrar nova Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tenants_store')}}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.pages.products._partials.form')

            </form>
        </div>
    </div>
@endsection