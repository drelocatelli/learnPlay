<?php

use App\Http\Controllers\Register\RegisterController;

if(RegisterController::createUser($_POST['email'], $_POST['nome'], $_POST['senha'])){
    header("Location: success");
}
exit();

?>