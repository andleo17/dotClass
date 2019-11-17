<div class="container">
    <div class="hero">
        <div class="fondo">
            <div class="imagen-fondo animate-pop-in"></div>
        </div>
        <div class="filtro"></div>
        <div class="hero-contenido">
            <h1 class="animate-pop-in">Aprende o comparte conocimientos</h1>
            <span class="animate-pop-in">Demuéstrale al mundo que puedes enseñar lo que sabes y también aprender de
                    los demás.</span>
            <a class="hero-button animate-pop-in" href="registro.html">Da tus primeros pasos</a>
        </div>
    </div>
    <div class="principal">
        <h3>Cursos más populares</h3>
        <div id="lista-cursos" class="card-list"></div>
    </div>
    <div class="principal">
        <h3>Docentes más populares</h3>
        <div id="lista-docentes" class="card-list"></div>
    </div>
</div>
<script>
    fetch('clase/Curso/').then(d => {
        d.json().then(data => {
            let $listaCursos = document.getElementById('lista-cursos');
            let html = '';
            data.forEach(c => {
                html += `
                    <div class="card">
                        <div class="card-header">
                            <img src="<?php echo SERVER_URL?>uploads/logos/${c.logo}"
                                alt="logo">
                            <a class="titulo-curso" href="curso_vista_profe.html">${c.titulo}</a>
                        </div>
                        <div class="card-body">
                            <p>${c.descripcion}</p>
                        </div>
                        <div class="card-footer">
                            <span>
                                <b>Docente:</b>${c.usuario.nombres} ${c.usuario.apellidos}
                            </span>
                            <span>
                                <b>Duración:</b>${c.duracion} h
                            </span>
                            <div class="card-rating">
                                <span>${c.numeroSubscriptores} subscriptores</span>
                                <span class="clasificacion">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                </span>
                            </div>
                        </div>
                    </div>`
            });
            $listaCursos.innerHTML = html;
        })
    });
    fetch('clase/Usuario/').then(d => {
        d.json().then(data => {
            let $listaDocentes = document.getElementById('lista-docentes');
            let html = '';
            data.forEach(docente => {
                html += `
                    <div class="card">
                    <div class="card-header">
                        <a href="perfil/${docente.nickname}" class="docente-foto">
                            <img src="uploads/perfiles/${docente.foto}">
                        </a>
                        <div class="docente-perfil">
                            <b>${docente.nickname}</b>
                            <span>${docente.numeroSeguidores} seguidores</span>
                        </div>
                    </div>
                    <div class="card-body docente-descripcion">
                        <p>${docente.descripcion}</p>
                    </div>
                    <div class="card-footer docente-datos">
                        <span>
                            <b>N° de cursos que enseña:</b>
                            15 cursos
                            <a href="perfil.html" class="flecha"><i class="fas fa-chevron-right"></i></a>
                        </span>
                        <span>
                            <b>N° de cursos que aprendió:</b>
                            19 cursos
                            <a href="perfil.html" class="flecha"><i class="fas fa-chevron-right"></i></a>
                        </span>
                        <span>
                            <b>Cursos destacados:</b>
                            <span class="docente-cursos">
                                <a href="html/curso-largo-java.html">Java desde cero</a>,
                                <a href="html/curso-largo-poo.html">Programación Orientada a Objetos (POO)</a>,
                                <a href="html/css-grid.html">CSS Grid Layout</a>
                            </span>
                        </span>
                    </div>
                </div>
                    `;
            });
            $listaDocentes.innerHTML = html;
        })
    })

</script>