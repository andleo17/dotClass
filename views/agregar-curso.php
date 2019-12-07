
    <div class="container">
        <div class="informacion-curso">
            <div class="icono-curso">
                <i class="far fa-image"></i>
                <label for="cargar-foto">Agregar ícono</label>
                <input type="file" name="cargar-foto" id="cargar-foto"></input>
            </div>
            <div class="curso-titulo">
                <input type="text" name="txtTituloCurso" id="txtTituloCurso" placeholder="Título del curso">
                <textarea name="txtDescripcionCurso" id="txtDescripcionCurso"
                    placeholder="Descripción del curso"></textarea>
            </div>
        </div>
        <div class="precursos">
            <span>Plan de estudios:</span>
            <div class="lista-pre">
                <a href="" id="agregar-pre">
                    <i class="fas fa-plus"></i>
                    <span>Agregar curso prerequisito</span>
                </a> 
                <div class="form-group col-6">
                    <label for="cboCursos">Cursos</label>
                    <select class="form-control" id="cboCursos" name="cursos">
                        <?php foreach ($cursos as $curso) { ?>
                            <option value="<?= $curso -> id ?>" <?= $curso -> id == $usurso -> curso -> id ? 'selected' : '' ?>><?= $curso -> titulo ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="contenido-curso">
            <span>Contenido:</span>
            <div class="lista-contenido">
                <div class="curso-seccion">
                    <div class="curso-seccion-titulo">
                        <span>Título del curso</span>
                        <a href="" class="editar"><i class="fas fa-pen"></i></a>
                    </div>
                    <div class="clases">
                        <a href="" id="agregar-clase">
                            <i class="fas fa-plus"></i>
                            <span>Agregar clase</span>
                        </a>
                    </div>
                </div>
                <a href="" id="agregar-seccion">
                    <i class="fas fa-plus"></i>
                    <span>Agregar sección</span>
                </a>
            </div>
        </div>
        <div class="boton-container">
            <a href="" class="guardar-cambios">Guardar cambios</a>
        </div>
    </div>