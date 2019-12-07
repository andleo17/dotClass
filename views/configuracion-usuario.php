<?php
    $paises = Pais ::listar();
    $ciudades = Ciudad ::listar();
?>
<div class="container my-5">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Edita tu perfil</h1>
        </div>
        <div class="col">
            <form id="formulario" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div class="form-group mt-3">
                            <label class="position-relative" for="btnSubirFoto">
                                <img id="imagen-usuario"
                                     class="rounded-circle"
                                     src="<?= SERVER_URL . "uploads/perfiles/{$usuario -> foto}" ?>"
                                     alt="">
                                <span id="editar-hover">
                                    <i class="far fa-edit"></i>
                                </span>
                            </label>
                            <input type="file" name="foto" id="btnSubirFoto">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="txtNickname">Nickname</label>
                            <input class="form-control" id="txtNickname" type="text"
                                   value="<?= $usuario -> nickname ?>" name="nickname">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="txtNombres">Nombres</label>
                                <input class="form-control" id="txtNombres" type="text"
                                       value="<?= $usuario -> nombres ?>" name="nombres">
                            </div>
                            <div class="form-group col-6">
                                <label for="txtApellidos">Apellidos</label>
                                <input class="form-control" id="txtApellidos" type="text"
                                       value="<?= $usuario -> apellidos ?>" name="apellidos">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">E-mail</label>
                            <input class="form-control" id="txtEmail" type="email" value="<?= $usuario -> email ?>"
                                   name="email">
                        </div>
                        <div class="form-group">
                            <label for="txtFechaNacimiento">Fecha de nacimiento</label>
                            <input class="form-control" id="txtFechaNacimiento" type="date"
                                   value="<?= $usuario -> fechaNacimiento ?>" name="fechaNacimiento">
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripcion</label>
                            <textarea class="form-control" id="txtDescripcion"
                                      name="descripcion"><?= $usuario -> descripcion ?></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="txtPregunta">Pregunta de seguridad</label>
                                <input class="form-control" id="txtPregunta" type="text"
                                       value="<?= $usuario -> preguntaSeguridad ?>" name="preguntaSeguridad">
                            </div>
                            <div class="form-group col-6">
                                <label for="txtRespuesta">Respuesta de seguridad</label>
                                <input class="form-control" id="txtRespuesta" type="text"
                                       value="<?= $usuario -> respuestaSeguridad ?>" name="respuestaSeguridad">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="cboPais">País</label>
                                <select class="form-control" id="cboPais" name="pais">
                                    <?php foreach ($paises as $pais) { ?>
                                        <option value="<?= $pais -> id ?>" <?= $pais -> id == $usuario -> pais -> id ? 'selected' : '' ?>><?= $pais -> nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="cboCiudad">Ciudad</label>
                                <select class="form-control" id="cboCiudad" name="ciudad">
                                    <?php foreach ($ciudades as $ciudad) { ?>
                                        <option value="<?= $ciudad -> id ?>" <?= $ciudad -> id == $usuario -> ciudad -> id ? 'selected' : '' ?>><?= $ciudad -> nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtPassword">Contraseña</label>
                            <input class="form-control" id="txtPassword" type="password"
                                   value="<?= $usuario -> password ?>" name="password">
                        </div>
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
                                    <?php foreach (Conocimiento ::listar($usuario -> id) as $conocimiento) { ?>
                                        <div class="col-12 my-2">
                                            <div class="card p-4">
                                                <div class="form-group">
                                                    <label for="txtNombreConocimiento[<?= $conocimiento -> id ?>]">Nombre</label>
                                                    <input class="form-control" type="text"
                                                           id="txtNombreConocimiento[<?= $conocimiento -> id ?>]"
                                                           name="nombreConocimiento[<?= $conocimiento -> id ?>]"
                                                           value="<?= $conocimiento -> nombre ?>">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtLugarEstudio[<?= $conocimiento -> id ?>]">Lugar
                                                            de estudio</label>
                                                        <input class="form-control" type="text"
                                                               id="txtLugarEstudio[<?= $conocimiento -> id ?>]"
                                                               name="lugarEstudio[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> lugarEstudio ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="cboPaisConocimiento[<?= $conocimiento -> id ?>]">Pais</label>
                                                        <select class="form-control"
                                                                id="cboPaisConocimiento[<?= $conocimiento -> id ?>]"
                                                                name="paisConocimiento[<?= $conocimiento -> id ?>]">
                                                            <?php foreach ($paises as $pais) { ?>
                                                                <option value="<?= $pais -> id ?>" <?= $pais -> id == $conocimiento -> pais -> id ? 'selected' : '' ?>><?= $pais -> nombre ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtGradoConocimiento[<?= $conocimiento -> id ?>]">Grado
                                                            de conocimiento</label>
                                                        <input class="form-control" type="text"
                                                               id="txtGradoConocimiento[<?= $conocimiento -> id ?>]"
                                                               name="gradoConocimiento[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> gradoAcademico ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="txtAnioConocimiento[<?= $conocimiento -> id ?>]">Año</label>
                                                        <input class="form-control" type="number"
                                                               id="txtAnioConocimiento[<?= $conocimiento -> id ?>]"
                                                               name="anioConocimiento[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> anio ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                                    <?php foreach (ExperienciaLaboral ::listar($usuario -> id) as $experiencia) { ?>
                                        <div class="col-12 my-2">
                                            <div class="card p-4">
                                                <div class="form-group">
                                                    <label for="txtNombreExp[<?= $experiencia -> id ?>]">Nombre</label>
                                                    <input class="form-control" type="text"
                                                           id="txtNombreExp[<?= $experiencia -> id ?>]"
                                                           name="nombreExp[<?= $experiencia -> id ?>]"
                                                           value="<?= $experiencia -> nombre ?>">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtLugarExp[<?= $experiencia -> id ?>]">Lugar</label>
                                                        <input class="form-control" type="text"
                                                               id="txtLugarExp[<?= $experiencia -> id ?>]"
                                                               name="lugarExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> lugar ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="cboPaisExp[<?= $experiencia -> id ?>]">Pais</label>
                                                        <select class="form-control"
                                                                id="cboPaisExp[<?= $experiencia -> id ?>]"
                                                                name="paisExp[<?= $experiencia -> id ?>]">
                                                            <?php foreach ($paises as $pais) { ?>
                                                                <option value="<?= $pais -> id ?>" <?= $pais -> id == $experiencia -> pais -> id ? 'selected' : '' ?>><?= $pais -> nombre ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtFechaInicioExp[<?= $experiencia -> id ?>]">Fecha
                                                            inicio</label>
                                                        <input class="form-control" type="date"
                                                               id="txtFechaInicioExp[<?= $experiencia -> id ?>]"
                                                               name="fechaInicioExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> fechaInicio ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="txtFechaFinExp[<?= $experiencia -> id ?>]">Fecha
                                                            fin</label>
                                                        <input class="form-control" type="date"
                                                               id="txtFechaFinExp[<?= $experiencia -> id ?>]"
                                                               name="fechaFinExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> fechaFin ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                <div class="form-row">
                    <div class="col-12 text-center">
                        <input class="btn btn-primary" type="submit" value="Guardar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    let $formulario = document.getElementById('formulario');
    $formulario.onsubmit = e => {
        e.preventDefault();
        fetch('../../clase/Usuario/editar', {
            method: 'POST',
            body: new FormData($formulario)
        }).then(res => res.text().then(data => {
            if (data == 1) {
                window.location = 'http://localhost/dotclass/';
            }
        }))
    }
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