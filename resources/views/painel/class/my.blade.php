@extends('layouts.painel')
@section('conteudo')
@include('dashboardLink')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.create')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; criar nova aula</a>
</div>

    <h3>Minhas aulas</h3>
    <hr>
    @if($classes->count() >= 1)
        <section class="content-section">
            <br><br>
            <div class=" d-flex flex-wrap">
                @foreach($classes as $class)
                <div class="card rounded" style="width: 14rem;">
                    <a href="{{route('dashboard.class.learn', [$class->id_class, $class->titulo])}}">
                        <img src="{{($class->thumbnail == '') ? asset('img/class.svg') : asset("img/classes/$class->thumbnail") }}" class="card-img-top">
                        <div class="card-body">
                        <center>
                        <h5 class="card-title">{{$class->titulo}}</h5>
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
