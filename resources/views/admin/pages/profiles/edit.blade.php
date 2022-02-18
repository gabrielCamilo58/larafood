@extends('adminlte::page')

@section('title', "Editar detalhe de: {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item "> <a href="{{route('profiles_index')}}">Perfis</a></li>
        {{--<li class="breadcrumb-item "> <a href="{{route('plans_show', $plan->url)}}">{{$plan->name}}</a></li>
        <li class="breadcrumb-item "> <a href="{{route('details_plan_index', $plan->url)}}">Detalhes</a></li>--}}
        <li class="breadcrumb-item active"> <a href="{{route('profiles_edit', $profile->id)}}">Editar</a></li>
    </ol>

    <h1>Editar o detalhe de {{$profile->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('profiles_update', $profile->id)}}" method="post">
                @method('PUT')
                @include('admin.pages.profiles._partials.form')

            </form>
        </div>
    </div>
@endsection