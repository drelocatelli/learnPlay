@extends('layouts.painel')
@section('conteudo')
    @component('painel.class.Categoryheader') @endcomponent
    <h4>Procurar aulas</h4>
    <hr>
    <br>


    {{-------------------------------------------- {{AULAS}} --}}
    @php $classes = Auth::user()->getClass('no-group'); @endphp

    @forelse($classes as $class)
        <table class="group-list rounded" width="100%">
            <tr>
                <td width="15rem">
                    <img src="{{ ($class->thumbnail == null) ? asset('img/class.svg') : asset("img/classes/$class->thumbnail") }}" style="width: 15rem; height: 15rem;">
                </td>
                <td valign="top">
                    <br>
                    <h5 style="position:absolute;">
                        <a href="javascript:void(0);">{{ $class->titulo }}</a> {!! ($class->tipo_restricao == 'password') ? "<span title='requer senha de acesso' style='    font-size: 80px; position: absolute; color: red; top: -15px; cursor: pointer; user-select: none;'>*</span>" : '' !!}
                    </h5>
                    <br>
                    <div style="display: block; min-height: 88px;">
                        {{ substr($class->descricao, 0, 400) }}
                        @if(strlen($class->descricao) >= 400)
                            ...
                        @endif
                    </div>
                    @php $date = new DateTime($class->timestamp); $date = $date->format('d/m/Y H:i'); @endphp
                     <b>Categoria:</b> <a href="{{route('dashboard.class.category', strtolower(urlencode($class->category_name)))}}">{{ $class->category_name }}</a>
                     <br>
                     <b>Iniciado em</b> {{ $date }}
                     <br>
                    @php $classMembers = Auth::user()->getClassUsers($class->id); @endphp
                     {{ ($classMembers->count() == 0) ? 'nenhum aluno ingressou ainda.' : $classMembers->count().' alunos participam.' }}
                     <br><br>
                </td>
            </tr>

        </table>

        @empty
            <h3>Nenhuma aula foi cadastrada</h3>
    @endforelse




@endsection
