<div class="container my-4">
    <div class="row text-center">
        <div class="col-12">
            <h1>Explora nuestro catálogo de cursos que tenemos para ti</h1>
        </div>
        <div class="col-12">
            <p>En dotClass queremos que nuestros usuarios aprendan lo que sea cuando deseen, es por ello que abarcamos
                todos
                los temas de estudios más relevantes que puedas encontrar.</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="container">
                <div class="row">
                    <?php foreach (Categoria::listar() as $categoria) { ?>
                        <div class="col-lg-6 col-md-12 mb-3">
                            <a href="../categoria/<?= $categoria -> id ?>" class="card animate-pop-in text-dark">
                                <div class="card-head">
                                    <img src="../assets/<?= $categoria -> logo ?>" alt="logo">
                                    <span class="ml-3"><?= $categoria -> nombre ?></span>
                                </div>
                                <div class="card-body">
                                    <p><?= $categoria -> descripcion ?></p>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>