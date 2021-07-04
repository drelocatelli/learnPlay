<?php

use App\Http\Controllers\Register\RegisterController;

RegisterController::createUser($_POST['email'], $_POST['nome'], $_POST['senha']);

// header("Location: register");
// exit();

?>