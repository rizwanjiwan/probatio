<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1601643129.
 * Generated on 2020-10-02 12:52:09 by woohooo
 */
class PropelMigration_1601643129
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

ALTER TABLE `assigned_variants`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `internal_visitor_id` `internal_visitor_id` int(11) unsigned NOT NULL,

  CHANGE `variant_id` `variant_id` int(11) unsigned NOT NULL;

CREATE INDEX `internal_visitor_id` ON `assigned_variants` (`internal_visitor_id`);

ALTER TABLE `assigned_variants` ADD CONSTRAINT `assigned_variants_fk_595f0d`
    FOREIGN KEY (`internal_visitor_id`)
    REFERENCES `visitors` (`id`);

ALTER TABLE `external_visitors`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `internal_visitor_id` `internal_visitor_id` int(11) unsigned NOT NULL,

  CHANGE `expires` `expires` int(11) unsigned NOT NULL;

ALTER TABLE `tests`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `variants`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `test_id` `test_id` int(11) unsigned NOT NULL;

ALTER TABLE `visitors`

  CHANGE `id` `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

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

ALTER TABLE `assigned_variants` DROP FOREIGN KEY `assigned_variants_fk_595f0d`;

DROP INDEX `internal_visitor_id` ON `assigned_variants`;

ALTER TABLE `assigned_variants`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `internal_visitor_id` `internal_visitor_id` int unsigned NOT NULL,

  CHANGE `variant_id` `variant_id` int unsigned NOT NULL;

ALTER TABLE `external_visitors`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `internal_visitor_id` `internal_visitor_id` int unsigned NOT NULL,

  CHANGE `expires` `expires` int unsigned NOT NULL;

ALTER TABLE `tests`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE `variants`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT,

  CHANGE `test_id` `test_id` int unsigned NOT NULL;

ALTER TABLE `visitors`

  CHANGE `id` `id` int unsigned NOT NULL AUTO_INCREMENT;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}