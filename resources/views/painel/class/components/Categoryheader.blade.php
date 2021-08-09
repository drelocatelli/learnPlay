{{-------------------------------------------- {{CATEGORIAS}} --}}


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


{{-------------------------------------------- {{BUSCA}} --}}

<div style="float:right;">
    <table>
        <form method="get" action="{{route('dashboard.class.search')}}">
            <tr>
                <td>
                    <input type="search" name="query" class="form-control" placeholder="Digite o nome da aula" autofocus>
                </td>
                <td>
                    <button class="btn btn-danger">procurar</button>
                </td>
            </tr>
        </form>
    </table>
</div>
<div style="clear:both; margin-bottom:20px;"></div>

<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.create')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; criar nova aula</a>
</div>
