@extends('layouts.app')

@section('content')
<div class="container">    
    @if (Session::has('mensaje'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{  Session::get('mensaje') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
<a href="{{route('product.create')}}" class="btn btn-success">Registrar nuevo producto</a>
<h1>lista de products</h1>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Fechas</th>
            <th>Precio</th>            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $product)           
       
        <tr>
            <td>{{ $product->id}}</td>
            <td>
                <img  src="{{  asset(('storage').'/'.$product->photo)}}" whidth="100" height="100" >
            </td>
            <td>{{$product->name}}</td>
            <td>{{$product->date}}</td>
            <td>{{$product->value}}</td>            
            <td>
                <a href="{{ route('product.edit',$product)}}" class="btn btn-warning">Edit</a> 
                 | 
                <form action="{{ route('product.destroy',$product->id)}}" method="post" class="d-inline">
                    @csrf @method('DELETE')
                    <input class="btn btn-danger" type="submit" onclick="return confirm('Deseas borrar el producto?')" value="Borrar">
                </form>
                </td>
                <h1>hola</h1>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $products->links() !!}
</div>
@endsection