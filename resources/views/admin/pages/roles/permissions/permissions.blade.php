@extends('adminlte::page')

@section('title', "Permissões de {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_index')}}">Perfis</a></li>
    </ol>

    <h1>Permissões de <strong>{{$role->name}}</strong><a href="{{route ('roles_permissons_available', $role->id)}}" class="btn btn-dark">ADD NOVA PERMISSÃO</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles_permission_search', $role->id)}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control">
            <button class="btn btn-dark">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 180px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
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
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
    
@stop