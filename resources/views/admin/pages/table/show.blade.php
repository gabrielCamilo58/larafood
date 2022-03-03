@extends('adminlte::page')

@section('title', "Detalhes da mesa {$table->identify}")

@section('content_header')
    <h1>Detalhes da mesa <b>{{$table->identify}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$table->identify}}
                </li>
                <li>
                    <strong>Descrição:</strong> {{$table->description}}
                </li>
            </ul>
            <form action="{{ route('tables_destroy', $table->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($table->identify)}} e suas relações')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection