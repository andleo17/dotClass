<?php
    require_once 'php/Usuario.php';

    $cumpleanos = new DateTime($_SESSION['usuario'] -> fechaNacimiento);
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);

    echo <<<"PAGE"

        <div class="container">
            <div class="profile-container">
                <div class="profile">
                    <div class="profile-header">
                        <img src="../uploads/perfiles/{$_SESSION['usuario'] -> foto}" alt="user_img" class="profile-photo">
                        <span class="profile-username">{$_SESSION['usuario'] -> nickname}</span>
                        <span class="profile-subs">{$_SESSION['usuario'] -> numeroSeguidores} seguidores</span>
                    </div>
                    <div class="profile-body">
                        <ul>
                            <li class="profile-info">Nombre:</li>
                            <li class="profile-data">{$_SESSION['usuario'] -> nombres} {$_SESSION['usuario'] -> apellidos}</li>
                            <li class="profile-info">Edad:</li>
                            <li class="profile-data">{$annos -> y} años</li>
                            <li class="profile-info">Correo electrónico:</li>
                            <li class="profile-data">{$_SESSION['usuario'] -> email}</li>
                            <li class="profile-info">Lugar de procedencia:</li>
                            <li class="profile-data">{$_SESSION['usuario'] -> ciudad -> nombre}, {$_SESSION['usuario'] -> pais -> nombre}</li>
                            <li class="profile-info">Trayectoria académica:</li>
                            <li class="profile-data">Ingeniería de Sistemas y Computación (Maestría) - USAT, Perú - 2018
                            </li>
                            <li class="profile-data">Teatro - Escuela de Bellas Artes - 2014</li>
                            <li class="profile-data">Ingeniería Industrial - PUCP, Lima - 2000</li>
                        </ul>
                    </div>
                    <div class="profile-footer">
                    </div>
                </div>
                <div class="profile-about">
                    <div class="profile-about-header">
                        <h2>Sobre mí</h2>
                        <p>"{$_SESSION['usuario'] -> descripcion}"</p>
                    </div>
                    <div class="profile-about-body">
                        <div class="experience">
                            <h3>Experiencia laboral</h3>
                            <ul>
                                <li>Musical "High School Musical" (2017), New York.</li>
                                <li>Cabinas "Mi Paolita" (2000-2004), Perú.</li>
                                <li>Asesora de tesis en la USAT (2014-2016), Perú.</li>
                            </ul>
                        </div>
                        <div class="curso-box">
                            <h3>Cursos que sigo</h3>
                            <div class="card-list">
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                        <hr>
                        <div class="curso-box">
                            <h3>Cosas que enseño</h3>
                            <div class="card-list">
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                                <div class="mini-card">
                                    <div class="mini-card-header">
                                        <img src="https://static.platzi.com/media/achievements/1050-bfb74f83-8e2e-4ff7-a66d-77d2c0067908.png"
                                             alt="logo">
                                        <span>Fundamentos de programación</span>
                                    </div>
                                    <div class="mini-card-footer">
                                            <span>
                                                <b>Docente:</b>sspacecowbboy
                                            </span>
                                        <span>
                                                <b>Duración:</b>21 h
                                            </span>
                                    </div>
                                    <div class="mini-card-rating">
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
                    </div>
                </div>
            </div>
            <div class="contenido comments">
                <span>- Comentarios -</span>
                <div class="card-list">
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                    <div class="pregunta comentario">
                        <div class="pregunta-header">
                            <a href="perfil.html" class="pregunta-perfil">
                                <img src="https://www.famousbirthdays.com/headshots/pasha-harulia-6.jpg" alt="foto-perfil">
                                pashaharu
                            </a>
                            <div class="pregunta-tiempo">
                                <i class="far fa-clock"></i>
                                <span>hace 1 sem</span>
                            </div>
                        </div>
                        <div class="pregunta-body">
                            ¿Cómo puedo crear una clase abstracta con implementación?
                        </div>
                        <div class="aporte-footer">
                            <div class="like">
                                <a href=""><i class="fas fa-heart"></i></a>
                                <span>327</span>
                            </div>
                            <div class="comentarios">
                                <i class="fas fa-comment-alt"></i>
                                <span>327</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
PAGE;