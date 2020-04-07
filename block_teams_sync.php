<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *Teams sync block class.
 *
 * @package    block_teams_sync
 * @author     Hirotaka Itoh <ht-itoh@nitech.ac.jp>, Naoki Maeda <maeda.naoki@nitech.ac.jp>
 * @copyright  (C) 2020 onwards NITech Information Technology Center (https://www.cc.nitech.ac.jp)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

class block_teams_sync extends block_base{
	
    function init(){
	//Get Title
	$this->title = get_string('teams_sync','block_teams_sync');
			//ブロックのバージョンの設定
	//$this->version = 2020040400;
    }

    function applicable_formats() {
	return array('all' => false, 'my' => false, 'course'=>true);
    }
		
    function instance_allow_multiple(){
	return true;
    }

    function instance_allow_config(){
	return true;
    }
		
    function get_content(){
        global $CFG, $USER, $DB;

        if ($this->content !== NULL) {
	    return $this->content;
        }
				
        $id = optional_param('id', 0, PARAM_INT);
        if ($cs = optional_param('course', 0, PARAM_INT)!=0) return '';
		
        if ($id != 0) {
	    if (!$course = $DB->get_record('course', array('id'=>$id))) {
		error('courseidwrong','block_attendance');
            }
 	} else {
            return;
        }		
			
        $this->content = new stdClass;
        $this->content->footer = '';
	
	$coursecontext = get_context_instance(CONTEXT_COURSE, $id);
        
	$lo365= $DB->get_record('config_plugins', array('plugin'=>'local_o365','name'=>'usergroupcustom'));
        if ($lo365) {
            $jsc=json_decode($lo365->value,true);
            if (array_key_exists($id,$jsc)) {
	      if ($jsc[$id]) $flag=1;
              else $flag=0;
	    } else {
	      $flag=0;
	    }
        } else {
	    $flag=0;
	}

        if ($flag) {
            $this->content->text = get_string('teamson','block_teams_sync');
        } else {
            $this->content->text = get_string('teamsoff','block_teams_sync');
            if (has_capability('moodle/course:update', $coursecontext)) {
	        $this->content->text .= '<p><center><a href="'.$CFG->wwwroot.'/blocks/teams_sync/turnon.php?id='.$id.'">'.get_string('turnon','block_teams_sync').'</a></center><br />';
	    }
        }			 
        return $this->content;
    }
}
?>
