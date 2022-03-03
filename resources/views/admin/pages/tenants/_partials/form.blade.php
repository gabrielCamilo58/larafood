@include('admin.includes.alerts')


<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Nome:" value="{{$product->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" ols="30" rows="5" class="form-control" id="description">{{$product->description ?? old('description')}}</textarea>
</div>

<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text" name="price" class="form-control" id="price" placeholder="Preço:" value="{{$product->price ?? old('price')}}">
</div>

<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" class="form-control" id="image">
</div>

<div class="form-group">
   <button type="submit" class="btn btn-dark">Enviar</button>
</div>