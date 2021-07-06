<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>LearnPlay</title>
</head>
<body>
    <a href="javascript:void(0);" onclick="showMenu()" class="toggle-sidebar"><i class="fas fa-bars"></i></a>
    <div class="sidebar  flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; display:none;">

        <ul class="nav nav-pills flex-column mb-auto mt-5">
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link link-dark">
              Home
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Dashboard
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Orders
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Products
            </a>
          </li>
          <li>
            <a href="#" class="nav-link link-dark">
              Customers
            </a>
          </li>
        </ul>
      </div>

    <div class="container">

        <nav>
            <ul class="nav justify-content-start" style="float:left;">
                <li class="nav-item">
                    <a href="{{route('user.profile', Auth::user()->nome)}}" class="nav-link" title="Meu perfil">
                        <img src="
                            @if(Auth::user()->photo === null)
                                {{ asset('img/userimg/default.png')}}
                            @else
                                {!! asset("img/userimg/". Auth::user()->photo) !!}
                            @endif
                        " class="profile-photo photo">
                    </a>
                </li>
            </ul>
            <ul id="notification" class="nav justify-content-end">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link" title="Página inicial"><i class="fas fa-home"></i></a>
                </li>
                <li class="nav-item dropdown dnotify-dropdown">
                    <a href="javascript:void(0);" class="nav-link " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bell"></i> &nbsp;<span id="notification_count" style="font-family:sans-serif; font-size:18px;">{{Auth::user()->alerts->where('status','1')->count()}}</span></a>
                    <ul class="dropdown-menu notify-dropdown">
                        @foreach(Auth::user()->notification() as $alert)
                            <li id="notification" data-id="{{$alert->id}}" data-status="{{$alert->status}}" onclick="notifyToggle('{{route('user.notifyToggle', $alert->id)}}', {{$alert->id}}, {{$alert->status}})">
                                {{$alert->alert}}
                            </li>
                        @endforeach
                        <script>

                            $('#notification').on('hide.bs.dropdown', function (e) {
                                if (e.clickEvent) {
                                e.preventDefault();
                                }
                            });
                            var notificationLiEl = document.querySelectorAll('li#notification');
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
                                        }
                                    }
                                })
                            }

                            function notifyToggle(route, id, status){
                                notification_style(id)

                                let notificationCount = document.querySelector('span#notification_count')
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
                                    //     console.log(data);
                                    // },
                                });
                            }
                        </script>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" title="Configurações"><i class="fas fa-user-edit"></i></a>
                </li>

                <li class="nav-item">
                    <a href="{{route('login.logout')}}" class="nav-link">
                        <i class="fas fa-times"></i>
                    </a>
                </li>


              </ul>
        </nav>
        <div style="clear:both;"></div>

          <div>
            @yield('conteudo')

          </div>
    </div>


    </div>
    <script>
        function showMenu(){
            let menu = document.querySelector('.sidebar')
            if(menu.style.display == 'block'){
                menu.style.display = "none"
            }else{
                menu.style.display = "block"
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>

    </script>
</body>
</html>
