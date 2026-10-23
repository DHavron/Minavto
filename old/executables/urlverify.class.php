<?php
class urlVerify {
    public $lang;
    private $filter=null;
    private $isSetPage=false;
    public $urlVerify=false;
    private $numPage=1;
    private $id=0;
    public $navStroke=array();
    
    public function __construct($core,$objDB,$tpl) {
        $this->core=$core;
        $this->db=$objDB;
        $this->useTpl=$tpl;
        $this->url=$this->identificationURL();
        $this->arrayURL=explode('/',$this->url);
        $this->verify();
    }
    private function verify() {
      if ($this->verifyLang()) {
        $this->navStroke[]=array('table'=>'global_url','link'=>'on');
        if (!$this->isIndex()) {
            if (!$this->isComponent()) {
                if ($this->checkFirstFromCHPU()) {
                    $this->useTpl=$this->core['links'][$this->arrayURL[0]]['name-tpl'];
                    $this->navStroke[]=array('table'=>'global_url','link'=>$this->core['links'][$this->arrayURL[0]]['show']);
                    if ($this->isAfterInArrayURL(0)) {
                        $numInUrl=count($this->arrayURL);
                        $iPartUrl=1;
                        $this->urlVerify=true;
                        $numSortTpl=count($this->core['links'][$this->arrayURL[0]]['sort-tpl']);
                        for ($iSortTable=0;$iSortTable<$numSortTpl;++$iSortTable) {
                            $nameTpl=$this->core['links'][$this->arrayURL[0]]['sort-tpl'][$iSortTable]['name-tpl'];
                            $nameTable=$this->core['tpls'][$nameTpl]['table'];
                            if ($this->urlVerify&&($iPartUrl<$numInUrl)) {
                                $this->useTpl=$nameTpl;
                                if ($this->isHaveChildren($nameTable)) {
                                    $parentChild=new parentChild($nameTable,$this->db,$this->arrayURL[$iPartUrl]);
                                    $arrayPartUrl=$parentChild->childrenURL($this->arrayURL[0]);
                                    while ($iPartUrl<$numInUrl) {
                                        if (in_array($this->arrayURL[$iPartUrl],$arrayPartUrl[$this->arrayURL[$iPartUrl-1]])&&(count($arrayPartUrl[$this->arrayURL[$iPartUrl]]>0))) {
                                            ++$iPartUrl;
                                            $this->navStroke[]=array('table'=>$nameTable,'link'=>'on');
                                        } else {
                                            break;
                                        }
                                    }
                                }
                                else {
                                    if (($iSortTable+1)==$numSortTpl) {
                                        $arrayLastPartUrl=array();
                                        for ($iLast=$iPartUrl;$iLast<$numInUrl;$iLast++) {array_push($arrayLastPartUrl,$this->arrayURL[$iLast]);}
                                        $strLastPartUrl=implode('/',$arrayLastPartUrl);
                                    }
                                    else {
                                        $strLastPartUrl=$this->arrayURL[$iPartUrl];
                                        ++$iPartUrl;
                                    }
                                    $this->navStroke[]=array('table'=>$nameTable,'link'=>'on');
                                    $queryLast=$this->db->select('`'.$nameTable.'`',array('`id`'),'`url`=\''.$strLastPartUrl.'\' && `show`=\'on\'');
                                    $numLast=count($queryLast);
                                    if ($numLast>0) {
                                        if (($numSortTpl>1)&&($iSortTable>0)) {
                                            $prevTpl=$this->core['links'][$this->arrayURL[0]]['sort-tpl'][$iSortTable-1]['name-tpl'];
                                            if ($this->isSetDepForTable($this->core['tpls'][$prevTpl]['table'])&&($this->core['tpls'][$prevTpl]['dependent']=='on')&&($this->core['dependents']['dependents'][$this->core['tpls'][$prevTpl]['table']]['dependent-table']==$nameTable)){
                                                $idLast=$queryLast[0]['id'];
                                                $this->id=$queryLast[0]['id'];
                                                $queryDepCol=$this->db->select('`'.$nameTable.'`',array('`'.$this->core['dependents']['dependents'][$this->core['tpls'][$prevTpl]['table']]['dependent-column'].'`'),'`id`='.$idLast,null,'LIMIT 1');
                                                $idDep=$queryDepCol[0][$this->core['dependents']['dependents'][$this->core['tpls'][$prevTpl]['table']]['dependent-column']];
                                                $queryDepNameURL=$this->db->select('`'.$this->core['tpls'][$prevTpl]['table'].'`',array('`url`'),'`id`='.$idDep.' && `show`=\'on\'',null,'LIMIT 1');
                                                $nameDepURL=$queryDepNameURL[0]['url'];
                                                $this->urlVerify=(in_array($nameDepURL,$this->arrayURL)) ? true : false;
                                            }
                                        }
                                    } else {
                                        $this->urlVerify=false;
                                    }
                                }
                            } else {break;}
                        }
                    } else {
                        $this->urlVerify=($this->core['links'][$this->arrayURL[0]]['show']=='of') ? false : true;
                    }
                }
                else {
                    if ($this->core['links']['default']['show']=='of') {$this->urlVerify=false;}
                    else {
                        $queryDefault=$this->db->select('`'.$this->core['tpls'][$this->useTpl]['table'].'`',array('`url`'),'`show`=\'on\'');
                        if (count($queryDefault)>0) {
                            for($i=0;$i<count($queryDefault);++$i) {
                                if ($this->url==$queryDefault[$i]['url']) {
                                    $this->urlVerify=true;
                                } else {
                                    $this->urlVerify=false;
                                }
                                if ($this->urlVerify) {break;}
                            }
                        }
                        unset($queryDefault);
                        $this->navStroke[]=array('table'=>$this->core['tpls'][$this->useTpl]['table'],'link'=>'on');
                    }
                }
            }
            else {
                $this->urlVerify=true;
                $this->useTpl=$this->core['components']['urls'][$this->url]['name-tpl'];
                $this->navStroke[]=array('table'=>'global_url','link'=>'on');
            }
        }
        else {
            $this->useTpl='index';
            $this->urlVerify=true;
        }
      }
      else {
        $this->urlVerify=false;
      }
      if (!is_null($this->filter)&&$this->urlVerify) {
        if (array_key_exists($this->useTpl,$this->core['filters'])) {
            $filters=explode(';',preg_replace("/\;?\]$/","",preg_replace("/^&filter\[/","",$this->filter)));
            $arrayFilter=array();
            for($i=0;$i<count($filters);++$i) {
                $partFilter=explode(":",$filters[$i]);
                if (isset($partFilter[0])&&(array_key_exists($partFilter[0],$this->core['filters'][$this->useTpl]))) {
                    $valuesFilter=explode(',',preg_replace("/}$/","",preg_replace("/^{/","",$partFilter[1])));
                    for($f=0;$f<count($valuesFilter);++$f) {
                        if (empty($valuesFilter[$f])||(strlen($valuesFilter[$f])==0)) {
                            $this->urlVerify=false;
                            break;
                        }
                    }
                    if ($this->urlVerify) {
                        $isSetFilters=$this->db->select('`'.$this->core['filters'][$this->useTpl][$partFilter[0]].'`',array('`url`'),'`url` IN(\''.implode('\',\'',$valuesFilter).'\') && `show`=\'on\'');
                        if ((count($isSetFilters)==0)&&$this->urlVerify) {
                            $this->urlVerify=false;
                            break;
                        }
                        $arrayFilter[$partFilter[0]]=$valuesFilter;
                    }
                } else {
                    $this->urlVerify=false;
                    break;
                }
            }
            if ($this->urlVerify) {
                $this->filter=$arrayFilter;
            }
            unset($filters,$partFilter,$valuesFilter,$isSetFilters,$f,$arrayFilter);
        } else {
            $this->urlVerify=false;
        }
      }
        if ($this->isSetPage&&$this->urlVerify) {
            if ($this->numPage<2) {
                $this->urlVerify=false;
            } else {
                if (!$this->isComponent()) {
                    $numOnPage=$this->core['tpls'][$this->useTpl]['num-on-page'];
                    if ($numOnPage==0) {$this->urlVerify=false;}
                    else {
                        $id=$this->useId();
                        if ($this->isSetDepForTable($this->core['tpls'][$this->useTpl]['table'])&&($this->core['tpls'][$this->useTpl]['dependent']=='on')) {
                            $tableDep=$this->core['dependents']['dependents'][$this->core['tpls'][$this->useTpl]['table']]['dependent-table'];
                            $column=$this->core['dependents']['dependents'][$this->core['tpls'][$this->useTpl]['table']]['column'];
                            $columnDep=$this->core['dependents']['dependents'][$this->core['tpls'][$this->useTpl]['table']]['dependent-column'];
                            if ($this->isHaveChildren($this->core['tpls'][$this->useTpl]['table'])) {
                                $children=new parentChild($this->core['tpls'][$this->useTpl]['table'],$this->db,end($this->arrayURL));
                                $arrayId=$children->children($id);
                                $queryNum=$this->db->select('`'.$tableDep.'`',array('`id`'),'`'.$columnDep.'` IN ('.implode(',',$arrayId['all']).') && `show`=\'on\'');
                                if (count($queryNum)>0) {
                                    $numPages=ceil(count($queryNum)/$numOnPage);
                                    $this->urlVerify=($this->numPage<=$numPages) ? true : false;
                                }
                            }
                            else {
                                $queryNum=$this->db->select('`'.$tableDep.'`',array('`id`'),'`'.$columnDep.'`='.$id.' && `show`=\'on\'');
                                if (count($queryNum)>0) {
                                    $numPages=ceil(count($queryNum)/$numOnPage);
                                    $this->urlVerify=($this->numPage<=$numPages) ? true : false;
                                }
                            }
                        } else {
                            $queryNum=$this->db->select('`'.$this->core['tpls'][$this->useTpl]['table'].'`',array('`id`'),'`show`=\'on\'');
                            if (count($queryNum)>0) {
                                $numPages=ceil(count($queryNum)/$numOnPage);
                                $this->urlVerify=($this->numPage<=$numPages) ? true : false;
                            }
                        }
                    }
                }
                else {
                    if ($this->core['components']['urls'][$this->url]['num-on-page']>0) {
                        $numPages=ceil((count($_SESSION[$this->core['components']['urls'][$this->url]['session-array']]['id_products'])-1)/$this->core['components']['urls'][$this->url]['num-on-page']);
                        $this->urlVerify=($this->numPage<=$numPages) ? true : false;
                    }
                    else {$this->urlVerify=false;}
                }
            }
        }
    }
    private function verifyLang() {
        if ($this->core['multilanguage']=='on') {
            $langs=array();
            foreach ($this->core['languages'] as $lang) {array_push($langs,$lang);}
            return (in_array($this->lang,$langs))?true:false;
        }
        else return true;
    }
    private function isIndex() {
        return (($this->url=='')||empty($this->url)) ? true : false;
    }
    private function checkFirstFromCHPU() {
        return (in_array($this->arrayURL[0],$this->core['name_chpu'])) ? true : false;
    }
    private function isAfterInArrayURL($now) {
        return (count($this->arrayURL)>$now) ? true : false;
    }
    private function isHaveChildren($table) {
        $queryIsParent=$this->db->query('SHOW COLUMNS FROM `'.$table.'`');
        $result=false;
        foreach ($queryIsParent as $resIsParent) {
            if ($resIsParent['Field']=='parent') {
                $result=true;
                break;
            }
        }
        return $result;
    }
    private function identificationURL() {
        $url=$_SERVER['QUERY_STRING'];
        if ($this->core['multilanguage']=='on') {
            $searchLang=preg_match("/^\w\w\/*/",$url,$language);
            $language=preg_replace('/\//','',$language[0]);
            $url=preg_replace('/^'.$language.'\/*/','',$url,1);
            $this->lang=$language;
            unset($searchLang,$language);
        } else {$this->lang=$this->core['languages'][0];}
        $searchPage=preg_match("/\/page\/\d/",$url,$page);
        if (count($page)>0) {$this->numPage=intval(end(explode('/',$page[0])));}
        unset($searchPage);
        $url=preg_replace("/\/page\/\d/",'',$url,1,$count);
        if ($count==1) $this->isSetPage=true;
        $searchFilter=preg_match("/&filter\[.*\]$/",$url,$filters);
        if (count($filters)>0) {$this->filter=$filters[0];}
        $url=preg_replace("/&filter\[([\w\d\-]+:\{[\w\d\-\,]+\}\;?)+\]$/",'',$url,1);
        return strval($url);
    }
    private function isSetDepForTable($table) {
        return (in_array($table,$this->core['dependents']['tables'])) ? true : false;
    }
    private function isComponent() {
        return (key_exists($this->url,$this->core['components']['urls'])) ? true : false;
    }
    public function useId() {
        if (!empty($this->arrayURL[0])&&!empty($this->core['tpls'][$this->useTpl]['table'])) {
            if ($this->checkFirstFromCHPU(0)) {
                $nameUrl=end($this->arrayURL);
                $queryId=$this->db->select('`'.$this->core['tpls'][$this->useTpl]['table'].'`',array('`id`'),'`url`=\''.$nameUrl.'\'',null,'LIMIT 1');
                if (count($queryId)>0) {$this->id=$queryId[0]['id'];}
                unset($queryId,$nameUrl);
            }
            else {
                $nameUrl=$this->arrayURL[0];
                $queryId=$this->db->select('`'.$this->core['tpls'][$this->useTpl]['table'].'`',array('`id`'),'`url`=\''.$nameUrl.'\'');
                if (count($queryId)>0) {$this->id=$queryId[0]['id'];}
                unset($queryId,$nameUrl);
            }
        }
        return $this->id;
    }
    
    public function useTpl() {return $this->useTpl;}
    
    public function numPage() {return $this->numPage;}
    
    public function useLang() {return $this->lang;}
    
    public function getFilter() {return $this->filter;}
    
    public function __destruct() {}
}
?>