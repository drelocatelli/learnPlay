@extends('layouts.master')
@section('conteudo')

@if(Request::getPathInfo() == '/register/error')
    Ocorreu um erro!
@endif

<h3>Ingressar na plataforma</h3>
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
@endsection