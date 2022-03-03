@include('admin.includes.alerts')

<div class="form-group">
    <label for="identify">Identificação:</label>
    <input type="text" name="identify" class="form-control" id="identify" placeholder="Identificação:" value="{{$table->identify?? old('identify')}}">
</div>

<div class="form-group">
    <label for="description">Descrição:</label>
    <textarea name="description" ols="30" rows="5" class="form-control" id="description">{{$table->description ?? old('description')}}</textarea>
</div>

<div class="form-group">
   <button type="submit" class="btn btn-dark">Enviar</button>
</div>