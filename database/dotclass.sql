-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dotclass
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dotclass
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dotclass` DEFAULT CHARACTER SET utf8 ;
USE `dotclass` ;

-- -----------------------------------------------------
-- Table `dotclass`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`pais` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`ciudad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`ciudad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(35) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nickname` VARCHAR(30) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  `nombres` VARCHAR(60) NOT NULL,
  `apellidos` VARCHAR(60) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `descripcion` TINYTEXT NULL,
  `numero_seguidores` INT NOT NULL DEFAULT 0,
  `pregunta_seguridad` VARCHAR(255) NOT NULL,
  `respuesta_seguridad` VARCHAR(50) NOT NULL,
  `foto` VARCHAR(100) NULL,
  `pais_id` INT NOT NULL,
  `ciudad_id` INT NOT NULL,
  `fecha_creacion` DATETIME NOT NULL DEFAULT NOW(),
  `estado` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  INDEX `fk_usuario_pais1_idx` (`pais_id` ASC) ,
  INDEX `fk_usuario_ciudad1_idx` (`ciudad_id` ASC) ,
  CONSTRAINT `fk_usuario_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `dotclass`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_ciudad1`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `dotclass`.`ciudad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria_id` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  `descripcion` MEDIUMTEXT NOT NULL,
  `logo` VARCHAR(70) NOT NULL,
  `duracion` INT NOT NULL DEFAULT 0,
  `numero_subscriptores` INT NOT NULL DEFAULT 0,
  `valoracion` INT NOT NULL DEFAULT 0,
  `fecha_creacion` DATETIME NOT NULL DEFAULT NOW(),
  `fecha_ultima_actualizacion` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  INDEX `fk_curso_categoria1_idx` (`categoria_id` ASC) ,
  CONSTRAINT `fk_curso_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `dotclass`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`seccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`seccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `curso_id` INT NOT NULL,
  `titulo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_seccion_curso1_idx` (`curso_id` ASC) ,
  CONSTRAINT `fk_seccion_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `dotclass`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`clase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`clase` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `seccion_id` INT NOT NULL,
  `titulo` VARCHAR(60) NOT NULL,
  `duracion` INT NOT NULL DEFAULT 0,
  `contenido_video` VARCHAR(180) NULL,
  `contenido_texto` LONGTEXT NULL,
  `fecha_subida` DATETIME NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  INDEX `fk_clase_seccion1_idx` (`seccion_id` ASC) ,
  CONSTRAINT `fk_clase_seccion1`
    FOREIGN KEY (`seccion_id`)
    REFERENCES `dotclass`.`seccion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`examen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`examen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`id`, `curso_id`),
  INDEX `fk_examen_curso1_idx` (`curso_id` ASC) ,
  CONSTRAINT `fk_examen_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `dotclass`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`pregunta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `examen_id` INT NOT NULL,
  `numero` TINYINT NOT NULL,
  `titulo` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pregunta_examen1_idx` (`examen_id` ASC) ,
  CONSTRAINT `fk_pregunta_examen1`
    FOREIGN KEY (`examen_id`)
    REFERENCES `dotclass`.`examen` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`alternativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`alternativa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pregunta_id` INT NOT NULL,
  `numero` INT NOT NULL,
  `contenido` VARCHAR(180) NOT NULL,
  `respuesta` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_alternativa_pregunta1_idx` (`pregunta_id` ASC) ,
  CONSTRAINT `fk_alternativa_pregunta1`
    FOREIGN KEY (`pregunta_id`)
    REFERENCES `dotclass`.`pregunta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`visita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`visita` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tiempo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comentario_padre_id` INT NULL,
  `contenido` VARCHAR(150) NOT NULL,
  `numero_likes` INT NOT NULL DEFAULT 0,
  `numero_comentarios` INT NOT NULL DEFAULT 0,
  `pregunta` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_comentario1_idx` (`comentario_padre_id` ASC) ,
  CONSTRAINT `fk_comentario_comentario1`
    FOREIGN KEY (`comentario_padre_id`)
    REFERENCES `dotclass`.`comentario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`marcador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`marcador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `tiempo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`aporte`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`aporte` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(150) NOT NULL,
  `contenido` LONGTEXT NOT NULL,
  `numero_likes` INT NOT NULL DEFAULT 0,
  `numero_comentarios` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`actividad_curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`actividad_curso` (
  `usuario_id` INT NOT NULL,
  `clase_id` INT NOT NULL,
  `visita_id` INT NULL,
  `marcador_id` INT NULL,
  `aporte_id` INT NULL,
  `comentario_id` INT NULL,
  `fecha` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`usuario_id`, `clase_id`),
  INDEX `fk_usuario_has_clase_clase1_idx` (`clase_id` ASC) ,
  INDEX `fk_usuario_has_clase_usuario1_idx` (`usuario_id` ASC) ,
  INDEX `fk_usuario_has_clase_visita1_idx` (`visita_id` ASC) ,
  INDEX `fk_usuario_has_clase_marcador1_idx` (`marcador_id` ASC) ,
  INDEX `fk_usuario_has_clase_aporte1_idx` (`aporte_id` ASC) ,
  INDEX `fk_usuario_has_clase_comentario1_idx` (`comentario_id` ASC) ,
  CONSTRAINT `fk_usuario_has_clase_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_clase_clase1`
    FOREIGN KEY (`clase_id`)
    REFERENCES `dotclass`.`clase` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_clase_visita1`
    FOREIGN KEY (`visita_id`)
    REFERENCES `dotclass`.`visita` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_clase_marcador1`
    FOREIGN KEY (`marcador_id`)
    REFERENCES `dotclass`.`marcador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_clase_aporte1`
    FOREIGN KEY (`aporte_id`)
    REFERENCES `dotclass`.`aporte` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_clase_comentario1`
    FOREIGN KEY (`comentario_id`)
    REFERENCES `dotclass`.`comentario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`seguimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`seguimiento` (
  `usuario_id` INT NOT NULL,
  `curso_id` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `curso_id`),
  INDEX `fk_usuario_has_curso1_curso1_idx` (`curso_id` ASC) ,
  INDEX `fk_usuario_has_curso1_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_usuario_has_curso1_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_curso1_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `dotclass`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`actividad_examen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`actividad_examen` (
  `usuario_id` INT NOT NULL,
  `pregunta_id` INT NOT NULL,
  `nota` INT NOT NULL,
  PRIMARY KEY (`usuario_id`, `pregunta_id`),
  INDEX `fk_usuario_has_pregunta_pregunta1_idx` (`pregunta_id` ASC) ,
  INDEX `fk_usuario_has_pregunta_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_usuario_has_pregunta_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_pregunta_pregunta1`
    FOREIGN KEY (`pregunta_id`)
    REFERENCES `dotclass`.`pregunta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`conocimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`conocimiento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `grado_academico` VARCHAR(40) NULL,
  `lugar_estudio` VARCHAR(80) NULL,
  `anio` INT NOT NULL,
  `pais_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_conocimiento_pais1_idx` (`pais_id` ASC) ,
  INDEX `fk_conocimiento_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_conocimiento_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `dotclass`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conocimiento_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`experiencia_laboral`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`experiencia_laboral` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(150) NOT NULL,
  `lugar` VARCHAR(80) NOT NULL,
  `fecha_inicio` DATE NOT NULL,
  `fecha_fin` DATE NULL,
  `pais_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  INDEX `fk_experiencia_laboral_pais1_idx` (`pais_id` ASC) ,
  INDEX `fk_experiencia_laboral_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_experiencia_laboral_pais1`
    FOREIGN KEY (`pais_id`)
    REFERENCES `dotclass`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_experiencia_laboral_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`prerrequisito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`prerrequisito` (
  `curso_id` INT NOT NULL,
  `curso_prerrequisito_id` INT NOT NULL,
  PRIMARY KEY (`curso_id`, `curso_prerrequisito_id`),
  INDEX `fk_curso_has_curso_curso2_idx` (`curso_prerrequisito_id` ASC) ,
  INDEX `fk_curso_has_curso_curso1_idx` (`curso_id` ASC) ,
  CONSTRAINT `fk_curso_has_curso_curso1`
    FOREIGN KEY (`curso_id`)
    REFERENCES `dotclass`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_curso_has_curso_curso2`
    FOREIGN KEY (`curso_prerrequisito_id`)
    REFERENCES `dotclass`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`blog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`blog` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `titulo` VARCHAR(150) NOT NULL,
  `contenido` LONGTEXT NOT NULL,
  `fecha_creacion` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  INDEX `fk_blog_usuario1_idx` (`usuario_id` ASC) ,
  CONSTRAINT `fk_blog_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`tipo_suscripcion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`tipo_suscripcion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dotclass`.`bonificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dotclass`.`bonificacion` (
  `usuario_emisor_id` INT NOT NULL,
  `usuario_receptor_id` INT NOT NULL,
  `tipo_suscripcion_id` INT NOT NULL,
  `cantidad` DECIMAL NULL,
  `fecha` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`usuario_emisor_id`, `usuario_receptor_id`),
  INDEX `fk_usuario_has_usuario_usuario2_idx` (`usuario_receptor_id` ASC) ,
  INDEX `fk_usuario_has_usuario_usuario1_idx` (`usuario_emisor_id` ASC) ,
  INDEX `fk_bonificacion_tipo_suscripcion1_idx` (`tipo_suscripcion_id` ASC) ,
  CONSTRAINT `fk_usuario_has_usuario_usuario1`
    FOREIGN KEY (`usuario_emisor_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_usuario_usuario2`
    FOREIGN KEY (`usuario_receptor_id`)
    REFERENCES `dotclass`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bonificacion_tipo_suscripcion1`
    FOREIGN KEY (`tipo_suscripcion_id`)
    REFERENCES `dotclass`.`tipo_suscripcion` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
