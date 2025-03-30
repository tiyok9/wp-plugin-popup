<?php

namespace database;
class DBCreate
{
    private static $instance = null;

    private function __construct()
    {
        // Singleton
    }

    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function my_plugin_create_table()
    {
        global $wpdb;
		$table_theme = $wpdb->prefix . 'popup_settings';
        $table_content = $wpdb->prefix . 'popup_content';
        $subscribe = $wpdb->prefix . 'subscribe';

        $charset_collate = $wpdb->get_charset_collate();

        // Tabel utama
        $sql1 = "CREATE TABLE $table_theme (
        id INT NOT NULL AUTO_INCREMENT,
        theme_style LONGTEXT NULL,
        button_style LONGTEXT NULL,
        button TINYINT(1) NOT NULL DEFAULT 0,
        background_img VARCHAR(255) NULL,
        template VARCHAR(100) NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

        // Tabel relasi popup dengan halaman
        $sql2 = "CREATE TABLE $table_content (
        id INT NOT NULL AUTO_INCREMENT,
        theme_id INT NOT NULL,
        page_id BIGINT(20) UNSIGNED NOT NULL,
        popup_title VARCHAR(255) NOT NULL,
        popup_content TEXT NOT NULL,
        popup_button VARCHAR(100) NOT NULL,
        status TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        FOREIGN KEY (theme_id) REFERENCES $table_theme(id) ON DELETE CASCADE,
        FOREIGN KEY (page_id) REFERENCES {$wpdb->prefix}posts(ID) ON DELETE CASCADE
    ) $charset_collate;";


        // Pastikan upgrade.php sudah diload sebelum dbDelta
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        dbDelta($sql1);
        dbDelta($sql2);
    }


    public static function my_plugin_delete_table()
    {
        global $wpdb;

        // Daftar tabel yang akan dihapus
        $tables = [
            $wpdb->prefix . 'popup_settings',
            $wpdb->prefix . 'popup_content',
        ];

        // Loop untuk menghapus setiap tabel
        foreach ($tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS $table");
        }
    }

}

if (defined('ABSPATH')) {
    register_activation_hook(__FILE__, ['DBCreate', 'my_plugin_create_table']);
    register_deactivation_hook(__FILE__, ['DBCreate', 'my_plugin_delete_table']);
    register_uninstall_hook(__FILE__, ['DBCreate', 'my_plugin_delete_table']);

    // Auto-create table jika belum ada (tanpa perlu deactivate/activate plugin)
    add_action('plugins_loaded', function () {
        DBCreate::my_plugin_create_table();
    });
}
