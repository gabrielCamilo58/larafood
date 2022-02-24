@extends('adminlte::page')

@section('title', "Editar Usuario: {$user->name}")

@section('content_header')
    <h1>Editar Usuario: {{$user->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('users_update', $user->id)}}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.users._partials.form')

            </form>
        </div>
    </div>
@endsection