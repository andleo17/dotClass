CREATE TABLE pais (
    id                      SERIAL                  PRIMARY KEY,
    nombre                  VARCHAR(20)             NOT NULL UNIQUE
);

CREATE TABLE ciudad (
    id                      SERIAL                  PRIMARY KEY,
    nombre                  VARCHAR(20)             NOT NULL UNIQUE
);

CREATE TABLE usuario (
    id                      SERIAL                  PRIMARY KEY,
    nickname                VARCHAR(30)             NOT NULL UNIQUE,
    password                VARCHAR(30)             NOT NULL,
    nombres                 VARCHAR(60)             NOT NULL,
    apellidos               VARCHAR(60)             NOT NULL,
    email                   VARCHAR(80)             NOT NULL,
    fecha_nacimiento        DATE                    NOT NULL,
    pais_id                 INT                     NOT NULL REFERENCES pais,
    ciudad_id               INT                     NOT NULL REFERENCES ciudad,
    descripcion             TEXT                    NULL,
    numero_seguidores       INT                     NOT NULL DEFAULT 0,
    pregunta_seguridad      TEXT                    NOT NULL,
    respuesta_seguridad     VARCHAR(50)             NOT NULL,
    foto                    VARCHAR(100)            NULL
);

CREATE TABLE conocimientos(
    id                      SERIAL                  PRIMARY KEY,
    nombre                  VARCHAR(100)            NOT NULL,
    grado_academico         VARCHAR(40)             NULL,
    lugar_estudio           VARCHAR(80)             NULL,
    fecha                   INT                     NULL
    pais_id                 INT                     NULL REFERENCES pais
);

/*POSIBLES TABLAS:
    - Cursos
    - Comentarios
    - Experiencia_Laboral
    - Movimientos (posible)
    - pre - requisito
    - clases
    - aportes
    - preguntas de examen
    - proyecto_curso
    - blog
    - categoria
    - 


POSIBLES IDEAS:
    - Secciones
    - Examenes finales y detalle de examenes
    - Marcadores
    - Control de los vídeos
*/