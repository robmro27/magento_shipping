<?php

$installer = $this;
$installer->startSetup();

$installer->run('ALTER TABLE '. $this->getTable('polcodeshipping/shipping') .'
	ADD COLUMN `deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `updated_at`;');

$installer->run('ALTER TABLE '. $this->getTable('polcodeshipping/shippingexcludes') .'
	ADD COLUMN `deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT \'0\' AFTER `updated_at`;');

$installer->endSetup();