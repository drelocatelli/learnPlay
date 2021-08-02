@extends('layouts.painel')
@section('conteudo')

    <h4>{{ $class->title }}</h4>
    <hr>
    {{ $class->all->descricao }}

    {{$class->users}}

@endsection
