@extends('layouts.painel')
@section('conteudo')
    <h3><a href="{{route('user.profile', [$user, $id])}}">{{$user}}</a></h3>
    <br>

    <img src="
        @if($find->photo === null)
            {{ asset('img/userimg/default.png')}}
        @else
            {!! asset("img/userimg/". $find->photo) !!}
        @endif
    " class="profile-photo rounded">

@endsection
