@extends('adminlte::page')

@section('title', "Editar detalhe de: {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_index')}}">Planos</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "> <a href="{{route('details_plan_index', $plan->url)}}">Detalhes</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('details_plan_edit', [$plan->url, $detail->id])}}">Editar</a></li>
    </ol>

    <h1>Editar o detalhe de {{$plan->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details_plan_update', [$plan->url, $detail->id])}}" method="post">
                @method('PUT')
                @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>
@endsection