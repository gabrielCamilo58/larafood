@extends('adminlte::page')

@section('title', "Detalhes do Empresa {$tenant->name}")

@section('content_header')
    <h1>Detalhes da Empresa <b>{{$tenant->name}}</b></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start">
                <img src="{{url("storage/{$tenant->logo}")}}" alt="{{$tenant->name}}" style="max-width:200px">
                <ul>
                    <li>
                        <strong>Nome: </strong> {{$tenant->name}}
                    </li>
                    <li>
                        <strong>CNPJ: </strong> {{$tenant->cnpj}}
                    </li>
                    <li>
                        <strong>URL: </strong> {{$tenant->url}}
                    </li>
                    <li>
                        <strong>E-mail:</strong> {{$tenant->email}}
                    </li>

                    <strong>Assinaturas:</strong>

                    <li>
                        <strong>Inscrita em:</strong> {{$tenant->subscription}}
                    </li>
                    
                    <li>
                        <strong>Expira em:</strong> {{$tenant->expires_at}}
                    </li>
                    <li>
                        <strong>Ativa? [1] sim, [0] não :</strong> {{$tenant->subscripton_active}}
                    </li>
                    <li>
                        <strong>Cancelada? [1] sim, [0] não :</strong> {{$tenant->subscription_suspended}}
                    </li>

                </ul>
            </div>
            <form action="{{ route('tenants_destroy', $tenant->id)}}" method="POST" onsubmit="return confirm('tem certeza que deseja excluir {{ addslashes($tenant->name)}} e suas relações')">
                @csrf
                @method('DELETE')

                <button class="btn btn-danger mt-2"><i class="fas fa-trash"></i></button>
                
            </form>
        </div>
    </div>
@endsection