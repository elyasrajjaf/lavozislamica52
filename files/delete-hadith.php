<?php

require 'bdd/config.php';
require 'head.php';
require 'header.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $getId = $_GET['id'];
    $query = $bdd->prepare('SELECT * FROM hadith WHERE id = ?');
    $query->execute(array($getId));
    if($query->rowCount() > 0){
        $deleteHadith = $bdd->prepare('DELETE FROM hadith WHERE id = ?');
        $deleteHadith->execute(array($getId));
        header('Location: list-hadith.php');
    }else{
        echo "No se ha encontrado ningun hadiz.";
    }
}else{
    echo "Id invalida";
}

require 'foot.php'; ?>