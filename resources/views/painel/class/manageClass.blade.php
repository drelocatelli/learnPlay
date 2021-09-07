@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.manage')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; aulas que gerencio</a>
</div>
<h3>{{ucfirst($class->title)}}</h3>
<hr>
<b>Descrição:</b> {{$class->all->descricao}}
<br>
<b>Privilégios: </b> {{($class->all->tipo_restricao == '') ? 'nenhum privilégio' : $class->all->tipo_restricao}}
<br>
<b>Categoria:</b> <a href="{{route('dashboard.class.category', [$class->all->category_name])}}">{{$class->all->category_name}}</a>
<br>
<b>Alunos:</b> {{$class->users}}
<br>
{{$class->all}}


@endsection
