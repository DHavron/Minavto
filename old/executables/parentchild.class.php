<?php
class parentChild {
    public function __construct($table,$db,$nameUrl) {
        $this->table=$table;
        $this->db=$db;
        $this->nameUrl=$nameUrl;
        $this->arrayChildren=array('all'=>array(),'next'=>array());
        $this->arrayChildrenURL=array();
    }
    public function childrenURL($first) {
        $this->arrayChildrenURL[$first]=array();
        $queryIdNow=$this->db->select('`'.$this->table.'`',array('`id`','`parent`'),'`url`=\''.$this->nameUrl.'\' && `show`=\'on\'');
        if (count($queryIdNow)>0) {
            $idNow=$queryIdNow[0]['id'];
            $parentNow=$queryIdNow[0]['parent'];
            if ($parentNow==0) {
                array_push($this->arrayChildrenURL[$first],$this->nameUrl);
                $this->childIdURL($idNow,$this->nameUrl);
            }
        }
        return $this->arrayChildrenURL;
    }
    private function childIdURL($id,$nameUrl) {
        $id=intval($id);
        $this->arrayChildrenURL[$nameUrl]=array();
        $queryId=$this->db->select('`'.$this->table.'`',array('`id`','`url`'),'`parent`='.$id.' && `show`=\'on\'');
        foreach ($queryId as $resId) {
            $this->arrayChildrenURL[$nameUrl][]=$resId['url'];
            $this->childIdURL($resId['id'],$resId['url']);
        }
    }
    public function children($id) {
        array_push($this->arrayChildren['all'],$id);
        $queryIdNow=$this->db->select('`'.$this->table.'`',array('`id`'),'`parent`='.$id.' && `show`=\'on\'');
        if (count($queryIdNow)>0) {
            foreach ($queryIdNow as $resNow) {
                array_push($this->arrayChildren['all'],$resNow['id']);
                array_push($this->arrayChildren['next'],$resNow['id']);
                $this->childId($resNow['id']);
            }
        }
        return $this->arrayChildren;
    }
    private function childId($id) {
        $id=intval($id);
        $queryId=$this->db->select('`'.$this->table.'`',array('`id`'),'`parent`='.$id.' && `show`=\'on\'');
        if (count($queryId)>0) {
            foreach ($queryId as $resId) {
                array_push($this->arrayChildren['all'],$resId['id']);
                array_push($this->arrayChildren['next'],$resId['id']);
                $this->childId($resId['id']);
            }
        }
    }
    public function __destruct() {}
}
?>