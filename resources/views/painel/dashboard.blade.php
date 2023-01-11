@extends('layouts.painel')
@section('conteudo')

    <h3>Dashboard</h3>

    <hr>

    <section class="content-section">
        <br><br>
        <div class="card-group d-flex flex-wrap">
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/community.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus grupos de estudo</h5><br><br>
                    <a href="{{route('dashboard.groups')}}" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/class.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Minhas aulas</h5><br><br>
                    <a href="{{route('dashboard.class')}}" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/articles.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus artigos</h5><br><br>
                    <a href="{{route('dashboard.articles')}}" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/books.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus materiais</h5><br><br>
                    <a href="{{route('dashboard.content')}}" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
        </div>

        <br><br><br>

        <div class="links vivify pullUp" style="animation-delay:1.3s;">
            <a href="https://www.buymeacoffee.com/drelocatelli" target="_blank" title="doe para o projeto">
                <img src="{{asset('img/donate.png')}}" />
            </a>
            &nbsp;&nbsp;
            <a href="https://github.com/drelocatelli/learnPlay" target="_blank" title="Github do projeto">
                <img src="{{asset('img/github.png')}}" />
            </a>
        </div>



        <br>

    </section>


@endsection
