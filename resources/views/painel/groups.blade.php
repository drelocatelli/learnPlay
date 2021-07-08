@extends('layouts.painel')
@section('conteudo')

    <h3>Meus grupos de estudo</h3>

    <hr>
    <section class="content-section">
        @if(Auth::user()->groups->count() >= 1)
        <h4>Você participa de {{Auth::user()->groups->count()}} grupo(s).</h4><br>
            <table class="bg-light group-list rounded" width="100%">
                @foreach (Auth::user()->groups as $group)
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
                                Entrou em: {{$group->timestamp }} ··· <b>{{Auth::user()->groups($group->id)->count()}} membro(s)</b>
                            </span>
                            <br>
                            <div style="float:right; margin-right:24px;">
                                @if($group->admin == 'true')
                                    Administrador &nbsp; &nbsp;
                                @endif
                                <a href="" class="btn btn-primary">Acessar grupo</a>
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
