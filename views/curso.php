<?php
    $curso = explode('/', $_SERVER['REQUEST_URI']);
    $curso = end($curso);
    $curso = Curso ::buscar($curso);
?>
<div class="container-fluid">
    <div class="row text-white">
        <div class="col-lg-6 col-md-12 p-0">
            <div class="card panel-container rounded-0 border-0 p-5">
                <div class="card-head">
                    <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>" alt="logo">
                    <h1 class="ml-3"><?= $curso -> titulo ?></h1>
                    <div class="bar">
                        <div class="bar-progress"></div>
                        <div class="full-progress"></div>
                        <span>75%</span>
                    </div>
                </div>
                <div class="card-body">
                    <p><?= $curso -> descripcion ?></p>
                </div>
                <div class="card-footer">
                    <span><b>Duración:</b> <?= $curso -> duracion ?> h</span>
                    <div class="card-rating">
                        <span><?= $curso -> numeroSubscriptores ?> subscriptores</span>
                        <span class="clasificacion">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
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
                    <div class="live">
                        <i class="fas fa-circle"></i>
                        <span>LIVE</span>
                    </div>
                </a>
                <div class="card-body docente-descripcion text-white">
                    <p>"<?= $curso -> usuario -> descripcion ?>"</p>
                </div>
                <div class="card-footer d-flex flex-column">
                    <span>
                        <b>N° de cursos que enseña:</b>
                        15 cursos
                        <a href="perfil.html" class="flecha"><i class="fas fa-chevron-right"></i></a>
                    </span>
                    <span>
                        <b>N° de cursos que aprendió:</b>
                        19 cursos
                        <a href="perfil.html" class="flecha"><i class="fas fa-chevron-right"></i></a>
                    </span>
                    <span>
                        <b>Cursos destacados:</b>
                        <span class="docente-cursos">
                            <a href="curso.html">Java desde cero</a>,
                            <a href="curso.html">Programación Orientada a Objetos (POO)</a>,
                            <a href="curso.html">CSS Grid Layout</a>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="plan-estudio">
                <h2>Plan de estudio para empezar este curso</h2>
                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($curso -> prerequisitos as $prerequisito) { ?>
                            <div class="col-xl-2 col-lg-4 col-md-6 mt-3">
                                <div class="mini card text-dark">
                                    <a href="../curso/<?= $prerequisito -> id ?>" class="card-head">
                                        <img src="<?= SERVER_URL ?>uploads/logos/<?= $prerequisito -> logo ?>"
                                             alt="logo">
                                        <span class="ml-3"><?= $prerequisito -> titulo ?></span>
                                    </a>
                                    <div class="card-footer d-flex flex-column">
                                        <span><b>Docente:</b><?= $prerequisito -> usuario -> nickname ?></span>
                                        <span><b>Duración:</b><?= $prerequisito -> duracion ?> h</span>
                                        <div class="card-rating">
                                            <span><?= $prerequisito -> numeroSubscriptores ?> subscriptores</span>
                                            <span class="clasificacion">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col mt-3 d-flex align-items-center">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-5 rounded-0">
        <div class="card-header pb-0">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="curso.html">Contenido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="curso-preguntas.html">Preguntas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="curso-aportes.html">Aportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="curso-marcadores.html">Marcadores</a>
                </li>
            </ul>
        </div>
        <div class="card-body container-fluid px-5">
            <?php foreach ($curso -> contenido as $seccion) { ?>
                <div class="border border-secondary px-4 py-3 mb-4 row">
                    <div class="col-12 text-dark">
                        <h5 class="mb-4"><?= $seccion -> titulo ?></h5>
                    </div>
                    <?php foreach ($seccion -> clases as $clase) { ?>
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
            <div class="row">
                <div class="col-12">
                    <div class="curso-examen">
                        <div>
                            <b>Examen final</b>
                            <span>Demuestra que has aprendido <i>Java avanzado</i></span>
                        </div>
                        <a href="examen.html">Dar examen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>