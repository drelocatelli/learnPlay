@extends('layouts.painel')
@section('conteudo')

    <h3>Editar perfil</h3>
    <hr>
    <div class="card" style="width:30rem;">
        <div class="card-body">
            <table>
                <tr>
                    <td>
                        <img src="
                        @if(Auth::user()->photo === null)
                            {{ asset('img/userimg/default.png')}}
                        @else
                            {!! asset("img/userimg/". Auth::user()->photo) !!}
                        @endif
                    " class="profile-photo setting">
                    </td>
                    <td valign="top" style="padding-left:50px;">
                        <h4>{{ Auth::user()->nome }}</h4>
                        {{ Auth::user()->email }}
                        <br><br><br>
                        <button class="btn btn-primary">Mudar foto de perfil</button>
                    </td>
                </tr>
            </table>
    </div>
</div>


@endsection
