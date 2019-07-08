
var listaCursos = [
    [1, "Java Avanzado", 128.99, "https://static.platzi.com/media/learningpath/badges/Badge-desarrollo-java.png", 
    "En este curso aprenderás el lenguaje de programación más demandado por el sector empresarial y el mejor remunerado en la actualidad.", "andleo17"],
    [2, "React", 130.00, "https://static.platzi.com/media/achievements/badge-reactjs-avanzado-bc9f61e9-9a1a-485b-b0ad-43a172cdb0aa.png",
    "React es una de las librerías más utilizadas hoy para crear aplicaciones web. Aprende desde la creación y diseño de componentes hasta traer datos de un API. Desarrolla aplicaciones web de muy alta calidad en tiempo record con React.js", "sofipaoms"],
    [3, "Java SE Básico", 250.00, "https://static.platzi.com/media/achievements/1222-434ce348-c008-4386-b0fc-edc18b8ec5e7.png",
    "Java es un lenguaje de programación con el que puedes desarrollar software multiplataforma gracias a la JVM (Máquina Virtual de Java). Aprende las características fundamentales del lenguaje y desarrolla tus propios proyectos.", "bleach19"],
    [4, "HTML y CSS3", 400.00, "https://static.platzi.com/media/achievements/badges-html-css-b0a71550-d5e7-4e27-aca2-f09f1321a517.png",
    "Aprende a crear sitios web con HTML y CSS. Profundiza en el desarrollo y personalización de páginas web navegables, intuitivas y a la medida de tus necesidades. Crea tus primeros proyectos con Platzi.", "anncode"],
    [5, "Python", 180.00, "https://static.platzi.com/media/achievements/1378-6fbee8c2-fb79-45db-bd28-d25878a0104c.png",
    "Domina la nueva versión de Python 3. Aprende los fundamentos y sintaxis del lenguaje Python y su instalación en todos los sistemas operativos. Forma las bases para especializarte en web con Django o en bases de datos y da un paso para convertirte en un gran desarrollador.", "sofiapaoms"],
    [6, "Angular", 95.00, "https://static.platzi.com/media/achievements/1340-7609a8dc-f858-4863-abeb-02a7dbbf59c1.png",
    "Desarrolla aplicaciones Web modulares e interactivas con Angular 6, el framework de Javascript, desarrollado y soportado por Google, que te permite crear aplicaciones SPA. Aprende a crear apps y mejora tus habilidades con Angular 6.", "sspacecowbboy"],
    [7, "PostgreSQL", 190.00, "https://static.platzi.com/media/achievements/badges-postgresql-2b631b5d-dcf4-4eec-8766-cea5196eb327.png",
    "Sabemos que diseñar y administrar bases de datos no es suficiente: aprovecha la libertad de acceso y personalización de PostgreSQL. Consigue una velocidad estable, procesos seguros y gran capacidad de almacenamiento.", "anncode"],
    [8, "Android", 250.00, "https://static.platzi.com/media/achievements/1049-ccf7d815-1c7d-4e1e-8cd4-d50369c96c7c.png",
    "Aprende a desarrollar aplicaciones Android de manera nativa con Java y Kotlin. Implementa notificaciones, almacenamiento y genera aplicaciones robustas con Firebase.", "theeagle"]
];

var carrito = [];

$(document).ready(function () {
    listarCursos();
});

function listarCursos() {
    $(".card-list").html("");
    listaCursos.forEach(c => {
        curso = '<div class="card">';
        curso +=    '<a class="card-header" href="curso.html">';
        curso +=        '<img src="' + c[3] + '" alt="logo"></img>';
        curso +=        '<span class="titulo-curso">' + c[1] + '</span>';
        curso +=    '</a>';
        curso +=    '<div class="card-body"><p>' + c[4] + '</p></div>';
        curso +=    '<div class="card-footer">';
        curso +=        '<span><b>Docente:</b>' + c[5] + '</span>';
        curso +=        '<span><b>Duración:</b>25 h</span>';
        curso +=        '<div class="card-rating"><span>1.2K subscriptores</span><span class="clasificacion"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></span></div>';
        curso +=    '</div>';
        curso +=    '<div class="card-button"><span>S/ ' + c[2] + '</span><a href="" class="btnAgregarCarrito">Añadir a carrito</a></div></div>';
        $(".card-list").append(curso);
    });
}

// barra desplegable
function mostrar() {
    document.getElementById("curso_content").style.display = "flex";
    document.getElementById("video_box").style.gridTemplateColumns = "20% 60% 20%";
    document.getElementById("mostrar_contenido").style.display = "none";
    document.getElementById("barra_mostrar").style.display = "none";
    document.getElementById("ocultar_contenido").style.display = "inline";
    document.getElementById("barra_ocultar").style.display = "inline";
}

function ocultar() {
    document.getElementById("video_box").style.gridTemplateColumns = "70% 30% ";
    document.getElementById("curso_content").style.display = "none";
    document.getElementById("mostrar_contenido").style.display = "inline";
    document.getElementById("barra_mostrar").style.display = "inline";
    document.getElementById("ocultar_contenido").style.display = "none";
    document.getElementById("barra_ocultar").style.display = "none";
}

