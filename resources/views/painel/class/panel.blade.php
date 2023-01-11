@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.manageClass', [$class->title, $class->all->id] )}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; voltar aos detalhes</a>
</div>
<br>

<h3>{{ucfirst($class->title)}} (Criar novo módulo)</h3>  
<hr>

<form action="">
    <table>
        <tr>
            <td>
                <label for="module">Titulo do módulo</label>
                <input type="text" class="form-control" id="module" name="module">
            </td>
        </tr>
        <tr align="right">
            <td>
                <button class="btn btn-danger" type="submit">Criar módulo</button>
            </td>
        </tr>
    </table>
</form>

@endsection
