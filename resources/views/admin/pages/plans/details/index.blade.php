@extends('adminlte::page')

@section('title', "detalhes do Plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('plans_index')}}">Planos</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('plans_show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('details_plan_index', $plan->url)}}">Detalhes</a></li>
    </ol>

    <h1>Detalhes de {{$plan->name}} <a href="{{route ('details_plan_create', $plan->url)}}" class="btn btn-dark">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('admin.includes.alerts')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{$detail->name}}</td>
                            <td>
                                <a href="{{route('details_plan_edit', [$plan->url, $detail->id])}}" class="btn btn-info">Editar</a>
                                <a href=" {{route('details_plan_show', [$plan->url, $detail->id])}} " class="btn btn-warning">Ver</a>
                            </td>
                        </tr>
                     @endforeach
                    
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $details->appends($filters)->links() !!}
            @else
                {!! $details->links() !!}
            @endif

        </div>
    </div>
    
@stop