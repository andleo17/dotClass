<div class="container">
    <div class="row">
        <div class="offset-lg-3 offset-md-2 col-lg-6 col-md-8">
            <form id="inicio-sesion" class="border border-secondary rounded p-5">
                <h1 class="text-center mb-4">Acceder</h1>
                <div class="form-group mt-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Usuario"
                               required autofocus>
                        <hr>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        <input class="form-control" type="password" name="password" id="password"
                               placeholder="Contraseña" required>
                    </div>
                </div>
                <div id="errores"></div>
                <div class="d-flex flex-column mt-5">
                    <a href="">¿Olvidaste la contraseña?</a>
                    <a href="../registro/">Crear cuenta.</a>
                </div>
                <button type="submit" class="btn btn-success mt-3">INGRESAR</button>
            </form>
        </div>
    </div>
</div>

<script>
    let $inicioSesion = document.getElementById('inicio-sesion');
    $inicioSesion.onsubmit = e => {
        e.preventDefault();
        fetch('../clase/Usuario/login', {
            method: 'POST',
            body: new FormData($inicioSesion)
        }).then(res => {
            res.json().then(data => {
                if (data) {
                    location.href = 'http://localhost/dotclass/';
                } else {
                    let $errores = document.getElementById('errores');
                    $errores.classList.add('mt-3', 'alert', 'alert-danger');
                    $errores.innerText = 'Usuario y/o contraseña incorrectos';
                }
            })
        });
    }
</script>