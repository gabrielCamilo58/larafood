@extends('adminlte::page')

@section('title', "Categorias de {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"> <a href="{{route('admin_index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"> <a href="{{route('products_index')}}">Perfis</a></li>
    </ol>

    <h1>Categorias disponiveis de <strong>{{$product->name}}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('category_product_available', $product->id)}}" method="POST" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control">
            <button class="btn btn-dark">Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    
                   <form action="{{route('category_product_attach', $product->id)}}" method="post">
                       @csrf
                       @foreach ($categories as $category)
                       <tr>
                            <td>
                                <input type="checkbox" name="categories[]" value="{{$category->id}}">
                            </td>
                            <td>{{$category->name}}</td>
                       </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                   </form>
                        
                </tbody>
            </table>
        </div>
        
        <div class="card-footer">

            @if(isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif

        </div>
    </div>
    
@stop