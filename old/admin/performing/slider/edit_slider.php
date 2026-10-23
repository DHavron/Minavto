<?php
set_include_path($_SERVER['DOCUMENT_ROOT'].'/executables');
spl_autoload_extensions('.class.php');
spl_autoload_register();
$auth=new auth();
if (!$auth->validAuth('admin')) {
    header ("Location: ".$auth->_SITE_."/admin/login.php");
    exit();
}
$init=new admin();
if ($auth->checkRight(array(0,1,2))&&$init->validateSender()) {
$antiHack=new antiHack;
$trimText=new trimText;
################################################# id #########################################################
if (isset($_POST['id'])&&!empty($_POST['id'])) {
    $id=intval($antiHack->filterAll($_POST['id']));
}
else {$init->back(666);}
########################################### now ##########################################################
$now=$init->dbc->select('`slider` `s`,`name` `n`,`text` `t`',array('`s`.`level`','`s`.`id_position`','`s`.`folder`','`n`.`name_'.$init->lang.'`','`t`.`text_'.$init->lang.'`'),'`s`.`id`='.$id.' && `n`.`id_table`=14 && `n`.`id_row`=`s`.`id` && `t`.`id_table`=14 && `t`.`id_row`=`s`.`id`',null,'LIMIT 1');
############################################## name ##########################################################
if (isset($_POST['name_'.$init->lang])&&!empty($_POST['name_'.$init->lang])) {
    $name=$trimText->trim(240,$antiHack->filterAll($_POST['name_'.$init->lang]));
}
else {$init->back(666);}
###################################################### text ############################
if (isset($_POST['text_'.$init->lang])&&!empty($_POST['text_'.$init->lang])) {
    $text=$_POST['text_'.$init->lang];
}
else {$text=null;}
###################################################### link ############################
if (isset($_POST['link'])&&is_array($_POST['link'])) {
    $link=$_POST['link'];
}
else {$link=array();}
################################################## level ###########################################
if (isset($_POST['level'])&&!empty($_POST['level'])) {
    $level=intval($antiHack->filterAll($_POST['level']));
}
else {$level=0;}
###################################################### position ############################
if (isset($_POST['position'])&&!empty($_POST['position'])&&$init->isPosInSlider($_POST['position'])) {
    $position=intval($antiHack->filterAll($_POST['position']));
}
else {$init->back(666);}
####################################################### ok #####################################################
if (($name!='')&&($id>0)&&($position>0)) {
    if ($init->dbc->update('`slider`',array('`id_position`','`date`','`level`'),array($position,date('Y-m-d H:i:s'),$level),'`id`='.$id)&&
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($name),'`id_table`=14 && `id_row`='.$id)&&
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($text),'`id_table`=14 && `id_row`='.$id)
    ) {
            if ($name==$now[0]['name_'.$init->lang]) {
                $init->dbc->delete(array('`slider_links`'),array('`id_slider`='.$id));
                if (count($link)>0) {
                    foreach ($link as $val) {
                        $init->dbc->insert('`slider_links`',array('`id_slider`','`link`'),array($id,$val));
                    }
                }
                $init->back(0);
            }
            else {
                if ($init->lang==$init->core['languages'][0]) {
                    $nameFolder=mb_strtolower($init->translit($name),'UTF-8');
                    $dir=$init->_DIR_.'/img/slider/';
                    $dirNew=$dir.$nameFolder;
                    if (mkdir($dirNew,0755)) {
                        $glob=glob($dir.$now[0]['folder'].'/*');
                        foreach ($glob as $allFiles) {
                            $arrayUrl=explode('/',$allFiles);
                            $nameFile=end($arrayUrl);
                            @rename($allFiles,$dirNew.'/'.$nameFile);
                        }
                        $init->deleteAndClearDir($dir.$now[0]['folder']);
                        $init->dbc->update('`slider`',array('`folder`'),array($nameFolder),'`id`='.$id);
                        $init->dbc->delete(array('`slider_links`'),array('`id_slider`='.$id));
                        if (count($link)>0) {
                            foreach ($link as $val) {
                                $init->dbc->insert('`slider_links`',array('`id_slider`','`link`'),array($id,$val));
                            }
                        }
                        $init->back(0);
                    }
                    else {
                        $init->dbc->update('`slider`',array('`id_position`','`date`','`level`'),array($now[0]['id_position'],$now[0]['date'],$now[0]['level']),'`id`='.$id);
                        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=14 && `id_row`='.$id);
                        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($now[0]['text_'.$init->lang]),'`id_table`=14 && `id_row`='.$id);
                        $init->back(555);
                    }
                }
                else {
                    $init->dbc->delete(array('`slider_links`'),array('`id_slider`='.$id));
                    if (count($link)>0) {
                            foreach ($link as $val) {
                                $init->dbc->insert('`slider_links`',array('`id_slider`','`link`'),array($id,$val));
                            }
                    }
                    $init->back(0);
                }
            }
    }
    else {
        $init->dbc->update('`slider`',array('`id_position`','`date`','`level`'),array($now[0]['id_position'],$now[0]['date'],$now[0]['level']),'`id`='.$id);
        $init->dbc->update('`name`',array('`name_'.$init->lang.'`'),array($now[0]['name_'.$init->lang]),'`id_table`=14 && `id_row`='.$id);
        $init->dbc->update('`text`',array('`text_'.$init->lang.'`'),array($now[0]['text_'.$init->lang]),'`id_table`=14 && `id_row`='.$id);
        $init->back(1010);
    }
}
else {$init->back(666);}
}
else {$init->back(10);}
?>