<?php
    
    require("../../config.php");   
    require_once("../../lib/deprecatedlib.php");    
    require_once("../../local/o365/classes/feature/usergroups/utils.php");    

    global $USER;

    $id=required_param('id',PARAM_INT);
    
    require_login();

    $coursecontext = get_context_instance(CONTEXT_COURSE, $id);

    if (has_capability('moodle/course:update', $coursecontext)) {
        $ugc=$DB->get_record('config_plugins',array('plugin'=>'local_o365','name'=>'usergroupcustom'));
        $ary1=json_decode($ugc->value,true);
        if (isset($ary1[$id])) {
            unset($ary1[$id]); 
            \local_o365\feature\usergroups\utils::delete_course_group($id);
        }
        $jsc1=json_encode($ary1);
        $ugc->value=$jsc1;
        $DB->update_record('config_plugins',$ugc);

        $ugcf=$DB->get_record('config_plugins',array('plugin'=>'local_o365','name'=>'usergroupcustomfeatures'));
        $ary2=json_decode($ugcf->value,true);
        if (isset($ary2[$id]["team"])) unset($ary2[$id]["team"]); 
        $jsc2=json_encode($ary2);
        $ugcf->value=$jsc2;
        $DB->update_record('config_plugins',$ugcf);
    }

    redirect($CFG->wwwroot."/course/view.php?id=$id");
?>