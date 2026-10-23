<?php
class sitemap
{
    private $arrayUrl=array();
    private $urlForParent=array('url'=>array(),'show'=>true);
    private $prefixIsSet=false;
                
    function __construct($initObj) {
        $this->init=$initObj;
    }
    public function updateSitemapFile($SITEMAP) {
        $resUpdate=false;
        if (is_file($SITEMAP)&&file_exists($SITEMAP)) {
            $content='<?xml version="1.0" encoding="UTF-8"?>'."\n";
            $content.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
            if ($this->init->core['multilanguage']=='on') {
                foreach ($this->init->core['languages'] as $lang) {
                    $content.='<url>'."\n";
                    $content.="\t".'<loc>'.$this->init->_SITE_.'/'.$lang.'/</loc>'."\n";
                    $content.="\t".'<lastmod>'.date('Y-m-d').'T'.date('H:i:s').'+03:00'.'</lastmod>'."\n";
                    $content.="\t".'<changefreq>daily</changefreq>'."\n";
                    $content.="\t".'<priority>1.0</priority>'."\n";
                    $content.='</url>'."\n";
                }
            }
            else {
                $content.='<url>'."\n";
                $content.="\t".'<loc>'.$this->init->_SITE_.'/</loc>'."\n";
                $content.="\t".'<lastmod>'.date('Y-m-d').'T'.date('H:i:s').'+03:00'.'</lastmod>'."\n";
                $content.="\t".'<changefreq>daily</changefreq>'."\n";
                $content.="\t".'<priority>1.0</priority>'."\n";
                $content.='</url>'."\n";
            }
            
            $urls=$this->createSitemap();
            if ($this->init->core['multilanguage']=='on') {
                foreach ($urls as $url) {
                    foreach ($this->init->core['languages'] as $lang) {
                        $content.='<url>'."\n";
                        $content.="\t".'<loc>'.$this->init->_SITE_.'/'.$lang.$url['url'].'</loc>'."\n";
                        $content.="\t".'<lastmod>'.$url['date'].'</lastmod>'."\n";
                        $content.="\t".'<changefreq>daily</changefreq>'."\n";
                        $content.="\t".'<priority>1.0</priority>'."\n";
                        $content.='</url>'."\n";
                    }
                }
            }
            else {
                foreach ($urls as $url) {
                    $content.='<url>'."\n";
                    $content.="\t".'<loc>'.$this->init->_SITE_.$url['url'].'</loc>'."\n";
                    $content.="\t".'<lastmod>'.$url['date'].'</lastmod>'."\n";
                    $content.="\t".'<changefreq>daily</changefreq>'."\n";
                    $content.="\t".'<priority>1.0</priority>'."\n";
                    $content.='</url>'."\n";
                }
            }
            $content.='</urlset>';
            if ($openFile=fopen($SITEMAP,"w+")) {
                fwrite($openFile,$content);
                fclose($openFile);
                $resUpdate=true;
            }
        }
        return $resUpdate;
    }
    
    public function createSitemap()
    {
        $arrayTablesForShow=array();
        foreach ($this->init->core['links'] as $li) {
            if (count($li['sort-tpl'])>0) {
                foreach ($li['sort-tpl'] as $tmp) {
                    if (!in_array($this->init->core['tpls'][$tmp['name-tpl']]['table'],$arrayTablesForShow)&&($this->init->core['tpls'][$tmp['name-tpl']]['table']!='none')) $arrayTablesForShow[]=$this->init->core['tpls'][$tmp['name-tpl']]['table'];
                }
            }
        }
		$allTables=array();
        $queryTables=$this->init->dbc->query("SHOW TABLES");
        foreach ($queryTables as $resTables) {if (array_key_exists($resTables['Tables_in_'.$this->init->dbc->DB_NAME],$this->init->core['table'])&&($resTables['Tables_in_'.$this->init->dbc->DB_NAME]!='none')&&in_array($resTables['Tables_in_'.$this->init->dbc->DB_NAME],$arrayTablesForShow)) array_push($allTables,$resTables['Tables_in_'.$this->init->dbc->DB_NAME]);}
        unset($queryTables,$arrayTablesForShow);
        $arrayPreName=array();
        if (count($this->init->core['links'])>0) {
            foreach ($this->init->core['links'] as $key=>$val) {
                if (($val['show']=='on')&&($key!='default')) {
                    $this->arrayUrl[]=array('url'=>'/'.$key.'/','date'=>date('Y-m-d').'T'.date('H:i:s').'+03:00');
                    if (!array_key_exists($key,$arrayPreName)) $arrayPreName[$this->init->core['tpls'][$val['sort-tpl'][0]['name-tpl']]['table']]=$key;
                }
            }
        }
        $dependensTables=array();
        foreach ($this->init->core['dependents']['dependents'] as $k=>$v) {
            $dependensTables[$k]=$v['dependent-table'];
        }
        $createUrl=new createUrl($this->init->dbc,$this->init->core);
        foreach ($allTables as $isTable) {
            $resInTable=$this->init->dbc->select('`'.$isTable.'`',array('`id`','`date`'),'`show`=\'on\'','`date` DESC,`level` DESC,`id` DESC');
            foreach ($resInTable as $res) {
                $url=$createUrl->url($isTable,$res['id']);
                $date=explode(' ',$res['date']);
                $this->arrayUrl[]=array('url'=>$url,'date'=>$date[0].'T'.$date[1].'+03:00');
            }
        }
        return $this->arrayUrl;
    }
}
?>