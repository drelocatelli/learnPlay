@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.manage')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; aulas que gerencio</a>
</div>
<br>

<div style="float:left;">
    <h3>{{ucfirst($class->title)}}</h3>  
</div>

<div style="float:right;">
    <div class="dropdown" style="display:inline;">
    <button class="btn btn-secondary dropdown-toggle"  style="background:#628aa0;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        Opções de grade
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{route('dashboard.class.painel', [$class->all->id])}}">Criar novo módulo</a></li>
        <li><a class="dropdown-item" href="#">Associar aula à módulo</a></li>
    </ul>
    </div>
    <a href="#" class="btn btn-warning" style="background:#628aa0;"><i class="fas fa-cog"></i>&nbsp; Alterar restrição</a>
</div>
<div style="clear:both;"></div>
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

@endsection
