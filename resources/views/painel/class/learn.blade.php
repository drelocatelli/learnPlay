@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-2 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> aulas que participo</a>
</div>
    <h4>{{ $class->title }}</h4>
    <hr>

    @php
        $totalMembers = $class->users->count()-1;
    @endphp
    <b>{{($totalMembers > 1) ? $totalMembers . ' alunos' : $totalMembers . ' aluno'}} </b> participando.

    <br>
    <b>Instrutor: </b>&nbsp; <a href="{{route('user.profile', [$class->all->nome, $class->all->id])}}" class="user-ls" title="{{$class->all->nome}}">
        <img style="padding:0!important;" src="{{ ($class->all->photo === null) ? asset('img/userimg/default.png') : asset("img/userimg/". $class->all->photo)}}" height="50px" width="50px" class="rounded-circle"> {{$class->all->nome}} </a>

    <br>

    <b>Descrição: </b>{{ $class->all->descricao }}
    @include('painel.class.components.modules')

    <br>
    <hr>
    <center>
        <a href="{{route('dashboard.class.leave', [$class->all->id, $class->all->titulo, 'redirect' => Crypt::encrypt(Route::currentRouteName())])}}" class="btn btn-danger"><i class="fas fa-times"></i>&nbsp; abandonar aula</a>
    </center>

@endsection
