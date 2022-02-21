@extends('adminlte::page')

@section('title', "Planos de {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('profiles_index')}}">Perfis</a></li>
    </ol>

    <h1>Planos disponiveis de <strong>{{$profile->name}}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('plan_profile_available', $profile->id)}}" method="POST" class="form form-inline">
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
                    
                   <form action="{{route('plan_profile_attach', $profile->id)}}" method="post">
                       @csrf
                       @foreach ($plans as $plan)
                       <tr>
                            <td>
                                <input type="checkbox" name="plans[]" value="{{$plan->id}}">
                            </td>
                            <td>{{$plan->name}}</td>
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
                {!! $plans->appends($filters)->links() !!}
            @else
                {!! $plans->links() !!}
            @endif

        </div>
    </div>
    
@stop