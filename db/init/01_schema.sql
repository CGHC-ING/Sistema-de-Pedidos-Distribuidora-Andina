SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema andina
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `andina` DEFAULT CHARACTER SET utf8 ;
USE `andina` ;

-- -----------------------------------------------------
-- Table `andina`.`ciudades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`ciudades` ;

CREATE TABLE IF NOT EXISTS `andina`.`ciudades` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`clientes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`clientes` ;

CREATE TABLE IF NOT EXISTS `andina`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `ciudad_id` INT NOT NULL,
  `nit` VARCHAR(20) NOT NULL,
  `razon_social` VARCHAR(100) NULL,
  `tipo` ENUM('minorista', 'mayorista') NOT NULL,
  `cupo_credito` DECIMAL(14,2) NULL,
  `activo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_clientes_ciudades1_idx` (`ciudad_id` ASC) VISIBLE,
  CONSTRAINT `fk_clientes_ciudades1`
    FOREIGN KEY (`ciudad_id`)
    REFERENCES `andina`.`ciudades` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `andina`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(120) NOT NULL,
  `password_hash` VARCHAR(255) NULL,
  `rol` ENUM('Admin', 'Vendedor', 'Bodega') NOT NULL,
  `activo` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`pedidos` ;

CREATE TABLE IF NOT EXISTS `andina`.`pedidos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `creado_en` DATETIME NOT NULL,
  `usuario_id` INT NOT NULL,
  `cliente_id` INT NOT NULL,
  `consecutivo` VARCHAR(20) NOT NULL,
  `referencia_cliente` VARCHAR(40) NULL,
  `subtotal` DECIMAL(14,2) NULL,
  `descuento` DECIMAL(14,2) NULL,
  `iva` DECIMAL(14,2) NULL,
  `total` DECIMAL(14,2) NULL,
  `estado` ENUM('borrador', 'confirmado', 'despachado', 'entregado', 'anulado') NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pedidos_usuarios_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_pedidos_clientes1_idx` (`cliente_id` ASC) VISIBLE,
  UNIQUE INDEX `consecutivo_UNIQUE` (`consecutivo` ASC) VISIBLE,
  CONSTRAINT `fk_pedidos_usuarios`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `andina`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_clientes1`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `andina`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`categorias` ;

CREATE TABLE IF NOT EXISTS `andina`.`categorias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nombre_UNIQUE` (`nombre` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`productos` ;

CREATE TABLE IF NOT EXISTS `andina`.`productos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sku` VARCHAR(20) NOT NULL,
  `nombre` VARCHAR(150) NOT NULL,
  `categoria_id` INT NOT NULL,
  `precio` DECIMAL(12,2) NOT NULL,
  `exento_iva` TINYINT(1) NOT NULL,
  `stock` INT NOT NULL,
  `stock_minimo` INT NOT NULL,
  `activo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_productos_categorias1_idx` (`categoria_id` ASC) VISIBLE,
  UNIQUE INDEX `sku_UNIQUE` (`sku` ASC) VISIBLE,
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `andina`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`pedido_detalle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`pedido_detalle` ;

CREATE TABLE IF NOT EXISTS `andina`.`pedido_detalle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  `cantidad` INT NULL,
  `precio_unitario` DECIMAL(12,2) NULL,
  `descuento_porcentaje` DECIMAL(5,2) NULL,
  `iva_porcentaje` DECIMAL(5,2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pedido_detalle_productos1_idx` (`producto_id` ASC) VISIBLE,
  INDEX `fk_pedido_detalle_pedidos1_idx` (`pedido_id` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_detalle_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `andina`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_detalle_pedidos1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `andina`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`pagos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`pagos` ;

CREATE TABLE IF NOT EXISTS `andina`.`pagos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pedido_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `valor` DECIMAL(14,2) NULL,
  `metodo` ENUM('cheque', 'tarjeta', 'efectivo') NULL,
  `fecha` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pagos_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_pagos_pedidos1_idx` (`pedido_id` ASC) VISIBLE,
  CONSTRAINT `fk_pagos_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `andina`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pagos_pedidos1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `andina`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`movimientos_inventario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`movimientos_inventario` ;

CREATE TABLE IF NOT EXISTS `andina`.`movimientos_inventario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `producto_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  `pedido_id` INT NULL,
  `tipo` ENUM('entrada', 'salida', 'reversion') NULL,
  `cantidad` INT NULL,
  `creado_en` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_movimientos_inventario_productos1_idx` (`producto_id` ASC) VISIBLE,
  INDEX `fk_movimientos_inventario_usuarios1_idx` (`usuario_id` ASC) VISIBLE,
  INDEX `fk_movimientos_inventario_pedidos1_idx` (`pedido_id` ASC) VISIBLE,
  CONSTRAINT `fk_movimientos_inventario_productos1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `andina`.`productos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientos_inventario_usuarios1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `andina`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimientos_inventario_pedidos1`
    FOREIGN KEY (`pedido_id`)
    REFERENCES `andina`.`pedidos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `andina`.`secuencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `andina`.`secuencias` ;

CREATE TABLE IF NOT EXISTS `andina`.`secuencias` (
  `prefijo` VARCHAR(10) NOT NULL,
  `anio` SMALLINT(2) NOT NULL,
  `ultimo` INT NULL,
  PRIMARY KEY (`prefijo`, `anio`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
