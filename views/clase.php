<?php
    $clase = explode('/', $_SERVER['REQUEST_URI']);
    $clase = Clase ::buscar(end($clase));
    $curso = Clase ::buscarContenidoCurso($clase -> id);
    $contenido = $curso['contenido'];
    $curso = $curso['curso'];
    if (!isset($_SESSION['usuario'])) {
        header('Location: ' . SERVER_URL);
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-10 p-0 d-flex">
            <div id="sidebar-container" class="sidebar-expanded d-none d-inline-block h-100">
                <ul class="list-group">
                    <button data-toggle="sidebar-colapse" class="list-group-item list-group-item-action d-flex align-items-center">
                        <div class="w-100">
                            <i id="collapse-icon" class="fas fa-arrow-left"></i>
                            <span id="collapse-text" class="menu-collapsed ml-3">Contenido de curso</span>
                        </div>
                    </button>
                    <?php foreach ($contenido as $seccion) { ?>
                        <a href="#submenu<?= $seccion -> id ?>" data-toggle="collapse" class="verde-oscuro list-group-item list-group-item-action text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="menu-collapsed"><?= $seccion -> titulo ?></span>
                                <i class="far fa-caret-square-down menu-collapsed"></i>
                            </div>
                        </a>
                        <div id='submenu<?= $seccion -> id ?>' class="collapse sidebar-submenu">
                            <?php foreach (Clase::buscarClases($seccion -> id) as $cl) { ?>
                                <a href="../clase/<?= $cl -> id ?>" class="list-group-item list-group-item-action">
                                    <span class="menu-collapsed"><?= $cl -> titulo ?></span>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </ul>
            </div>
            <div class="p-3 w-100">
                <a href="<?= SERVER_URL . "perfil/{$curso -> usuario -> nickname}" ?>" class="card-head">
                    <img src="../uploads/perfiles/<?= $curso -> usuario -> foto ?>" alt="foto">
                    <span class="ml-3"><?= $curso -> usuario -> nickname ?></span>
                </a>
                <h1><?= $clase -> titulo ?></h1>
                <iframe class="video" id="vid" src="https://www.youtube.com/embed/<?= $clase -> video ?>/"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                <h2>Descripción</h2>
                <p><?= $clase -> descripcion ?></p>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="verde-oscuro h-100"></div>
            <div class="d-flex align-items-center justify-content-between form-control">
                <input class="border-0 w-100" type="text" placeholder="Haz un comentario">
                <i class="fas fa-arrow-up"></i>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = () => {
        document.getElementsByTagName('footer')[0].classList.add('d-none');

        // Collapse click
        $('[data-toggle=sidebar-colapse]').click(function () {
            SidebarCollapse();
        });

        function SidebarCollapse() {
            $('.menu-collapsed').toggleClass('d-none');
            $('.sidebar-submenu').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $('#sidebar-container').toggleClass('sidebar-collapsed');

            // Treating d-flex/d-none on separators with title
            var SeparatorTitle = $('.sidebar-separator-title');
            if (SeparatorTitle.hasClass('d-flex')) {
                SeparatorTitle.removeClass('d-flex');
            } else {
                SeparatorTitle.addClass('d-flex');
            }

            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-arrow-right');
        }
    };
</script>