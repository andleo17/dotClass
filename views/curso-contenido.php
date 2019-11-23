<?php foreach (Curso ::buscarContenido($curso -> id) as $seccion) { ?>
    <div class="border border-secondary px-4 py-3 mb-4 row">
        <div class="col-12 text-dark">
            <h5 class="mb-4"><?= $seccion -> titulo ?></h5>
        </div>
        <?php foreach (Seccion ::listarClases($seccion -> id) as $clase) { ?>
            <div class="col-3 mb-3">
                <div class="card border border-secondary rounded-top">
                    <div class="card-header bg-success"></div>
                    <a href="../clase/<?= $clase -> id ?>" class="card-body d-flex flex-column">
                        <span class="mb-4"><?= $clase -> titulo ?></span>
                        <span class="mt-auto"><b>Duración:</b> <?= $clase -> duracion ?></span>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>
<?php if ($examen = Curso ::buscarExamen($curso -> id)) { ?>
    <div class="row">
        <div class="col-12 p-0">
            <div class="curso-examen d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <b>Examen final</b>
                    <span>Demuestra que has aprendido <b><?= $curso -> titulo ?></b></span>
                </div>
                <a class="btn btn-light text-body" href="<?= $_SERVER['REQUEST_URI'] ?>/examen">Dar examen</a>
            </div>
        </div>
    </div>
<?php } ?>