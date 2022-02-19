@extends('adminlte::page')

@section('title', "Editar detalhe de: {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('permission_index')}}">Permissões</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('permission_edit', $permission->id)}}">Editar</a></li>
    </ol>

    <h1>Editar o detalhe de {{$permission->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('permission_update', $permission->id)}}" method="post">
                @method('PUT')
                @include('admin.pages.permission._partials.form')

            </form>
        </div>
    </div>
@endsection