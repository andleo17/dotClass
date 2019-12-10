<?php
    require_once 'php/Blog.php';
?>
<div class="container_blog animate-pop-in">
    <?php foreach (Blog::listar(1) as $blog) { ?>
        <div class="wrapper">
            <h1 ><?= $blog -> titulo ?></h1>
            <span><?= $blog -> fechaCreacion ?></span>
            <h2><?= substr($blog -> contenido, 0, 15) . '...' ?></h2>
            <img src="<?= $blog -> logo ?>">
            <p> <?= $blog -> contenido ?></p>
            
                <div class="author_data">
                    <h3>Acerca del autor</h3>
                    <img src="<?= $blog -> usuario -> foto?>" alt="author">
                    <!-- <span>Robotitus</span> -->
                </div>
        </div>
    <?php } ?> 
     
        <aside>
            
                <label > CURSOS TOP</label>
                <ul class="cursos_top">
                    <li> <a href="explorar.php">Cursos de Java</a> </li>
                    <li> <a href="explorar.php">Cursos de Python</a> </li>
                    <li> <a href="explorar.php">Cursos de Excel</a> </li>
                    <li> <a href="explorar.php">Aprende Excel con este tutorial</a> </li>
                    <li> <a href="explorar.php">Conviertete en un desarrollador web</a> </li>
                </ul>
                <hr>
                <label > POSTS POPULARES</label>
                    <ul class="post_pop">
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/03/qlshajgqhmckx0ce6vm4-351x185.jpg" alt="post"> <a
                                >Como construir una app para iPhone con Scratch </a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/03/qlshajgqhmckx0ce6vm4-351x185.jpg" alt="post"> <a
                                >Diez lenguajes de programacion</a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/03/qlshajgqhmckx0ce6vm4-351x185.jpg" alt="post"> <a
                                >Diez lenguajes de programacion</a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/03/qlshajgqhmckx0ce6vm4-351x185.jpg" alt="post"> <a
                                >Diez lenguajes de programacion</a></li>
                    </ul>
                <hr>
                <LAbel> POSTS RELACIONADOS</LAbel>
                    <ul class="post_pop">
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/06/061219_cw_europa_feat-351x185.jpg" alt="post"> <a
                                href="">Como construir una app para iPhone con Scratch </a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/06/061219_cw_europa_feat-351x185.jpg" alt="post"> <a
                                href="">Diez lenguajes de programacion</a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/06/061219_cw_europa_feat-351x185.jpg" alt="post"> <a
                                href="">Diez lenguajes de programacion</a></li>
                        <li> <img src="https://www.robotitus.com/wp-content/uploads/2019/06/061219_cw_europa_feat-351x185.jpg" alt="post"> <a
                                href="">Diez lenguajes de programacion</a></li>
                    </ul>
            
        </aside>
        
        
    </div>
    <footer>
        <a href="index.php" class="logo">
            <span class="dot">dot</span>
            <span class="class">Class</span>
        </a>
        <div class="footer-datos">
            <div class="informacion">
                <ul>
                    <li><a href="about.html">Acerca de nosotros</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                    <li><a href="terminos-condiciones.html">Términos y Condiciones</a></li>
                </ul>
            </div>
            <div class="redes-sociales">
                <ul>
                    <li><a href=""><i class="fab fa-facebook-square"></i>Facebook</a></li>
                    <li><a href=""><i class="fab fa-twitter-square"></i>Twitter</a></li>
                    <li><a href=""><i class="fab fa-instagram"></i>Instagram</a></li>
                </ul>
            </div>
            <form class="novedades-contacto">
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