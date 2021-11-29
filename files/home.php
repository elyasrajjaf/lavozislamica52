<?php 

require 'bdd/config.php';
require 'head.php';
require 'header.php';

?>

<div class="container-voz home">
    <div class="row pt-4 mx-auto">
        <h2 class="mb-5">Bienvenido, 'Admin'!</h2>
        <div class="row mb-3">
            <div class="col-4">
                <a href="list-hadith.php" class="form-control py-4 text-light text-center text-decoration-none text-decoration-none"><i class="text-warning me-3 fas fa-list"></i>Lista Hadices</a>
            </div>
            <div class="col-4">
                <a href="all-hadith.php" class="form-control py-4 text-light text-center text-decoration-none"><i class="text-warning me-3 far fa-eye"></i>Ver Hadices</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <a href="add-hadith.php" class="form-control py-4 text-light text-center text-decoration-none"><i class="text-warning me-3 far fa-plus-square"></i>Publicar Hadith</a>
            </div>
            <div class="col-4">
                <a href="edit-hadith.php" class="form-control py-4 text-light text-center text-decoration-none"><i class="text-warning me-3 far fa-edit"></i>Modificar Hadith</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                <a href="delete-hadith.php" class="form-control py-4 text-light text-center text-decoration-none"><i class="text-warning me-3 fas fa-trash-alt"></i>Borrar Hadith</a>
            </div>
            <div class="col-4">
                <a href="#" class="form-control py-4 text-light text-center text-decoration-none">. . .</a>
            </div>
        </div>
    </div>
</div>

<?php 

require 'foot.php';

?>

