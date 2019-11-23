<?php
    include 'php/config.php';
    require_once 'php/Usuario.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo SERVER_URL ?>css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>dotClass</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark animate-pop-in">
    <a href="<?php echo SERVER_URL ?>" class="logo navbar-brand">
        <span class="dot">dot</span>
        <span class="class">Class</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SERVER_URL ?>explorar/">EXPLORAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SERVER_URL ?>blog/">BLOG</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SERVER_URL ?>contacto/">CONTÁCTANOS</a>
            </li>
        </ul>
        <div class="navbar-nav nav-botones my-2 my-lg-0">
            <a class="nav-link" href="<?php echo SERVER_URL ?>notificaciones/"><i class="fas fa-bell"></i></a>
            <?php if (!isset($_SESSION['usuario'])) { ?>
                    <a class='nav-link' href="<?= SERVER_URL ?>inicio-sesion/"><i class='fas fa-user'></i></a>
            <?php } else { ?>
                    <div class='btn-group'>
                        <a id='btn-perfil' href="<?= SERVER_URL ?>perfil/<?= $_SESSION['usuario'] -> nickname ?>">
                            <img src="<?= SERVER_URL ?>uploads/perfiles/<?= $_SESSION['usuario'] -> foto ?>" alt='foto'>
                            <b><?= $_SESSION['usuario'] -> nickname ?></b>
                        </a>
                        <button type='button' class='btn btn-light dropdown-toggle dropdown-toggle-split' data-toggle='dropdown'>
                            <span class='sr-only'>Toggle Dropdown</span>
                        </button>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <a class='dropdown-item' href='<?= SERVER_URL . 'perfil/' . $_SESSION['usuario'] -> nickname . '/editar' ?>'>Configuración</a>
                            <a class='dropdown-item' href='#'>Gestionar cursos</a>
                            <div class='dropdown-divider'></div>
                            <button id='cerrar-sesion' class='dropdown-item text-danger'>Cerrar sesión</button>
                        </div>
                    </div>
            <?php } ?>
        </div>
    </div>
</nav>
<?php
    if (isset($_GET['view'])) {
        $views = explode('/', $_GET['view']);
        include "views/{$views[0]}.php";
    } else {
        include 'views/index.php';
    }
?>
<footer class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="<?php echo SERVER_URL ?>" class="logo">
                <span class="dot">dot</span>
                <span class="class">Class</span>
            </a>
        </div>
        <div class="col-lg-2 offset-lg-1 col-12 col-md-6 col-sm-12 mt-4">
            <ul>
                <li><a href="<?php echo SERVER_URL ?>about.html">Acerca de nosotros</a></li>
                <li><a href="<?php echo SERVER_URL ?>contacto.html">Contacto</a></li>
                <li><a href="<?php echo SERVER_URL ?>html/terminos-condiciones.html">Términos y Condiciones</a></li>
            </ul>
        </div>
        <div class="col-lg-2 col-12 col-md-6 col-sm-12 mt-4">
            <ul>
                <li><a href=""><i class="fab fa-facebook-square"></i>Facebook</a></li>
                <li><a href=""><i class="fab fa-twitter-square"></i>Twitter</a></li>
                <li><a href=""><i class="fab fa-instagram"></i>Instagram</a></li>
            </ul>
        </div>
        <div class="col-lg-3 col-12 col-md-6 col-sm-12 mt-4">
            <span>¿Quieres que te avisemos cuando haya novedades?</span>
            <form>
                <div class="input-group pr-5">
                    <input class="form-control" type="email" placeholder="Correo electrónico">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-light">OK</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-12 col-md-6 col-sm-12 mt-4">
            <ul>
                <li>Av. San Josemaría Escrivá de Balaguer N° 855 Chiclayo - Perú</li>
                <li>+51 942 993 030</li>
                <li>contacto@dotclass.com</li>
            </ul>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script>
    try {
        document.getElementById('cerrar-sesion').onclick = e => {
            fetch('<?php echo SERVER_URL?>clase/Usuario/cerrarSesion')
                .then(res => location.href = '<?php echo SERVER_URL?>');
        }
    } catch (e) {}
</script>
</body>
</html>