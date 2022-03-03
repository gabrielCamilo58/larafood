@extends('adminlte::page')

@section('title', 'Cadastrar nova Mesa')

@section('content_header')
    <h1>Cadastrar nova Mesa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tables_store')}}" class="form" method="POST">
                @csrf

                @include('admin.pages.table._partials.form')

            </form>
        </div>
    </div>
@endsection