<?php
class slider {
    public function __construct($db,$site,$url,$lang) {
        $this->db=$db;
        $this->_SITE_=$site;
        $this->url=str_ireplace($this->_SITE_,'',$url);
        if (($this->url=='')||empty($this->url)) $this->url='index';
        $this->lang=$lang;
    }
    public function initialSlider($position) {
        $this->slides=array();
        $this->show=false;
        $querySlider=$this->db->select('`slider` `s`,`text` `t`',array('`s`.`id`','`s`.`folder`','`t`.`text_'.$this->lang.'`'),'`s`.`show`=\'on\' && `t`.`id_row`=`s`.`id` && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'slider\') && `s`.`id_position`='.$position,'`s`.`level` DESC');
        if (count($querySlider)>0) {
            $slider=array();
            foreach ($querySlider as $resSlider) {
                $slider[$resSlider['id']]=array('folder'=>$resSlider['folder'],'text'=>$resSlider['text_'.$this->lang]);
            }
            unset($querySlider);
            $queryLinks=$this->db->select('`slider_links`',array('`id_slider`'),'`id_slider` IN ('.implode(',',array_keys($slider)).') && `link`=\''.$this->url.'\'');
            if (count($queryLinks)>0) {
              $newIdSlider=array();
              foreach ($queryLinks as $link) {$newIdSlider[]=$link['id_slider'];}
              foreach ($slider as $key=>$val) {if (!in_array($key,$newIdSlider)) unset($slider[$key]);}
              $querySlides=$this->db->select('`slides` `sl`,`text` `t`,`name` `n`',array('`sl`.`link`','`sl`.`id_slider`','`sl`.`img`','`t`.`text_'.$this->lang.'`','`n`.`name_'.$this->lang.'`'),'`sl`.`id_slider` IN ('.implode(',',array_keys($slider)).') && `t`.`id_row`=`sl`.`id` && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'slides\') && `n`.`id_row`=`sl`.`id` && `n`.`id_table`=`t`.`id_table`','`sl`.`level` DESC,`sl`.`id` DESC');
              if (count($querySlides)>0) {
                foreach ($querySlides as $sl) {
                    $this->slides[]=array(
                                            'name'=>$sl['name_'.$this->lang],
                                            'img'=>$this->_SITE_.'/img/slider/'.$slider[$sl['id_slider']]['folder'].'/'.$sl['img'],
                                            'link'=>$sl['link'],
                                            'text'=>$this->textForSlide($slider[$sl['id_slider']]['text'],$sl['text_'.$this->lang])
                                        );
                }
                $this->show=true;
              }
            }
            unset($queryLinks);
        }
        else {unset($querySlider);}
    }
    private function textForSlide($textSlider,$textSlide) {
        if (empty($textSlide)||($textSlide=='')||is_null($textSlide)) {return $textSlider;} else {return $textSlide;}
    }
    public function __destruct() {}
}
?>