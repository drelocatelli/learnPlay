@extends('layouts.painel')
@section('conteudo')
@include('dashboardLink')
<div class="position-relative mb-2 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-warning"><i class="fas fa-chalkboard-teacher"></i>&nbsp; procurar por aulas</a>
</div>
<div class="position-relative mb-1 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.create')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; criar nova aula</a>
    &nbsp;&nbsp;
    <a href="{{route('dashboard.class.manage')}}" class="btn btn-success"><i class="fas fa-bars"></i>&nbsp; gerenciar aulas</a>
</div>

        <h3>Minhas aulas</h3>
        <hr>
        <br><br>
    @if($classes->count() >= 1)
        <section class="content-section">

            <div class=" d-flex flex-wrap">
                @foreach($classes as $class)

                    @if($class->classes->id_admin != Auth::id())

                        <div class="card rounded mb-4" style="width: 14rem;">

                            <a href="{{route('dashboard.class.learn', [$class->id_class, $class->titulo])}}">
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
        <center>Você não participa de nenhuma aula.</center>
    @endif

@endsection
