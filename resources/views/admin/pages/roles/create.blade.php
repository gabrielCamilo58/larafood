@extends('adminlte::page')

@section('title', 'Cadastrar novo cargo')

@section('content_header')
    <h1>Cadastrar novo cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('roles_store')}}" class="form" method="POST">
                @csrf

                @include('admin.pages.roles._partials.form')

            </form>
        </div>
    </div>
@endsection