<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vivify.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>LearnPlay</title>
</head>
<body>
    <a href="javascript:void(0);" onclick="showMenu()" class="toggle-sidebar vivify rollInLeft" style="animation-duration:1.2s; animation-delay: 0.5s;"><i class="fas fa-bars"></i></a>
    <div class="sidebar  flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; display:none;">

        <ul class="nav nav-pills flex-column mb-auto mt-5">
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link link-dark">
                <b>Meu conteúdo</b>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Procurar <b>artigos</b>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Procurar <b>aulas</b>
            </a>
          </li>
          <li>
            <a href="{{route('dashboard.groups.public')}}" class="nav-link link-dark">
              Procurar <b>grupos de estudo</b>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Procurar <b>materiais</b>
            </a>
          </li>
        </ul>
      </div>

    <div class="container vivify swoopInBottom" style="animation-duration: 0.3s; animation-delay:0.3s;">
        <nav class="">
            <ul class="nav justify-content-start " style="float:left;">
                <li class="nav-item"><a href="/" class="nav-link vivify popIn" style="animation-delay: 0.85s; "><b>LearnPlay</b></a></li>

            </ul>
            <ul id="notification" class="nav justify-content-end">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link" title="Meu perfil">
                        <img src="
                            @if(Auth::user()->photo === null)
                                {{ asset('img/userimg/default.png')}}
                            @else
                                {!! asset("img/userimg/". Auth::user()->photo) !!}
                            @endif
                        " class="profile-photo photo vivify popIn" style="animation-delay: 0.85s; ">
                    </a>
                </li>
                <li class="nav-item dropdown dnotify-dropdown">
                    <a href="javascript:void(0);" class="nav-link " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell"></i> &nbsp;<span id="notification_count" style="font-family:sans-serif; font-size:18px;">0</span></a>
                    <ul class="dropdown-menu notify-dropdown">
                        @foreach(Auth::user()->notification() as $alert)
                            <li id="notification" data-id="{{$alert->id}}" data-status="{{$alert->status}}" onclick="notifyToggle('{{route('user.notifyToggle', $alert->id)}}', {{$alert->id}}, {{$alert->status}})">
                                {{$alert->alert}}
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{route('user.settings')}}" class="nav-link" title="Configurações"><i class="fas fa-cog"></i></a>
                </li>

                <li class="nav-item">
                    <a href="{{route('login.logout')}}" class="nav-link" title="deslogar">
                        <i class="fas fa-times"></i>
                    </a>
                </li>


              </ul>
        </nav>
        <div style="clear:both;"></div>

          <div class="vivify fadeIn" style="animation-duration: 0.5s; animation-delay:0.6s;">
            @yield('conteudo')

          </div>
    </div>


    </div>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        var notificationLiEl = document.querySelectorAll('li#notification');
        var notificationCount = document.querySelector('span#notification_count')

        function bounceNotification(){
            if(parseInt(document.querySelector("#notification_count").innerText) >= 1){
                    let notificationIcon = (notificationCount.offsetParent.childNodes[1].querySelector('i'))
                    notificationIcon.style = 'transition:text-shadow 0.3s; zoom:105%; text-shadow:0px 0px 14px yellow;'
                    notificationIcon.classList.add('animate__animated', 'animate__tada');
                    notificationIcon.style.setProperty('--animate-duration', '1.2s');
                    setTimeout(()=>{
                        notificationIcon.classList.remove('animate__animated', 'animate__tada')
                        notificationIcon.style = getComputedStyle(notificationIcon)
                    },1200)
                }
        }


        window.onload = function(){
            $('html,body').scrollTop(0);
            bounceNotification()

            setInterval(function(){
                bounceNotification()
            }, 2800)

        }

        function countNotifications(){

            let num = 0;
            notificationLiEl.forEach((i)=>{
                let count = parseInt(i.dataset.status);
                num += count;
            });
            notificationCount.innerText = (num)
        }countNotifications()

        $('#notification').on('hide.bs.dropdown', function (e) {
            if (e.clickEvent) {
            e.preventDefault();
            }
        });
        notificationLiEl.forEach((i)=>{
            notification_style(i.dataset.id)
        })

        function notification_style(id){
            notificationLiEl.forEach((i)=>{
                if(i.dataset.id == id){
                    if(i.dataset.status == '0'){
                        i.style = window.getComputedStyle(i)
                        i.dataset.status = '1';
                    }else if(i.dataset.status == '1'){
                        i.dataset.status = '0';
                        i.style.color = '#3c1f23';
                        i.style.fontWeight = 'bold';
                        i.style.background = 'rgb(233, 233, 233)';
                    }
                }
            })

        }

        function notifyToggle(route, id, status){
            notification_style(id)

            notificationLiEl.forEach((i)=>{
                if(i.dataset.id == id){
                    if(i.dataset.status == '0'){
                        notificationCount.innerText = parseInt(notificationCount.innerText) + 1
                    }else if(i.dataset.status == '1'){
                        notificationCount.innerText = parseInt(notificationCount.innerText) - 1
                    }
                }
            })

            $.ajax({
                type: "PUT",
                url: route,
                data: {_token: '{{csrf_token()}}'},
                // success: function (data) {
                    // console.log(data);
                // },
            });
        }
    </script>
    <script>
        let menu = document.querySelector('.sidebar')


        function menuOptions(){
            if(localStorage.getItem('menu') == 'true'){
                menu.style.display = "block"
            }else{
                menu.style.display = "none"
            }
        }menuOptions()

        function showMenu(){
            if(menu.style.display == 'block'){
                menu.style.display = "none"
                localStorage.setItem('menu',false);
            }else{
                menu.style.display = "block"
                localStorage.setItem('menu',true);

            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

    </script>
</body>
</html>
