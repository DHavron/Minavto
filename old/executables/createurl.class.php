<?php
class createUrl {
    private $urlForParent=array();
    public function __construct($dbc,$core) {
        $this->dbc=$dbc;
        $this->core=$core;
    }
    public function url($table,$id) {
        $url='';
        $arrayPreName=array();
        if (count($this->core['links'])>0) {
            foreach ($this->core['links'] as $key=>$val) {
                if (!array_key_exists($key,$arrayPreName)) $arrayPreName[$this->core['tpls'][$val['sort-tpl'][0]['name-tpl']]['table']]=$key;
            }
        }
        $dependensTables=array();
        foreach ($this->core['dependents']['dependents'] as $k=>$v) {
            $dependensTables[$k]=$v['dependent-table'];
        }
        if (in_array($table,$dependensTables)) {
                $parentTable=null;
                foreach (array_reverse($dependensTables) as $key=>$val) {
                    if ($table===$val) {$parentTable=$key;break;}
                }
                if (!is_null($parentTable)) {
                    $columnParentTable=$this->core['dependents']['dependents'][$parentTable]['column'];
                    $columnIsTable=$this->core['dependents']['dependents'][$parentTable]['dependent-column'];
                    $queryIsTable=$this->dbc->select('`'.$table.'`',array('`url`','`'.$columnIsTable.'`'),'`show`=\'on\' && `id`='.intval($id));
                    if (count($queryIsTable)>0) {
                        foreach ($queryIsTable as $resIsTable) {
                            $col=$resIsTable[$columnIsTable];
                            $url='/'.$resIsTable['url'].'/';
                            if ($this->isHaveChildren($parentTable)) {
                                $this->parent($parentTable,$col);
                                $url=$this->prefix($parentTable).'/'.implode('/',array_reverse($this->urlForParent)).$url;
                                $this->urlForParent=array();
                            }
                            else {
                                $queryParentTable=$this->dbc->select('`'.$parentTable.'`',array('`url`'),'`'.$columnParentTable.'`=\''.$col.'\' && `show`=\'on\'');
                                if (count($queryParentTable)>0) {
                                    $url=$this->prefix($parentTable).'/'.$queryParentTable[0]['url'].$url;
                                }
                                else {exit('Ошибка ядра');}
                            }
                        }
                    }
                }
                else {exit('Ошибка ядра');}
            } else {
                if ($this->isHaveChildren('`'.$table.'`')) {
                    $this->parent($table,$id);
                    $url.='/'.$arrayPreName[$table].'/'.implode('/',array_reverse($this->urlForParent)).'/';
                    $this->urlForParent=array();
                } else {
                    $queryTable=$this->dbc->select('`'.$table.'`',array('url'),'`id`='.$id);
                    if (count($queryTable)>0) {
                        $url.=$this->prefix($table).'/'.$queryTable[0]['url'].'/';
                    }
                }
            }
        return $url;
    }
    protected function prefix($table) {
        $prefix='';
        foreach (array_reverse($this->core['links']) as $key=>$val) {
            if (($table==$this->core['tpls'][$val['name-tpl']]['table'])&&($key!='default')&&($key!='none')) {$prefix='/'.$key;break;}
        }
        return $prefix;
    }
    protected function parent($table,$id) {
        $queryPar=$this->dbc->select('`'.$table.'`',array('`parent`','`url`'),'`id`='.intval($id),null,'LIMIT 1');
        if (count($queryPar)>0) {
            $this->urlForParent[]=$queryPar[0]['url'];
            $par=$queryPar[0]['parent'];
            if ($par>0) {$this->parent($table,$par);}
        }
    }
    private function isHaveChildren($table) {
        $queryIsParent=$this->dbc->query('SHOW COLUMNS FROM '.$table);
        $result=false;
        foreach ($queryIsParent as $resIsParent) {
            if ($resIsParent['Field']=='parent') {
                $result=true;
                break;
            }
        }
        return $result;
    }
    public function __destruct() {}
}
?>