@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups.page', [$title, $id])}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> Voltar pro grupo</a>
</div>
<div class="discussion-post bg-light p-2 rounded">
        @php
            $group_article = Auth::user()->getArticle($article, $id);
        @endphp
    <discuss>
        @php
            $body = nl2br(Auth::user()->emoticon($group_article->body));
            $body = strip_tags(($body),'<br><b>');
            print $body;
        @endphp
    </discuss>


    <a href="{{route('user.profile', [$group_article->nome, $group_article->id])}}" class="user-list">
        <img src="
        @if($group_article->photo === null)
            {{ asset('img/userimg/default.png')}}
        @else
            {!! asset("img/userimg/". $group_article->photo) !!}
        @endif
            " height="25px" width="25px" class="photo-default">&nbsp; {{$group_article->nome}}
    </a>&nbsp;
    ·&nbsp; {{$group_article->timestamp}}
    <br><br><br>

    <h5>Deixar comentário</h5>
    <form method="post">
        @csrf
        <input type="hidden" name="id_group" value="{{$id}}">
        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body" required></textarea>
            <br>
            <div style="float:right;">
                <button type="submit" class="btn btn-info">comentar</button>
            </div>
            <div style="clear:both;"></div>
        </div>
    </form>

    <br>

    <h3>Comentários</h3><br>
    @php $comments = Auth::user()->get_Comment($id, $article); @endphp

    @foreach ($comments as $comment)
    <a href="{{route('user.profile', [$comment->nome, $comment->id])}}" class="user-list">
        <img src="
        @if($comment->photo === null)
            {{ asset('img/userimg/default.png')}}
        @else
            {!! asset("img/userimg/". $comment->photo) !!}
        @endif
            " height="25px" width="25px" class="photo-default">&nbsp; {{$comment->nome}}
    </a> comentou:&nbsp; · {{$comment->timestamp}}
    <discuss>
        @php
            $body = nl2br(Auth::user()->emoticon($comment->body));
            $body = strip_tags(($body),'<br><b>');
            print $body;
        @endphp
    </discuss>
    <br><br>
    @endforeach



@endsection
