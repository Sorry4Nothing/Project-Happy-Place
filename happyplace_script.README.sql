SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema happyplace
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema happyplace
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `happyplace` DEFAULT CHARACTER SET utf8 ;
USE `happyplace` ;

-- -----------------------------------------------------
-- Table `happyplace`.`Country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `happyplace`.`Country` (
  `idCountry` INT NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Code` VARCHAR(5) NULL,
  PRIMARY KEY (`idCountry`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `happyplace`.`Locality`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `happyplace`.`Locality` (
  `idLocality` INT NOT NULL,
  `Name` VARCHAR(100) NULL,
  `Postal Code` INT NULL,
  `Country_idCountry` INT NOT NULL,
  PRIMARY KEY (`idLocality`),
  INDEX `fk_Locality_Country_idx` (`Country_idCountry` ASC) VISIBLE,
  CONSTRAINT `fk_Locality_Country`
    FOREIGN KEY (`Country_idCountry`)
    REFERENCES `happyplace`.`Country` (`idCountry`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `happyplace`.`Adress`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `happyplace`.`Adress` (
  `idAdress` INT NOT NULL,
  `Street` VARCHAR(100) NULL,
  `HouseNumber` INT NULL,
  `Locality_idLocality` INT NOT NULL,
  PRIMARY KEY (`idAdress`),
  INDEX `fk_Adress_Locality1_idx` (`Locality_idLocality` ASC) VISIBLE,
  CONSTRAINT `fk_Adress_Locality1`
    FOREIGN KEY (`Locality_idLocality`)
    REFERENCES `happyplace`.`Locality` (`idLocality`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `happyplace`.`Person`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `happyplace`.`Person` (
  `idPerson` INT NOT NULL,
  `Surnames` VARCHAR(100) NULL,
  `Lastname` VARCHAR(100) NULL,
  `idResidence` INT NOT NULL,
  PRIMARY KEY (`idPerson`),
  INDEX `fk_Person_Adress1_idx` (`idResidence` ASC) VISIBLE,
  CONSTRAINT `fk_Person_Adress1`
    FOREIGN KEY (`idResidence`)
    REFERENCES `happyplace`.`Adress` (`idAdress`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
