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
                        <form name="userconfig" method="post" enctype="multipart/form-data" action="{{route('user.changePhoto')}}">
                            {{ csrf_field() }}
                            <input type="file" name="photo">
                        </form>
                        <button class="btn btn-primary" name="changePhoto">Mudar foto de perfil</button>
                        <script>
                            let changePhotoBtn = $('button[name="changePhoto"]')[0]
                            let changePhotoForm = $('input[name=photo]');
                            const form = document.querySelector('form[name=userconfig]');
                            const imgsEl = document.querySelectorAll('img.profile-photo');

                            form.onsubmit = function(e) {
                                e.preventDefault();
                                const el = e.target[1];
                                const file = el.files[0];

                                $.ajax({
                                    url: '{!! route('user.changePhoto') !!}',
                                    method: 'POST',
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(response) {
                                        for(let imgEl of imgsEl) {
                                            imgEl.src = `${imgEl.src}?=${new Date().getTime()}`;
                                        }
                                    },
                                    error: function(e) {
                                        console.log('error', e);
                                    }
                                });
                                
                            }

                            changePhotoForm.hide()

                            changePhotoBtn.onclick = function(){
                                changePhotoForm.show()
                                changePhotoForm.focus()
                                changePhotoForm.click()
                                changePhotoForm.hide()

                                changePhotoForm.change(function(e){
                                    $('form[name=userconfig]').submit()
                                })

                            }
                        </script>
                    </td>
                </tr>
            </table>
    </div>
</div>


@endsection
