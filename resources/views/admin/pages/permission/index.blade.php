@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('permission_index')}}">Permissões</a></li>
    </ol>

    <h1>Permissões<a href="{{route ('permission_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permission_search')}}" method="POST" class="form form-inline">
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
                        <th style="width: 190px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td>
                               {{-- <a href="{{route('details_plan_index', $plan->url)}}" class="btn btn-info">Detalhes</a> --}}
                                <a href="{{route('permission_edit', $permission->id)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('permission_show', $permission->id)}} " class="btn btn-warning">Ver</a> 
                                <a href=" {{route('profiles_permissons_available_profiles', $permission->id)}} " class="btn btn-success"><i class="fas fa-address-book"></i></a>
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