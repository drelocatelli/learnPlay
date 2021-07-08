@extends('layouts.painel')
@section('conteudo')

    <h3>Meus grupos de estudo</h3>

    <hr>
    <section class="content-section">
        @foreach (Auth::user()->group_users as $groupUser)
            @foreach (Auth::user()->groups($groupUser->id) as $group)
                    <div class="card-group d-flex flex-wrap group-card">
                        <div class="card rounded" style="width: 14rem;">
                            <img src="" class="card-img-top">
                            <div class="card-body">
                            <center>
                            <h5 class="card-title">{{ $group->title }}</h5>
                            <span>
                                {{ substr($group->description, 0, 150) }}
                                @if(strlen($group->description) >= 150)
                                    ...
                                @endif
                            </span><br><br>
                            <b>{{$groupUser->count()}} membro(s)</b>
                            <br><br>
                                <a href="" class="btn btn-primary">visualizar</a>
                            </center>
                            </div>
                        </div>
                @endforeach
        @endforeach
    </section>
@endsection
