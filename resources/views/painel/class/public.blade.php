@extends('layouts.painel')
@section('conteudo')

    <h4>Procurar aulas</h4>

    {{-------------------------------------------- {{BUSCA}} --}}

    <table align="right">
        <form method="post">
            <tr>
                <td>
                    <input type="text" class="form-control" placeholder="Digite o nome da aula" autofocus>
                </td>
                <td>
                    <button class="btn btn-danger">procurar</button>
                </td>
            </tr>
        </form>
    </table>

    {{-------------------------------------------- {{CATEGORIAS}} --}}

    <div style="clear:both; height:20px;"></div>
    @php $categories = Auth::user()->getAllCategories(); @endphp
    @if($categories->count() > 0)
        <center class="bg-light rounded p-3">
            @foreach ($categories as $category)
                <a href="{{route('dashboard.class.category', strtolower(urlencode($category->nome)))}}">{{$category->nome}}</a>&nbsp;&nbsp;
            @endforeach
        </center><br>
    @else
        <h4>Nenhuma categoria foi cadastrada ainda.</h4>
    @endif

    {{-------------------------------------------- {{AULAS}} --}}
    @php $classes = Auth::user()->getClass('no-group'); @endphp

    @forelse($classes as $class)
        @php $classMembers = Auth::user()->getClassUsers($class->id); @endphp
        <table class="group-list rounded" width="100%">
            <tr>
                <td width="15rem">
                    <img src="{{ ($class->thumbnail == null) ? asset('img/class.svg') : asset("img/classes/$class->thumbnail") }}" style="width: 15rem; height: 15rem;">
                </td>
                <td valign="top">
                    <br>
                    <h5 style="position:absolute;">
                        <a href="#">{{ $class->titulo }}</a> {!! ($class->tipo_restricao == 'password') ? "<span title='requer senha de acesso' style='    font-size: 80px; position: absolute; color: red; top: -15px; cursor: pointer; user-select: none;'>*</span>" : '' !!}
                    </h5>
                    <br>
                    <div style="display: block; min-height: 88px;">
                        {{ substr($class->descricao, 0, 400) }}
                        @if(strlen($class->descricao) >= 400)
                            ...
                        @endif
                    </div>
                    @php $date = new DateTime($class->timestamp); $date = $date->format('d/m/Y'); @endphp
                     <b>Categoria:</b> <a href="#">{{ $class->category_name }}</a>
                     <br>
                     <b>Criado em:</b> {{ $date }}
                     <br>
                     {{ ($classMembers->count() == 0) ? 'Nenhum aluno ingressou ainda.' : $classMembers->count() }}
                     <br><br>
                </td>
            </tr>

        </table>

        @empty
            <h3>Nenhuma aula foi cadastrada</h3>
    @endforelse




@endsection
