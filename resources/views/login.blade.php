@extends('layouts.master')
@section('conteudo')

    <?php 
        use App\Http\Controllers\Register\RegisterController;
    
    if( isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']) ){
        $_POST['senha'] = bcrypt($_POST['senha']);

        if( RegisterController::loguin($_POST) ){
            print 'Usuário existe!';
        }else{
            print 'Loguin e senha inválidos!';
        }
        
    }

    ?>
@endsection