@extends('layouts.painel')
@section('conteudo')
<div class="position-relative mb-5 d-flex flex-row-reverse float-right">
    <a href="{{route('dashboard.groups.new')}}" class="btn btn-danger"><i class="fas fa-plus"></i>&nbsp; Criar novo grupo</a>
</div>
    <h3>Procurar grupos de estudo</h3>
    <br>
    <table class="group-list rounded" width="100%">
        @php $groups = Auth::user()->get_all_groups() @endphp
        @forelse ($groups as $group)
            @php
                // verifica se nao participa do grupo
                $verify = !Auth::user()->get_all_group_users($group->id)->where('id_user', '=', Auth::user()->id)->first();
                // verifica se há Membros
                $members = Auth::user()->get_all_group_users($group->id)->count();
            @endphp
            @if($verify && $members >= 1)
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
                    <br><br>
                    <h5><a href="{{route('dashboard.groups.page', [urlencode($group->title), $group->id])}}"> {{ $group->title }} </a></h5> <br>
                    <span style="display: block; min-height: 100px;">
                        {{ substr($group->description, 0, 400) }}
                        @if(strlen($group->description) >= 400)
                            ...
                        @endif
                    </span>
                    <br>
                    <span>
                        <b>{{$members}} membro(s)</b>
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
                    </div>
                    <br><br>
                </td>
            </tr>
            @endif
            @empty
            <center>
                <h5>Nenhum grupo disponível.</h5>
            </center>

        @endforelse
    </table>

    <div class="pagination">
        {{ Auth::user()->get_all_groups()->links() }}
    </div>


@endsection
