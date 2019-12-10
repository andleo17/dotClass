<?php
    require_once 'php/Blog.php';
    require_once 'php/Categoria.php';
?>
<div class="container">

    <div class="row">
        <div class="col mt-4">                        
            <div class="jumbotron" id ="jum-blog" >
                <h1 class="display-4">Compartiendo conocimiento, cambiando vidas</h1>
                <hr class="my-4">
                <p class="text-center"><i>"El mayor enemigo del conocimiento no es la ignorancia, es la ilusión del conocimiento"</i><b> Stephen Hawing</b></p>                                
            </div>
        </div>     
    </div>
    
    <div class="row mt-2">
        <?php foreach (Blog::listarNuevos() as $blog) { ?>
        <div class="col-md-6 mb-0">
            <div class="card flex-md-row mb-0 box-shadow h-md-250">
                <div class="card-body mb-0 d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-danger"><?= $blog -> categoria -> nombre ?></strong>
                    <h3 class="mb-0"><a class="text-dark" href="#"><?= $blog -> titulo ?></a></h3>
                    <div class="my-2 text-muted"><?= $blog -> usuario -> nickname ?></div>
                    <p class="card-text mb-4"><?= substr($blog -> contenido, 0, 80) . '...' ?></p>
                    <div class="blog_foot my-2">
                        <i class="fas fa-heart"></i>
                        <label class="likes"><?= $blog -> numeroSeguidores ?></label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments"><?= $blog -> numeroComentarios ?></label>
                        <span>Compartir</span>
                    </div>
                    <a href="<?php echo SERVER_URL ?>/blog_content/">Continuar Lectura ...</a>
                </div>
                <img class="card-img-right flex-auto d-none d-lg-block mb-0" style="width: 200px; " src="<?= $blog -> logo ?>" >
            </div>
        </div>
        <?php } ?>   

    </div>

    <div class="row my-4">
        <div class="col-md-8">

            <?php foreach (Blog::listar() as $blog) { ?>
            <div class="blog ">
                <div class="blog_head position-relative">
                    <img class="card-img-top rounded-0 " src="<?= $blog -> logo ?>" alt="">
                    <a href="<?php echo SERVER_URL ?>/blog_content/" class="blog_item_date" >
                        <h3><?= date("d", strtotime($blog -> fechaCreacion)) ?></h3>
                        <p><?= date("M", strtotime($blog -> fechaCreacion)) ?></p>
                    </a>
                </div>
                <div class="blog_body">
                    <h3 class = "blog-post-title my-4"> <a href="blog_content.html"><?= $blog -> titulo ?></a></h3>
                    <p class="blog-post-meta">Por <a href="#"><b><?= "{$blog -> usuario -> nombres} {$blog -> usuario -> apellidos}" ?></b></a></p>
                    <p class = "text-justify"><?= $blog -> contenido ?></p>
                    <div class="blog_foot">
                        <i class="fas fa-heart"></i>
                        <label class="likes"><?= $blog -> numeroSeguidores ?></label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments"><?= $blog -> numeroComentarios ?></label>
                        <span>Compartir</span>
                    </div>
                </div>
            </div>
            <?php } ?>  

        </div>

        <div class="col-md-4">
            <div class="blog ">
                <div class="p-3 bg-light rounded">
                    <h4 class="font-italic">Frase del Día:</h4>
                    <p class="mb-0 text-center"><i>"La verdadera creatividad surge siempre de la escasez"</i></p>
                    <p class="mb-0 text-center"><b>Wolfgang Joop</b> </p>
                </div>          
                <div class="">
                    <h4 class="font-black my-4">Categorías</h4>
                    <div class="list-group ">
                    <?php foreach (Categoria::listar() as $cate) { ?>
                        <a href="#" class="list-group-item list-group-item-action"><?= $cate -> nombre ?></a>
                    <?php } ?> 
                    </div>
                </div>
                <div class="">
                    <h3 class="widget_title py-3">Publicaciones Recientes</h3>
                    <?php foreach (Blog::listarNuevos() as $blog) { ?>
                    <div class="card mini my-3">
                        <a href="" class="card-head">
                            <img src="<?= $blog -> logo ?>" alt="logo">
                            <span class="ml-2 font-weight-normal "><?= substr($blog -> titulo, 0, 35) . '...' ?></span>
                        </a>                                    
                    </div>
                    <?php } ?> 
                </div>
            </div>
        </div>
    </div>

</div>