@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.class.public')}}" class="btn btn-primary"><i class="fas fa-chevron-left"></i> todas as aulas</a>
</div>
    @if($class)
        <center>
            <h4>{{ $class->title }}</h4>
            {{ $class->all->descricao }}
            <hr>

            <table border='0' align='center' class="bg-light rounded-circle" style="background:#f8f9fa63!important;">
                <tr>
                    <td>
                        <img src="{{ ($class->all->thumbnail == null) ? asset('img/class.svg') : asset("img/classes/". $class->all->thumbnail)}}" style="    width: 420px;
                        height: 400px;">
                    </td>
                    <td>
                        <b>Criador: </b>&nbsp; <a href="{{route('user.profile', [$class->all->nome, $class->all->id])}}" class="user-ls" title="{{$class->all->nome}}">
                            <img style="padding:0!important;" src="{{ ($class->all->photo === null) ? asset('img/userimg/default.png') : asset("img/userimg/". $class->all->photo)}}" height="50px" width="50px" class="rounded-circle"> {{$class->all->nome}} </a>
                        <br>
                        <br>
                        <b>Categoria: </b> <a href="{{route('dashboard.class.category', [$class->all->category_name])}}"><span style="text-transform: lowercase;">{{ $class->all->category_name }}</span></a>
                        <br>
                        <b>Início: </b> {{ $class->all->timestamp }}
                        <br>
                        <b>Privilégios: </b> {{($class->all->tipo_restricao == '') ? 'nenhum privilégio' : $class->all->tipo_restricao}}

                    </td>
                </tr>
            </table>

    <br>
            @php $users = []; @endphp
            @if($class->users->count() >= 1)
                <b>{{$class->users->count()}} Alunos participantes:</b>
                <br>
                @foreach($class->users as $user)
                    <a href="{{route('user.profile', [$user->nome, $user->id])}}" class="user-ls" title="{{$user->nome}}">
                        <img src="{{ ($user->photo === null) ? asset('img/userimg/default.png') : asset("img/userimg/". $user->photo)}}" height="50px" width="50px" class="rounded-circle">
                            {{$user->nome}}
                    </a>
                    @php array_push($users, $user->nome); @endphp
                @endforeach
            @else
                <b>Nenhum aluno participando ainda.</b>
            @endif
            <hr>
            @if(!in_array(Auth::user()->nome, $users))
                @if(empty($users))
                    @php $enrollName = 'seja o primeiro aluno' @endphp
                @else
                    @php $enrollName = 'inscrever-se na aula' @endphp
                @endif
                <a href="{{route('dashboard.class.matricula', [$class->all->id, $class->all->titulo])}}" class="btn btn-success">{{$enrollName}}</a>
            @else
                Participando
            @endif
        </center>
    @else
        <h4>Aula não encontrada ou sem permissão de acesso.</h4>
    @endif
@endsection
