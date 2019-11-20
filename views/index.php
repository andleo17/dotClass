<div id="hero">
    <div class="fondo">
        <div class="imagen-fondo animate-pop-in"></div>
        <div class="filtro"></div>
    </div>
    <div class="hero-contenido">
        <h1 class="animate-pop-in">Aprende o comparte conocimientos</h1>
        <span class="animate-pop-in">Demuéstrale al mundo que puedes enseñar lo que sabes y también aprender de
                    los demás.</span>
        <a class="hero-button animate-pop-in" href="registro/">Da tus primeros pasos</a>
    </div>
</div>
<div class="container-fluid">
    <div class="mt-5 row">
        <div class="col principal">
            <h3>Cursos más populares</h3>
            <div class="container-fluid">
                <div class="row">
                    <?php foreach (Curso ::listar() as $curso) { ?>
                        <div class="mt-3 col-xl-4 col-lg-6 col-md-12">
                            <div class="card">
                                <a href="curso/<?= $curso -> id ?>" class="card-head">
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
                                    <span><b>Duración:</b><?= $curso -> duracion ?> h</span>
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 mb-5 row">
        <div class="col principal">
            <h3>Docentes más populares</h3>
            <div class="container-fluid">
                <div class="row">
                    <?php foreach (Usuario ::listar() as $usuario) { ?>
                        <div class="mt-3 col-xl-4 col-lg-6 col-md-12">
                            <div class="card">
                                <a href="perfil/<?= $usuario -> nickname ?>" class="card-head">
                                    <img src="uploads/perfiles/<?= $usuario -> foto ?>">
                                    <div class="ml-3 docente-perfil">
                                        <b><?= $usuario -> nickname ?></b>
                                        <span><?= $usuario -> numeroSeguidores ?> seguidores</span>
                                    </div>
                                </a>
                                <div class="card-body docente-descripcion">
                                    <p>"<?= $usuario -> descripcion ?>"</p>
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
                                        <span>
                                            <a href="html/curso-largo-java.html">Java desde cero</a>,
                                            <a href="html/curso-largo-poo.html">Programación Orientada a Objetos (POO)</a>,
                                            <a href="html/css-grid.html">CSS Grid Layout</a>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>