@extends('adminlte::page')

@section('title', "Usuarios de {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_index')}}">Perfis</a></li>
    </ol>

    <h1>Usuarios de <strong>{{$role->name}}</strong><a href="{{route ('roles_users_available', $role->id)}}" class="btn btn-dark">ADD NOVO USUARIO</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles_user_search', $role->id)}}" method="POST" class="form form-inline">
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
                    
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>
                                <a href="{{route('roles_users_detach', [$role->id, $user->id])}}" class="btn btn-danger">Desvincular</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif

        </div>
    </div>
    
@stop