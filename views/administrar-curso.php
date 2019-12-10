<?php    
    
    $curso = explode('/', $_SERVER['REQUEST_URI']);
    if (end($curso) == 'editar') {
        $curso = Curso ::buscar($curso[3]);
        include 'views/administrar-curso.php';
        return;
    }
    $curso = Curso ::buscar(end($curso));
    $cursos = Curso ::listar();
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1>Modificar Curso</h1>
        </div>
        <div class="col mt-5">
            <form id="formulario" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="icono-curso">                        
                        <img src="<?= SERVER_URL ?>uploads/logos/<?= $curso -> logo ?>"
                                                 alt="logo">
                        <input type="file" name="cargar-foto" id="cargar-foto"><?= $curso -> logo ?></input>
                    </div>
                    <div class="curso-titulo">
                        <input type="text" name="TituloCurso" id="txtTituloCurso" 
                            value="<?= $curso -> titulo ?>" >
                        <textarea name="DescripcionCurso" id="txtDescripcionCurso"
                            placeholder="Descripción del curso"><?= $curso -> descripcion ?></textarea>
                    </div>
                </div>                
                <div class="form-row mt-5">
                    <div class="col-12 ">
                        <h4>Plan de estudios:</h4>
                        <hr>
                    </div>
                    <?php if ($cursosPrerequisitos = Curso ::listarPrerequisitos($curso -> id)) { ?>
                    <div class="col-3 p-0 m-3">
                        <div class="card p-4">
                            <label for="cboPreRequisito[<?= $cursos -> id ?>]">Curso Pre-Requisito: </label>
                            <select class="form-control"
                                    id="cboPreRequisito[<?= $cursos -> id ?>]"
                                    name="PreRequisitoCurso[<?= $cursos -> id ?>]">
                                <?php foreach ($cursosPrerequisitos as $cur) { ?>
                                    <option value="<?= $cur -> id ?>" > <?= $cur -> titulo ?> </option>                                                            
                                 <?php } ?>
                            </select>
                        </div>                         
                    </div>
                    <?php } ?>
                </div>
                <div class="form-row mt-5">
                    <div class="col-12 ">
                        <h4>Detalles del Curso:</h4>
                        <hr>
                    </div>
                    <div class="col-12 card mx-4 rounded-0">
                        <div class="card-header pb-0">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a id="contenido-tab" class="nav-link active" href="#contenido" data-toggle="tab">Contenido</a>
                                </li>
                                <li class="nav-item">
                                    <a id="preguntas-tab" class="nav-link" href="#preguntas" data-toggle="tab">Preguntas</a>
                                </li>
                                <li class="nav-item">
                                    <a id="aportes-tab" class="nav-link" href="#aportes" data-toggle="tab">Aportes</a>
                                </li>
                                <li class="nav-item">
                                    <a id="marcadores-tab" class="nav-link" href="#marcadores" data-toggle="tab">Marcadores</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content px-5 py-4">
                            <div id="contenido" class="tab-pane fade show active">                                
                                <div class="border border-secondary px-4 py-3 mb-4 row">
                                    <div class="col-12">                                                                                 
                                        <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Introduce un título para la sección" required>
                                    </div>
                                    
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                </div>
                                <div class="border border-secondary px-4 py-3 mb-4 row">
                                    <div class="col-12">                                                                                 
                                        <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Introduce un título para la sección" required>
                                    </div>
                                    
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                </div>
                                <div class="border border-secondary px-4 py-3 mb-4 row">
                                    <div class="col-12">                                                                                 
                                        <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Introduce un título para la sección" required>
                                    </div>
                                    
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                    <div class="col-3 my-3">
                                        <div class="card border border-secondary rounded-top">
                                            <div class="card-header bg-success"></div>
                                            <div class ="p-4">
                                                <input class="form-control" type="text" name="nombreSeccion" id="nombreSeccion" placeholder="Título para tu clase" required>
                                            </div>
                                        </div>                         
                                    </div>
                                </div>
                            </div>
                            <div id="preguntas" class="tab-pane fade"></div>
                            <div id="aportes" class="tab-pane fade"></div>
                            <div id="marcadores" class="tab-pane fade"></div>
                        </div>
                    </div>
                </div>
                <div class="form-row mt-5">
                    <div class="col-12 text-center">
                        <input class="btn btn-primary" type="submit" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
