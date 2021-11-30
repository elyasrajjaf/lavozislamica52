<?php 

require 'bdd/config.php';
require 'head.php';
require 'header.php';

if (!empty($_POST)) {
    
    $errors = [];
    $safe = array_map('trim', array_map('strip_tags', $_POST));

    if (!is_numeric($safe['id'])) {
        $errors[] = 'Votre stock est invalide';
    }

    if (count($errors) === 0) {

        try {
            $sql = 'INSERT INTO blog (blog_title, blog_cover, blog_content, blog_date, blog_category) 
                VALUES(:param_blog_title, 
                :param_blog_cover, 
                :param_blog_content, 
                :param_blog_date, 
                :param_blog_category)';

            $query = $bdd->prepare($sql);

            // Les bindValues permettent d'associer les :param_* aux valeurs du formulaire
            $query->bindValue(':param_blog_title', $safe['blog_title'], PDO::PARAM_STR);
            $query->bindValue(':param_blog_cover', $safe['blog_cover'], PDO::PARAM_STR);
            $query->bindValue(':param_blog_content', $safe['blog_content'], PDO::PARAM_STR);
            $query->bindValue(':param_blog_date', $safe['blog_date'], PDO::PARAM_STR);
            $query->bindValue(':param_blog_category', $safe['blog_category'], PDO::PARAM_STR);

            $query->execute(); // J'execute ma requete
            echo '<div class="d-grid gap-2 col-4 mx-auto mt-4"><p  class="alert alert-success">Su blog se ha agregado correctamente.</p></div>';
        } catch (PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }


        $isFormValid = true;
    } else {
        $isFormValid = false;
    }
}
?>

<div class="container-voz">
    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center my-5">Agregar un blog</h1>
            <form method="post" enctype=”multipart/form-data”>

                <!-- Hadith_Ar -->
                <div class="mb-3">
                    <label for="blog_title" class="form-label">Titulo</label>
                    <input class="form-control" id="blog_title" name="blog_title"></input>
                </div>

                <!--Button-->
                <div class="mb-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Publicar Blog</button>
                </div>
                
            </form>
        </div>
    </div>
</div>

<?php require 'foot.php'; ?>