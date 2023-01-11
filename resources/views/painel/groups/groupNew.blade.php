@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Meus grupos</a>
</div>
    <div class="container" style="min-height: auto!important;">

        <h4>Criar novo grupo de estudos</h4>
        <hr><br>
        <form method="post" action="{{route('dashboard.groups.new')}}">
            @csrf
            <div class="form-group">
                <label for="groupTitle">Título do grupo</label>
                <input type="text" class="form-control" id="groupTitle" name="title"  autofocus required>
            </div>
            <div class="form-group">
                <label for="groupDescription">Descrição do grupo</label>
                <textarea class="form-control" id="groupDescription" name="description" rows="3" required></textarea>
              </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="visibility" name="visibility" value="private">
                <label class="form-check-label" for="visibility">Grupo privado</label>
            </div>
            <br>
            <button type="submit" class="btn btn-danger" style="float:right;">criar novo grupo</button>
            <div style="clear: both;"></div>
        </form>
    </div>
    <br>
@endsection
