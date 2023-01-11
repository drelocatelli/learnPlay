@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Minhas aulas</a>
</div>
    <div class="container" style="min-height: auto!important;">

        <h4>Adicionar nova aula</h4>
        <hr><br>
        <form method="post">
            @csrf
            <div class="form-group">
                <label for="classTitle">Título da aula</label>
                <input type="text" class="form-control" id="classTitle" name="title"  autofocus required>
            </div>
            <div class="form-group">
                <label for="classDescription">Descrição da aula</label>
                <textarea class="form-control" id="classDescription" name="description" rows="3" required></textarea>
              </div>

            <div class="form-group">

                <label for="classCategory">Categoria</label>
                <select class="form-control" name="category" id="classCategory">
                    @foreach($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->nome}}</option>
                    @endforeach
                </select>
            </div>

            <b>Restrição:</b>

            <div class="form-check">
                <input type="radio" class="form-check-input" id="visibility0" name="visibility" value="none" checked>
                <label class="form-check-label" for="visibility0">nenhuma</label>
                <br>
                <input type="radio" class="form-check-input" id="visibility1" name="visibility" value="password">
                <label class="form-check-label" for="visibility1">senha de acesso</label>
            </div>

            <div class="form-group restricao_form" style="display:none;">
                <label for=""></label>
                <input type="password" class="form-control" id="classRest" name="password" placeholder="digite a senha de acesso">
            </div>
            <br>
            <button type="submit" class="btn btn-danger" style="float:right;">adicionar nova aula</button>
            <div style="clear: both;"></div>
        </form>
    </div>
    <br>

    <script>
        let visibility = [$('#visibility0') ,$('#visibility1')];
        let restricaoForm = document.querySelector('.restricao_form')

        visibility.forEach(function(item){
            item[0].onchange = function(i){
                toggle(i);
            }
        })

        function toggle(i){
            if(i.target.value != 'none'){
                    restricaoForm.style.display = 'block';
                    $('input[type=password]')[0].required = true;
                    $('input[type=password]').focus();
                }else{
                    restricaoForm.style.display = 'none';
                    $('input[type=password]')[0].required = false;
                }
        }
    </script>
@endsection
