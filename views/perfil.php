<?php
    require_once 'php/Usuario.php';
    require_once 'php/ExperienciaLaboral.php';
    require_once 'php/Conocimiento.php';
    require_once 'php/config.php';

    $usuario = explode('/', $_SERVER['REQUEST_URI']);
    if (end($usuario) == 'editar') {
        if ($usuario[3] == $_SESSION['usuario'] -> nickname) {
            $usuario = Usuario::buscar(null, $usuario[3]);
        } else {
            header("Location: ../../perfil/{$_SESSION['usuario'] -> nickname}/editar ");
        }
        include 'views/configuracion-usuario.php';
        return;
    }

    $usuario = Usuario ::buscar(null, end($usuario));
    $dictadosUsuario = Usuario ::listarEnseñanza($usuario -> id);
    $annos = (new DateTime()) -> diff(new DateTime($usuario -> fechaNacimiento));
?>

<div class="container-fluid">
    <div id="perfil" class="row">
        <div id="perfil-info" class="col">
            <div id="perfil-header">
                <img class="mb-3" src="../uploads/perfiles/<?= $usuario -> foto ?>" alt="user_img">
                <b><?= $usuario -> nickname ?></b>
                <span><?= $usuario -> numeroSeguidores ?> seguidores</span>
            </div>
            <div class="mt-5">
                <ul>
                    <li class="perfil-key">Nombre:</li>
                    <li class="perfil-value"><?= "{$usuario -> nombres} {$usuario -> apellidos}" ?></li>
                    <li class="perfil-key">Edad:</li>
                    <li class="perfil-value"><?= $annos -> y ?> años</li>
                    <li class="perfil-key">Correo electrónico:</li>
                    <li class="perfil-value"><?= $usuario -> email ?></li>
                    <li class="perfil-key">Lugar de procedencia:</li>
                    <li class="perfil-value"><?= "{$usuario -> ciudad -> nombre}, {$usuario -> pais -> nombre}" ?></li>
                    <?php if ($trayectoriaUsuario = Conocimiento ::listar($usuario -> id)) { ?>
                        <li class="perfil-key">Trayectoria académica:</li>
                        <?php foreach ($trayectoriaUsuario as $trayectoria) { ?>
                            <li class="perfil-value"><?= "{$trayectoria -> nombre }, {$trayectoria -> gradoAcademico} , {$trayectoria -> lugarEstudio }, ({$trayectoria -> anio}), {$trayectoria -> pais -> nombre} " ?></li>
                        <?php }
                    } ?>
                </ul>
            </div>
        </div>
        <div id="perfil-detalle" class="col-9">
            <div id="perfil-detalle-header">
                <h2 class="mb-4">Sobre mí</h2>
                <?php if ($usuario -> descripcion != null) { ?>
                    <p class="docente-descripcion">"<?= $usuario -> descripcion ?>"</p>
                <?php } ?>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <?php if ($experienciaUsuario = ExperienciaLaboral ::listar($usuario -> id)) { ?>
                        <div class="perfil-detalle-body col-12 mt-3">
                            <h3>Experiencia laboral</h3>
                            <ul id="experiencia-laboral">
                                <?php foreach ($experienciaUsuario as $experiencia) { ?>
                                    <li><?= "{$experiencia -> nombre} , {$experiencia -> lugar}, {$experiencia -> fechaInicio} ,{$experiencia -> fechaFin} , {$experiencia -> pais -> nombre}" ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
                    <?php if ($seguidosUsuario = Usuario ::listarSeguimiento($usuario)) { ?>
                        <div class="perfil-detalle-body col-12 mt-4">
                            <h3>Cursos que sigo</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($seguidosUsuario as $curso) { ?>
                                        <div class="col-3">
                                            <div class="mini card">
                                                <a href="../curso/<?= $curso -> id ?>" class="card-head">
                                                    <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>"
                                                         alt="logo">
                                                    <span class="ml-3"><?= $curso -> titulo ?></span>
                                                </a>
                                                <div class="card-footer d-flex flex-column">
                                                <span>
                                                    <b>Docente:</b><?= $curso -> usuario -> nickname ?>
                                                </span>
                                                    <span>
                                                    <b>Duración:</b><?= $curso -> duracion ?> h
                                                </span>
                                                    <div class="mt-auto d-flex justify-content-between font-weight-bold">
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
                    <?php } ?>
                    <?php if ($dictadosUsuario != []) { ?>
                        <div class="perfil-detalle-body col-12 mt-4">
                            <h3>Cosas que enseño</h3>
                            <div class="container-fluid">
                                <div class="row">
                                    <?php foreach ($dictadosUsuario as $curso) { ?>
                                        <div class="col-3">
                                            <div class="mini card">
                                                <a href="../curso/<?= $curso -> id ?>" class="card-head">
                                                    <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>"
                                                         alt="logo">
                                                    <span class="ml-3"><?= $curso -> titulo ?></span>
                                                </a>
                                                <div class="card-footer d-flex flex-column">
                                                    <span><b>Docente:</b><?= $curso -> usuario -> nickname ?></span>
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container comments">
        <h1>- Comentarios -</h1>
        <div id="comentarios" class="row">
            <div class="col-4">
                <div class="card border-secondary">
                    <a class="card-head" href="perfil.html">
                        <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                        <span class="ml-3">pashaharu</span>
                        <div class="ml-auto pregunta-tiempo">
                            <i class="far fa-clock"></i>
                            <span>hace 1 sem</span>
                        </div>
                    </a>
                    <a class="pregunta card-body" href="">
                        ¿Cómo puedo crear una clase abstracta con implementación?
                    </a>
                    <div class="card-footer">
                        <button class="btn"><i class="fas fa-heart mr-1"></i>327</button>
                        <button class="btn"><i class="fas fa-comment-alt mr-1"></i>327</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>