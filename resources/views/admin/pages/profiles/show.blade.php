@extends('adminlte::page')

@section('title', "Detalhes do plano {$profile->name}")

@section('content_header')
    <h1>Detalhes do perfil <b>{{$profile->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$profile->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{$profile->description}}
                </li>
            </ul>
            <form action="{{ route('profiles_destroy', $profile->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($profile->name)}} e seus detalhes?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection