@if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif

@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-warning">
        {{session('info')}}
    </div>
@endif
@if(session('indisponivel'))
    <div class="alert alert-warning">
        {{session('indisponivel')}}
    </div>
@endif