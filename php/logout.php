<?php
function logoutuser(){
    session_start();

    if ($email === $_POST['email'] && $password === $_POST['password']){
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
      session_destroy();

      header("Location: ../forms/login.html");
}
}

logoutuser();