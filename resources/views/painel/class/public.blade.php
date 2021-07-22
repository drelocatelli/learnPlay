@extends('layouts.painel')
@section('conteudo')
    @component('painel.class.components.Categoryheader') @endcomponent
    <h4>Procurar aulas</h4>
    <hr>
    <br>


    {{-------------------------------------------- {{AULAS}} --}}
    @php $classes = Auth::user()->getClass('no-group'); @endphp

    @forelse($classes as $class)
        @include('painel.class.components.classes')

        @empty
            <b>Nenhuma aula foi cadastrada</b>
    @endforelse

@endsection
