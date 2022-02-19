@extends('adminlte::page')

@section('title', 'Cadastrar nova Permissão')

@section('content_header')
    <h1>Cadastrar nova Permissão</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('permission_store')}}" class="form" method="POST">
                @csrf

                @include('admin.pages.permission._partials.form')

            </form>
        </div>
    </div>
@endsection