SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `transevaldb` ;
CREATE SCHEMA IF NOT EXISTS `transevaldb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `transevaldb` ;

-- -----------------------------------------------------
-- Table `transevaldb`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`roles` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`users` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NULL,
  `password` VARCHAR(255) NULL,
  `created` DATETIME NULL,
  `role_id` INT NULL,
  `last_login` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_roles_idx` (`role_id` ASC),
  CONSTRAINT `fk_users_roles`
    FOREIGN KEY (`role_id`)
    REFERENCES `transevaldb`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`languages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`languages` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`languages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`assignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`assignments` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`assignments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `source_lang_id` INT NULL,
  `target_lang_id` INT NULL,
  `name` VARCHAR(100) NULL,
  `created` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_assignments_languages2_idx` (`target_lang_id` ASC),
  INDEX `fk_assignments_languages1_idx` (`source_lang_id` ASC),
  CONSTRAINT `fk_assignments_languages1`
    FOREIGN KEY (`source_lang_id`)
    REFERENCES `transevaldb`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assignments_languages2`
    FOREIGN KEY (`target_lang_id`)
    REFERENCES `transevaldb`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`inputs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`inputs` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`inputs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NULL,
  `pos` INT NULL,
  `assignment_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_inputs_assignments1_idx` (`assignment_id` ASC),
  CONSTRAINT `fk_inputs_assignments1`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `transevaldb`.`assignments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`users_assignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`users_assignments` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`users_assignments` (
  `user_id` INT NOT NULL,
  `assignment_id` INT NOT NULL,
  `concordia_enabled` TINYINT(1) NULL,
  `completed` TINYINT(1) NULL,
  PRIMARY KEY (`user_id`, `assignment_id`),
  INDEX `fk_users_has_assignments_assignments1_idx` (`assignment_id` ASC),
  INDEX `fk_users_has_assignments_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_assignments_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `transevaldb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_assignments_assignments1`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `transevaldb`.`assignments` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`targets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`targets` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`targets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NULL,
  `input_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `accepted` TINYINT(1) NULL DEFAULT NULL,
  `modified` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_targets_inputs1_idx` (`input_id` ASC),
  INDEX `fk_targets_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_targets_inputs1`
    FOREIGN KEY (`input_id`)
    REFERENCES `transevaldb`.`inputs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_targets_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `transevaldb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `transevaldb`.`concordia_uses`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `transevaldb`.`concordia_uses` ;

CREATE TABLE IF NOT EXISTS `transevaldb`.`concordia_uses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fragment` TEXT NULL,
  `word_count` INT NULL,
  `overlay_score` FLOAT NULL,
  `target_id` INT NOT NULL,
  `created` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_concordia_uses_targets1_idx` (`target_id` ASC),
  CONSTRAINT `fk_concordia_uses_targets1`
    FOREIGN KEY (`target_id`)
    REFERENCES `transevaldb`.`targets` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
