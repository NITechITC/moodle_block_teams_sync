<?php
    
require("../../config.php");   
require_once("../../lib/deprecatedlib.php");    

global $USER;

    $id=required_param('id',PARAM_INT);
    
    require_login();

    $coursecontext = get_context_instance(CONTEXT_COURSE, $id);

    if (has_capability('moodle/course:update', $coursecontext)) {
        $ugc=$DB->get_record('config_plugins',array('plugin'=>'local_o365','name'=>'usergroupcustom'));
        if ($ugc) {
            $ary1=json_decode($ugc->value,true);
            $ary1[$id]=true;
            $jsc1=json_encode($ary1);
            $ugc->value=$jsc1;
            $DB->update_record('config_plugins',$ugc);
	} else {
	    $ugc=new StdClass;
	    $ugc->plugin='local_o365';
	    $ugc->name='usergroupcustom';
            $ary1=array();
            $ary1[$id]=true;
            $jsc1=json_encode($ary1);
            $ugc->value=$jsc1;
            $DB->insert_record('config_plugins',$ugc);
	}

        $ugcf=$DB->get_record('config_plugins',array('plugin'=>'local_o365','name'=>'usergroupcustomfeatures'));
        if ($ugcf) {
            $ary2=json_decode($ugcf->value,true);
	    $ary2[$id]["team"]=true;
            $jsc2=json_encode($ary2);
            $ugcf->value=$jsc2;
            $DB->update_record('config_plugins',$ugcf);
	} else {
	    $ugcf=new StdClass;
	    $ugcf->plugin='local_o365';
	    $ugcf->name='usergroupcustomfeatures';
            $ary2=array("teams"=>true);
	    $ary3=array();
            $ary3[$id]=$ary2;
            $jsc2=json_encode($ary3);
            $ugcf->value=$jsc2;
            $DB->insert_record('config_plugins',$ugcf);
	}
    }

    redirect($CFG->wwwroot."/course/view.php?id=$id");
?>