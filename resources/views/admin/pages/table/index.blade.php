@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('tables_index')}}">Mesas</a></li>
    </ol>

    <h1>Mesas <a href="{{route ('tables_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tables_search')}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control">
            <button class="btn btn-dark">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identificação</th>
                        <th>Descrição</th>
                        <th style="width: 290px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{$table->identify}}</td>
                            <td>{{$table->description}}</td>
                            <td>
                                <a href="{{route('tables_qrcode', $table->identify)}}" class="btn btn-default" target="blank"><i class="fas fa-qrcode"></i></a>
                                <a href="{{route('tables_edit', $table->id)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('tables_show', $table->id)}} " class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $tables->appends($filters)->links() !!}
            @else
                {!! $tables->links() !!}
            @endif

        </div>
    </div>
    
@stop