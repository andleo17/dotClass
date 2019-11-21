<?php
    $curso = explode('/', $_SERVER['REQUEST_URI']);
    $curso = end($curso);
    $curso = Curso ::buscar($curso);
    $cursosUsuario = Usuario::listarEnseñanza($curso -> usuario -> id);
?>
<div class="container-fluid">
    <div class="row text-white">
        <div class="col-lg-6 col-md-12 p-0">
            <div class="card panel-container rounded-0 border-0 p-5">
                <div class="card-head">
                    <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>" alt="logo">
                    <h1 class="ml-3"><?= $curso -> titulo ?></h1>
                    <?php if (isset($_SESSION['usuario'])) { ?>
                        <div class="bar">
                            <div class="bar-progress"></div>
                            <div class="full-progress"></div>
                            <span>75%</span>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <p><?= $curso -> descripcion ?></p>
                </div>
                <div class="card-footer">
                    <span><b>Duración:</b> <?= $curso -> duracion ?></span>
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
        <div class="col-lg-6 col-md-12 p-0">
            <div class="card panel-container rounded-0 border-0 p-5">
                <a href="../perfil/<?= $curso -> usuario -> nickname ?>" class="card-head">
                    <img src="../uploads/perfiles/<?= $curso -> usuario -> foto ?>" alt="foto-perfil">
                    <div class="ml-3 docente-perfil text-white">
                        <b><?= $curso -> usuario -> nickname ?></b>
                        <span><?= $curso -> usuario -> numeroSeguidores ?> seguidores</span>
                    </div>
<!--                    <div class="live">-->
<!--                        <i class="fas fa-circle"></i>-->
<!--                        <span>LIVE</span>-->
<!--                    </div>-->
                </a>
                <div class="card-body docente-descripcion text-white">
                    <p>"<?= $curso -> usuario -> descripcion ?>"</p>
                </div>
                <div class="card-footer d-flex flex-column">
                    <span><b>N° de cursos que enseña:</b><?= count($cursosUsuario) ?> cursos</span>
                    <span><b>N° de cursos que aprendió:</b>19 cursos</span>
                    <span>
                        <b>Cursos destacados:</b>
                        <span>
                            <?php
                                for ($i = 0; $i < count($cursosUsuario); $i++) {
                                    $c = $cursosUsuario[$i];
                                    $cursosUsuario[$i] = "<a href='../curso/{$c -> id}'>{$c -> titulo}</a>";
                                }
                                echo implode(', ', $cursosUsuario);
                            ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <?php if ($cursosPrerequisitos = Curso ::listarPrerequisitos($curso -> id)) { ?>
            <div class="col-12 p-0">
                <div class="plan-estudio">
                    <h2>Plan de estudio para empezar este curso</h2>
                    <div class="container-fluid">
                        <div class="row">
                            <?php foreach ($cursosPrerequisitos as $key => $prerequisito) { ?>
                                <div class="col-xl-2 col-lg-4 col-md-6 mt-3">
                                    <div class="mini card text-dark">
                                        <a href="../curso/<?= $prerequisito -> id ?>" class="card-head">
                                            <img src="<?= SERVER_URL ?>uploads/logos/<?= $prerequisito -> logo ?>"
                                                 alt="logo">
                                            <span class="ml-3"><?= $prerequisito -> titulo ?></span>
                                        </a>
                                        <div class="card-footer d-flex flex-column">
                                            <span><b>Docente:</b><?= $prerequisito -> usuario -> nickname ?></span>
                                            <span><b>Duración:</b><?= $prerequisito -> duracion ?></span>
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
                                <?php if($key != count($cursosPrerequisitos) - 1) { ?>
                                    <div class="col mt-3 d-flex align-items-center">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="card mt-5 rounded-0">
        <div class="card-header pb-0">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a id="contenido-tab" class="nav-link active" href="#contenido" data-toggle="tab">Contenido</a>
                </li>
                <li class="nav-item">
                    <a id="preguntas-tab" class="nav-link" href="#preguntas" data-toggle="tab">Preguntas</a>
                </li>
                <li class="nav-item">
                    <a id="aportes-tab" class="nav-link" href="#aportes" data-toggle="tab">Aportes</a>
                </li>
                <li class="nav-item">
                    <a id="marcadores-tab" class="nav-link" href="#marcadores" data-toggle="tab">Marcadores</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="card-body container-fluid px-5">
                <div id="contenido" class="tab-pane fade show active">
                    <?php foreach (Curso ::buscarContenido($curso -> id) as $seccion) { ?>
                        <div class="border border-secondary px-4 py-3 mb-4 row">
                            <div class="col-12 text-dark">
                                <h5 class="mb-4"><?= $seccion -> titulo ?></h5>
                            </div>
                            <?php foreach (Seccion ::listarClases($seccion -> id) as $clase) { ?>
                                <div class="col-3 mb-3">
                                    <div class="card border border-secondary rounded-top">
                                        <div class="card-header bg-success"></div>
                                        <a href="" class="card-body d-flex flex-column">
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
                                    <a class="btn btn-light text-body" href="examen.html">Dar examen</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="preguntas" class="tab-pane fade"></div>
                <div id="aportes" class="tab-pane fade"></div>
                <div id="marcadores" class="tab-pane fade"></div>
            </div>
        </div>
    </div>
</div>