<?php

$installer = $this;

$installer->startSetup();

$installer->run('CREATE TABLE '. $this->getTable('polcodeshipping/shipping') .' (
                        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                        `weekday` TINYINT(1) UNSIGNED NOT NULL,
                        `hour_start` VARCHAR(10) NOT NULL,
                        `hour_end` VARCHAR(10) NOT NULL,
                        `order_limit` INT(11) UNSIGNED NOT NULL,
                        `cost` DECIMAL(8,2) UNSIGNED NOT NULL,
                        `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (`id`)
                )
                COMMENT=\'settings for shipping\'
                COLLATE=\'utf8_general_ci\'
                ENGINE=InnoDB
                AUTO_INCREMENT=6
                ;');





$installer->endSetup();