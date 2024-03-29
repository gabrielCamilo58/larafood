@extends('adminlte::page')

@section('title', "Editar Mesa: {$table->identify}")

@section('content_header')
    <h1>Editar Mesa: {{$table->identify}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tables_update', $table->id)}}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.table._partials.form')

            </form>
        </div>
    </div>
@endsection