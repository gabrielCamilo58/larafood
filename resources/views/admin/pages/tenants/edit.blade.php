@extends('adminlte::page')

@section('title', "Editar empresa: {$tenant->name}")

@section('content_header')
    <h1>Editar empresa: {{$tenant->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tenants_update', $tenant->id)}}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.tenants._partials.form')

            </form>
        </div>
    </div>
@endsection