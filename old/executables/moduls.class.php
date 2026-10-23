<?php
class moduls {
    public function __construct($db,$site,$url,$lang) {
        $this->db=$db;
        $this->_SITE_=$site;
        $this->url=str_ireplace($this->_SITE_,'',$url);
        if (($this->url=='')||empty($this->url)) $this->url='index';
        $this->lang=$lang;
    }
    public function showModul($position) {
        $queryModul=$this->db->select('`moduls` `m`,`text` `t`',array('`t`.`text_'.$this->lang.'`'),'`m`.`show`=\'on\' && `t`.`id_row`=`m`.`id` && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'moduls\') && `m`.`id_position`='.$position,'`m`.`level` DESC','LIMIT 1');
        $queryShowModul=$this->db->select('`moduls_links` `l`,`moduls` `m`',array('`l`.`link`'),'`m`.`show`=\'on\' && `m`.`id_position`='.$position.' && `l`.`id_modul`=`m`.`id`');
        if (count($queryShowModul)>0) {
            $textModul=null;
            foreach ($queryShowModul as $mod) {
                if ($mod['link']==$this->url) {$textModul=$queryModul[0]['text_'.$this->lang];break;}
            }
            return $textModul;
        }
        elseif ((count($queryModul)>0)&&(count($queryShowModul)==0)) {
            return $queryModul[0]['text_'.$this->lang];
        }
        else return null;
    }
    public function __destruct() {}
}
?>