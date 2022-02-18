@extends('adminlte::page')

@section('title', "Adicionar novo detalhe ao {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_index')}}">Planos</a></li>
        <li class="breadcrumb-item "> <a href="{{route('plans_show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('details_plan_create', $plan->url)}}">Novo</a></li>
    </ol>

    <h1>Adicionar novo detalhe ao {{$plan->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('details_plan_store', $plan->url)}}" method="post">
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
@endsection