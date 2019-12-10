<?php
    $cursos = Curso ::listar();
?>
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1>Agregar Curso</h1>
        </div>
        <div class="col mt-5">
            <form id="formulario" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-3 d-flex align-items-center justify-content-center">
                        <div class="form-group mt-3">
                            <label class="position-relative" for="btnSubirFoto">
                                <img id="imagen-usuario"
                                     class="rounded-circle"
                                     src=""
                                     alt="">
                                <i class="far fa-image"></i>
                                <span id="editar-hover">
                                    <i class="far fa-edit"></i>
                                </span>
                            </label>
                            <input type="file" name="foto" id="btnSubirFoto">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input class="form-control" type="text" name="txtTituloCurso"
                                   placeholder="Título del curso">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="txtDescripcionCurso"
                                      placeholder="Descripción del curso"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-12">
                        <h4>Plan de estudios:</h4>
                        <hr>
                    </div>
                    <div class="col">
                        <div class="row" id="prerequisitos"></div>
                    </div>
                    <div class="col-3 p-0 m-3">
                        <button class="agregar-config" type="button" data-toggle="modal"
                                data-target="#exampleModalCenter">Agregar
                        </button>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-12">
                        <h4>Detalles del Curso:</h4>
                        <hr>
                    </div>
                    <div id="contenido" class="col-12">
                        <div class="border border-secondary px-4 py-3 mb-4">
                            <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion"
                                   placeholder="Introduce un título para la sección" required>
                            <div class="col-3 my-3">
                                <div class="card border border-secondary rounded-top">
                                    <div class="card-header bg-success"></div>
                                    <div class="p-4">
                                        <input class="form-control" type="text" name="nombreSeccion"
                                               id="nombreSeccion" placeholder="Título para tu clase" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 p-0 m-3">
                                <button id="agregar-clase" class="agregar-config" type="button">Agregar</button>
                            </div>
                        </div>
                        <div class="col-12 m-3">
                            <button id="agregar-seccion" class="agregar-config" type="button">Agregar</button>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-12 text-center">
                        <input id="btnGuardar" type="button" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Buscar curso</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="my-3 mx-2">
                <input type="search" placeholder="Buscar curso" class="form-control">
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <?php foreach ($cursos as $key => $prerequisito) { ?>
                            <input type="checkbox"
                                   value="<?= $prerequisito -> id ?>">
                            <div class="col my-2">
                                <div class="mini card text-dark prerequisito">
                                    <a href="../curso/<?= $prerequisito -> id ?>" class="card-head">
                                        <img src="<?= SERVER_URL ?>uploads/logos/<?= $prerequisito -> logo ?>"
                                             alt="logo">
                                        <span class="ml-3"><?= $prerequisito -> titulo ?></span>
                                    </a>
                                    <div class="card-footer d-flex flex-column">
                                        <span><b>Docente:</b><?= $prerequisito -> usuario -> nickname ?></span>
                                        <span><b>Duración:</b><?= $prerequisito -> duracion ?></span>
                                        <div class="mt-2 d-flex justify-content-between font-weight-bold">
                                            <span><?= $prerequisito -> numeroSubscriptores ?> subscriptores</span>
                                            <span class="text-warning">
                                                    <?php for ($i = 0; $i < $prerequisito -> valoracion; $i++) { ?>
                                                        <i class="fa fa-star"></i>
                                                    <?php } ?>
                                                <?php for ($i = 0; $i < 5 - $prerequisito -> valoracion; $i++) { ?>
                                                    <i class="far fa-star"></i>
                                                <?php } ?>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="agregar-prerequisito">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
    let btn = document.getElementById('agregar-prerequisito');
    let $prerequisitos = document.getElementById('prerequisitos');
    btn.onclick = e => {
        let chck = document.getElementsByTagName('input');
        for (let i = 0; i < chck.length; i++) {
            let c = chck.item(i);
            if (c.type === 'checkbox') {
                if (c.checked) {
                    $prerequisitos.append(c.nextElementSibling);
                }
            }
        }
        $('#exampleModalCenter').modal('hide')
    }
    document.getElementById('btnGuardar').onclick = e => {
        window.location = 'http://localhost/dotclass/';
    }
</script>


    