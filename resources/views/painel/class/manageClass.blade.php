@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.manage')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; aulas que gerencio</a>
</div>
<h3>{{ucfirst($class->title)}}</h3>
<hr>
<h5>Detalhes:</h5>
<b>Descrição:</b> {{$class->all->descricao}}
<br>
<b>Privilégios: </b> {{($class->all->tipo_restricao == '') ? 'nenhum privilégio' : $class->all->tipo_restricao}}
<br>
<b>Categoria:</b> <a href="{{route('dashboard.class.category', [$class->all->category_name])}}">{{$class->all->category_name}}</a>
<br>
<b>Alunos:</b>
@php
    $totalMembers = $class->users->count()-1;
@endphp
{{($totalMembers > 1) ? $totalMembers . ' alunos' : $totalMembers . ' aluno'}} participando.
<br>
@include('painel.class.components.modulesManage')
<br><br>
<center>
    <a href="#" class="btn btn-warning"><i class="fas fa-asterisk"></i> Gerenciar módulos</a>
</center>

@endsection
