<?php

class AddFormFilter
{
	const PLUGIN_FILE_NAME = "add-form-filter.php";
	const DATABASE_PREFIX = "add_form_filter_";
	const TABLE_NAME_FILTER = "filter";
	const TABLE_NAME_FIELD = "field";
	
	/**
	 * 
	 * @var AdministrationView
	 */
	private $administrationView = null;
	
	/**
	 * Initialise le plugin
	 */
	public function __construct() {
		register_activation_hook(dirname(dirname(__FILE__))."/".self::PLUGIN_FILE_NAME, array("AddFormFilter", "install"));
		register_uninstall_hook(dirname(dirname(__FILE__))."/".self::PLUGIN_FILE_NAME, array("AddFormFilter", "uninstall"));
		
		add_action('admin_enqueue_scripts', array($this, 'includeScripts'));
		add_action('wp_ajax_drag_and_drop', array('AdministrationAjax', 'dragAndDrop'));
		add_action('init', array($this, 'init'));
		
		$this->administrationView = new AdministrationView();
		add_action('admin_menu', array($this->administrationView, 'addAdminMenu'));
	}
	
	/**
	 * Déploie les tables nécessaires au fonctionnement du plugin dans la base de données Wordpress.
	 */
	public static function install() {
		global $wpdb;
		
		// Déploie le SQL
		$wpdb->query(
				"CREATE TABLE IF NOT EXISTS
				".self::DATABASE_PREFIX.self::TABLE_NAME_FILTER."(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(50) NOT NULL,
				is_actif TINYINT(1) NOT NULL DEFAULT 0
		);");
	
		$wpdb->query(
				"CREATE TABLE IF NOT EXISTS
				".self::DATABASE_PREFIX.self::TABLE_NAME_FIELD."(
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				id_filter INT NOT NULL,
				label VARCHAR(50) NOT NULL,
				meta_key VARCHAR(75) NOT NULL,
				ordre_affichage int DEFAULT 0,
				value_html TEXT DEFAULT NULL,
				FOREIGN KEY (id_filter) REFERENCES ".self::DATABASE_PREFIX.self::TABLE_NAME_FILTER."(id) ON DELETE CASCADE
		);
				");
	}
	
	/**
	 * Supprime les tables du plugin en base de données.
	 */
	public static function uninstall() {
		global $wpdb;
	
		$wpdb->query("DROP TABLE IF EXISTS ".self::DATABASE_PREFIX.self::TABLE_NAME_FIELD);
		$wpdb->query("DROP TABLE IF EXISTS ".self::DATABASE_PREFIX.self::TABLE_NAME_FILTER);
	}
	
	public function init() {
		// Pour les redirections
		session_start();
		ob_start();
	}
	
	public function includeScripts() {
		wp_enqueue_style('admin', plugin_dir_url(dirname(__FILE__)) . '/ressources/css/admin.css');
		wp_enqueue_style('jquery-ui-slider-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
		wp_register_script('admin', plugin_dir_url(dirname(__FILE__)) . '/ressources/js/admin.js');
		
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('admin');
	}
}