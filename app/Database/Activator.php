<?php

namespace NinjaCountdown\Database;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Activator Class
 * @since 1.0.0
 */
class Activator
{
    public $wpsrDBVersion = NINJACOUNTDOWN_DB_VERSION;

    public function migrateDatabases($network_wide = false)
    {
        global $wpdb;
        if ($network_wide) {
            // Retrieve all site IDs from this network (WordPress >= 4.6 provides easy to use functions for that).
            if (function_exists('get_sites') && function_exists('get_current_network_id')) {
                $site_ids = get_sites(array('fields' => 'ids', 'network_id' => get_current_network_id()));
            } else {
                $site_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs WHERE site_id = $wpdb->siteid;");
            }
            // Install the plugin for all these sites.
            foreach ($site_ids as $site_id) {
                switch_to_blog($site_id);
                $this->migrate();
                restore_current_blog();
            }
        } else {
            $this->migrate();
        }
    }

    public function maybeUpgradeDB()
    {
        if (get_option('WPSR_DB_VERSION') < $this->wpsrDBVersion) {
            // We need to upgrade the database
            $this->forceUpgradeDB();
        }
    }

    public function forceUpgradeDB()
    {
        update_option('WPSR_DB_VERSION', $this->wpsrDBVersion, false);
    }

    public function migrate()
    {
        $this->createPeopleTable();
    }

    public function createPeopleTable()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $table_name = $wpdb->prefix . 'ninjapeople';

        $sql = "CREATE TABLE $table_name (
				id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,		
				name varchar(255),	
				description longtext,
				age int(11),
				created_at timestamp NULL,
				updated_at timestamp NULL
			) $charset_collate;";

        return $this->runSQL($sql, $table_name);
    }

    private function runSQL($sql, $tableName)
    {
        global $wpdb;
        if ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName) {
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            return true;
        }
        return false;
    }
}
