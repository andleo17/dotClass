<div class="container my-5">
    <div class="row">
        <div class="col-12 mb-3">
            <h1>Edita tu perfil</h1>
        </div>
        <div class="col">
            <form>
                <div class="form-row">
                    <div class="col d-flex align-items-center justify-content-center">
                        <div class="form-group mt-3">
                            <label class="position-relative" for="btnSubirFoto">
                                <img class="rounded-circle"
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
                                   value="<?= $usuario -> nickname ?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label for="txtNombres">Nombres</label>
                                <input class="form-control" id="txtNombres" type="text"
                                       value="<?= $usuario -> nombres ?>">
                            </div>
                            <div class="form-group col-6">
                                <label for="txtApellidos">Apellidos</label>
                                <input class="form-control" id="txtApellidos" type="text"
                                       value="<?= $usuario -> apellidos ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtEmail">E-mail</label>
                            <input class="form-control" id="txtEmail" type="email" value="<?= $usuario -> email ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcion">Descripcion</label>
                            <textarea class="form-control" id="txtDescripcion"><?= $usuario -> descripcion ?></textarea>
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
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="trayectoria">
                                <div class="form-row my-4">
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
                                                           name="txtNombreConocimiento[<?= $conocimiento -> id ?>]"
                                                           value="<?= $conocimiento -> nombre ?>">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtLugarEstudio[<?= $conocimiento -> id ?>]">Lugar
                                                            de estudio</label>
                                                        <input class="form-control" type="text"
                                                               id="txtLugarEstudio[<?= $conocimiento -> id ?>]"
                                                               name="txtLugarEstudio[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> lugarEstudio ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="cboPaisConocimiento[<?= $conocimiento -> id ?>]">Pais</label>
                                                        <select class="form-control"
                                                                id="cboPaisConocimiento[<?= $conocimiento -> id ?>]">
                                                            <?php foreach (Pais ::listar() as $pais) { ?>
                                                                <option value="cboPaisConocimiento[<?= $pais -> id ?>]" <?= $pais -> id == $conocimiento -> pais -> id ? 'selected' : '' ?>><?= $pais -> nombre ?></option>
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
                                                               name="txtGradoConocimiento[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> gradoAcademico ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="txtAnio[<?= $conocimiento -> id ?>]">Año</label>
                                                        <input class="form-control" type="number"
                                                               id="txtAnio[<?= $conocimiento -> id ?>]"
                                                               name="txtAnio[<?= $conocimiento -> id ?>]"
                                                               value="<?= $conocimiento -> anio ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="experiencia">
                                <div class="form-row my-4">
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
                                                           name="txtNombreExp[<?= $experiencia -> id ?>]"
                                                           value="<?= $experiencia -> nombre ?>">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <label for="txtLugarExp[<?= $experiencia -> id ?>]">Lugar</label>
                                                        <input class="form-control" type="text"
                                                               id="txtLugarExp[<?= $experiencia -> id ?>]"
                                                               name="txtLugarExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> lugar ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="cboPaisExp[<?= $experiencia -> id ?>]">Pais</label>
                                                        <select class="form-control"
                                                                id="cboPaisExp[<?= $experiencia -> id ?>]">
                                                            <?php foreach (Pais ::listar() as $pais) { ?>
                                                                <option value="cboPaisExp[<?= $pais -> id ?>]" <?= $pais -> id == $experiencia -> pais -> id ? 'selected' : '' ?>><?= $pais -> nombre ?></option>
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
                                                               name="txtFechaInicioExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> fechaInicio ?>">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="txtFechaFinExp[<?= $experiencia -> id ?>]">Fecha
                                                            fin</label>
                                                        <input class="form-control" type="date"
                                                               id="txtFechaFinExp[<?= $experiencia -> id ?>]"
                                                               name="txtFechaFinExp[<?= $experiencia -> id ?>]"
                                                               value="<?= $experiencia -> fechaFin ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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