@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Todas as categorias</a>
</div>
    @php $title = ucfirst(urldecode($category)); @endphp
    @component('painel.class.components.Categoryheader') @endcomponent

    <h4>{{ $title }}</h4>
    <hr>

    <br>

    {{-------------------------------------------- {{AULAS}} --}}

    @php $classes = Auth::user()->getClassByName($title)->where('tipo_restricao', '<>', 'group'); @endphp

    @forelse($classes as $class)
        @include('painel.class.components.classes')
    @empty
        <b>Nenhuma aula foi cadastrada</b>
    @endforelse
@endsection
