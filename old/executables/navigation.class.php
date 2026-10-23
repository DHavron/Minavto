<?php
class navigation {
    public $limit='';
    public $numPages=1;
    private $component=array();
    public function __construct($db,$core,$tpl,$nowPage,$id,$url,$lang,$stroke) {
        $this->db=$db;
        $this->core=$core;
        $this->tpl=$tpl;
        $this->page=$nowPage;
        $this->id=$id;
        $this->url=$url;
        $this->lang=$lang;
        $this->stroke=$stroke;
        $this->limit();
    }
    private function visibleNavigation() {
        if (isset($this->core['tpls'][$this->tpl])) {
            return ($this->core['tpls'][$this->tpl]['num-on-page']>0) ? true : false;
        }
        elseif (in_array($this->tpl,$this->core['components']['tpls'])) {
            $trueFalse=false;
            foreach ($this->core['components']['urls'] as $key=>$val) {
                if ($val['name-tpl']==$this->tpl) {
                    if ($val['num-on-page']>0) {
                        $this->component['num-on-page']=$val['num-on-page'];
                        $this->component['session-array']=$val['session-array'];
                        $trueFalse=true;
                    }
                    break;
                }
            }
            return $trueFalse;
        }
        else {return false;}
    }
    private function isDependentOn() {
        return ($this->core['tpls'][$this->tpl]['dependent']=='on') ? true : false;
    }
    private function isComponent() {
        return (in_array($this->tpl,$this->core['components']['tpls'])) ? true : false;
    }
    public function limit() {
        if ($this->visibleNavigation()){
          if (!$this->isComponent()) {
            if ($this->isDependentOn()) {
                $str='';
                if ($this->id>0) {
                    $str.=' && `'.$this->core['dependents']['dependents'][$this->core['tpls'][$this->tpl]['table']]['dependent-column'].'` IN ('.$this->searchIdForIN().')';
                } else {
                    $queryIdAll=$this->db->select($this->core['tpls'][$this->tpl]['table'],array('`id`'),'`show`=\'on\'');
                    if (count($queryIdAll)>0) {
                        $arrayIdAll=array();
                        foreach ($queryIdAll as $resIdAll) {array_push($arrayIdAll,$resIdAll['id']);}
                        $str.=' && `'.$this->core['dependents']['dependents'][$this->core['tpls'][$this->tpl]['table']]['dependent-column'].'` IN ('.implode(',',$arrayIdAll).')';
                    }
                }
                $queryNum=$this->db->select($this->core['dependents']['dependents'][$this->core['tpls'][$this->tpl]['table']]['dependent-table'],array('`id`'),'`show`=\'on\''.$str);
                if (count($queryNum)>0) {
                    $numResult=count($queryNum);
                    $this->numPages=ceil($numResult/$this->core['tpls'][$this->tpl]['num-on-page']);
                    $start=($this->page-1)*$this->core['tpls'][$this->tpl]['num-on-page'];
                    $end=$this->core['tpls'][$this->tpl]['num-on-page'];
                    $this->limit="LIMIT ".$start.",".$end;
                }
            }
            else {
                $queryNum=$this->db->select($this->core['tpls'][$this->tpl]['table'],array('`id`'),'`show`=\'on\'');
                if (count($queryNum)>0) {
                    $numResult=count($queryNum);
                    $this->numPages=ceil($numResult/$this->core['tpls'][$this->tpl]['num-on-page']);
                    $start=($this->page-1)*$this->core['tpls'][$this->tpl]['num-on-page'];
                    $end=$this->core['tpls'][$this->tpl]['num-on-page'];
                    $this->limit="LIMIT ".$start.",".$end;
                }
            }
          }
          else {
            $this->numPages=ceil((count($_SESSION[$this->component['session-array']]['id_products'])-1)/$this->component['num-on-page']);
            $start=($this->page-1)*$this->component['num-on-page'];
            $end=$this->component['num-on-page'];
            $this->limit="LIMIT ".$start.",".$end;
          }
        }
        return $this->limit;
    }
    private function searchIdForIN() {
        if ($this->isHaveChildren($this->core['tpls'][$this->tpl]['table'])) {
            $parentChild=new parentChild($this->core['tpls'][$this->tpl]['table'],$this->db,'');
            $children=$parentChild->children($this->id);
            return implode(',',$children['all']);
        }
        else {
            return $this->id;
        }
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
    public function showNavigation($url,$showNum=0) {
      if ($this->visibleNavigation()) {
        for($i=1;$i<$this->numPages+1;$i++) {
            if ($i>1) {$str='page/'.$i.'/';} else {$str='';}
            if (intval($showNum)>0) {
                $half=($showNum-1)/2;
                $left=$right=0;
                if ($this->page-$half<=0) {$right=-($this->page-$half)+1;}
                if ($this->page+$half>$this->numPages) {$left=-($this->page+$half-$this->numPages);}
                if (($i>=($this->page-$half+$left))&&($i<=($this->page+$half+$right))) {
                    if ($i==$this->page) {echo '<span>'.$i.'</span>';}
                    else {echo '<a href="'.$url.$str.'">'.$i.'</a>';}
                }
            }
            else {
                if ($i==$this->page) {echo '<span>'.$i.'</span>';}
                else {echo '<a href="'.$url.$str.'">'.$i.'</a>';}
            }
        }
      }
    }
    public function getNaviStroke() {
        $arrayNaviStroke=array();
        $arrayUrl=explode('/',preg_replace('/\/$/','',$this->url));
        if (count($this->stroke)>0) {
          $promUrl='/';
          for ($i=0;$i<count($this->stroke);++$i) {
            $url=($arrayUrl[$i]=='')?'index':$arrayUrl[$i];
            $naviName=$this->db->select('`name`',array('`name_'.$this->lang.'`'),'`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$this->stroke[$i]['table'].'\' LIMIT 1) && `id_row`=(SELECT `id` FROM `'.$this->stroke[$i]['table'].'` WHERE `url`=\''.$url.'\' LIMIT 1)',null,'LIMIT 1');
            if ($i>0) {$promUrl=$promUrl.$arrayUrl[$i].'/';}
            if (count($naviName)>0) {$arrayNaviStroke[]=array('url'=>$promUrl,'name'=>$naviName[0]['name_'.$this->lang],'link'=>$this->stroke[$i]['link']);}
            unset($naviName);
          }
        }
        return $arrayNaviStroke;
    }
}
?>