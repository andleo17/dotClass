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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>dotClass</title>
</head>

<body>
<nav class="animate-pop-in">
    <div class="nav-items animate-pop-in">
        <a href="<?php echo SERVER_URL ?>" class="logo">
            <span class="dot">dot</span>
            <span class="class">Class</span>
        </a>
        <ul>
            <li><a href="<?php echo SERVER_URL ?>explorar/">EXPLORAR</a></li>
            <li><a href="<?php echo SERVER_URL ?>blog/">BLOG</a></li>
            <li><a href="<?php echo SERVER_URL ?>contacto/">CONTÁCTANOS</a></li>
        </ul>
    </div>
    <div class="nav-botones">
        <a href="<?php echo SERVER_URL ?>notificaciones/"><i class="fas fa-bell"></i></a>
        <?php
            if (!isset($_SESSION['usuario'])) {
                echo "<a href='" . SERVER_URL . "inicio-sesion/'><i class='fas fa-user'></i></a>";
            } else {
                echo "
                    <a id='btn-perfil' href='" . SERVER_URL . "perfil/{$_SESSION['usuario'] -> nickname}'>
                        <img src='". SERVER_URL . "uploads/perfiles/{$_SESSION['usuario'] -> foto}' alt='foto'>
                        <b>{$_SESSION['usuario'] -> nombres} {$_SESSION['usuario'] -> apellidos}</b>
                    </a>";
            }
        ?>
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
<footer>
    <a href="<?php echo SERVER_URL ?>" class="logo">
        <span class="dot">dot</span>
        <span class="class">Class</span>
    </a>
    <div class="footer-datos">
        <div class="footer-informacion">
            <ul>
                <li><a href="<?php echo SERVER_URL ?>about.html">Acerca de nosotros</a></li>
                <li><a href="<?php echo SERVER_URL ?>contacto.html">Contacto</a></li>
                <li><a href="<?php echo SERVER_URL ?>html/terminos-condiciones.html">Términos y Condiciones</a></li>
            </ul>
        </div>
        <div class="footer-informacion">
            <ul>
                <li><a href=""><i class="fab fa-facebook-square"></i>Facebook</a></li>
                <li><a href=""><i class="fab fa-twitter-square"></i>Twitter</a></li>
                <li><a href=""><i class="fab fa-instagram"></i>Instagram</a></li>
            </ul>
        </div>
        <form class="footer-informacion">
            <span>¿Quieres que te avisemos cuando haya novedades?</span>
            <div class="correo">
                <input type="email" placeholder="Correo electrónico">
                <button>OK</button>
            </div>
        </form>
        <div class="datos">
            <ul>
                <li>Av. San Josemaría Escrivá de Balaguer N° 855 Chiclayo - Perú</li>
                <li>+51 942 993 030</li>
                <li>contacto@dotclass.com</li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>