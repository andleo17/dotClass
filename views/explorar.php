<div class="container">
    <h1>Explora nuestro catálogo de cursos que tenemos para ti</h1>
    <p>En dotClass queremos que nuestros usuarios aprendan lo que sea cuando deseen, es por ello que abarcamos todos
        los temas de estudios más relevantes que puedas encontrar.</p>
    <div id="lista-categoria" class="card-list margin-bottom"></div>
</div>

<script>
    fetch('../clase/Categoria/').then(res => {
        res.json().then(data => {
            let $listaCategoria = document.getElementById('lista-categoria');
            let html = '';
            data.forEach(categoria => {
                html += `
                <a href="categoria.html" class="card animate-pop-in">
                    <div class="card-header">
                        <img src="../assets/${categoria.logo}" alt="logo">
                        <span class="titulo-curso">${categoria.nombre}</span>
                    </div>
                    <div class="card-body">
                        <p>${categoria.descripcion}</p>
                    </div>
                </a>`;
            });
            $listaCategoria.innerHTML = html;
        })
    });
</script>