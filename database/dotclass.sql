CREATE TABLE USUARIO (
    idUsuario              SERIAL              PRIMARY KEY,
    nombreCompleto          varcahr(50)         NOT NULL,
    fechaNacimiento         date                NOT NULL
);