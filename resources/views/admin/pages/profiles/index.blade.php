@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('profiles_index')}}">Perfis</a></li>
    </ol>

    <h1>Perfis<a href="{{route ('profiles_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('profiles_search')}}" method="POST" class="form form-inline">
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
                    
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{$profile->name}}</td>
                            <td>
                               {{-- <a href="{{route('details_plan_index', $plan->url)}}" class="btn btn-info">Detalhes</a> --}}
                                <a href="{{route('profiles_edit', $profile->id)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('profiles_show', $profile->id)}} " class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif

        </div>
    </div>
    
@stop