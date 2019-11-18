<div class="container">
    <div class="row">
        <div class="col">
            <form id="registro" class="my-5" enctype="multipart/form-data">
                <h1 class="text-center mb-4">Regístrate</h1>
                <div class="form-group mt-5">
                    <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Usuario"
                           required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" id="password"
                           placeholder="Contraseña" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="confirmarPassword" id="confirmarPassword"
                           placeholder="Confirmar contraseña" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="nombres" id="nombres"
                           placeholder="Nombres" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="apellidos" id="apellidos"
                           placeholder="Apellidos" required>
                </div>
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
                <div class="form-group">
                    <input class="form-control" type="text" name="preguntaSeguridad" id="preguntaSeguridad"
                           placeholder="Pregunta de seguridad" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="respuestaSeguridad" id="respuestaSeguridad"
                           placeholder="Respuesta de seguridad" required>
                </div>
                <div class="form-group">
                    <label class="btn btn-primary" for="foto">Foto de perfil</label>
                    <input type="file" name="foto" id="foto">
                </div>
                <div class="form-group">
                    <select class="form-control" name="pais" id="pais"></select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="ciudad" id="ciudad"></select>
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

    listarCiudades();
    listarPaises();

    function listarPaises() {
        fetch('../clase/Pais/')
            .then(res => {
                res.json().then(data => {
                    let $pais = document.getElementById('pais');
                    let html = '';
                    data.forEach(pais => {
                        html += `
                            <option value="${pais.id}">${pais.nombre}</option>
                        `;
                    });
                    $pais.innerHTML = html;
                })
            });
    }

    function listarCiudades() {
        fetch('../clase/Ciudad/')
            .then(res => {
                res.json().then(data => {
                    let $ciudad = document.getElementById('ciudad');
                    let html = '';
                    data.forEach(ciudad => {
                        html += `
                            <option value="${ciudad.id}">${ciudad.nombre}</option>
                        `;
                    });
                    $ciudad.innerHTML = html;
                })
            });
    }

</script>