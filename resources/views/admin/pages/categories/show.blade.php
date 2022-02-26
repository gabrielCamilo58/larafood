@extends('adminlte::page')

@section('title', "Detalhes da categoria {$category->name}")

@section('content_header')
    <h1>Detalhes da categoria <b>{{$category->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$category->name}}
                </li>
                <li>
                    <strong>URL: </strong> {{$category->url}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$category->description}}
                </li>
            </ul>
            <form action="{{ route('categories_destroy', $category->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($category->name)}} e suas relações')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection