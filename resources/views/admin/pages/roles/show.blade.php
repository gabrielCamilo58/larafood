@extends('adminlte::page')

@section('title', "Detalhes do cargo {$role->name}")

@section('content_header')
    <h1>Detalhes do Cargo <b>{{$role->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$role->name}}
                </li>
                <li>
                    <strong>Descrição: </strong> {{$role->description}}
                </li>
            </ul>
            <form action="{{ route('roles_destroy', $role->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($role->name)}} e seus detalhes?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection