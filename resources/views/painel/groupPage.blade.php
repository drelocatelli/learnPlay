@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Meus grupos</a>
</div>
    <div class="container">
    @php $group_page = Auth::user()->group_page(); @endphp
    @if(!empty($group_page))
            <div class="main">
                <div class="post">
                    <h4>
                        @if(Auth::user()->group_page()->visibility == 'public')
                            <i title="público" class="fas fa-eye"></i>
                        @else
                            <i title="restringido à membros" class="fas fa-eye-slash"></i>
                        @endif
                        &nbsp;
                        {{urldecode($title)}}</h4>
                    <hr>
                    <h5><i class="fas fa-graduation-cap"></i>&nbsp; Aulas</h5>
                    <h5><i class="fas fa-comments"></i>&nbsp; Discussão</h5>

                </div>
                <div class="aside">
                    <h4>Descrição</h4>
                    <hr>
                        {{Auth::user()->group_page()->description}}
                    <h4>Administradores</h4>
                    <hr>
                        @foreach (Auth::user()->group_admin() as $group_user)
                            <a href="{{route('user.profile', [$group_user->nome, $group_user->id])}}">{{$group_user->nome}}</a><br>
                        @endforeach
                    <hr>
                    terminar entrar no grupo / sair do grupo
                    <a href="#" class="btn btn-danger">sair do grupo</a>

                </div>
            </div>

            <div style="clear:both;"></div>

    @else
        <h4>Nenhum grupo encontrado.</h4>
    @endif

    </div>

@endsection
