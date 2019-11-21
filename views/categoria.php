<?php
    require_once 'php/Categoria.php';
    require_once 'php/config.php';

    $categoria = explode('/', $_SERVER['REQUEST_URI']);
    $categoria = end($categoria);
    $categoria = Categoria ::buscar($categoria);

?>

<div class="container-fluid">
    <div class="row categoria-header">
        <div class="offset-3 col-6">
            <div class="d-flex align-items-center p-4">
                <img src="<?= SERVER_URL . "assets/{$categoria -> logo}" ?>" alt="icono-curso">
                <div class="ml-3">
                    <h1 class="mb-4"><?= $categoria -> nombre ?></h1>
                    <p><?= $categoria -> descripcion ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-12 text-center">
            <h3>Escoge qué quieres aprender de nuestro catálogo</h3>
        </div>
        <div class="col mt-3">
            <div class="container">
                <div class="row">
                    <?php foreach (Categoria ::listarCursos($categoria -> id) as $curso) { ?>
                        <div class="mt-3 col-xl-4 col-lg-6 col-md-12">
                            <div class="card">
                                <a href="../curso/<?= $curso -> id ?>" class="card-head">
                                    <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>" alt="logo">
                                    <span class="ml-3"><?= $curso -> titulo ?></span>
                                </a>
                                <div class="card-body">
                                    <p><?= $curso -> descripcion ?></p>
                                </div>
                                <div class="card-footer d-flex flex-column">
                                    <span>
                                        <b>Docente:</b>
                                        <a href="perfil/<?= $curso -> usuario -> nickname ?>"><?= $curso -> usuario -> nickname ?></a>
                                    </span>
                                    <span><b>Duración:</b><?= $curso -> duracion ?></span>
                                    <div class="mt-2 d-flex justify-content-between font-weight-bold">
                                        <span><?= $curso -> numeroSubscriptores ?> subscriptores</span>
                                        <span class="text-warning">
                                            <?php for ($i = 0; $i < $curso -> valoracion; $i++) { ?>
                                                <i class="fa fa-star"></i>
                                            <?php } ?>
                                            <?php for ($i = 0; $i < 5 - $curso -> valoracion; $i++) { ?>
                                                <i class="far fa-star"></i>
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>