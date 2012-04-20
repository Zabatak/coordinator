<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * FrontlineSMS Hook
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package	   Ushahidi - http://source.ushahididev.com
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license	   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
class coordinator {

    /**
     * Registers the main event add method
     */
    public function __construct() {
        // Hook into routing
        Event::add('system.pre_controller', array($this, 'add'));
    }

    /**
     * Adds all the events to the main Ushahidi application
     */
    public function add() {
        // SMS Provider
        //Event::add('ushahidi_action.nav_admin_main_top', array($this, 'addToMenu'));	

        if (Router::$controller == 'coordinator') {

            plugin::add_javascript('coordinator/views/js/jquery.colorbox');
            #plugin::add_javascript('fullscreenmap/views/js/ui.draggable');
            //plugin::add_stylesheet('coordinator/views/css/fullscreenmap');
            plugin::add_stylesheet('coordinator/views/css/colorbox');
        }

        Event::add('ushahidi_action.nav_admin_main_top', array($this, '_addToMenu'));
        //Event::add('ushahidi_action.admin_header_top_left', array($this, '_check_for_group'));	
    }

    public function _addToMenu() {
        $data = Event::$data;
        //vent::$data = array();
        $data['coordinator'] = 'coordinator';
        Event::$data = $data;
        /* Event::
          print_r($this_page);
          echo $this_page;
          $menu = "";
          $menu .= "<li><a href=\"" . url::site() . "bigmap\" ";
          $menu .= ($this_page == 'bigmap') ? " class=\"active\"" : "";
          $menu .= ">" . Kohana::lang('adminmap.big_map_main_menu_tab') . "</a></li>";
          $this_page['abbas'] = 'abbas' ;
          //echo $menu;
         */
    }

}

new coordinator;
