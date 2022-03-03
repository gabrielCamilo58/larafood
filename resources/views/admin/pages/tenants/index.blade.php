@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('tenants_index')}}">Empresas</a></li>
    </ol>

    <h1>Empresas <a href="{{route ('tenants_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tenants_search')}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control">
            <button class="btn btn-dark">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>E-mail</th>
                        <th>URL</th>
                        <th style="width: 290px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td>
                                <img src="{{url("storage/{$tenant->logo}")}}" alt="{{$tenant->name}}" style="max-width:130px">
                            </td>
                            <td>{{$tenant->name}}</td>
                            <td>{{$tenant->cnpj}}</td>
                            <td>{{$tenant->email}}</td>
                            <td>{{$tenant->url}}</td>
                            <td>
                                <a href="{{route('tenants_edit', $tenant->id)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('tenants_show', $tenant->id)}} " class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif

        </div>
    </div>
    
@stop