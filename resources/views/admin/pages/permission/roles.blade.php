@extends('adminlte::page')

@section('title', "Perfis vinculados a {$permission->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_index')}}">Cargos</a></li>
    </ol>

    <h1>Perfis vinculados à <strong>{{$permission->name}}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 180px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{route('roles_permissons_detach', [$role->id, $permission->id])}}" class="btn btn-danger">Desvincular</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif

        </div>
    </div>
    
@stop