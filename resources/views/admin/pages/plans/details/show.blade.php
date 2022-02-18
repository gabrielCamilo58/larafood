@extends('adminlte::page')

@section('title', "Detalhes {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_index')}}">Planos</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "> <a href="{{route('details_plan_index', $plan->url)}}">Detalhes</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('details_plan_edit', [$plan->url, $detail->id])}}">Editar</a></li>
    </ol>

    <h1>Detalhes do detalhe {{$plan->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: {{$detail->name}}</strong>
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{route('details_plan_destroy', [$plan->url, $detail->id])}}" method="post">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
    </div>
@endsection