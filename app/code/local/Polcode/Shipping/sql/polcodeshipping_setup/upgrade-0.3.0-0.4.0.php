<?php

$installer = $this;
$installer->startSetup();

$installer->run('CREATE TABLE '. $this->getTable('polcodeshipping/shippingexcludes') .' (
                        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`date` DATE NULL DEFAULT NULL,
	`hour_start` VARCHAR(10) NULL DEFAULT NULL,
	`hour_end` VARCHAR(10) NULL DEFAULT NULL,
	`created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE=\'utf8_general_ci\'
ENGINE=InnoDB
;');

$installer->endSetup();