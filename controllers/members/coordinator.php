<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Mobile Controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author	   Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module	   Mobile Controller	
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 * 
 */
class coordinator_Controller extends Members_Controller {

    
    public function __construct() {
        parent::__construct();

        $this->template->this_page = 'coordinator';
        $this->db = new Database();
        //$this->params = array('all_reports' => TRUE);
        //
      //Event::add('system.pre_controller', array($this, 'add'));
    }

    function index() {


        if ($_POST) {
            //$post = Validation::factory(array_merge($_POST));
            //$reporters = $post->reporter;
            //  var_dump($_POST);
            $reporters = $_POST['reporter'];
            //echo $reporters[2]['lat'];


            foreach ($reporters as $id => $r) {
                //echo " Reporter $key has " . $r['lat'] . " " . $r['lng'] . "<br>";
                $model = new Reporters_Model($id);
                $model->user_id = $r['user_id'];
                $model->lat= $r['lat'];
                $model->lng = $r['lng'];
                $model->save();
            }
        }


        //$view = new View('coordinator/reporters');
        $all = ORM::factory('reporters')->find_all();
		$data = $this->db->query('select i.user_id, count(*) cc from reporters_location rl inner join incident i on rl.user_id = i.user_id  group by user_id ORDER BY `i`.`incident_date` DESC ');
		$data2 = $this->db->query('select i.user_id, count(*) cc from reporters_location rl inner join incident i on rl.user_id = i.user_id where incident_active = 1  group by user_id ORDER BY `i`.`incident_date` DESC ');
		$data3 = $this->db->query('select i.user_id, count(*) cc from reporters_location rl inner join incident i on rl.user_id = i.user_id where incident_verified = 1  group by user_id ORDER BY `i`.`incident_date` DESC ');
		

		$counts = array();
		
		foreach ($data as $row){
		  $counts[$row->user_id] = $row->cc;
		}
		
		foreach ($data2 as $row){
		  $accepted[$row->user_id] = $row->cc;
		}
		
		foreach ($data3 as $row){
		  $verified[$row->user_id] = $row->cc;
		}

        //$this->template->content = $view;

        $this->template->content = new View("coordinator/reporters");
        $this->template->content->reporters = $all;
		$this->template->content->counts = $counts;
		$this->template->content->accepted = $accepted;
		$this->template->content->verified = $verified;
        $this->template->content->title = "SMSSync Settings";
        $this->template->map_enabled = TRUE;



        /*
          if ($group->loaded) {
          $this->template->content->group_name = $group->name;
          $this->template->content->group_description = $group->description;
          $this->template->content->group_id = $group->id;
          $this->template->content->group_logo = $group->logo;
          } else { //couldn't load the group so send these jokers back to, ya ya ya you get it.
          url::redirect('main');
          }
          $this->template->content = 'hiii';
         * 
         */

//        $this->template->content = $content;
    }

}