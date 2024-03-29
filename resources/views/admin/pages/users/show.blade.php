@extends('adminlte::page')

@section('title', "Detalhes do Usuario {$user->name}")

@section('content_header')
    <h1>Detalhes do Usuario <b>{{$user->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$user->name}}
                </li>
                <li>
                    <strong>Email: </strong> {{$user->email}}
                </li>
                <li>
                    <strong>Empresa:</strong> {{$user->tenant->name}}
                </li>
            </ul>
            <form action="{{ route('users_destroy', $user->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($user->name)}} e suas relações')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection