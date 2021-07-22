@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Todas as categorias</a>
</div>
@component('painel.class.components.Categoryheader') @endcomponent

    <h4>Procurando por: {{$query}}</h4>
    <hr>
    {{-------------------------------------------- {{AULAS}} --}}
    @php $classes = Auth::user()->searchClass($query); @endphp
    @forelse($classes as $class)
        @include('painel.class.components.classes')

    @empty
        <b>Não foi retornado nada.</b>
    @endforelse

@endsection
