@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Meus grupos</a>
</div>
    <div class="container">
    @php
        $group_page = Auth::user()->group_page();
        $group_users = Auth::user()->get_group_all_users();
        $group_users_id = [];
    @endphp
    @foreach ($group_users as $group_user)
        @php
            array_push($group_users_id, $group_user->id_user);
        @endphp
    @endforeach
    @php $userInGroup = in_array(Auth::user()->id, $group_users_id); @endphp

        @if(empty($group_page))
            <h4>Grupo inválido e/ou sem membros disponíveis, impossível ingressar.</h4>

        @else
                @if($group_page->visibility == 'public' or $userInGroup)

                @if(!empty($group_page))
                        <div class="main">
                            <div class="post">
                                <h4 class="vivify fadeIn" style="animation-delay: 0.8s;">
                                    @if(Auth::user()->group_page()->visibility == 'public')
                                        <i title="público" class="fas fa-eye"></i>
                                    @else
                                        <i title="restringido à membros" class="fas fa-eye-slash"></i>
                                    @endif
                                    &nbsp;
                                    {{urldecode($title)}}</h4>
                                <hr>
                                @if($userInGroup)
                                <br>
                                <div class="discussion bg-light p-2 vivify fadeIn" style="animation-delay: 0.8s; border-radius:15px!important;"><br>
                                    <h5><i class="fas fa-comments"></i>&nbsp; Discussão</h5>

                                    <form name="article" method="post" action="{{route('dashboard.groups.post', [$title, $id])}}">
                                        @csrf
                                        <input type="hidden" name="id_group" value="{{$id}}">
                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body" required></textarea>
                                            <br>
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-info">Postar</button>
                                            </div>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </form>

                                </div>
                                <script>
                                    $('form[name=article] textarea').focus(function(e){
                                        e.currentTarget.onkeypress = function(ev){
                                            if(ev.ctrlKey && ev.code == 'Enter'){
                                                $('form[name=article]').submit();
                                            }
                                        }
                                    })
                                </script>
                                <br><br>
                                <h6>{{Auth::user()->group_article()->count()}} artigos</h6>
                                @foreach (Auth::user()->group_article() as $group_article)
                                    <br>
                                    <div class="discussion-post bg-light p-2 rounded">
                                        <discuss>
                                            @php
                                                $body = nl2br(Auth::user()->emoticon($group_article->body));
                                                $body = strip_tags(($body),'<br><b>');
                                                print $body;
                                            @endphp
                                        </discuss>
                                        <br>
                                        <a href="{{route('user.profile', [$group_article->nome, $group_article->id])}}" class="user-list">
                                            <img src="
                                            @if($group_article->photo === null)
                                                {{ asset('img/userimg/default.png')}}
                                            @else
                                                {!! asset("img/userimg/". $group_article->photo) !!}
                                            @endif
                                                " height="25px" width="25px" class="photo-default">&nbsp; {{$group_article->nome}}
                                        </a>&nbsp;
                                        ·&nbsp; {{$group_article->timestamp}} &nbsp;·&nbsp; <a href="{{route('dashboard.groups.comment', [$title, $id, $group_article->id_article])}}" title="comentar"><i class="far fa-comment-dots"></i> comentar ({{count(Auth::user()->get_Comment($id, $group_article->id_article))}})</a>
                                        @if(Auth::user()->id == $group_article->id_user)
                                            <div style="float:right">
                                                <a href="{{route('dashboard.groups.postDelete', [$id, $group_article->id_article])}}" class="btn btn-danger" title="deletar postagem"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <center>
                                    <div class="discussion-post bg-light p-2 rounded">
                                        <br>
                                        Entre no grupo para ver o conteúdo.
                                        <br><br>
                                        <a href="{{route('dashboard.groups.enter', [$title, $id])}}" class="btn btn-success mb-3">entrar no grupo</a>
                                    </div>
                                </center>
                            @endif

                            </div>
                            <div class="aside">
                                <h4>Sobre o grupo</h4>
                                <hr>
                                <img src="
                                @if($group_page->thumbnail == null)
                                    {{ asset('img/community.svg')}}
                                @else
                                    {!! asset('img/groups/'. $group_page->thumbnail) !!}
                                @endif
                                " class="img-thumbnail bg-transparent">
                                <br><br>
                                    {{Auth::user()->group_page()->description}}
                                <br><br>
                                <a class="btn btn-info"><i class="fas fa-photo-video"></i>&nbsp; Verificar aulas</a>
                                <br><br>
                                <h4>Administradores</h4>
                                <hr>
                                    @foreach (Auth::user()->group_admin() as $group_admin)
                                        <a href="{{route('user.profile', [$group_admin->nome, $group_admin->id])}}" class="user-list">
                                            <img src="
                                            @if($group_admin->photo === null)
                                                {{ asset('img/userimg/default.png')}}
                                            @else
                                                {!! asset("img/userimg/". $group_admin->photo) !!}
                                            @endif
                                                " height="25px" width="25px" class="photo-default"> {{$group_admin->nome}}
                                        </a>&nbsp;
                                    @endforeach
                                <h4>Membros</h4>
                                <hr>
                                    @if(Auth::user()->get_group_users()->count() >= 1)
                                    @foreach (Auth::user()->get_group_users() as $group_user)
                                        <a href="{{route('user.profile', [$group_user->nome, $group_user->id])}}" class="user-list">
                                            <img src="
                                            @if($group_user->photo === null)
                                                {{ asset('img/userimg/default.png')}}
                                            @else
                                                {!! asset("img/userimg/". $group_user->photo) !!}
                                            @endif
                                            " height="25px" width="25px" class="photo-default">
                                            {{$group_user->nome}}
                                        </a>&nbsp;
                                    @endforeach
                                    @else
                                    Nenhum membro.
                                    @endif
                                <br><br><br>
                                @if($userInGroup)
                                    <a href="{{route('dashboard.groups.leave', [$title, $id])}}" class="btn btn-danger">sair do grupo</a>
                                @endif

                            </div>
                        </div>

                        <div style="clear:both;"></div>
                @endif

        @else
            <h4>Grupo inexistente ou sem permissão para acessá-lo.</h4>
        @endif
    @endif

    </div>

    <script>
        function urlify(text) {
        var urlRegex = /(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/gm;
        text = text.replaceAll('<br>', '')
        return text.replace(urlRegex, function(url) {
            return '<br><a href="' + url + '" target="_blank">' + url + '</a>';
        })
        }

        document.querySelectorAll('discuss').forEach(function(i){
            let html = urlify(i.innerHTML);

            i.innerHTML = html;
        })

    </script>

@endsection
