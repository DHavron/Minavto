<?php
class init extends prepend {
    private $nowPage=1;
    public $id;
    public $serverVars=array();
    public $url='';
    public $tdk=array('title'=>'','description'=>'','keywords'=>'');
    public $vae=array();
    public $navi;
    public $lang;
    public $filter=null;
    private $headers=array(/*'Content-Type: application/xhtml+xml; charset=UTF-8','X-UA-Compatible: IE=Edge,chrome=1'*/);
    
    public function __construct($sessionRegen=false) {
        $this->session($sessionRegen);
        $this->dbc=new mysql('CRU');
        $this->varsVerify();
        $this->core=$this->loadCore();
        $this->useTpl=$this->core['links']['default']['sort-tpl'][0]['name-tpl'];
    }

    public function putToHeaders($header) {
        $this->headers[]=$header;
    }
    function sendHeaders() {
        for($head=0;$head<count($this->headers);++$head) {
            header($this->headers[$head]);
        }
    }
    public function getStyles() {
        if (isset($this->core['styles'][$this->useTpl])) {
            for ($style=0;$style<count($this->core['styles'][$this->useTpl]);++$style) {
                echo ($this->core['styles'][$this->useTpl][$style]['if']!='of')?'<!--[if '.$this->core['styles'][$this->useTpl][$style]['if'].']>':'';
                echo '<link type="text/css" rel="stylesheet" href="'.$this->core['styles'][$this->useTpl][$style]['href'].'" media="'.$this->core['styles'][$this->useTpl][$style]['media'].'" />';
                echo ($this->core['styles'][$this->useTpl][$style]['if']!='of')?'<![endif]-->'."\n":"\n";
            }
        }
        unset($this->core['styles'],$style);
    }
    public function getScripts() {
        if (isset($this->core['scripts'][$this->useTpl])) {
            for ($script=0;$script<count($this->core['scripts'][$this->useTpl]);++$script) {
                echo '<script type="'.$this->core['scripts'][$this->useTpl][$script]['type'].'" src="'.$this->core['scripts'][$this->useTpl][$script]['src'].'"></script>'."\n";
            }
        }
        unset($this->core['scripts'],$script);
    }
    public function hrefLang() {
      if (($this->core['multilanguage']=="on")&&($this->core['alternate']=="on")) {
        foreach ($this->core['languages'] as $langs) {
            $href=($this->url=='')?$this->_SITE_.'/'.$langs.'/':$this->_SITE_.'/'.$langs.$this->url;
            echo '<link rel="alternate" hreflang="'.$langs.'" href="'.$href.'" />';
        }
        if (isset($href)) unset($href);
      }
    }

    public function session($regen) {
        if(session_id() == '') session_start();
        if ($regen) session_regenerate_id(true);
    }
    
    public function validateSender() {return (stripos($this->serverVars['refer'],$this->_SITE_)!==false) ? true : false;}
    
    private function loadCore() {
        $coreLoad=new core($this->_DIR_.'/core/core.xml');
        return $coreLoad->core;
    }
    
    public function urlVerify() {
        $this->goto301();
        $urlVerify=new urlVerify($this->core,$this->dbc,$this->useTpl);
        if (!$urlVerify->urlVerify) {
            $this->error404();}
        else {
            $this->useTpl=$urlVerify->useTpl();
            $this->nowPage=$urlVerify->numPage();
            $this->id=$urlVerify->useId();
            $this->url=($urlVerify->url=='') ? '' : '/'.$urlVerify->url.'/';
            $this->lang=$urlVerify->useLang();
            $this->filter=$urlVerify->getFilter();
            $this->navi=new navigation($this->dbc,$this->core,$this->useTpl,$this->nowPage,$this->id,$this->url,$this->lang,$urlVerify->navStroke);
        }
        unset($urlVerify);
        $this->tdk();
    }
    private function error404() {
        $this->dbc->cc();
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        $this->useTpl='404';
        $this->loadTpl();
        exit();
    }
    private function goto301() {
        if (($_SERVER['QUERY_STRING']=='')&&($this->core['multilanguage']=='on')) {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: '.$this->_SITE_.'/'.$this->core['languages'][0].'/');
            exit();
        }
    }
    private function varsVerify() {
        $vars=new vars;
        if (!$vars->verify(array('user-agent'))) {$this->error404();}
        $this->serverVars=$vars->getVars();
    }
    
    public function getVAE() {if (isset($_SESSION['vae'])) $this->vae=$_SESSION['vae'];}
    public function clearVAE() {unset($_SESSION['vae']);$this->vae=array();}
    
    private function tdk() {
        if (in_array($this->useTpl,$this->core['name_chpu'])||(in_array($this->useTpl,$this->core['components']['tpls']))||($this->useTpl=='index')) {
            $resTDK=$this->dbc->select(
                '`global_url` `g`,`h1` `h`,`title` `t`,`description` `d`,`keywords` `k`',
                array('`g`.`id`','`h`.`h1_'.$this->lang.'`','`t`.`title_'.$this->lang.'`','`d`.`description_'.$this->lang.'`','`k`.`keywords_'.$this->lang.'`'),
                '`g`.`url`=\''.$this->useTpl.'\' && `g`.`id`=`t`.`id_row` && `h`.`id_row`=`t`.`id_row` && `g`.`id`=`d`.`id_row` && `g`.`id`=`k`.`id_row` && `t`.`id_table`=10 && `h`.`id_table`=10 && `d`.`id_table`=10 && `k`.`id_table`=10',
                null,
                'LIMIT 1'
            );
            if (count($resTDK)>0) {
                $this->tdk['title']=$resTDK[0]['title_'.$this->lang];
                $this->tdk['description']=$resTDK[0]['description_'.$this->lang];
                $this->tdk['keywords']=$resTDK[0]['keywords_'.$this->lang];
                $this->tdk['h1']=$resTDK[0]['h1_'.$this->lang];
            }
        }
        else {
            $resTDK=$this->dbc->select('`title` `tit`,`description` `d`,`keywords` `k`,`h1` `h`',array('`tit`.`title_'.$this->lang.'`','`d`.`description_'.$this->lang.'`','`k`.`keywords_'.$this->lang.'`','`h`.`h1_'.$this->lang.'`'),'`tit`.`id_row`='.$this->id.' && `k`.`id_row`=`tit`.`id_row` && `h`.`id_row`=`tit`.`id_row` && `d`.`id_row`=`tit`.`id_row` && `tit`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$this->core['tpls'][$this->useTpl]['table'].'\') && `d`.`id_table`=`tit`.`id_table` && `h`.`id_table`=`tit`.`id_table` && `k`.`id_table`=`tit`.`id_table`',null,'LIMIT 1');
            if (count($resTDK)>0) {
                $this->tdk['title']=$resTDK[0]['title_'.$this->lang];
                $this->tdk['description']=$resTDK[0]['description_'.$this->lang];
                $this->tdk['keywords']=$resTDK[0]['keywords_'.$this->lang];
                $this->tdk['h1']=$resTDK[0]['h1_'.$this->lang];
            }
        }
    }
    public function loadTpl() {
        if ($this->useTpl!='404') {$this->statistics();}
        require_once($this->_DIR_.'/tpls/'.$this->useTpl.'.php');
    }
    /*_____________________________________________________showText___________________________________________________*/
    public function showText($text) {
        preg_match_all("/%%load=\w([\w|\.|\-])*%%/i",$text,$load,PREG_SET_ORDER);
        if (!empty($load)){
            foreach ($load as $include) {
                $query=preg_replace("/%%load=/",'',$include[0]);
                $nameFile=preg_replace("/%%/",'',$query);
                if (is_file($this->_DIR_.'/include/files/'.$nameFile)) {
                    $text=preg_replace('/'.$include[0].'/i',include($this->_DIR_.'/include/files/'.$nameFile),$text);
                }
                else {$text=preg_replace('/'.$include[0].'/i','',$text);}
            }
        }
        return $text;
    }
    /*_____________________________________________________counters___________________________________________________*/
    public function counters() {
        $counter=array('visible'=>null,'hidden'=>null);
        $link=array();
        $counterUrl=($this->url=='')?'index':$this->url;
        foreach ($this->dbc->select('`counters_block_links`',array('`link`'),'`link`=\''.$counterUrl.'\'') as $links) {$link[]=$links['link'];}
        if (count($link)==0) {
            $counters=$this->dbc->select('`counters`',array(),null,null,'LIMIT 1');
            if ($counters[0]['visible_block']!=null) $counter['visible']=$counters[0]['visible_block'];
            if ($counters[0]['hidden_block']!=null) $counter['hidden']=$counters[0]['hidden_block'];
            unset($counters);
        }
        unset($link);
        return $counter;
    }
    /*_____________________________________________________statistics___________________________________________________*/
    private function statistics() {
        $thisDomainName=preg_replace("/\.[\w]{2,}/",'',preg_replace("/^http(s)?:\/\//",'',$this->_SITE_));
        if (!isset($_SESSION[$thisDomainName.'_stat'])) $_SESSION[$thisDomainName.'_stat']=array();
        if (isset($_COOKIE[$thisDomainName.'_stat'])&&(count($_SESSION[$thisDomainName.'_stat'])==0)) {
            $_SESSION[$thisDomainName.'_stat']=json_decode($_COOKIE[$thisDomainName.'_stat'],true);
        }
        if ((count($_SESSION[$thisDomainName.'_stat'])==0)||((time()-strtotime($_SESSION[$thisDomainName.'_stat']['date-date'].' '.$_SESSION[$thisDomainName.'_stat']['date-time']))>1800)) {
            $searchDomain=preg_match("/^(http(s)?|ftp|telnet):\/\/[\w-]+\.[\w-]{2,}/",$this->serverVars['refer'],$referDomain);
            $refDomain=(count($referDomain)==0)?null:$referDomain[0];
            $_SESSION[$thisDomainName.'_stat']['refer_domain']=$refDomain;
            $_SESSION[$thisDomainName.'_stat']['ip']=$this->serverVars['ip'];
            $_SESSION[$thisDomainName.'_stat']['refer']=$this->serverVars['refer'];
            $_SESSION[$thisDomainName.'_stat']['refer_enc']=urldecode($this->serverVars['refer']);
            $start_page=($this->core['multilanguage']=='on')?$this->_SITE_.'/'.$this->lang.$this->url:$this->_SITE_.$this->url;
            $_SESSION[$thisDomainName.'_stat']['start_page']=$start_page;
            $this->dbc->insert('`statistics`',array('`user_agent`','`ip`','`date-date`','`date-time`','`refer_domain`','`refer`','`refer_enc`','`start_page`','`country`','`city`'),array($this->serverVars['user-agent'],ip2long($this->serverVars['ip']),date('Y-m-d'),date('H:i:s'),$refDomain,$this->serverVars['refer'],urldecode($this->serverVars['refer']),$start_page,null,null));
            unset($start_page,$refDomain,$searchDomain);
        }
        $_SESSION[$thisDomainName.'_stat']['date-date']=date('Y-m-d');
        $_SESSION[$thisDomainName.'_stat']['date-time']=date('H:i:s');
        setcookie($thisDomainName.'_stat',json_encode($_SESSION[$thisDomainName.'_stat']),time()+1800);
        unset($thisDomainName);
    }
    public function __destruct() {unset($this->dbc,$this->core);}
}
?>