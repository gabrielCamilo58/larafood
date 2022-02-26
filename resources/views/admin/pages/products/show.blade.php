@extends('adminlte::page')

@section('title', "Detalhes do produto {$product->name}")

@section('content_header')
    <h1>Detalhes do produto <b>{{$product->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <img src="{{url("storage/{$product->image}")}}" alt="{{$product->name}}" style="max-width:200px">
                <ul>
                    <li>
                        <strong>Nome: </strong> {{$product->name}}
                    </li>
                    <li>
                        <strong>Preço: </strong> {{$product->price}}
                    </li>
                    <li>
                        <strong>URL: </strong> {{$product->url}}
                    </li>
                    <li>
                        <strong>Descrição:</strong> {{$product->description}}
                    </li>
                </ul>
            </div>
            <form action="{{ route('products_destroy', $product->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($product->name)}} e suas relações')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger mt-2"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection