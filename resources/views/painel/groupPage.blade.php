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


        @if($group_page->visibility == 'public' or $userInGroup)

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
                        @if($userInGroup)
                        <h5><i class="fas fa-graduation-cap"></i>&nbsp; Aulas</h5>
                        <hr>
                        <div class="discussion bg-light p-2" style="border-radius:15px!important;"><br>
                            <h5><i class="fas fa-comments"></i>&nbsp; Discussão</h5>
                            <form action="">
                                <div class="form-group">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <br>
                                    <div style="float:right;">
                                        <button type="submit" class="btn btn-info">Postar</button>
                                    </div>
                                    <div style="clear:both;"></div>
                                </div>
                            </form>
                        </div>
                        <br><br>
                        <h6>Total: {{Auth::user()->group_article()->count()}}</h6>
                        @foreach (Auth::user()->group_article() as $group_article)
                            <br>
                            <div class="discussion-post bg-light p-2 rounded">
                                {{ Auth::user()->emoticon($group_article->body) }}
                                <hr>
                                <a href="{{route('user.profile', [$group_article->nome, $group_article->id])}}" class="user-list">
                                    <img src="
                                    @if($group_article->photo === null)
                                        {{ asset('img/userimg/default.png')}}
                                    @else
                                        {!! asset("img/userimg/". $group_article->photo) !!}
                                    @endif
                                        " height="25px" width="25px" class="photo-default">&nbsp; {{$group_article->nome}}
                                </a>&nbsp;
                                |&nbsp; {{$group_article->timestamp}} &nbsp;|&nbsp; <a href=""><i class="far fa-comment-dots"></i> comentários (0)</a>
                                @if(Auth::user()->id == $group_article->id_user)
                                    <div style="float:right;">
                                        <a href="" class="btn btn-danger" title="deletar postagem"><i class="far fa-trash-alt"></i></a>
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
                        <br><br>
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

    </div>

@endsection
