<?php 

require 'bdd/config.php';
require 'head.php';
require 'header.php';

if (!empty($_POST)) {
    
    $errors = [];
    $safe = array_map('trim', array_map('strip_tags', $_POST));

    if (!is_numeric($safe['hadith_num'])) {
        $errors[] = 'NUM INVALID';
    }

    if (count($errors) === 0) {

        $sql = 'UPDATE hadith SET 
                hadith_ar        = :param_hadith_ar,
                hadith_es        = :param_hadith_es,
                hadith_book      = :param_hadith_book,
                hadith_num       = :param_hadith_num,
                hadith_narrator  = :param_hadith_narrator
                WHERE id         = :id_param';


        // la variable $bdd se trouve dans le fichier config.php et est ma connexion à ma de données
        // $bdd->prepare() me permet de préparer ma requete SQL
        $query = $bdd->prepare($sql);

        // Les bindValues permettent d'associer les :param_* aux valeurs du formulaire
        $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
        $query->bindValue(':param_hadith_ar', $safe['hadith_ar']);
        $query->bindValue(':param_hadith_es', $safe['hadith_es']);
        $query->bindValue(':param_hadith_book', $safe['hadith_book']);
        $query->bindValue(':param_hadith_narrator', $safe['hadith_narrator']);
        $query->bindValue(':param_hadith_num', $safe['hadith_num']);
        
        $query->execute();



        $isFormValid = true;
    } else {
        $isFormValid = false;
    }
}

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

    $query = $bdd->prepare('SELECT * FROM hadith WHERE id = :id_param');
    $query->bindValue(':id_param', $_GET['id'], PDO::PARAM_INT);
    $query->execute();

    $hadith = $query->fetch(PDO::FETCH_ASSOC); // Je récupère une ligne de données    
}
?>
<div class="container-voz">
    <div class="row justify-content-center">
        <?php if (!isset($hadith) || empty($hadith)) : ?>
        <div class="col-6">
            <div class="alert alert-danger mt-5">NOT FOUND</div>
        </div>
        <div class="col-6">
        <?php else : ?>    
            <h1 class="text-center my-5">Editar un Hadiz</h1>
            <?php
                if (isset($formIsValid) && $formIsValid == true) {
                    echo '<div class="alert alert-success">EXITO</div>';
                } elseif (isset($formIsValid) && $formIsValid == false) {
                    echo '<div class="alert alert-danger">' . implode('<br>', $errors) . '</div>';
                }
            ?>
            <form method="post" enctype=”multipart/form-data”>
                <!-- Hadith_Ar -->
                <div class="mb-3">
                    <label for="hadith_ar" class="form-label">Hadith Ar</label>
                    <textarea class="form-control" id="hadith_ar" rows="10" name="hadith_ar"><?=$hadith['hadith_ar'];?></textarea>
                </div>

                <!-- Hadith_Es -->
                <div class="mb-3">
                    <label for="hadith_es" class="form-label">Hadith Es</label>
                    <textarea class="form-control" id="hadith_es" rows="10" name="hadith_es"><?=$hadith['hadith_es'];?></textarea>
                </div>

                <!-- Hadith_Book -->
                <div class="mb-3">
                    <label for="hadith_book" class="form-label">Hadith Book</label>
                    <select id="hadith_book" name="hadith_book" class="form-control text-center">
                        <option value="0" selected disabled>--Elegir--</option>
                        <?php foreach ($books as $key => $value) : ?>
                        <option value="<?= $key; ?>" <?= ($hadith['hadith_book'] == $key) ? 'selected' : ''; ?>><?= mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Hadith_Narrator -->
                <div class="mb-3">
                    <label for="hadith_narrator" class="form-label">Hadith Narrator</label>
                    <select id="hadith_narrator" name="hadith_narrator" class="form-control text-center">
                        <option value="0" selected disabled>--Elegir--</option>
                        <?php foreach ($narrators as $key => $value) : ?>
                        <option value="<?= $key; ?>" <?= ($hadith['hadith_narrator'] == $key) ? 'selected' : ''; ?>><?= mb_strtoupper(mb_substr($value, 0, 1)) . mb_substr($value, 1); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <!--Hadith_Num-->
                <div class="mb-3 row">
                    <label for="hadith_num" class="col-sm-2 col-form-label">Hadith Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="hadith_num" id="hadith_num" value="<?=$hadith['hadith_num'];?>">
                    </div>
                </div>

                <!--Button-->
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Publicar Hadiz</button>
                </div>
            </form>
        <?php endif; ?>
        </div>
    </div>
</div>

<?php 

require 'footer.php';
require 'foot.php';

?>
