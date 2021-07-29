@extends('layouts.painel')
@section('conteudo')


    <section>
        <ul class="nav nav-tabs">
            <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.class')}}">Minhas aulas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Aulas que gerencio.</a>
            </li>
        </ul>
    </section>
    <br>
    <h3>Minhas aulas</h3>
    <hr>
    @if($classes->count() >= 1)
        <section class="content-section">
            <br><br>
            <div class=" d-flex flex-wrap">
                @foreach($classes as $class)

                <div class="card rounded" style="width: 14rem;">
                    <a href="#">
                        <img src="{{($class->thumbnail == '') ? asset('img/class.svg') : asset("img/classes/$class->thumbnail") }}" class="card-img-top">
                        <div class="card-body">
                        <center>
                        <h5 class="card-title">{{$class->titulo}}</h5>
                            {{ substr($class->descricao, 0, 400) }}
                            @if(strlen($class->descricao) >= 400)
                                ...
                            @endif
                        </center>
                        </div>
                    </a>
                </div>
                @endforeach
                </div>
            </div>
        </section>
    @else
        <center>Você não participa de nenhuma aula.</center>
    @endif

@endsection
