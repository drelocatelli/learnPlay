@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups.new')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; Criar novo grupo</a>
</div>
    <h3>Meus grupos de estudo</h3>

    <hr>
    <section class="content-section">
        @if(Auth::user()->groups->count() >= 1)
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link disabled" aria-current="page" href="#" aria-disabled="true">Todos os grupos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard.groups.admin')}}">Grupos que gerencio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-current="page" href="#" aria-disabled="true">Você participa de {{Auth::user()->groups->count()}} grupo(s).</a>
            </li>
          </ul>

            <table class="group-list rounded" width="100%">
                @foreach (Auth::user()->groups as $group)
                    <tr>
                        <td width="15rem">
                            <img src="
                            @if($group->thumbnail == null)
                                {{ asset('img/community.svg')}}
                            @else
                                {!! asset('img/groups/'. $group->thumbnail) !!}
                            @endif
                            " style="width: 15rem; height: 15rem;">
                        </td>
                        <td valign="top" align="left">
                            <br>
                            <h5>{{ $group->title }}</h5> <br>
                            <span style="display: block; min-height: 100px;">
                                {{ substr($group->description, 0, 400) }}
                                @if(strlen($group->description) >= 400)
                                    ...
                                @endif
                            </span>
                            <br>
                            @php $date = new DateTime($group->timestamp); $date = $date->format('d/m/Y | H:i'); @endphp
                            <span>
                                Entrou em: {{$date }} | <b>{{Auth::user()->groups($group->id)->count()}} membro(s)</b>
                            </span>
                            <br>
                            <div style="float:right; margin-right:24px;">
                                @if($group->visibility == 'public')
                                    <i title="público" class="fas fa-eye"></i>
                                @else
                                    <i title="restringido à membros" class="fas fa-eye-slash"></i>
                                @endif
                                &nbsp;&nbsp;
                                @if($group->admin == 'true')
                                    <button class="btn btn-danger">Administrador</button> &nbsp;
                                @endif
                                <a href="{{route('dashboard.groups.page', [urlencode($group->title), $group->id])}}" class="btn btn-primary">Acessar grupo</a>
                            </div>
                            <br><br>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
            <h4>Você não participa de nenhum grupo.</h4>
        @endif
    </section>
@endsection
