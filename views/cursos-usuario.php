<?php
    require_once 'php/Usuario.php';
    require_once 'php/ExperienciaLaboral.php';
    require_once 'php/Conocimiento.php';
    require_once 'php/config.php';
   
    $curso = Curso :: listarCursosUsuario($_SESSION['usuario'] -> id);  
?>

<div class="container my-4">
    <div class="row my-3">
        <div class="col">
            <a role="button" class="btn btn-success" href="<?= SERVER_URL ?>agregar-curso/">Agregar</a>
        </div>
    </div>

    <?php if (count($curso) > 0) { ?>
    <table class="table">
        <thead class="thead-dark">
            <tr class="d-flex">                                                                                                              
                <th class="col-1">Título</th>
                <th class="col-4">Descripción</th>
                <th class="col-2">Categoria</th>
                <th class="col-2">Logo</th>
                <th class="col-1">Autor</th>
                <th class="col-2">Opciones </th>                                                                     
            </tr>
        </thead>
        <tbody>
        <?php if ($curso != []) { ?>                                
            <?php foreach ($curso as $cur) { ?>
            <tr class="d-flex">                                                                                 
                <td class="col-1"><?= "{$cur -> titulo}"?></td>
                <td class="col-4"><?= "{$cur -> descripcion}"?></td>
                <td class="col-2"><?= "{$cur -> categoria -> nombre}" ?></td>
                <td class="col-2"><?= "{$cur -> logo}"?></td>
                <td class="col-1"><?= "{$cur -> usuario -> nickname}" ?></td>
                <td class="col-2">
                    <a role="button" class='btn btn-success' href="<?= SERVER_URL . 'administrar-curso/' . $cur -> id . '/editar' ?>">Ver</a>
                    <button class='btn btn-danger' type='button'>X</button>
                </td>
            </tr>                                  
            <?php }
        } ?> 
        </tbody>
    </table>
    <?php } ?>
    
    <?php if (count($curso) == 0) { ?>
        <div style="height: 200px;"> 
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Usted no a registrado cursos!!</h4>
                <hr>
                <p class="mb-0"><strong>Recuerde :</strong> El conocimiento es poder, por eso le invitamos a que comparta su conocimiento con las personas</p>
            </div>
        </div>
    <?php } ?>

</div>