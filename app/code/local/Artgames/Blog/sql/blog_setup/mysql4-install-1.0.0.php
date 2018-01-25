<?php

$installer = $this;
$installer->startSetup();
$installer->run("
	CREATE TABLE `magento`.`blog` ( `Id` INT(32) NOT NULL AUTO_INCREMENT , `Title` VARCHAR NOT NULL , `Post` TEXT NOT NULL , PRIMARY KEY (`Id`)) ENGINE = InnoDB;
	");
$installer->endSetup();