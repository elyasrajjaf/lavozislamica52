<?php
require '../bdd/config.php';

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
        session_start();
        
        $_SESSION['user'] = $foundUser['user'];
        header('Location: ../home.php');
        die();

    }else{
        echo '<div class="alert alert-danger text-center">Error: Intente otra vez</div>';
    }   
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - La Voz Islamica</title>
    <!--Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="login container-fluid">
    <div class="form">
        <?php
        if(isset($formIsValid) && $formIsValid == false){
            echo '<div class="alert alert-danger">'.implode('<br>', $errors).'</div>';}
        ?>
        <h3 class="mx-auto mb-4">Conectarse</h3>
        <form method="POST" class="mx-auto">
            <div class="form-group">
                <label for="email" class="d-block mb-2">Email</label>
                <input class="mb-3" type="email" name="email" id="email" placeholder="email@ejemplo.com" required>
            </div>
            <div class="form-group">
                <label for="password" class="d-block mb-2">Contraseña</label>
                <input class="mb-5" type="password" name="password" id="password" placeholder="contraseña" required>
            </div>

            <button class="mb-3 btn">Conecterse</button>
        </form>
    </div>
</section>
</body>