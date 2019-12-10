<?php
    require_once 'php/Usuario.php';
    require_once 'php/ExperienciaLaboral.php';
    require_once 'php/Conocimiento.php';
    require_once 'php/config.php';
   
    $curso = Curso :: listarCursosUsuario($_SESSION['usuario'] -> id);
    $cursosUsuario = Usuario ::listarEnseñanza($curso -> usuario -> id);   
?>

<div class="container my-4">
    <div class="row m-3">
        <div class="col">
            <a role="button" class="btn btn-success" href="<?= SERVER_URL ?>agregar-curso/">Agregar</a>
        </div>
    </div>

    <?php if (count($cursosUsuario) > 0) { ?>
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

</div>