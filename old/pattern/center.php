<script type="text/javascript" src="<?php echo $this->_SITE_; ?>/js/jquery.carouFredSel-6.2.1.js"></script>
<div id="center">
<?php
$text=$this->dbc->select('`setting`',array('`text_'.$this->lang.'`'),null,null,'LIMIT 1');
echo $text[0]['text_'.$this->lang];
unset($text);
?>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('.image-3-mod>ul').carouFredSel({scroll : {duration: 1000}});
});
</script>