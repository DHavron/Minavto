<div id="center">
<?php
$url=new createUrl($this->dbc,$this->core);
$news=$this->dbc->select('`'.$this->core['tpls'][$this->useTpl]['table'].'` `tpl`,`name` `n`,`text` `t`',array('`t`.`text_'.$this->lang.'`','`tpl`.`id`','`tpl`.`img`','`n`.`name_'.$this->lang.'`'),'`tpl`.`show`=\'on\' && `t`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$this->core['tpls'][$this->useTpl]['table'].'\' && `t`.`id_row`=`tpl`.`id` && `n`.`id_table`=`t`.`id_table` && `n`.`id_row`=`tpl`.`id`)',null,$this->navi->limit);
$trimText=new trimText;
for($i=0;$i<count($news);++$i) {
	$urlItem=$url->url('news',$news[$i]['id']);
?>
	<div class="news">
		<?php
		if (!is_null($news[$i]['img'])) {
		?>
		<div class="image"><a href="<?php echo $this->_SITE_.'/'.$this->lang.$urlItem; ?>" title="<?php echo $news[$i]['name_'.$this->lang]; ?>"><img src="<?php echo $this->_SITE_; ?>/img/news/<?php echo $news[$i]['img']; ?>" alt="<?php echo $news[$i]['name_'.$this->lang]; ?>"></a></div>
		<?php
		}
		?>
		<h3><a href="<?php echo $this->_SITE_.'/'.$this->lang.$urlItem; ?>" title="<?php echo $news[$i]['name_'.$this->lang]; ?>"><?php echo $news[$i]['name_'.$this->lang]; ?></a></h3>
		<p><?php echo $trimText->trim(680,strip_tags($news[$i]['text_'.$this->lang]),true); ?></p>
	</div>
<?php
}
unset($news);
?>
	<div class="pagination">Страницы: <?php $this->navi->showNavigation($this->_SITE_.'/'.$this->lang.$this->url); ?></div>
</div>