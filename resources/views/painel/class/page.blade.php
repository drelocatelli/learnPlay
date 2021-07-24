@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> todas as aulas</a>
</div>
    <h4>{{$class->title}}</h4>
    <hr>
    {{$class->all}}
    <br>
    @if($class->users->count() >= 1)
        <b>{{$class->users->count()}} Alunos participantes.</b>
        <br>
        @foreach($class->users as $user)
            <a href="{{route('user.profile', [$user->nome, $user->id])}}" class="user-ls" title="{{$user->nome}}">
                <img src="{{ ($user->photo === null) ? asset('img/userimg/default.png') : asset("img/userimg/". $user->photo)}}" height="50px" width="50px" class="rounded-circle">
                    {{$user->nome}}
            </a>
        @endforeach
    @else
        <b>Nenhum aluno participando ainda.</b>
    @endif

@endsection
