@extends('adminlte::page')

@section('title', "Planos de {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('profiles_index')}}">Perfis</a></li>
    </ol>

    <h1>Planos de <strong>{{$profile->name}}</strong><a href="{{route ('plan_profile_available', $profile->id)}}" class="btn btn-dark">ADD NOVO PLANO</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plan_profile_available_search', $profile->id)}}" method="POST" class="form form-inline">
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
                    
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{$plan->name}}</td>
                            <td>
                                <a href="{{route('plan_profile_detach', [$profile->id, $plan->id])}}" class="btn btn-danger">Desvincular</a>
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