@extends('layouts.painel')
@section('conteudo')

    <h3>Dashboard</h3>

    <hr>

    <section class="content-section">
        <div class="card-group d-flex flex-wrap">
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/community.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus grupos de estudo</h5><br>
                    <a href="#" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/class.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Minhas aulas</h5><br><br>
                    <a href="#" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/articles.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus artigos</h5><br><br>
                    <a href="#" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
            <div class="card rounded" style="width: 14rem;">
                <img src="{{ asset('img/books.svg') }}" class="card-img-top">
                <div class="card-body">
                <center>
                <h5 class="card-title">Meus materiais</h5><br><br>
                    <a href="#" class="btn btn-primary">visualizar</a>
                </center>
                </div>
            </div>
        </div>
    </section>


@endsection
