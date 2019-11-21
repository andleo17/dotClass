START TRANSACTION;

CREATE TABLE pais (
    id              SERIAL              PRIMARY KEY,
    nombre          VARCHAR(35)         NOT NULL
);

INSERT INTO pais VALUES
                        (DEFAULT, 'Perú');

CREATE TABLE ciudad (
    id              SERIAL              PRIMARY KEY,
    nombre          VARCHAR(35)         NOT NULL
);

INSERT INTO ciudad VALUES
                          (DEFAULT, 'Chiclayo');

CREATE TABLE visita (
    id              SERIAL              PRIMARY KEY,
    tiempo          TIME                NOT NULL
);

CREATE TABLE aporte (
    id              SERIAL              PRIMARY KEY,
    titulo          VARCHAR(150)        NOT NULL,
    contenido       TEXT                NOT NULL,
    numero_likes    INT                 NOT NULL DEFAULT 0,
    numero_comentarios INT              NOT NULL DEFAULT 0
);

CREATE TABLE marcador (
    id              SERIAL              PRIMARY KEY,
    titulo          VARCHAR(45)         NOT NULL,
    tiempo          VARCHAR(45)         NOT NULL
);

CREATE TABLE categoria (
    id              SERIAL              PRIMARY KEY ,
    nombre          VARCHAR(45)         NOT NULL,
    descripcion     VARCHAR(150)        NOT NULL,
    logo            VARCHAR(100)        NOT NULL
);

INSERT INTO categoria VALUES
                             (DEFAULT, 'Tecnología', '', 'tecnologia.webp'),
                             (DEFAULT, 'Ciencia', '', 'ciencia.webp'),
                             (DEFAULT, 'Matemáticas', '', 'matematicas.webp'),
                             (DEFAULT, 'Arte', '', 'arte.webp'),
                             (DEFAULT, 'Marketing', '', 'marketing.webp'),
                             (DEFAULT, 'Música', '', 'musica.webp');

CREATE TABLE tipo_suscripcion (
    id              SERIAL              PRIMARY KEY,
    nombre          VARCHAR(45)         NOT NULL
);

CREATE TABLE usuario (
    id              SERIAL              PRIMARY KEY,
    nickname        VARCHAR(30)         NOT NULL UNIQUE,
    password        VARCHAR(42)         NOT NULL,
    nombres         VARCHAR(60)         NOT NULL,
    apellidos       VARCHAR(60)         NOT NULL,
    email           VARCHAR(80)         NOT NULL UNIQUE,
    fecha_nacimiento DATE NOT           NULL,
    descripcion     VARCHAR             NULL,
    numero_seguidores INT               NOT NULL DEFAULT 0,
    pregunta_seguridad VARCHAR(255)     NOT NULL,
    respuesta_seguridad VARCHAR(50)     NOT NULL,
    foto            VARCHAR(100)        NULL,
    pais_id         INT                 NOT NULL REFERENCES pais,
    ciudad_id       INT                 NOT NULL REFERENCES ciudad,
    fecha_creacion  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado          BOOLEAN             NOT NULL DEFAULT TRUE
);

INSERT INTO usuario VALUES
                            (DEFAULT, 'Andle17', '123456789', 'Andrés', 'Baldárrago', 'ab@gmail.com', '2000-07-01', 'Me gusta jugar y enseñar.', DEFAULT, '¿Quién soy?', 'nose', 'Andle17.png', 1, 1, '2019-11-14 16:42:51', DEFAULT),
                            (DEFAULT, 'CinthyaYomona', '123', 'Cinthya Lisseth', 'Yomona Parraguez', 'cinthya@gmail.com', '1999-05-23', 'Se suponde que me debo de bañar, que mis convers ya no aguantan más!!...Pero llegas tú !! :) <3', DEFAULT, 'Inspiraciíon?', 'Priscila', '20180319_103506.jpg', 1, 1, '2019-11-14 16:42:51', DEFAULT);

CREATE TABLE conocimiento (
    id              SERIAL              PRIMARY KEY,
    nombre          VARCHAR(100)        NOT NULL,
    grado_academico VARCHAR(40)         NULL,
    lugar_estudio   VARCHAR(80)         NULL,
    anio            INT                 NOT NULL,
    pais_id         INT                 NOT NULL REFERENCES pais,
    usuario_id      INT                 NOT NULL REFERENCES usuario
);

CREATE TABLE experiencia_laboral (
    id              SERIAL              PRIMARY KEY,
    nombre          VARCHAR(150)        NOT NULL,
    lugar           VARCHAR(80)         NOT NULL,
    fecha_inicio    DATE                NOT NULL,
    fecha_fin       DATE                NULL,
    pais_id         INT                 NOT NULL REFERENCES pais,
    usuario_id      INT                 NOT NULL REFERENCES usuario
);

CREATE TABLE blog (
    id              SERIAL              PRIMARY KEY,
    usuario_id      INT                 NOT NULL REFERENCES usuario,
    titulo          VARCHAR(150)        NOT NULL,
    contenido       TEXT                NOT NULL,
    fecha_creacion  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bonificacion (
    usuario_emisor_id INT               NOT NULL REFERENCES usuario,
    usuario_receptor_id INT             NOT NULL REFERENCES usuario,
    tipo_suscripcion_id INT             NOT NULL REFERENCES tipo_suscripcion,
    cantidad        MONEY               NULL,
    fecha           TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE curso (
    id              SERIAL              PRIMARY KEY,
    categoria_id    INT                 NOT NULL REFERENCES categoria,
    titulo          VARCHAR(45)         NOT NULL,
    descripcion     TEXT                NOT NULL,
    logo            VARCHAR(70)         NOT NULL,
    duracion        TIME                NOT NULL DEFAULT '00:00:00',
    numero_subscriptores INT            NOT NULL DEFAULT 0,
    valoracion      INT                 NOT NULL DEFAULT 0,
    fecha_creacion  TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_ultima_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    usuario_id      INT                 NOT NULL REFERENCES usuario
);

INSERT INTO curso VALUES
                        (DEFAULT, 1, 'Java Avanzado', 'En este curso aprenderás el lenguaje de programación más demandado por el sector empresarial y el mejor remunerado en la actualidad.\r\nAprenderemos todos juntos acerca de clases anidadas, clases abstractas, lambdas, JDBC y mucho más.', 'Badge-desarrollo-java.webp', '00:00:25', 1200, 4, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1),
                        (DEFAULT, 1, 'HTML5 y CSS3', 'Diseña tus propias páginas o sitios web y aprende los mejores frameworks de diseño. Sé un buen arquitecto fronted con este curso.', 'badges-html-css.webp', '00:00:21', 1000, 5, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1),
                        (DEFAULT, 1, 'React', 'React es una de las librerías más utilizadas hoy para crear aplicaciones web. Aprende desde la creación y diseño de componentes hasta traer datos de un API.', 'badge-reactjs-avanzado.webp', '00:00:25', 1200, 3, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1);

CREATE TABLE seccion (
    id              SERIAL              PRIMARY KEY,
    curso_id        INT                 NOT NULL REFERENCES curso,
    titulo          VARCHAR(45)         NOT NULL
);

INSERT INTO seccion VALUES
                            (DEFAULT, 1, 'Introducción al curso'),
                            (DEFAULT, 1, 'Clases avanzadas'),
                            (DEFAULT, 1, 'JavaDocs'),
                            (DEFAULT, 1, 'Clases anidadas'),
                            (DEFAULT, 1, 'Interfaces avanzadas'),
                            (DEFAULT, 1, 'JDBC'),
                            (DEFAULT, 1, 'Lambdas');

CREATE TABLE clase (
    id              SERIAL              PRIMARY KEY,
    seccion_id      INT                 NOT NULL REFERENCES seccion,
    titulo          VARCHAR(150)        NOT NULL,
    duracion        TIME                NOT NULL DEFAULT '00:00:00',
    contenido_video VARCHAR(180)        NULL,
    contenido_texto TEXT                NULL,
    fecha_subida    TIMESTAMP           DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO clase VALUES
                         (DEFAULT, 1, 'Bienvenida al curso', '00:11:57', NULL, NULL, '2019-11-19 11:11:30'),
                         (DEFAULT, 1, 'Primeros pasos', '00:11:21', NULL, NULL, '2019-11-19 11:11:30'),
                         (DEFAULT, 2, 'Clases abstractas', '00:25:23', NULL, NULL, '2019-11-19 11:16:28'),
                         (DEFAULT, 2, 'Implementando clases abstractas al proyecto', '00:00:32', NULL, NULL, '2019-11-19 11:16:28'),
                         (DEFAULT, 2, 'Ejercicio práctico', '00:14:01', NULL, NULL, '2019-11-19 11:16:28'),
                         (DEFAULT, 2, 'Implementando métodos abstractos en Java', '00:32:00', NULL, NULL, '2019-11-19 11:16:28'),
                         (DEFAULT, 3, 'Qué es JavaDocs', '00:04:54', NULL, NULL, '2019-11-19 11:30:17'),
                         (DEFAULT, 3, 'Implementando JavaDocs al proyecto', '00:18:02', NULL, NULL, '2019-11-19 11:30:17'),
                         (DEFAULT, 3, 'Javadocs tags para herencia e interfaces', '00:16:14', NULL, NULL, '2019-11-19 11:30:17'),
                         (DEFAULT, 3, 'Generando JavaDocs', '00:34:12', NULL, NULL, '2019-11-19 11:30:17'),
                         (DEFAULT, 4, 'Clases anidadas y tipos', '00:50:47', NULL, NULL, '2019-11-19 11:34:35'),
                         (DEFAULT, 4, 'Implementando una clase anidada al proyecto', '00:04:34', NULL, NULL, '2019-11-19 11:34:35'),
                         (DEFAULT, 4, 'Instanciando clases estáticas anidadas', '00:24:06', NULL, NULL, '2019-11-19 11:34:35'),
                         (DEFAULT, 4, 'Enumeraciones', '00:08:14', NULL, NULL, '2019-11-19 11:34:35'),
                         (DEFAULT, 5, 'Métodos con implementación métodos default y private', '00:14:24', NULL, NULL, '2019-11-19 11:36:15'),
                         (DEFAULT, 5, 'Creando Interfaz DAO con métodos default y private', '00:37:34', NULL, NULL, '2019-11-19 11:36:15'),
                         (DEFAULT, 5, 'Diferencias entre Interfaces y Clases abstractas', '00:09:04', NULL, NULL, '2019-11-19 11:36:15'),
                         (DEFAULT, 5, 'Herencia en interfaces', '00:06:06', NULL, NULL, '2019-11-19 11:36:15'),
                         (DEFAULT, 6, 'Definición y composición del API', '00:12:21', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Ejercicio: JDBC API', '00:01:03', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Creando la base de datos y conectando el proyecto con MySQL', '00:31:24', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Generando conexión a la base de datos y creando clase de constantes', '00:24:16', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Sentencia SELECT en Java', '00:08:07', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Sentencia SELECT con parámetros', '00:16:04', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Sentencia INSERT en Java', '00:12:06', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 6, 'Reto: Reporte por fecha', '00:01:00', NULL, NULL, '2019-11-19 11:38:39'),
                         (DEFAULT, 7, 'Interfaces funcionales', '00:06:04', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Programación funcional', '00:24:14', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Lambdas', '00:19:19', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Ejercicio: Lambdas', '00:02:14', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Lambdas como variables y recursividad', '00:15:18', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Stream y Filter', '00:24:20', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Predicate y consumer', '00:14:57', NULL, NULL, '2019-11-19 11:42:44'),
                         (DEFAULT, 7, 'Conclusión del curso del curso', '00:03:57', NULL, NULL, '2019-11-19 11:42:44');

CREATE TABLE examen (
    id              SERIAL              PRIMARY KEY,
    curso_id        INT                 NOT NULL REFERENCES curso
);

CREATE TABLE pregunta (
    id              SERIAL              PRIMARY KEY ,
    examen_id       INT                 NOT NULL REFERENCES examen,
    numero          SMALLINT            NOT NULL,
    titulo          VARCHAR(150)        NOT NULL
);

CREATE TABLE alternativa (
    id              SERIAL              PRIMARY KEY,
    pregunta_id     INT                 NOT NULL REFERENCES pregunta,
    numero          INT                 NOT NULL,
    contenido       VARCHAR(180)        NOT NULL,
    respuesta       BOOLEAN             NOT NULL
);

CREATE TABLE comentario (
    id              SERIAL              PRIMARY KEY,
    comentario_padre_id INT             NULL REFERENCES comentario,
    contenido       VARCHAR(150) NOT    NULL,
    numero_likes    INT                 NOT NULL DEFAULT 0,
    numero_comentarios INT              NOT NULL DEFAULT 0,
    pregunta        BOOLEAN             NOT NULL DEFAULT FALSE
);

CREATE TABLE actividad_curso (
    usuario_id      SERIAL              NOT NULL REFERENCES usuario,
    clase_id        INT                 NOT NULL REFERENCES clase,
    visita_id       INT                 NULL REFERENCES visita,
    marcador_id     INT                 NULL REFERENCES marcador,
    aporte_id       INT                 NULL REFERENCES aporte,
    comentario_id   INT                 NULL REFERENCES comentario,
    fecha           TIMESTAMP           NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE actividad_examen (
    usuario_id      INT                 NOT NULL REFERENCES usuario,
    pregunta_id     INT                 NOT NULL REFERENCES pregunta,
    nota            INT                 NOT NULL
);

CREATE TABLE prerrequisito (
    curso_id        INT                 NOT NULL REFERENCES curso,
    curso_prerrequisito_id INT          NOT NULL REFERENCES curso
);

INSERT INTO prerrequisito VALUES
                                 (3, 2);

CREATE TABLE seguimiento (
    usuario_id      INT                 NOT NULL REFERENCES usuario,
    curso_id        INT                 NOT NULL REFERENCES curso
);

UPDATE curso SET duracion = (SELECT SUM(duracion) FROM clase INNER JOIN seccion s on clase.seccion_id = s.id WHERE curso_id = curso.id) WHERE id = 1;

COMMIT;