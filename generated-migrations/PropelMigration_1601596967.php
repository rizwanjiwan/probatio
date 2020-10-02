<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1601596967.
 * Generated on 2020-10-02 00:02:47 by woohooo
 */
class PropelMigration_1601596967
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `visitors`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

CREATE TABLE `external_visitors`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `internal_visitor_id` int(11) unsigned NOT NULL,
    `external_visitor_id` VARCHAR(127) NOT NULL,
    `external_id_type` VARCHAR(127) NOT NULL,
    `expires` int(11) unsigned NOT NULL,
    `created` DATETIME NOT NULL,
    `updated` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `external_visitor_id` (`external_visitor_id`),
    INDEX `internal_visitor_id` (`internal_visitor_id`),
    INDEX `external_id_type` (`external_id_type`),
    INDEX `expires` (`expires`),
    INDEX `created` (`created`),
    INDEX `updated` (`updated`),
    CONSTRAINT `external_visitors_fk_595f0d`
        FOREIGN KEY (`internal_visitor_id`)
        REFERENCES `visitors` (`id`)
) ENGINE=InnoDB CHARACTER SET=\'utf8mb4\' COLLATE=\'utf8mb4_unicode_ci\';

CREATE TABLE `tests`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `test_name` VARCHAR(127),
    `created` DATETIME NOT NULL,
    `updated` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `test_name` (`test_name`),
    INDEX `created` (`created`),
    INDEX `updated` (`updated`)
) ENGINE=InnoDB CHARACTER SET=\'utf8mb4\' COLLATE=\'utf8mb4_unicode_ci\';

CREATE TABLE `variants`
(
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `test_id` int(11) unsigned NOT NULL,
    `name` VARCHAR(127) NOT NULL,
    `metadata` VARCHAR(127),
    `created` DATETIME NOT NULL,
    `updated` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `test_id` (`test_id`),
    INDEX `name` (`name`),
    INDEX `created` (`created`),
    INDEX `updated` (`updated`),
    CONSTRAINT `variants_fk_dbfee7`
        FOREIGN KEY (`test_id`)
        REFERENCES `tests` (`id`)
) ENGINE=InnoDB CHARACTER SET=\'utf8mb4\' COLLATE=\'utf8mb4_unicode_ci\';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `external_visitors`;

DROP TABLE IF EXISTS `tests`;

DROP TABLE IF EXISTS `variants`;

ALTER TABLE `visitors`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}