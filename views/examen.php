<?php
    $examen = Curso::buscarExamen($curso -> id);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <h1>Prueba tus conocimientos</h1>
            <p><?= $examen -> mensaje ?></p>
        </div>
    </div>
    <div class="row">
        <?php foreach (Examen::listarPreguntas($examen -> id) as $pregunta) { ?>
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header bordes-arriba">
                        <span class="font-weight-bold"><?= $pregunta -> numero ?>.</span>
                        <span class="pregunta-examen-titulo"><?= $pregunta -> titulo ?></span>
                    </div>
                    <div class="card-body">
                        <?php foreach (Pregunta::listarAlternativas($pregunta -> id) as $alternativa) { ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><?= $alternativa -> numero ?></div>
                                </div>
                                <span class="form-control"><?= $alternativa -> contenido ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row my-5">
        <div class="col-12 text-center">
            <a href="" class="btn btn-success text-light">Finalizar examen</a>
        </div>
    </div>
</div>