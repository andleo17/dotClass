<?php
    require_once 'php/Usuario.php';
    require_once 'php/ExperienciaLaboral.php';
    require_once 'php/Conocimiento.php';
    require_once 'php/config.php';
    
    $usuario = Usuario :: listar();        
    $categoria = Categoria :: listar();
    $curso = Curso :: listar();
    
?>

<div class="container-fluid my-4">
    <div class="col-12">
        <div id="felicidades" class="m-3"></div>
    </div> 
    <div class="card rounded-0">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#categoria" role="tab" data-toggle="tab">Categoría</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#Usuario" role="tab" data-toggle="tab">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#curso" role="tab" data-toggle="tab">Cursos</a>

            </li>
        </ul>
        <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade show active" id="categoria">                     
                    <div class="row m-3"> 
                        <button type='button' class='btn btn-success' data-toggle="modal" data-target="#divCat" '>Agregar</button>                        
                    </div>
                                  
                    <div class="row m-3">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr class="d-flex">                                                                                                              
                                    <th class="col-2">Nombre</th>
                                    <th class="col-6">Descripción</th>
                                    <th class="col-2">Logo</th>
                                    <th class="col-2">Opciones </th>                                                                     
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($categoria != []) { ?>                                
                                <?php foreach ($categoria as $cat) { ?>
                                <tr  class="d-flex">                                                                                 
                                    <td class="col-2"><?= "{$cat -> nombre}"?></td>
                                    <td class="col-6"><?= "{$cat -> descripcion}"?></td>
                                    <td class="col-2"><?= "{$cat -> logo}"?></td>
                                    <td class="col-2">
                                        <button type='button' class='btn btn-info' data-toggle="modal" data-target="#divCat" onclick= 'divCat(<?= "{$cat -> id}"?>)'>Editar</button>
                                        <button type='button' class='btn btn-danger' onclick= 'elimCat(<?= "{$cat -> id}"?>)'>X</button>
                                    </td>
                                </tr>                                  
                                <?php }
                            } ?> 
                            </tbody>
                        </table>
                    </div>                                           
                </div>
                <div role="tabpanel" class="tab-pane fade" id="Usuario">
                    <!--<div id="divbuscar">
                        <input type="text" name="txtbuscar" id="txtbuscar" class="form-control" 
                            placeholder="Escribe aquí para buscar un usuario" >
                    </div> <br> -->
                    <div class="row m-3"> 
                        <button type='button' class='btn btn-success' onclick="location.href='<?php echo SERVER_URL ?>registro/'" '>Agregar</button>
                        
                    </div>                  
                    <div class="row m-3">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>                                                                                                              
                                    <th>Nickname</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Email</th>
                                    <th>Lugar de Procedencia</th>
                                    <th>Opciones </th>                                                                     
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($usuario != []) { ?>                                
                                <?php foreach ($usuario as $user) { ?>
                                <tr>                                                                                 
                                    <td><?= "{$user -> nickname}"?></td>
                                    <td><?= "{$user -> nombres} {$user -> apellidos}"?></td>
                                    <td><?= "{$user -> fechaNacimiento}" ?></td>
                                    <td><?= "{$user -> email}"?></td>
                                    <td><?= "{$user -> ciudad -> nombre}, {$user -> pais -> nombre}" ?></td>
                                    <td>
                                        <button type='button' class='btn btn-info' data-toggle="modal" data-target="#divUsu" onclick= 'divUsu(<?= "{$user -> id}"?>)'>Editar</button>
                                        <button class='btn btn-danger' type='button'>X</button>
                                    </td>
                                </tr>                                  
                                <?php }
                            } ?> 
                            </tbody>
                        </table>
                    </div>                     
                </div>                    
                <div role="tabpanel" class="tab-pane fade" id="curso">
                    <!--<div id="divbuscar">
                        <input type="text" name="txtbuscar" id="txtbuscar" class="form-control" 
                            placeholder="Escribe aquí para buscar un usuario" >
                    </div> <br> -->
                    <div class="row m-3">                                        
                        <button type='button' class='btn btn-success' onclick="location.href='<?php echo SERVER_URL ?>agregar-curso/'" '>Agregar</button>
                        
                    </div>                  
                    <div class="row m-3">
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
                                <tr class="d-flex" id="<?= "{$cur -> id}"?>" name="<?= "{$cur -> id}"?>">                                                                                 
                                    <td class="col-1"><?= "{$cur -> titulo}"?></td>
                                    <td class="col-4"><?= "{$cur -> descripcion}"?></td>
                                    <td class="col-2"><?= "{$cur -> categoria -> nombre}" ?></td>
                                    <td class="col-2"><?= "{$cur -> logo}"?></td>
                                    <td class="col-1"><?= "{$cur -> usuario -> nickname}" ?></td>
                                    <td class="col-2">
                                    <a role="button" class='btn btn-info' style="color: white;" href="<?= SERVER_URL . 'curso/' . $cur -> id . '/editar' ?>">Editar</a>
                                        <button class='btn btn-danger' type='button'>X</button>
                                    </td>
                                </tr>                                  
                                <?php }
                            } ?> 
                            </tbody>
                        </table>
                    </div>
                </div>                
        </div>
    </div>

    <div class="modal fade" id="divCat" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Categoría</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
          <form id="registroCat" enctype="multipart/form-data">            
            <div class="modal-body">	
                    <div class="form-group">
                        <label for="txtprecio">Nombre</label>
                        <input type="text" class="form-control" name="txtnombre" id="txtnombre" >
                    </div>
                    <div class="form-group">
                        <label for="txtdescripcion">Descripción</label>
                        <input type="text" class="form-control" name="txtdescripcion" id="txtdescripcion" >
                    </div>
                    <div class="form-group">
                        <label for="txtlogo">Logo:</label>
                        <input type="text" class="form-control" name="txtlogo" id="txtlogo" >
                    </div>                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>
          </form>
	    </div>
	  </div>
    </div>
    
    <div class="modal fade" id="divUsu" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-body">
	        <form>            
	        	<div class="form-group">
				    <label for="txtNickname">Nickname</label>
				    <input type="text" class="form-control" name="txtNickname" id="txtNickname" >
				</div>
				<div class="form-group">
				    <label for="txtnombreU">Nombres</label>
				    <input type="text" class="form-control" name="txtnombreU" id="txtnombreU" >
                </div>
                <div class="form-group">
				    <label for="txtApellido">Apellidos</label>
				    <input type="text" class="form-control" name="txtApellido" id="txtApellido" >
                </div>
                <div class="form-group">
				    <label for="txtFecha">Fecha Nacimiento</label>
				    <input type="date" class="form-control" name="txtFecha" id="txtFecha" >
                </div> 
                <div class="form-group">
				    <label for="txtCorreo">Correo Electronico</label>
				    <input type="text" class="form-control" name="txtCorreo" id="txtCorreo" >
                </div>
                <div class="form-group">
                <label for="cbopais">País</label>
                    <select class="form-control" name="cboPais" id="cboPais" >
                        <?php foreach (Pais ::listar() as $pais) { ?>
                            <option value="<?= $pais -> id ?>"><?= $pais -> nombre ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                <label for="cbociudad">Ciudad</label>
                    <select class="form-control" name="cboCiudad" id="cboCiudad">
                        <?php foreach (Ciudad ::listar() as $ciu) { ?>
                            <option value="<?= $ciu -> id ?>"><?= $ciu -> nombre ?></option>
                        <?php } ?>
                    </select>
                </div>          
            </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

    <div class="modal fade" id="divCur" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Curso</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-body">
	        <form>            
	        	<div class="form-group">
                    <label for="txtTitulo">Título:</label>
				    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" >
				</div>
				<div class="form-group">
				    <label for="txtDescripcionCU">Descripción</label>
				    <input type="text" class="form-control" name="txtDescripcionCU" id="txtDescripcionCU" >
                </div>
                <div class="form-group">
				    <label for="txtLogoCU">Logo</label>
				    <input type="text" class="form-control" name="txtLogoCU" id="txtLogoCU" >
                </div>
                <div class="form-group">
				    <label for="txtAutor">Autor</label>
				    <input type="text" class="form-control" name="txtAutor" id="txtAutor" >
                </div>
                <div class="form-group">
                <label for="cboCategoria">Categoria</label>
                    <select class="form-control name="cboCategoria" id="cboCategoria"" >
                        <?php foreach (Categoria ::listar() as $cat) { ?>
                            <option value="<?= $cat -> id ?>"><?= $cat -> nombre ?></option>
                        <?php } ?>
                    </select>
                </div>                        
            </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="button" class="btn btn-primary" onclick="">Guardar</button>
	      </div>
	    </div>
	  </div>
	</div>

</div>

<script>
    function divCat(id){
        fetch('../clase/Categoria/' + id).then(res => res.json().then(data => {
            document.getElementById("txtnombre").value = data.nombre
            document.getElementById("txtdescripcion").value = data.descripcion
            document.getElementById("txtlogo").value = data.logo
        }))
    };
</script>
<script>
    let $registro = document.getElementById('registroCat');
    $registro.onsubmit = e => {
        e.preventDefault();
        fetch('../clase/Categoria/crear', {
            method: 'POST',
            body: new FormData($registro)
        }).then(res => {
            res.text().then(data => {
                if (data) {
                    if (data == 1) {
                        let $felicidades = document.getElementById('felicidades');
                        $felicidades.classList.add('m-2', 'alert', 'alert-warning');
                        $felicidades.innerText = "Felicidades!!... se a registrado correctamente";
                    }
                } else {
                    let $errores = document.getElementById('felicidades');
                    $errores.classList.add('m-2', 'alert', 'alert-danger');
                    $errores.innerText = "Se a producido un error al registrar!!";
                }
            })
        });
    };

</script>
<script>
    function elimCat(id){
        fetch('../clase/Categoria/eliminar' + id,{
            method: 'POST',
            body: {id}
        }).then(res => res.json().then(data => {
            if (data) {
                if (data == 1) {
                    let $felicidades = document.getElementById('felicidades');
                    $felicidades.classList.add('m-2', 'alert', 'alert-warning');
                    $felicidades.innerText = "Felicidades!!... se a eliminado correctamente";
                }
            } else {
                let $errores = document.getElementById('felicidades');
                $errores.classList.add('m-2', 'alert', 'alert-danger');
                $errores.innerText = "Se a producido un error al eliminar!!";
            }
        }))
    };
</script>

<script>
    function divUsu(id){
        fetch('../clase/Usuario/' + id).then(res => res.json().then(data => {
            document.getElementById("txtNickname").value = data.nickname
            document.getElementById("txtnombreU").value = data.nombres
            document.getElementById("txtApellido").value = data.apellidos
            document.getElementById("txtFecha").value = data.fechaNacimiento
            document.getElementById("txtCorreo").value = data.email
            document.getElementById("cboPais").value = data.pais.id
            document.getElementById("cboCiudad").value = data.ciudad.id
        }))
    };
</script>

<script>
    function divCur(id){
        fetch('../clase/Curso/' + id).then(res => res.json().then(data => {
            document.getElementById("txtTitulo").value = data.titulo
            document.getElementById("txtDescripcionCU").value = data.descripcion
            document.getElementById("txtLogoCU").value = data.logo
            document.getElementById("cboCategoria").value = data.categoria.id
            document.getElementById("txtAutor").value = data.usuario.nickname
        }))
    };
</script>