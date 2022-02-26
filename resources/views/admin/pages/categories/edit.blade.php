@extends('adminlte::page')

@section('title', "Editar Usuario: {$category->name}")

@section('content_header')
    <h1>Editar Usuario: {{$category->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('categories_update', $category->id)}}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include('admin.pages.categories._partials.form')

            </form>
        </div>
    </div>
@endsection