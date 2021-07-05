@extends('layouts.master')
@section('conteudo')

@if(Request::getPathInfo() == '/register/error')
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Ocorreu um erro inesperado, tente novamente!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(Request::getPathInfo() == '/register/success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <b>Sucesso:</b> Você foi cadastrado na plataforma! Faça o login para continuar.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<script>
  let loguinDropdown = document.querySelector('nav ul.dropdown-loguin');
  loguinDropdown.classList.add('show');
  loguinDropdown.querySelector('input[name=email]').focus();

</script>
@else
<h3>Ingressar na plataforma</h3>
<br>
<form method="post" action="{{ route('register') }}">
@csrf
  <div class="form-group">
    <label for="nome">Nome</label> 
    <input id="nome" name="nome" type="text" required="required" class="form-control">
    @if($errors->has('nome'))
      <p class="error-msg">{{ $errors->first('nome') }}</p>
    @endif
  </div>
  <div class="form-group">
    <label for="email">E-mail</label> 
    <input id="email" name="email" type="email" required="required" class="form-control">
    @if($errors->has('email'))
      <p class="error-msg">{{ $errors->first('email') }}</p>
    @endif
  </div>
  <div class="form-group">
    <label for="senha">Senha</label> 
    <input id="senha" name="senha" type="password" required="required" class="form-control">
    @if($errors->has('senha'))
      <p class="error-msg">{{ $errors->first('senha') }}</p>
    @endif
  </div> 
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Ingressar</button>
  </div>
</form>
@endif
@endsection