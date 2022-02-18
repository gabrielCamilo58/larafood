@extends('adminlte::page')

@section('title', 'Cadastrar novo plano')

@section('content_header')
    <h1>Cadastrar novo plano</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('plans_store')}}" class="form" method="POST">
                @csrf

                @include('admin.pages.profiles._partials.form')

            </form>
        </div>
    </div>
@endsection