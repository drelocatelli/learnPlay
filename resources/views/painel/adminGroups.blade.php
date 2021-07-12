@extends('layouts.painel')
@section('conteudo')

<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups.new')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; Criar novo grupo</a>
</div>

    <h3>Meus grupos de estudo</h3>

    <hr>
    <section class="content-section">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('dashboard.groups')}}" >Todos os grupos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" aria-disabled="true">Grupos que gerencio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-current="page" href="#" aria-disabled="true">Você gerencia {{Auth::user()->management_groups->count()}} grupo(s).</a>
            </li>
          </ul>
          <br>

        @if(Auth::user()->management_groups->count() >= 1)
            <table class="group-list rounded" width="100%">
                @foreach (Auth::user()->management_groups as $group)
                    <tr>
                        <td>
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
                            <span>
                                Entrou em: {{$group->timestamp }} | <b>{{Auth::user()->groups($group->id)->count()}} membro(s)</b>
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
            <br>
            <h4>Você não gerencia grupos.</h4>
        @endif
    </section>
@endsection
