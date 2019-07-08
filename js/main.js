
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
        curso +=    '<div class="card-button"><span>S/ ' + c[2] + '</span><a class="btnAgregarCarrito">Añadir a carrito</a></div></div>';
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

//carrito a ver si sale
window.onload = function () {
    // Variables
    let baseDeDatos = [
        {
            id: 1,
            nombre: 'Frontend',
            foto: 'https://drupal.ed.team/sites/default/files/imagenes-cdn-edteam/2019-03/Redes%20Enrutammiento.png',
            precio: 150
        },
        {
            id: 2,
            nombre: 'Backend',
            foto: 'https://drupal.ed.team/sites/default/files/styles/medium/public/imagenes-cdn-edteam/2019-01/Android%20Material%20Design.png?itok=cuUacCaR',
            precio: 70
        },
        {
            id: 3,
            nombre: 'Dart',
            foto: 'https://drupal.ed.team/sites/default/files/styles/medium/public/imagenes-cdn-edteam/2018-12/Dart.png?itok=Ul2YVOuq',
            precio: 25
        },
        {
            id: 4,
            nombre: 'Flutter',
            foto: 'https://drupal.ed.team/sites/default/files/styles/medium/public/imagenes-cdn-edteam/2018-12/Flutter.png?itok=MpF412ML',
            precio: 30
        },
        {
            id: 5,
            nombre: 'DW en Java',
            foto: 'https://drupal.ed.team/sites/default/files/styles/medium/public/courses/images/java-web.jpg',
            precio: 30
        },
        {
            id: 6,
            nombre: 'React JS',
            foto: 'https://drupal.ed.team/sites/default/files/imagenes-cdn-edteam/2019-04/React%20Rutas%20manejo%20de%20estados%20%281%29.png',
            precio: 15
        }
    ]
    
    let $$items = document.querySelector('#items');
    let carrito = [];
    let total = 0;
    let $carrito = document.querySelector('#carrito');
    let $total = document.querySelector('#total');
    
    // Funciones
    function listarItems () {
        for (let info of baseDeDatos) {
            // Estructura
            let miNodo = document.createElement('div');
            miNodo.classList.add('card', 'col-sm-4');
            miNodo.classList.add('nod');
            // Body
            let miNodoCardBody = document.createElement('div');
            miNodoCardBody.classList.add('card-body');
            
            //Imagen
            let miNodoImagen = document.createElement('img');
            miNodoImagen.classList.add('card-img');
            miNodoImagen.setAttribute('src',info['foto']);
            
            // Titulo
            let miNodoTitle = document.createElement('h5');
            miNodoTitle.classList.add('card-title');
            miNodoTitle.textContent = info['nombre'];
            // Precio
            let miNodoPrecio = document.createElement('p');
            miNodoPrecio.classList.add('card-text');
            miNodoPrecio.textContent = 'S/.' + info['precio'] ;
            // Boton 
            let miNodoBoton = document.createElement('button');
            miNodoBoton.classList.add('btn', 'btn-outline-success');
            miNodoBoton.textContent = 'Agregar al carrito';
            miNodoBoton.setAttribute('marcador', info['id']);
            miNodoBoton.addEventListener('click', agregarCarrito);
            // Insertamos
            miNodoCardBody.appendChild(miNodoTitle);
            miNodoCardBody.appendChild(miNodoImagen);
            miNodoCardBody.appendChild(miNodoPrecio);
            miNodoCardBody.appendChild(miNodoBoton);
            miNodo.appendChild(miNodoCardBody);
            $$items.appendChild(miNodo);
        }
    }
    
    function agregarCarrito () {
        // Anyadimos el Nodo a nuestro carrito
        
        carrito.push(this.getAttribute('marcador'));
        //Añadimos al localStorage
        localStorage.setItem( 'producto', JSON.stringify(carrito));
        // Calculo el total
        calcularTotal();
        // Renderizamos el carrito 
        mostrarCarrito();

    }

    function mostrarCarrito () {
        // Vaciamos todo el html
        $carrito.textContent = '';
        // Generamos los Nodos a partir de carrito
        carrito=JSON.parse(localStorage.getItem('producto'));
        carrito.forEach(function (item, indice) {
            // Obtenemos el item que necesitamos de la variable base de datos
            let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                return itemBaseDatos['id'] == item;
            });
            // Creamos el nodo del item del carrito
            let miNodo = document.createElement('li');
            miNodo.classList.add('list-group-item', 'text-left', 'd-flex');
            miNodo.classList.add('nod');
            miNodo.textContent = `${miItem[0]['nombre']} -S/.${miItem[0]['precio']}`;
            // Boton de borrar
            let miBoton = document.createElement('button');
            miBoton.classList.add('btn', 'btn-outline-danger', 'ml-auto');
            miBoton.textContent = 'Eliminar producto';
            miBoton.setAttribute('posicion', indice);
            miBoton.addEventListener('click', borrarItemCarrito);
            // Mezclamos nodos
            miNodo.appendChild(miBoton);
            $carrito.appendChild(miNodo);
            
            
        });
       
    }
    
    function borrarItemCarrito () {
        // Obtenemos la posicion que hay en el boton pulsado
        let posicion = this.getAttribute('posicion');
        // Borramos la posicion que nos interesa
        carrito.splice(posicion, 1);
        //Actualizamos la informacion en el localstorage
        localStorage.setItem( 'producto', JSON.stringify(carrito) );
        // volvemos a renderizar
        mostrarCarrito();
        // Calculamos de nuevo el precio
        calcularTotal();
    }
    
    function calcularTotal () {
        // Limpiamos precio anterior
        total = 0;
        // Recorremos el array del carrito
        for (let etiqueta of carrito) {
            // De cada elemento obtenemos su precio
            let miItem = baseDeDatos.filter(function(itemBaseDatos) {
                return itemBaseDatos['id'] == etiqueta;
            });
            total = total + miItem[0]['precio'];
        }
        // Formateamos el total para que solo tenga dos decimales
        let totalDosDecimales = total.toFixed(2);
        // Renderizamos el precio en el HTML
        $total.textContent = totalDosDecimales;
    
    }

    
    
    // Eventos
    let btnReiniciar = document.getElementById('btnReiniciar');
    btnReiniciar.onclick = function reiniciarCarrito(){
        //Borramos los datos
        carrito.splice(0);
        //Actualizamos el storage
        localStorage.setItem( 'producto', JSON.stringify(carrito));
        // volvemos a renderizar
        mostrarCarrito();
        // Calculamos de nuevo el precio
        calcularTotal();
        
    }

    let btnAvisar = document.getElementById('btnAvisar');
    btnAvisar.onclick = function mostrarAviso(){
        //Obtenemos los datos del usuario
        let nombre = document.getElementById('txtnombre').value;
        let email = document.getElementById('txtemail').value;
        //mandamos el mensaje solicitado
        alert( 'Su compra ha sido registrada' + ' NOMBRE: '+ nombre + ' CORREO: ' + email + ' TOTAL DE LA COMPRA: ' + total.toFixed(2));
        //reiniciar carrito
        carrito.splice(0);
        //Actualizamos el storage
        localStorage.setItem( 'producto', JSON.stringify(carrito));
        // volvemos a renderizar
        mostrarCarrito();
        // Calculamos de nuevo el precio
        calcularTotal();
    
    } 
    
    // Inicio
    listarItems();
    if( carrito!=null )  {
        mostrarCarrito();
    }
    calcularTotal ();
    
} 
