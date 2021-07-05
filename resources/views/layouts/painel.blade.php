<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <title>LearnPlay</title>
</head>
<body>

    <div class="container">

        <nav>
            <ul class="nav justify-content-start" style="float:left;">
                <li class="nav-item">
                    <a href="{{route('user.profile', Auth::User()->nome)}}" class="nav-link" title="Meu perfil">
                        <img src="
                            @if(Auth::User()->photo === null)
                                {{ asset('img/userimg/default.png')}}
                            @else
                                {!! asset("img/userimg/". Auth::User()->photo) !!}
                            @endif
                        " class="profile-photo photo">
                    </a>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link" title="Página inicial"><i class="fas fa-home"></i></a>
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
        @yield('conteudo')
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>
</body>
</html>
