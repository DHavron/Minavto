<div id="center">
<?php
$text=$this->dbc->select('`'.$this->core['tpls'][$this->useTpl]['table'].'` `tpl`,`text` `t`,`name` `n`',array('`n`.`name_'.$this->lang.'`','`t`.`text_'.$this->lang.'`','`tpl`.`img`'),'`tpl`.`id`='.$this->id.' && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$this->core['tpls'][$this->useTpl]['table'].'\') && `t`.`id_row`=`tpl`.`id` && `n`.`id_row`=`tpl`.`id` && `n`.`id_table`=`n`.`id_table`',null,'LIMIT 1');
if (!is_null($text[0]['img'])) {echo '<div class="image_item"><img src="'.$this->_SITE_.'/img/news/'.$text[0]['img'].'" alt="'.$text[0]['name_'.$this->lang].'"></div>';}
echo $text[0]['text_'.$this->lang];
unset($text);
?>
</div>