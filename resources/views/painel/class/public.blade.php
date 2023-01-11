@extends('layouts.painel')
@section('conteudo')
    @component('painel.class.components.Categoryheader') @endcomponent
    <h4>Procurar aulas</h4>
    <hr>
    <br>


    {{-------------------------------------------- {{AULAS}} --}}

    @forelse($classes as $class)
        @include('painel.class.components.classes')
        @empty
            <b>Nenhuma aula foi cadastrada</b>
    @endforelse

    <div class="pagination">
        {{ $classes->links() }}

    </div>

@endsection
