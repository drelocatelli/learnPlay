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
        <form method="post">
            @csrf
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
</div>
<div style="clear:both; margin-bottom:20px;"></div>
