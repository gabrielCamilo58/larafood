@extends('adminlte::page')

@section('title', "Editar detalhes de: {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('roles_index')}}">Cargos</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_edit', $role->id)}}">Editar</a></li>
    </ol>

    <h1>Editar o detalhe de {{$role->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('roles_update', $role->id)}}" method="post">
                @method('PUT')
                @include('admin.pages.roles._partials.form')

            </form>
        </div>
    </div>
@endsection