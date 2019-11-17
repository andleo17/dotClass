<div class="container centrado">
    <form id="inicio-sesion">
        <span>Acceder</span>
        <div class="datos-usuario">
            <div>
                <i class="fas fa-user"></i>
                <input type="text" name="nickname" id="nickname" placeholder="Usuario">
                <hr>
            </div>
            <div>
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <hr>
            </div>
        </div>
        <div class="extras">
            <a href="olvidar-contrasena.html">¿Olvidaste la contraseña?</a>
            <a href="registro.html">Crear cuenta.</a>
        </div>
        <button type="submit" class="btnIngresar">INGRESAR</button>
    </form>
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
                sessionStorage.setItem('usuario', JSON.stringify(data));
                location.href = 'http://localhost/dotclass/';
            })
        });
    }
</script>