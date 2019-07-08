
var listaCursos = [
    [1, "Java Avanzado", 128.99, "https://static.platzi.com/media/learningpath/badges/Badge-desarrollo-java.png", 
    "En este curso aprenderás el lenguaje de programación más demandado por el sector empresarial y el mejor remunerado en la actualidad.", "andleo17"],
    [2, "React", 130.00, "https://static.platzi.com/media/achievements/badge-reactjs-avanzado-bc9f61e9-9a1a-485b-b0ad-43a172cdb0aa.png"],
    [3, "Java SE Básico", 250.00, "https://static.platzi.com/media/achievements/1222-434ce348-c008-4386-b0fc-edc18b8ec5e7.png"],
    [4, "HTML y CSS3", 400.00, "https://static.platzi.com/media/achievements/badges-html-css-b0a71550-d5e7-4e27-aca2-f09f1321a517.png"],
    [5, "Python", 180.00, "https://static.platzi.com/media/achievements/1378-6fbee8c2-fb79-45db-bd28-d25878a0104c.png"],
    [6, "Angular", 95.00, "https://static.platzi.com/media/achievements/1340-7609a8dc-f858-4863-abeb-02a7dbbf59c1.png"],
    [7, "PostgreSQL", 190.00, "https://static.platzi.com/media/achievements/badges-postgresql-2b631b5d-dcf4-4eec-8766-cea5196eb327.png"],
    [8, "Android", 250.00, "https://static.platzi.com/media/achievements/1049-ccf7d815-1c7d-4e1e-8cd4-d50369c96c7c.png"]
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


