@extends('layouts.painel')
@section('conteudo')
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
    |&nbsp; {{$group_article->timestamp}}
    <br><br><br>
    <h5>Deixar comentário</h5>
    <form method="post" action="">
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
    <hr><br>
    <h5>Comentários</h5>
@endsection
