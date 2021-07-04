@extends('layouts.master')
@section('conteudo')

@if(Request::getPathInfo() == '/register/error')
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    Ocorreu um erro inesperado, tente novamente!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(Request::getPathInfo() == '/register/error/user_exists')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <b>Erro:</b> Já foi cadastrado um usuário com este e-mail. Tente novamente!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Request::getPathInfo() == '/register/success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <b>Sucesso:</b> Você foi cadastrado na plataforma!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@else
<h3>Ingressar na plataforma</h3>
<br>
<form method="post" action="/register/complete">
@csrf
  <div class="form-group">
    <label for="nome">Nome</label> 
    <input id="nome" name="nome" type="text" required="required" class="form-control">
  </div>
  <div class="form-group">
    <label for="email">E-mail</label> 
    <input id="email" name="email" type="email" required="required" class="form-control">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label> 
    <input id="senha" name="senha" type="password" required="required" class="form-control">
  </div> 
  <div class="form-group">
    <button name="submit" type="submit" class="btn btn-primary">Ingressar</button>
  </div>
</form>
@endif
@endsection