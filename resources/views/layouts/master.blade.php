<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>LearnPlay</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand logo" href="/" title="Learn Play">
        Learn Play
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link"href="/">Página inicial</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Fazer login
          </a>
          <ul class="dropdown-menu dropdown-loguin
          @if(($errors->has('email_login') or $errors->has('senha_login')))
            {{'show'}}
          @endif
          " aria-labelledby="navbarDropdownMenuLink">
            <div class="loguin-form">
            <form method="post" action="{{ route('login') }}">
              @csrf
              @if(($errors->has('email_login') or $errors->has('senha_login')))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <b>E-mail e senha inválidos.</b>
                  </div>
                @endif
              <div class="form-group">
                <label for="email2">E-mail</label>
                <input id="email2" name="email_login" type="text" required="required" class="form-control"
                @if(($errors->has('email_login') or $errors->has('senha_login')))
                    {{'autofocus'}}
                @endif
                >
              </div>
              <div class="form-group">
                <label for="senha2">Senha</label>
                <input id="senha2" name="senha_login" type="password" required="required" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
              </div>
            </form>
            </div>
          </ul>
        </li>
        <li class="nav-item"><a href="javascript:void(0);" class="nav-link btn btn-primary text-light">Obter App</a></li>

      </ul>
    </div>
  </div>
</nav>
    <div class="container">
    <br><br>
    <div class="row mt-5">
      <div class="card mt-5 rounded">
      <div class="card-body">
    @yield('conteudo')
      </div></div></div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    </script>
</body>
</html>
