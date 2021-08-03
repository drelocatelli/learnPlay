@extends('layouts.painel')
@section('conteudo')

    <h4>{{ $class->title }}</h4>
    <hr>

    <b>{{($class->users->count() > 1) ? $class->users->count() . ' alunos' : $class->users->count() . ' aluno'}} </b> participando.

    <br>

    <b>Descrição: </b>{{ $class->all->descricao }}



    <hr>
    <center>
        <a href="{{route('dashboard.class.leave', [$class->all->id, $class->all->titulo, 'redirect' => Crypt::encrypt(Route::currentRouteName())])}}" class="btn btn-danger"><i class="fas fa-times"></i> sair da aula</a>
    </center>

@endsection
