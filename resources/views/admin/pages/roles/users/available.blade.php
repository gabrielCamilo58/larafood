@extends('adminlte::page')

@section('title', "Usuarios de {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('roles_index')}}">Cargos</a></li>
    </ol>

    <h1>Usuarios disponiveis de <strong>{{$role->name}}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('roles_users_available', $role->id)}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control">
            <button class="btn btn-dark">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <form action="{{route('roles_users_attach', $role->id)}}" method="post">
                       @csrf
                       @foreach ($users as $user)
                       <tr>
                            <td>
                                <input type="checkbox" name="users[]" value="{{$user->id}}">
                            </td>
                            <td>{{$user->name}}</td>
                       </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                   </form>
                        
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