@include('admin.includes.alerts')


<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Nome:" value="{{$tenant->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="cnpj">CNPJ:</label>
    <input type="numeric" name="cnpj" class="form-control" id="cnpj" placeholder="CNPJ:" value="{{$tenant->name ?? old('cnpj')}}">
</div>

<div class="form-group">
    <label for="email">E-mail:</label>
    <input type="text" name="email" class="form-control" id="email" placeholder="E-mail:" value="{{$tenant->email ?? old('email')}}">
</div>

<div class="form-group">
    <label for="expires_at">Expira em:</label>
    <input type="date" name="expires_at" class="form-control" id="expires_at" placeholder="Expira em:" value="{{$tenant->email ?? old('email')}}">
</div>

<div class="form-group">
    <label for="image">Imagem:</label>
    <input type="file" name="image" class="form-control" id="image">
</div>

<div class="form-group">
    <label for="active">Ativo?</label>
    <select name="active" id="active">
        <option value="Y" @if(isset($tenant) && $tenant->active == 'Y') selected @endif >SIM</option>
        <option value="N" @if(isset($tenant) && $tenant->active == 'N') selected @endif>NAO</option>
    </select>
</div>

<div class="form-group">
    <label for="subscripton_active">Assinatura Ativa?</label>
    <select name="subscripton_active" id="subscripton_active">
        <option value="1" @if(isset($tenant) && $tenant->subscripton_active ) selected @endif >SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscripton_active ) selected @endif>NAO</option>
    </select>
</div>

<div class="form-group">
    <label for="subscription_suspended">Assinatura Cancelada?</label>
    <select name="subscription_suspended" id="subscription_suspended">
        <option value="1" @if(isset($tenant) && $tenant->subscription_suspended ) selected @endif >SIM</option>
        <option value="0" @if(isset($tenant) && !$tenant->subscription_suspended ) selected @endif>NAO</option>
    </select>
</div>
<div class="form-group">
   <button type="submit" class="btn btn-dark">Enviar</button>
</div>