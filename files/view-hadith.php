<?php

require 'bdd/config.php';
require 'head.php';
require 'header.php';

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $query = $bdd->prepare('SELECT * FROM hadith WHERE id = :id_param');
    $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
    $query->execute();

    $hadith = $query->fetch();
}

?>

<div class="container-voz">
    <div class="mt-2"><h1>Hadiz : <?=$hadith['hadith_num'];?></h1></div>
    <div class="mt-5"></div>
    <div class="grid d-flex justify-content-between align-items-center border-bottom border-dark mb-5">
        <div class="col-5">
            <p><?=$hadith['hadith_es'];?></p>
            <p><small><?=$books[$hadith['hadith_book']];?></small></p>
        </div>
        <div class="col-2"></div>
        <div class="col-5">
            <p><?=$hadith['hadith_ar'];?></p>
            <p><small>Narrado por : <?=$narrators[$hadith['hadith_narrator']];?></small></p>
        </div>
    </div>
</div>

<?php require 'foot.php'; ?>