<?php
session_start();
require '../bdd/config.php';
require '../head.php'; 
?>

<nav class="navbar navbar-expand-lg w-100 bg-dark d-flex justify-content-between px-3">
    <a href="#" class="py-2 text-decoration-none text-light">Inicio</a>
    <img class="login-logo py-2" src="../assets/logo.png" alt="Logo">
</nav>

<?php

$errors = [];

if(!empty($_POST)){
    $safe = array_map('trim', array_map('strip_tags', $_POST));

    $sql = $bdd->prepare('SELECT email, password, token
                          FROM register 
                          WHERE email = :email AND password = :password');

    $password_hash = hash('sha256', $safe['password']);

    $sql->bindValue(':email', $safe['email']);
    $sql->bindValue(':password', $password_hash);
    $sql->execute();
    
    $foundUser = $sql->fetch(); 

    

    if(!empty($foundUser)){ // J'ai un utilsateur
        
        $_SESSION['user'] = $foundUser['token'];
        header('Location: ../home.php');
        die();

    }else{
        echo '<div class="alert alert-danger text-center">Error: Intente otra vez</div>';
    }   
}

?>

<?php 

    if(isset($formIsValid) && $formIsValid == true){
        echo '<div class="alert alert-success">Votre inscription a bien été enregistré</div>';
    }
    elseif(isset($formIsValid) && $formIsValid == false){
        echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>';

    }
?>

<main class="login">
<form method="POST" class="login-form">
    <div style="width: 600px;" class="container form-group card text-center shadow p-3 bg-white rounded">

        <h3 class="mx-auto mb-4 w-25">Conectarse</h3>

        <div class="mb-3 row">
            <label for="email" class="col-sm-3 col-form-label text-start ps-3">Email</label>
            <div class="col-sm-9">
            <input type="email" class="form-control" name="email" id="email" placeholder="email@ejemplo.com" required>
            </div>
        </div>


        <div class="mb-3 row">
            <label for="password" class="col-sm-3 col-form-label text-start ps-3">Contraseña</label>
            <div class="col-sm-9">
            <input type="password" class="form-control" name="password" id="password" placeholder="*******" required>
            </div>
        </div>

        <button class="btn btn-warning form-control">Conecterse</button>

        <a class="mt-3 text-dark" href="inscription.php">Registrarse</a>

    </div>
</form>
</main>