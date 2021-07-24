@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Todas as categorias</a>
</div>
    @component('painel.class.components.Categoryheader') @endcomponent

    <h4>{{ $category }}</h4>
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
