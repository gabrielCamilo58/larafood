@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_index')}}">Cargos</a></li>
    </ol>

    <h1>Cargoss<a href="{{route ('roles_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles_search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 250px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                <a href="{{route('roles_edit', $role->id)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('roles_show', $role->id)}} " class="btn btn-warning">Ver</a>
                                <a href="{{route('roles_permissons', $role->id)}}" class="btn btn-warning"><i class="fas fa-lock"></i></a> 
                                <a href="{{route('roles_users', $role->id)}}" class="btn btn-warning"><i class="fas fa-users"></i></a>
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