<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Viddler Admin Controller 
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @module	   Clickatell Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
class Coordinator_Settings_Controller extends Admin_Controller {

    public function __construct() {
        parent::__construct();

        $this->template->this_page = 'Cordinator';
        //$this->params = array('all_reports' => TRUE);
        //
      Event::add('system.pre_controller', array($this, 'add'));
    }

    public function index() {
       
    }

    public function add() {

        Event::add('ushahidi_action.nav_admin_main_top', array($this, 'SESE'));
    }

}