<?php 

require 'bdd/config.php';
require 'head.php';
require 'header.php';

$query = $bdd->prepare('SELECT * FROM hadith ORDER BY hadith_num ASC');
$query->execute(); 

$hadiths = $query->fetchAll(PDO::FETCH_ASSOC); 

if (!empty($_GET['filtre'])) {
    if (isset($_GET['filtre']) && $_GET['filtre'] == 'qudsi') {
        $query = $bdd->prepare('SELECT * FROM hadith WHERE hadith_book LIKE "q%"');
        $query->execute();
    }

    if (isset($_GET['filtre']) && $_GET['filtre'] == 'anawawi') {
        $query = $bdd->prepare('SELECT * FROM hadith WHERE hadith_book LIKE "a%"');
        $query->execute();
    }

    if (isset($_GET['filtre']) && $_GET['filtre'] == 'ryad_asalihin') {
        $query = $bdd->prepare('SELECT * FROM hadith WHERE hadith_book LIKE "r%"');
        $query->execute();
    }

    $hadiths = $query->fetchAll(PDO::FETCH_ASSOC);
}

?>
<div class="container-voz">
    <div class="row align-items-right">
        <div class="col-3"></div>
        <div class="col-6"> 
           <form class="row" method="get">
               <div class="col-8">
                    <select class="search-hadith form-control" name="filtre" id="filtre">
                        <option value="0">Ver todo</option>
                        <option name="qudsi" value="qudsi">40 hadices Qudsi.</option>
                        <option name="anawawi" value="anawawi">40 hadices de an-Nawawi.</option>
                        <option name="ryad_asalihin" value="ryad_asalihin">Riyad as-Salihin.</option>
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-outline-dark form-control" type="submit">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
        <div class="col-1">

        </div>
        <div class="mt-5"></div>
    </div>
        <div class="row border-bottom-list mt-4">
            <div class="col-4">
                <p>Nombre de libro</p>
            </div>
            <div class="col-2 text-center">
                <p>Numero de hadiz</p>
            </div>
            <div class="col-2 text-center">
                <p>Ver hadiz</p>
            </div>
            <div class="col-2 text-center">
                <p>Editar hadiz</p>
            </div>
            <div class="col-2 text-center">
                <p>Eliminar</p>
            </div>
        </div>
    <?php foreach($hadiths as $hadith):?>
        <div class="row row-hadith border-bottom border-secondary pt-5 pb-2">
            <div class="col-4">
                <p>Libro : <?=$books[$hadith['hadith_book']];?></p>
                <p>Por : <?=$narrators[$hadith['hadith_narrator']];?></p>
            </div>
            <div class="col-2 text-center">
                <p>N° : 0<?=$hadith['hadith_num'];?></p>
                <p>ID : <?=$hadith['id'];?></p>
            </div>
            <div class="col-2 text-center">
                <a class="btn btn-warning" target="blank" href="view-hadith.php?id=<?=$hadith['id'];?>">Ver Hadiz</a>
            </div>
            <div class="col-2 text-center">
                <a class="btn btn-outline-dark" target="blank" href="edit-hadith.php?id=<?=$hadith['id'];?>">Editar Hadiz</a>
            </div>
            <div class="col-2 text-center">
                <a class="btn btn-dark" target="blank" onclick="return confirm('Eliminar hadith n°<?=$hadith['hadith_num'];?>');" href="delete-hadith.php?id=<?=$hadith['id'];?>">Eliminar Hadiz</a>
            </div>
        </div>
    <?php endforeach;?>
</div>

<?php require 'foot.php'; ?>


