@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i>&nbsp; minhas aulas</a>
</div>

    <h3>Gerenciar aulas</h3>
    <hr>
    <br><br>

    @if($classes->count() >= 1)
        <section class="content-section">

            <div class=" d-flex flex-wrap">
                @foreach($classes as $class)

                    @if($class->classes->id_admin == Auth::id())
                        <div class="card rounded mb-4" style="width: 14rem;">
                            <a href="{{route('dashboard.class.manageClass', [$class->classes->titulo, $class->id_class])}}">
                                <img src="{{($class->thumbnail == '') ? asset('img/class.svg') : asset("img/classes/$class->thumbnail") }}" class="card-img-top">
                                <div class="card-body">
                                <center>
                                <h5 class="card-title">{{$class->classes->titulo}}</h5>
                                </center>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach

                </div>
        </section>
    @else
        <center>Você não gerencia de nenhuma aula.</center>
    @endif

@endsection
