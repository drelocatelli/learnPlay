@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-2 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> aulas que participo</a>
</div>
    <h4>{{ $class->title }}</h4>
    <hr>

    <b>{{($class->users->count() > 1) ? $class->users->count() . ' alunos' : $class->users->count() . ' aluno'}} </b> participando.

    <br>

    <b>Descrição: </b>{{ $class->all->descricao }}

    <hr>
    <center>
      <h4>
        {{( $module->count() > 1) ? $module->count(). ' módulos' : $module->count().' módulo'}}.
      </h4>
    </center>
    <br>
    @if($module->count() > 0)


        @foreach($module as $model)


            <div class="accordion accordion-flush" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$loop->iteration}}" aria-expanded="true" aria-controls="collapseOne">
                        {{ucfirst($module[$loop->iteration][0]->title)}}
                    </button>
                </h2>
                <div id="collapse_{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="card card-chapter">
                    <ul class="list-group list-group-flush">
                    @for($i = 0; $i < $model->count(); $i++)
                        <a href="#" style="witdh:max-content;"><li class="list-group-item">{{ucfirst($module[$loop->iteration][$i]->class_chapter_title)}}</li></a>
                    @endfor

                    </ul>
                </div>
                </div>
            </div>

            </div>
        @endforeach
    @else
        <center><b>Nenhum módulo foi criado.</b></center>
    @endif

    <hr>
    <center>
        <a href="{{route('dashboard.class.leave', [$class->all->id, $class->all->titulo, 'redirect' => Crypt::encrypt(Route::currentRouteName())])}}" class="btn btn-danger"><i class="fas fa-times"></i>&nbsp; abandonar aula</a>
    </center>

@endsection
