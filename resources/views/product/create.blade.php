@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('product._form',['modo'=>'Crear'])
</form>
</div>
@endsection
 