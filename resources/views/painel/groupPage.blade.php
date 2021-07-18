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
                @php
                    $authIsAdmin = Auth::user()->group_isAdmin($id, Auth::user()->id);
                @endphp
                        <div class="main">
                            <div class="post">
                                <h4 class="vivify fadeIn" style="animation-delay: 0.8s;">
                                        <div id="groupVisibilityIcons" style="display:inline;">
                                            @if(Auth::user()->group_page()->visibility == 'public')
                                                <i name="public-group" title="público" class="fas fa-eye"></i>
                                            @else
                                                <i name="private-group" title="restringido à membros" class="fas fa-eye-slash"></i>
                                            @endif
                                            &nbsp;
                                        </div>
                                    <group-title>{{$group_page->title}}</group-title>
                                    @if($authIsAdmin)
                                    <!-- Editar titulo do grupo -->
                                        <div style="float:right;">
                                            <a href="javascript:void(0);" name="edit_title" class="text-dark" title="editar titulo"><i class="fas fa-pen"></i></a>
                                        </div>
                                        <form method="post" action="{{route('dashboard.group.changeTitle', [$title, $id])}}" name="changeGroup_title" style="display:none;">
                                            @csrf
                                            <input name="group_title" type="text" class="form-control" style="display: inline; width: 80%;" required>
                                        </form>
                                        <script>
                                            let gpTitleEl = $('group-title')[0];
                                            let gpTitleFo = $('form[name=changeGroup_title]')[0];
                                            let gpTitleIn = $('form[name=changeGroup_title] input[name=group_title]')[0];
                                            $('a[name=edit_title]').click(function(){
                                                gpTitleFo.style.display = 'inline';
                                                gpTitleIn.value = gpTitleEl.innerText;
                                                gpTitleEl.style.display = 'none';
                                                gpTitleIn.focus();

                                                gpTitleIn.onkeypress = function(event){
                                                    if(event.key == 'Enter'){
                                                        event.preventDefault();
                                                        gpTitleEl.innerText = gpTitleIn.value;
                                                        gpTitleEl.style.display = 'inline'
                                                        gpTitleFo.style.display = 'none'

                                                        // send form
                                                        let UrlGroupTitle = `{{route('dashboard.group.changeTitle', [$title, $id])}}`
                                                        $.ajax({
                                                            method: "POST",
                                                            url: UrlGroupTitle,
                                                            data: { _token: gpTitleIn.previousElementSibling.value, group_title: gpTitleIn.value }
                                                        }).done(function(ev){
                                                            console.log('nome do grupo salvo')
                                                        })

                                                        Swal.fire({
                                                            title: 'Nome do grupo atualizado!',
                                                            icon: 'success',
                                                            confirmButtonText: 'OK'
                                                        })

                                                    }
                                                }
                                            })

                                        </script>
                                        <div style="clear:both;"></div>
                                    @endif
                                </h4>
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
                                        @php $date = new DateTime($group_article->timestamp); $date = $date->format('d/m/Y | H:i'); @endphp
                                        ·&nbsp; {{$date}} &nbsp;·&nbsp; <a href="{{route('dashboard.groups.comment', [$title, $id, $group_article->id_article])}}" title="comentar"><i class="far fa-comment-dots"></i> comentar ({{count(Auth::user()->get_Comment($id, $group_article->id_article))}})</a>
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
                                <div style="position:relative;">
                                @if($authIsAdmin)
                                    <!-- Editar imagem do grupo -->
                                    <a href="javascript:void(0);" name="change_thumbnail" class="text-dark" style="position: absolute; right: 10px; background: white; padding: 8px 15px; border-radius: 75px; font-size: 12px; border:1px solid #000;" title="editar thumbnail"><i class="fas fa-pen"></i></a>
                                    <div class="change_group_photo">
                                        <form method="post" name="changeThumbPhoto" action="{{route('dashboard.group.changeThumbnail', [$title, $id])}}" enctype="multipart/form-data" style="display:none;">
                                            @csrf
                                            <input type="file" name="group_thumbnail">
                                        </form>
                                    </div>
                                    <script>
                                        $('a[name=change_thumbnail').click(function(){
                                            let thumbnailIn = $('input[name=group_thumbnail]');
                                            let thumbnailImg = $('img.img-thumbnail')[0];

                                            thumbnailIn.click()
                                            thumbnailIn.change(function(e){
                                                let token = $('form[name=changeThumbPhoto] input[name=_token]')[0].value

                                                let file = (this.files[0]);

                                                let fileName = `{{$title}}`+`_`+`{{$id}}`;
                                                fileName = fileName.replaceAll('+', '_');

                                                thumbnailImg.src = URL.createObjectURL(this.files[0]);
                                                let urlThumb = `{{route('dashboard.group.changeThumbnail', [$title, $id])}}`
                                                let formThumbnail = $('form[name=changeThumbPhoto]')[0];
                                                let formDataThumbnail = new FormData(formThumbnail);
                                                $.ajax({
                                                    type:'post',
                                                    url: urlThumb,
                                                    cache: false,
                                                    contentType: false,
                                                    processData: false,
                                                    data: formDataThumbnail
                                                }).done(function(e){
                                                    Swal.fire({
                                                        title: 'Thumbnail alterada!',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'
                                                    })
                                                })
                                            })
                                        });
                                    </script>
                                @endif
                                    <img src="
                                    @if($group_page->thumbnail == null)
                                        {{ asset('img/community.svg')}}
                                    @else
                                        {!! asset('img/groups/'. $group_page->thumbnail) !!}
                                    @endif
                                    " class="img-thumbnail bg-transparent">
                                </div>
                                <br>
                                <span name="group_description">
                                    @php
                                        $description = nl2br(Auth::user()->group_page()->description);
                                        print $description;
                                    @endphp
                                </span>
                                    @if($authIsAdmin)
                                        <!-- Editar descrição do grupo -->
                                        <form method="post" action="{{route('dashboard.group.changeDescription', [$title, $id])}}" name="Groupchange_description" style="display:none;">
                                            @csrf
                                            <textarea name="group_description" class="form-control">{{Auth::user()->group_page()->description}}</textarea><br>
                                            <button type="button" class="btn btn-warning">salvar</button>
                                        </form>


                                    @endif
                                <br><br>
                                <a class="btn btn-info"><i class="fas fa-photo-video"></i>&nbsp; Verificar aulas</a>
                                <br>
                                @if($authIsAdmin)
                                    <br>
                                    <h4>Gerenciamento</h4>
                                    <hr>
                                    <a href="javascript:void(0);" name="change_description" class="btn btn-warning" title="editar descrição"><i class="fas fa-pen"></i> Mudar descrição</a>
                                    <script>
                                        let formDescFo = $('form[name=Groupchange_description]')[0];
                                        let formDescToken = $('form[name=Groupchange_description] input[name=_token]')[0];
                                        let formDescIn = $('form[name=Groupchange_description] textarea[name=group_description]')[0];
                                        let formDescBtn = $('form[name=Groupchange_description] button[type=button]')[0];
                                        let description = $('span[name=group_description]')[0]

                                        $('a[name=change_description]').click(function(e){
                                            formDescFo.style.display = 'block';
                                            formDescIn.focus();
                                            formDescIn.onkeypress = function(e){
                                                if(e.ctrlKey && e.code == 'Enter'){
                                                    formDescBtn.click()
                                                }
                                            }
                                            description.style.display = 'none'

                                            formDescBtn.onclick = function(e){
                                                description.innerText = formDescIn.value
                                                formDescFo.style.display = 'none';
                                                description.style.display = 'block'

                                                let urlDesc = `{{route('dashboard.group.changeDescription', [$title, $id])}}`;

                                                $.ajax({
                                                    method: 'POST',
                                                    url: urlDesc,
                                                    data: { _token: formDescToken.value, group_description: formDescIn.value}
                                                }).done(function(err){
                                                    Swal.fire({
                                                    title: 'Descrição alterada!',
                                                    icon: 'success',
                                                    confirmButtonText: 'OK'
                                                    })
                                                })

                                            }
                                        })
                                    </script>
                                            <a href="javascript:void(0);" style="display:none;" name="visibility-public" class="btn btn-primary bg-dark"><i title="público" class="fas fa-eye"></i> Grupo público</a>
                                            <a href="javascript:void(0);" style="display:none;" name="visibility-private" class="btn btn-primary bg-dark"><i title="restringido à membros" class="fas fa-eye-slash"></i> Grupo privado</a>
                                            <br><br>
                                            <a href="javascript:void(0);" class="btn btn-success"><i class="fas fa-plus"></i> membros</a>
                                    <script>
                                        let publicBtn = $('a[name=visibility-public]')[0];
                                        let privateBtn = $('a[name=visibility-private]')[0];

                                        let privateIcon = $('i[name=private-group]')[0];
                                        let publicIcon = $('i[name=public-group]')[0];


                                        if(privateIcon){
                                            privateBtn.style.display = 'inline-block';
                                        }else if(publicIcon){
                                            publicBtn.style.display = 'inline-block';
                                        }

                                        $('#groupVisibilityIcons').remove()


                                        let urlChanges = `{{route('dashboard.group.changeVisibility', [$title, $id])}}`
                                        let token = `{{ csrf_token() }}`

                                        publicBtn.onclick = function(e){
                                            privateBtn.style.display = 'inline-block';
                                            publicBtn.style.display = 'none';

                                            $.ajax({
                                                url: urlChanges,
                                                method: 'post',
                                                data: { _token: token, group_visibility: "private" }
                                            }).done(function() {
                                                Swal.fire({
                                                    title: 'grupo privado!',
                                                    icon: 'info',
                                                    confirmButtonText: 'OK'
                                                })
                                            });
                                        }

                                        privateBtn.onclick = function(e){
                                            publicBtn.style.display = 'inline-block';
                                            privateBtn.style.display = 'none';
                                            $.ajax({
                                                url: urlChanges,
                                                method: 'post',
                                                data: { _token: token, group_visibility: "public" }
                                            }).done(function() {
                                                Swal.fire({
                                                    title: 'grupo público!',
                                                    icon: 'info',
                                                    confirmButtonText: 'OK'
                                                })
                                            });
                                        }
                                    </script>
                                @endif
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
