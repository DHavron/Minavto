<?php
$langs=array(
    'ru'=>array('ru'=>'Русский язык','en'=>'Английский язык','de'=>'Немецкий язык','pl'=>'Польский язык','by'=>'Белорусский язык','logo'=>'Логотип компании'),
    'en'=>array('ru'=>'Russian','en'=>'English','de'=>'German','pl'=>'Polish','by'=>'Belorussian','logo'=>'Company logo'),
    'de'=>array('ru'=>'Russisch','en'=>'Englisch','de'=>'Deutsch','pl'=>'Polnisch','by'=>'Weißrussisch','logo'=>'Firmenlogo'),
    'pl'=>array('ru'=>'Rosyjski','en'=>'Angielski','de'=>'Niemiecki','pl'=>'Polski','by'=>'Białoruski','logo'=>'Logo firmy'),
    'by'=>array('ru'=>'Руская мова','en'=>'Англійская мова','de'=>'Нямецкая мова','pl'=>'Польская мова','by'=>'Беларуская мова','logo'=>'')
);
$slider=new slider($this->dbc,$this->_SITE_,$this->url,$this->lang);
?>
<div id="top">
    <table>
        <tr>
            <td id="logo" rowspan="3"><img src="<?php echo $this->_SITE_; ?>/imgcss/logo.gif" alt="<?php echo $langs[$this->lang]['logo']; ?>" title="<?php echo $langs[$this->lang]['logo']; ?>"></td>
            <td id="lang">
                <div id="modul-pos1"><?php $modul->showModul(1); ?></div>
                <?php
                $alLangs=array_reverse($this->core['languages']);
                for ($i=0;$i<count($alLangs);++$i) {
                    $activeLang=($this->lang==$alLangs[$i])?' active':null;
                    $noFirst=($i==count($alLangs))?' first-lang':' no-first-lang';
                    $lastLang=($i==0)?' last-lang':null;
                    $urlLink=($this->url=='')?'/':$this->url;
                ?>
				<div class="lang"><a href="<?php echo $this->_SITE_.'/'.$alLangs[$i].$urlLink; ?>" title="<?php echo $langs[$this->lang][$alLangs[$i]]; ?>">
                    <span class="img-lang<?php echo $activeLang; ?>"><img src="<?php echo $this->_SITE_; ?>/imgcss/<?php echo $alLangs[$i]; ?>.jpg" alt="<?php echo $langs[$this->lang][$alLangs[$i]]; ?>" /></span>
                    <span class="text-lang<?php echo $lastLang.$noFirst.$activeLang; ?>"><?php echo mb_strtoupper($alLangs[$i],'utf-8'); ?></span>
                </a></div>
                <?php
                }
                unset($alLangs);
                ?>
            </td>
        </tr>
        <tr>
            <td id="menu">
                <?php
                $menuTop=$this->dbc->select('`menu` `m`,`name` `n`',array('`m`.`click`','`m`.`link`','`n`.`name_'.$this->lang.'`'),'`m`.`show`=\'on\' && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\'menu\') && `n`.`id_row`=`m`.`id`','`m`.`level`');
                for ($i=0;$i<count($menuTop);++$i) {
                    $link=($menuTop[$i]['link']=='')?'/':$menuTop[$i]['link'];
                    $class=' class="menu';
                    if ($i==(count($menuTop)-1)) $class.='-first';
                    if ($i==0) $class.='-last';
                    if ($this->url==$menuTop[$i]['link']) $class.='-active';
                    $class.='"';
                ?>
                <a href="<?php echo $this->_SITE_.'/'.$this->lang.$link; ?>" title="<?php echo $menuTop[$i]['name_'.$this->lang]; ?>"<?php echo $class; ?>><?php echo $menuTop[$i]['name_'.$this->lang]; ?></a>
                <?php
                }
                unset($menuTop);
                ?>
            </td>
        </tr>
        <?php
        $searchLang=array(
            'ru'=>array('name'=>'Поиск','find'=>'Найти'),
            'en'=>array('name'=>'Search','find'=>'Find'),
            'de'=>array('name'=>'Suche','find'=>'Finden'),
            'pl'=>array('name'=>'Poszukiwanie','find'=>'Odnaleźć'),
            'by'=>array('name'=>'Пошук','find'=>'Знайсці'),
        );
        ?>
        <tr><td id="search">
        <div id="poisk"><form method="post" action="<?php echo $this->_SITE_.'/'.$this->lang.'/suche/'; ?>">
            <label for="sent-words"><?php echo $searchLang[$this->lang]['name']; ?></label><input type="text" name="sent-words" size="18" id="sent-search">
            <input type="image" src="<?php echo $this->_SITE_; ?>/imgcss/search.png" id="sent" title="<?php echo $searchLang[$this->lang]['find']; ?>">
        </form></div>
        </td></tr>
        <?php
        unset($searchLang);
        ?>
    </table>
</div>