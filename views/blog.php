<?php
    require_once 'php/blog.php';
?>
<div class="container my-4">
    <div class="row">
        <div class="col">                        
            <div class="jumbotron">
                <h1 class="display-4">Compartiendo conocimiento, cambiando vidas</h1>
                <hr class="my-4">
                <p class="text-center"><i>"El mayor enemigo del conocimiento no es la ignorancia, es la ilusión del conocimiento"</i><b> Stephen Hawing</b></p>                                
            </div>
        </div>     
    </div>
    
    <div class="row mb-2">
        <?php foreach (Blog::listar() as $blog) { ?>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-danger">Nuevo</strong>
                    <h3 class="mb-0"><a class="text-dark" href="#"><?= $blog -> titulo ?></a></h3>
                    <div class="mb-1 text-muted"><?= $blog -> fechaCreacion ?></div>
                    <p class="card-text mb-auto"><?= substr($blog -> contenido, 0, 90) . '...' ?></p>
                    <div class="blog_foot">
                        <i class="fas fa-heart"></i>
                        <label class="likes"><?= $blog -> numeroSeguidores ?></label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments"><?= $blog -> numeroComentarios ?></label>
                        <span>COMPARTIR</span>
                    </div>
                    <a href="#">Continue reading</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="https://josefacchin.com/wp-content/uploads/2017/08/como-crear-un-canal-de-youtube.png" data-holder-rendered="true">
            </div>
        </div>
        <?php } ?>                       
        
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-danger">Nuevo</strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="#">Creando Oportunidades</a>
                    </h3>
                    <div class="mb-1 text-muted">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                    <div class="blog_foot">
                        <i class="fas fa-heart"></i>
                        <label class="likes">609</label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments">120</label>
                        <span>COMPARTIR</span>
                    </div>
                    <a href="#">Continue reading</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="https://www.jhestudio.com/wp-content/uploads/2018/12/photoshop-online-gratis.png" data-holder-rendered="true">
            </div>
        </div>
        </div>
    </div>

    <div class="row mx-5">
        <div class="col-md-8 blog-main">
            <div class="blog ">
                <div class="blog_head position-relative">
                    <img class="card-img-top rounded-0 " src="https://vilmanunez.com/wp-content/uploads/2019/02/editor-de-videos.png" alt="">
                    <a href="#" class="blog_item_date" >
                        <h3>15</h3>
                        <p>Jan</p>
                    </a>
                </div>
                <div class="blog_body">
                    <h3 class = "blog-post-title my-3"> <a href="blog_content.html">Oportunidades para todos</a></h3>
                    <p class="blog-post-meta">Por <a href="#"><b>Mark</b></a></p>
                    <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. 
                    Basic typography, images, and code are all supported.</p>
                    <div class="blog_foot">
                        <i class="fas fa-heart"></i>
                        <label class="likes">609</label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments">120</label>
                        <span>COMPARTIR</span>
                    </div>
                </div>
            </div>
            <div class="blog ">
                <div class="blog_head position-relative">
                    <img class="card-img-top rounded-0 " src="https://vilmanunez.com/wp-content/uploads/2019/02/editor-de-videos.png" alt="">
                    <a href="#" class="blog_item_date" >
                        <h3>15</h3>
                        <p>Jan</p>
                    </a>
                </div>
                <div class="blog_body">
                    <h3 class = "blog-post-title my-3"> <a href="blog_content.html">Oportunidades para todos</a></h3>
                    <p class="blog-post-meta">Por <a href="#"><b>Mark</b></a></p>
                    <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. 
                    Basic typography, images, and code are all supported.</p>
                    <div class="blog_foot">
                        <i class="fas fa-heart"></i>
                        <label class="likes">609</label>
                        <i class="fas fa-comment-alt"></i>
                        <label class="comments">120</label>
                        <span>COMPARTIR</span>
                    </div>
                </div>
            </div>
        </div>

        <aside class="col-md-4 blog-sidebar">
            <div class="p-3 bg-light rounded">
                <h4 class="font-italic">Frase del Día:</h4>
                <p class="mb-0 text-center"><i>"La verdadera creatividad surge siempre de la escasez"</i><b>—Wolfgang Joop</b> </p>
            </div>          
            <div class="p-3">
                <h4 class="font-black my-4">Categorías</h4>
                <div class="list-group ">
                    <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                    <a href="#" class="list-group-item list-group-item-action">A simple primary list group item</a>
                    <a href="#" class="list-group-item list-group-item-action">A simple secondary list group item</a>
                    <a href="#" class="list-group-item list-group-item-action">A simple success list group item</a>
                    <a href="#" class="list-group-item list-group-item-action">A simple danger list group item</a>
                </div>
            </div>
            <div class="p-3 ">
                <h3 class="widget_title">Publicaciones Recientes</h3>
                <div class="card mini my-3">
                    <a href="" class="card-head">
                        <img src="https://www.mabelcajal.com/wp-content/uploads/2016/11/blog.png" alt="logo">
                        <span class="ml-2 font-weight-normal ">Detalles de la Nueva Tecnología.....</span>
                    </a>                                    
                </div>
                <div class="card mini my-3">
                    <a href="" class="card-head">
                        <img src="https://www.mabelcajal.com/wp-content/uploads/2016/11/blog.png" alt="logo">
                        <span class="ml-2 font-weight-normal ">Detalles de la Nueva Tecnología.....</span>
                    </a>                                    
                </div>
                <div class="card mini my-3">
                    <a href="" class="card-head">
                        <img src="https://www.mabelcajal.com/wp-content/uploads/2016/11/blog.png" alt="logo">
                        <span class="ml-2 font-weight-normal ">Detalles de la Nueva Tecnología.....</span>
                    </a>                                    
                </div>
            </div>
        </aside>
    </div>

</div>