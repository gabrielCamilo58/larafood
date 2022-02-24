@extends('adminlte::page')

@section('title', 'Cadastrar novo Usuario')

@section('content_header')
    <h1>Cadastrar novo Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('users_store')}}" class="form" method="POST">
                @csrf

                @include('admin.pages.users._partials.form')

            </form>
        </div>
    </div>
@endsection