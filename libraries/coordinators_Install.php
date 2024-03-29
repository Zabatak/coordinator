<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Performs install/uninstall methods for the FrontlineSMS Plugin
 *
 * @package    Ushahidi
 * @author     Ushahidi Team
 * @copyright  (c) 2008 Ushahidi Team
 * @license    http://www.ushahidi.com/license.html
 */
class coordinators_Install {
	
	/**
	 * Constructor to load the shared database library
	 */
	public function __construct()
	{
		$this->db =  new Database();
	}

	/**
	 * Creates the required columns for the FrontlineSMS Plugin
	 */
	public function run_install()
	{
		
		// ****************************************
		// DATABASE STUFF
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `".Kohana::config('database.default.table_prefix')."reporters_location`
			(
				id int(11) unsigned NOT NULL AUTO_INCREMENT,
                                user_id int(11) unsigned NOT NULL,
				lat varchar(100) DEFAULT NULL,
                                lng varchar(100) DEFAULT NULL,
				PRIMARY KEY (`id`)
			);
		");
		// ****************************************
	}

	/**
	 * Drops the FrontlineSMS Tables
	 */
	public function uninstall()
	{
		$this->db->query("
			DROP TABLE ".Kohana::config('database.default.table_prefix')."reporters_location;
			");
	}
}