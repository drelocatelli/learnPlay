<?php

use App\Http\Controllers\Register\RegisterController;

if(RegisterController::create($_POST['email'], $_POST['nome'], $_POST['senha'])){
    header("Location: success");
}
exit();

?>