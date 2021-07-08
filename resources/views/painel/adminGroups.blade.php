@extends('layouts.painel')
@section('conteudo')

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
          </ul>
          <br><br>
        @if(Auth::user()->management_groups->count() >= 1)
        <h4>Você gerencia {{Auth::user()->management_groups->count()}} grupo(s).</h4><br>
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
                                @if($group->admin == 'true')
                                    <button class="btn btn-danger">Administrador</button> &nbsp;
                                @endif
                                <a href="" class="btn btn-primary">Acessar grupo</a>
                            </div>
                            <br><br>
                        </td>
                    </tr>
                @endforeach
            </table>
            @else
            <h4>Você não gerencia nenhum grupo.</h4>
        @endif
    </section>
@endsection
