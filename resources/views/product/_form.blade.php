<h1>{{ $modo }} Producto</h1>

    @if (count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach               
            </ul>
        </div>
    @endif
    <div class="form-group">

        <label for="name">Nombre</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ isset($product->name)?$product ->name:old('name') }}">
    </div>
    <div class="form-group">
        <label for="date">Fecha</label>
        <input type="date" name="date" id="date" class="form-control" value="{{ isset($product->date)?$product ->date:old('date') }}">
    </div>
    <div class="form-group">
        <label for="value">Valor del Producto </label>
        <input type="value" name="value" id="value" class="form-control" value="{{ isset($product->value)?$product ->value:old('value') }}">
    </div>
    <div class="form-group">
        <label for="category_id" >Categoria</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Seleccione</option>
           @foreach ($categories as $id => $namecategory)
               <option value="{{$id}}"            
                @if($id === $product->category_id) selected @endif>   
                {{$name}}</option>
           @endforeach  
        </select>   
    </div>
    <div class="form-group">
        <label for="image" ></label>
        @if (isset($product->image))
            <img src="{{  asset(('storage').'/'.$product->image)}}"   whidth="100" height="100" >
        @endif    
        <input type="file" class="form-control" name="image" id="image" value=""><br>
    </div>
    <button class="btn btn-success">Enviar</button>

    <a href="{{route('product.index')}}" class="btn btn-primary">REGRESAR</a>