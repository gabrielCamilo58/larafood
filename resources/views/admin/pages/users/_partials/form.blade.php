@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Nome:" value="{{$user->name ?? old('email')}}">
</div>

<div class="form-group">
    <label for="description">E-mail:</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="E-mail" value="{{$user->email ?? old('email')}}">
</div>
<div class="form-group">
    <label for="password">Senha:</label>
    <input type="text" name="password" class="form-control" id="password" placeholder="Senha">
</div>
<div class="form-group">
   <button type="submit" class="btn btn-dark">Enviar</button>
</div>