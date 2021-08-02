@extends('layouts.painel')
@section('conteudo')

    <h3>Minhas aulas</h3>
    <hr>
    @if($classes->count() >= 1)
        <section class="content-section">
            <br><br>
            <div class=" d-flex flex-wrap">
                @foreach($classes as $class)

                <div class="card rounded" style="width: 14rem;">
                    <a href="{{route('dashboard.class.learn', [$class->id, $class->titulo])}}">
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
