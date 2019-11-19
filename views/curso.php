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
                        <div class="col-xl-2 col-lg-4 col-md-6 mt-3">
                            <div class="mini card text-dark">
                                <a href="" class="card-head">
                                    <img src="https://static.platzi.com/media/achievements/badges-html-css-b0a71550-d5e7-4e27-aca2-f09f1321a517.png"
                                         alt="logo">
                                    <span class="ml-3">HTML5 y CSS3</span>
                                </a>
                                <div class="card-footer d-flex flex-column">
                                    <span><b>Docente:</b>piscoyron</span>
                                    <span><b>Duración:</b>21 h</span>
                                    <div class="card-rating">
                                        <span>1K subscriptores</span>
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
        <div class="card-body">
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>Introducción al curso</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Bienvenida al curso</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Primeros pasos</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>Clases avanzadas</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Clases abstractas</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Implementando clases abstractas al proyecto</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Ejercicio práctico </span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Implementando métodos abstractos en Java</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>JavaDocs</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Qué es JavaDocs</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Implementando JavaDocs al proyecto</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Javadocs tags para herencia e interfaces</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Generando JavaDocs</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>Clases anidadas</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Clases anidadas y tipos</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Implementando una clase anidada al proyecto</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Instanciando clases estáticas anidadas</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Enumeraciones</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>Interfaces avanzadas</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Métodos con implementación métodos default y private</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Creando Interfaz DAO con métodos default y private</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Diferencias entre Interfaces y Clases abstractas</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Herencia en interfaces</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>JDBC</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Definición y composición del API</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Ejercicio: JDBC API</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                                <span class="clase-titulo">Creando la base de datos y conectando el proyecto con
                                    MySQL</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                                <span class="clase-titulo">Generando conexión a la base de datos y creando clase de
                                    constantes</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Sentencia SELECT en Java</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Sentencia SELECT con parámetros</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Sentencia INSERT en Java</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Reto: Reporte por fecha</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="curso-seccion">
                <div class="curso-seccion-header">
                    <div class="curso-seccion-titulo">
                        <span>Lambdas</span>
                    </div>
                </div>
                <div class="clases">
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Interfaces funcionales</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Programación funcional</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Lambdas</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Ejercicio: Lambdas</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Lambdas como variables y recursividad</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Stream y Filter</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Predicate y consumer</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                    <a class="clase" href="reproductor.html">
                        <div class="clase-estado"></div>
                        <div class="clase-contenido">
                            <span class="clase-titulo">Conclusión del curso del curso</span>
                            <span class="clase-duracion">Duración: <b>10m 34s</b></span>
                        </div>
                    </a>
                </div>
            </div>
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