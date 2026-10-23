<div class="null"></div>
</div>
<?php
$toTop=array('ru'=>'НАВЕРХ','en'=>'UP','de'=>'NACH OBEN','pl'=>'Początek strony','by'=>'НАВЕРХ');
$dev=array(
    'ru'=>array('text'=>'Дизайн и разработка сайта','title'=>'Дизайн и разработка сайта'),
    'en'=>array('text'=>'Website design and development','title'=>'Website design and development'),
    'de'=>array('text'=>'Design und Entwicklung der Webseite','title'=>'Die Entwicklung der Webseite'),
    'pl'=>array('text'=>'Projekt i opracowanie strony internetowej','title'=>'Projekt i opracowanie strony internetowej'),
    'by'=>array('text'=>'Дызайн і распрацоўка сайта','title'=>'Дызайн і распрацоўка сайта')
);
?>
<div id="bottom">
    <div>
    <table><tr>
        <td id="manufacturer"><?php echo $modul->showModul(3); ?></td>
        <td id="to-up"><a href="<?php echo $this->_SITE_.'/'.$this->lang;echo ($this->url=='')?'/':$this->url; ?>#up"><?php echo mb_strtoupper($toTop[$this->lang],'utf-8') ?></a></td>
        <td id="developer"><a href="https://it-elab.by" title="<?php echo $dev[$this->lang]['title']; ?>" target="_blank"><?php echo $dev[$this->lang]['text']; ?></a> :: iT-eLab</td>
    </tr></table>
    <div style="height: 0px !important;"><?php $counters=$this->counters(); echo $counters['visible']; ?></div>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<div class="hide"><?php echo $counters['hidden']; ?></div>
<?php
unset($toTop,$dev);
?>