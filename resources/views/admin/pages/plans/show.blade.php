@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
    <h1>Detalhes do plano <b>{{$plan->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome: </strong> {{$plan->name}}
                </li>
                <li>
                    <strong>URL: </strong> {{$plan->url}}
                </li>
                <li>
                    <strong>Price: </strong> R$ {{number_format($plan->price, 2, ',', '.') }}
                </li>
                <li>
                    <strong>Descrição: </strong> {{$plan->description}}
                </li>
            </ul>
            <form action="{{ route('plans_destroy', $plan->url)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($plan->name)}} e seus detalhes?')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection