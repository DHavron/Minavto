<div id="center">
<?php
$antiHack=new antiHack;
$search=$antiHack->filterAll(strip_tags($_POST['sent-words']));
if (strlen($search)>0) {
	$res=array();
	$articles=$this->dbc->select('`article` `tpl`,`text` `t`,`name` `n`',array('`n`.`name_'.$this->lang.'`','`t`.`text_'.$this->lang.'`','`tpl`.`img`','`tpl`.`id`'),'`t`.`id_row`=`tpl`.`id` && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'article\') && `t`.`id_row`=`n`.`id_row` && `n`.`id_table`=`t`.`id_table` && (`n`.`name_'.$this->lang.'` LIKE \'%'.$search.'%\' || `t`.`text_'.$this->lang.'` LIKE \'%'.$search.'%\')');
	for($i=0;$i<count($articles);++$i) {
		$res[]=array(
									'table'=>'article',
									'id'=>$articles[$i]['id'],
									'img'=>$articles[$i]['img'],
									'name'=>$articles[$i]['name_'.$this->lang],
									'text'=>strip_tags($articles[$i]['text_'.$this->lang])
		);
	}
	$news=$this->dbc->select('`news` `tpl`,`text` `t`,`name` `n`',array('`n`.`name_'.$this->lang.'`','`t`.`text_'.$this->lang.'`','`tpl`.`img`','`tpl`.`id`'),'`t`.`id_row`=`tpl`.`id` && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'news\') && `t`.`id_row`=`n`.`id_row` && `n`.`id_table`=`t`.`id_table` && (`n`.`name_'.$this->lang.'` LIKE \'%'.$search.'%\' || `t`.`text_'.$this->lang.'` LIKE \'%'.$search.'%\')');
	for($i=0;$i<count($news);++$i) {
		$res[]=array(
									'table'=>'news',
									'id'=>$news[$i]['id'],
									'img'=>$news[$i]['img'],
									'name'=>$news[$i]['name_'.$this->lang],
									'text'=>strip_tags($news[$i]['text_'.$this->lang])
		);
	}
	unset($articles,$news);
	if (count($res)>0) {
		$url=new createUrl($this->dbc,$this->core);
		$trimText=new trimText;
		for($i=0;$i<count($res);++$i) {
			$urlItem=$url->url($res[$i]['table'],$res[$i]['id']);
	?>
			<div class="news">
			<?php
				if (!is_null($res[$i]['img'])) {
			?>
			<div class="image"><a href="<?php echo $this->_SITE_.'/'.$this->lang.$urlItem; ?>" title="<?php echo $res[$i]['name']; ?>"><img src="<?php echo $this->_SITE_; ?>/img/<?php echo $res[$i]['table']; ?>/<?php echo $res[$i]['img']; ?>" alt="<?php echo $res[$i]['name']; ?>"></a></div>
			<?php
				}
			?>
			<h3><a href="<?php echo $this->_SITE_.'/'.$this->lang.$urlItem; ?>" title="<?php echo $res[$i]['name']; ?>"><?php echo $res[$i]['name']; ?></a></h3>
			<p><?php echo $trimText->trim(400,strip_tags($res[$i]['text']),true); ?></p>
		</div>
	<?php
		}
	}
	else {
		switch($this->lang) {
			case 'ru': echo '<p>По Вашему запросу <u>'.mb_strtoupper($search,'UTF-8').'</u> ничего не найдено!</p>';break;
			case 'en': echo '<p>Your search <u>'.mb_strtoupper($search,'UTF-8').'</u> nothing found!</p>';break;
			case 'pl': echo '<p>Szukano <u>'.mb_strtoupper($search,'UTF-8').'</u> nic nie znaleziono!</p>'; break;
			case 'by': echo '<p>Па Вашым запыце <u>'.mb_strtoupper($search,'UTF-8').'</u> нічога не знойдзена!</p>'; break;
			default: echo '<p>Ihre suche <u>'.mb_strtoupper($search,'UTF-8').'</u> nichts gefunden!</p>';
		}
	}
}
?>
</div>