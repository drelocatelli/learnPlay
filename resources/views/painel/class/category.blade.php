@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Todas as categorias</a>
</div>
    <h4>{{ ucfirst(urldecode($category)) }}</h4>
@endsection
