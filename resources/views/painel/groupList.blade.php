@extends('layouts.painel')
@section('conteudo')

    <h3>Procurar grupos de estudo</h3>
    <br>
    <table class="group-list rounded" width="100%">
        @foreach (Auth::user()->get_all_groups() as $group)

            @if(!Auth::user()->get_all_group_users($group->id)->where('id_user', '=', Auth::user()->id)->first())
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
                    <span>
                        <b>{{Auth::user()->get_all_group_users($group->id)->count()}} membro(s)</b>
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
            @endif
        @endforeach
    </table>
    <div class="pagination">
        {{ Auth::user()->get_all_groups()->links() }}
    </div>


@endsection
