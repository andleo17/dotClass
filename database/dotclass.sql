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