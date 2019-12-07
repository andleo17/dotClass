<?php
    $paises = Pais ::listar();
    $ciudades = Ciudad ::listar();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <form id="registro" class="my-5" enctype="multipart/form-data">
                <h1 class="text-center mb-4">Regístrate</h1>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Usuario"
                            required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="Contraseña" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="password" name="confirmarPassword" id="confirmarPassword"
                            placeholder="Confirmar contraseña" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="nombres" id="nombres"
                            placeholder="Nombres" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="apellidos" id="apellidos"
                            placeholder="Apellidos" required>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" id="email"
                           placeholder="E-mail" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="fechaNacimiento" id="fechaNacimiento"
                           placeholder="Fecha de nacimiento" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="descripcion" id="descripcion"
                              placeholder="Descripcion"></textarea>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="text" name="preguntaSeguridad" id="preguntaSeguridad"
                            placeholder="Pregunta de seguridad" required>
                    </div>
                    <div class="col">
                        <input class="form-control" type="text" name="respuestaSeguridad" id="respuestaSeguridad"
                            placeholder="Respuesta de seguridad" required>
                    </div>                    
                </div>
                <br>
                <div class="row">                    
                    <div class="col">
                        <select class="form-control" name="pais" id="pais">
                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?= $pais -> id ?>"><?= $pais -> nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-control" name="ciudad" id="ciudad">
                            <?php foreach ($ciudades as $ciudad) { ?>
                                <option value="<?= $ciudad -> id ?>"><?= $ciudad -> nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-12">
                        <img id="imagen-usuario"
                             class="my-4 rounded-circle"
                             src=""
                             alt="">
                    </div>
                    <div class="col">
                        <label class="btn btn-primary" for="btnSubirFoto">Foto de perfil</label>
                        <input type="file" class="form-control-file" name="foto" id="btnSubirFoto">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="trayectoria-tab" data-toggle="tab" href="#trayectoria">Trayectoria
                                    académica</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="experiencia-tab" data-toggle="tab" href="#experiencia">Experiencia
                                    laboral</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="trayectoria">
                                <div id="conocimientos" class="form-row my-4">
                                    <div class="col-12">
                                        <h2 class="text-center">Trayectoria académica</h2>
                                    </div>
                                </div>
                                <div class="col-12 p-0 my-4">
                                    <button id="agregar-trayectoria" class="agregar-config" type="button">Agregar
                                        trayectoria
                                        académica
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="experiencia">
                                <div id="experiencias" class="form-row my-4">
                                    <div class="col-12">
                                        <h2 class="text-center">Experiencia laboral</h2>
                                    </div>
                                </div>
                                <div class="col-12 p-0 my-4">
                                    <button id="agregar-experiencia" class="agregar-config" type="button">Agregar
                                        experiencia laboral
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="errores"></div>
                <div class="d-flex flex-column mt-5">
                    <a href="../inicio-sesion/">Ya tengo una cuenta.</a>
                </div>
                <button type="submit" class="btn btn-success mt-3">Registrarse</button>
            </form>
        </div>
    </div>
</div>

<script>
    let $registro = document.getElementById('registro');
    $registro.onsubmit = e => {
        e.preventDefault();
        fetch('../clase/Usuario/crear', {
            method: 'POST',
            body: new FormData($registro)
        }).then(res => {
            res.text().then(data => {
                if (data) {
                    if (data == 1) {
                        location.href = 'http://localhost/dotclass/inicio-sesion/';
                    }
                } else {
                    let $errores = document.getElementById('errores');
                    $errores.classList.add('mt-3', 'alert', 'alert-danger');
                    $errores.innerText = data;
                }
            })
        });
    };

</script>
<script>
    let btnAgregarConocimientos = document.getElementById('agregar-trayectoria');
    let btnAgregarExperiencias = document.getElementById('agregar-experiencia');
    let i = -1;
    let j = -1;
    btnAgregarConocimientos.onclick = e => {
        let $conocimientos = document.getElementById('conocimientos');
        let $div = document.createElement('div');
        $div.classList.add('col-12', 'my-2');
        $div.innerHTML = `
            <div class="card p-4">
                <div class="form-group">
                    <label for="txtNombreConocimiento[${i}]">Nombre</label>
                    <input class="form-control" type="text"
                           id="txtNombreConocimiento[${i}]"
                           name="nombreConocimiento[${i}]"
                           value="">
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="txtLugarEstudio[${i}]">Lugar
                            de estudio</label>
                        <input class="form-control" type="text"
                               id="txtLugarEstudio[${i}]"
                               name="lugarEstudio[${i}]"
                               value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="cboPaisConocimiento[${i}]">Pais</label>
                        <select class="form-control"
                                id="cboPaisConocimiento[${i}]"
                                name="paisConocimiento[${i}]">
                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?= $pais -> id ?>"><?= $pais -> nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="txtGradoConocimiento[${i}]">Grado
                            de conocimiento</label>
                        <input class="form-control" type="text"
                               id="txtGradoConocimiento[${i}]"
                               name="gradoConocimiento[${i}]"
                               value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="txtAnioConocimiento[${i}]">Año</label>
                        <input class="form-control" type="number"
                               id="txtAnioConocimiento[${i}]"
                               name="anioConocimiento[${i}]"
                               value="">
                    </div>
                </div>
            </div>
        `;
        $conocimientos.append($div);
        i--;
    };

    btnAgregarExperiencias.onclick = e => {
        let $experiencias = document.getElementById('experiencias');
        let $div = document.createElement('div');
        $div.classList.add('col-12', 'my-2');
        $div.innerHTML = `
            <div class="card p-4">
                <div class="form-group">
                    <label for="txtNombreExp[${j}]">Nombre</label>
                    <input class="form-control" type="text"
                           id="txtNombreExp[${j}]"
                           name="nombreExp[${j}]"
                           value="">
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="txtLugarExp[${j}]">Lugar</label>
                        <input class="form-control" type="text"
                               id="txtLugarExp[${j}]"
                               name="lugarExp[${j}]"
                               value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="cboPaisExp[${j}]">Pais</label>
                        <select class="form-control"
                                id="cboPaisExp[${j}]"
                                name="paisExp[${j}]">
                            <?php foreach ($paises as $pais) { ?>
                                <option value="<?= $pais -> id ?>"><?= $pais -> nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="txtFechaInicioExp[${j}]">Fecha
                            inicio</label>
                        <input class="form-control" type="date"
                               id="txtFechaInicioExp[${j}]"
                               name="fechaInicioExp[${j}]"
                               value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="txtFechaFinExp[${j}]">Fecha
                            fin</label>
                        <input class="form-control" type="date"
                               id="txtFechaFinExp[${j}]"
                               name="fechaFinExp[${j}]"
                               value="">
                    </div>
                </div>
            </div>
            `;
        $experiencias.append($div);
        j--;
    }
</script>
<script>
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = e => {
                let $imagenUsuario = document.getElementById('imagen-usuario');
                $imagenUsuario.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    var fileUpload = document.getElementById('btnSubirFoto');
    fileUpload.onchange = e => {
        readFile(e.target);
    }
</script>
