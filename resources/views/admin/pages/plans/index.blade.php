@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('plans_index')}}">Planos</a></li>
    </ol>

    <h1>Planos <a href="{{route ('plans_create')}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plans_search')}}" method="POST" class="form form-inline">
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
                        <th>Preço</th>
                        <th style="width: 290px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->name}}</td>
                            <td>R$ {{number_format($plan->price, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{route('details_plan_index', $plan->url)}}" class="btn btn-info">Detalhes</a>
                                <a href="{{route('plans_edit', $plan->url)}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('plans_show', $plan->url)}} " class="btn btn-warning">Ver</a>
                                <a href=" {{route('plan_profile_available_Profile', $plan->id)}} " class="btn btn-warning"><i class="fas fa-address-book"></i></a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif

        </div>
    </div>
    
@stop