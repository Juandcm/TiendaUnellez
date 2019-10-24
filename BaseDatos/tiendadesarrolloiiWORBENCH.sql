SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `tiendadesarrolloii` DEFAULT CHARACTER SET utf8 ;
USE `tiendadesarrolloii` ;

-- -----------------------------------------------------
-- Table `tiendadesarrolloii`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiendadesarrolloii`.`usuario` (
  `usu_iden` INT(11) NOT NULL AUTO_INCREMENT ,
  `usu_nomb` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `usu_apel` VARCHAR(50) NOT NULL ,
  `usu_corr` VARCHAR(50) NOT NULL ,
  `usu_cont` VARCHAR(60) NOT NULL ,
  `usu_tele` INT(11) NULL DEFAULT NULL ,
  `usu_foto` TEXT NULL DEFAULT NULL ,
  `usu_fech` DATETIME NULL DEFAULT NULL ,
  `usu_perm` ENUM('0','1') NOT NULL DEFAULT '0' ,
  `usu_esta` ENUM('0','1') NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`usu_iden`) )
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiendadesarrolloii`.`inventario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiendadesarrolloii`.`inventario` (
  `inv_iden` INT(11) NOT NULL AUTO_INCREMENT ,
  `usu_iden` INT(11) NOT NULL ,
  `inv_nomb` VARCHAR(150) NOT NULL ,
  `inv_desc` TEXT NULL DEFAULT NULL ,
  `inv_prec` FLOAT NOT NULL ,
  `inv_fech` DATETIME NULL DEFAULT NULL ,
  `inv_foto` TEXT NULL DEFAULT NULL ,
  `inv_cant` INT(11) NULL DEFAULT NULL ,
  `inv_esta` ENUM('0','1') NULL DEFAULT '0' ,
  PRIMARY KEY (`inv_iden`) ,
  INDEX `fk_INVENTARIO_USUARIO1_idx` (`usu_iden` ASC) ,
  CONSTRAINT `fk_INVENTARIO_USUARIO1`
    FOREIGN KEY (`usu_iden` )
    REFERENCES `tiendadesarrolloii`.`usuario` (`usu_iden` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiendadesarrolloii`.`compra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiendadesarrolloii`.`compra` (
  `com_iden` INT(11) NOT NULL AUTO_INCREMENT ,
  `usu_comp` INT(11) NOT NULL ,
  `usu_vent` INT(11) NOT NULL ,
  `inv_comp` INT(11) NOT NULL ,
  `com_prec` FLOAT NULL DEFAULT NULL ,
  `com_fech` DATETIME NULL DEFAULT NULL ,
  `com_cant` INT(11) NOT NULL ,
  PRIMARY KEY (`com_iden`) ,
  INDEX `fk_COMPRA_USUARIO1_idx` (`usu_comp` ASC) ,
  INDEX `fk_COMPRA_INVENTARIO1_idx` (`inv_comp` ASC) ,
  CONSTRAINT `fk_COMPRA_INVENTARIO1`
    FOREIGN KEY (`inv_comp` )
    REFERENCES `tiendadesarrolloii`.`inventario` (`inv_iden` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPRA_USUARIO1`
    FOREIGN KEY (`usu_comp` )
    REFERENCES `tiendadesarrolloii`.`usuario` (`usu_iden` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 20
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiendadesarrolloii`.`parametro`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiendadesarrolloii`.`parametro` (
  `par_iden` INT(11) NOT NULL AUTO_INCREMENT ,
  `par_tipo` VARCHAR(45) NULL DEFAULT NULL ,
  `parprueba` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`par_iden`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `tiendadesarrolloii`.`venta`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tiendadesarrolloii`.`venta` (
  `ven_iden` INT(11) NOT NULL AUTO_INCREMENT ,
  `usu_vent` INT(11) NOT NULL ,
  `usu_comp` INT(11) NOT NULL ,
  `inv_vent` INT(11) NOT NULL ,
  `ven_prec` FLOAT NOT NULL ,
  `ven_fech` DATETIME NOT NULL ,
  `ven_cant` INT(11) NOT NULL ,
  PRIMARY KEY (`ven_iden`) ,
  INDEX `fk_COMPFRA_INVENTARIO1_idx` (`inv_vent` ASC) ,
  INDEX `fk_COMPFRA_USUARIO1_idx` (`usu_vent` ASC) ,
  CONSTRAINT `fk_COMPFRA_INVENTARIO1`
    FOREIGN KEY (`inv_vent` )
    REFERENCES `tiendadesarrolloii`.`inventario` (`inv_iden` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMPFRA_USUARIO1`
    FOREIGN KEY (`usu_vent` )
    REFERENCES `tiendadesarrolloii`.`usuario` (`usu_iden` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8;

USE `tiendadesarrolloii` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
