<?php
class mysql implements db {
    private $mysqli;
    public $lastID=0;
    private $DB_HOST='localhost';
    public $DB_NAME='minavto_base';
    private $DB_USER;
    private $DB_PASSWORD;
    private $_USERS=array(
                            'CRUD'=>array('user'=>'minavto','password'=>'PZcR76by'),
                            'CRU'=>array('user'=>'minavto','password'=>'PZcR76by'),
                            'R'=>array('user'=>'minavto','password'=>'PZcR76by')
                        );
    
    public function __construct($type) {
        if (key_exists($type,$this->_USERS)) {
            $this->DB_USER=$this->_USERS[$type]['user'];
            $this->DB_PASSWORD=$this->_USERS[$type]['password'];
            $this->oc();
        }
        else {exit();}
    }
    public function insert(
                            $table,
                            $column=array(),
                            $values=array(),
                            $last=false
    ) {
        $this->mysqli->autocommit(FALSE);
        foreach ($values as $key=>$val) {
            if (is_int($val)) {$values[$key]=$this->mysqli->escape_string($val);}
            elseif (is_null($val)) {$values[$key]='null';}
            else {$values[$key]='\''.$this->mysqli->escape_string($val).'\'';}
        }
        $query='INSERT INTO '.strval($table).' ('.strval(implode(',',$column)).') VALUES ('.implode(',',$values).')';
        if ($this->mysqli->query($query)) {
            $this->mysqli->commit();
            if ($last) {
                $idLast=$this->select($table,array('`id`'),null,'`id` DESC','LIMIT 1');
                $this->lastID=$idLast[0]['id'];
            }
            return true;
        }
        else {
            $this->mysqli->rollback();
            return false;
        }
    }
    public function select(
                            $table,
                            $column=array(),
                            $where=null,
                            $order=null,
                            $limit=null
    ) {
        $result=array();
        $strRows= (count($column)>0) ? implode(',',$column) : '*';
        $query='SELECT '.$strRows.' FROM '.strval($table);
        if (!is_null($where)) $query.=' WHERE '.strval($where);
        if (!is_null($order)) $query.=' ORDER BY '.strval($order);
        if (!is_null($limit)) $query.=' '.strval($limit);
        $querySelect=$this->mysqli->query($query);
        if ($querySelect->num_rows>0) {
            while ($resSelect=$querySelect->fetch_assoc()) {
                $preArray=array();
                foreach ($resSelect as $key=>$val) {$preArray[$key]=$val;}
                $result[]=$preArray;
            }
            $querySelect->close();
        }
        return $result;
    }
    public function update(
                           $table,
                           $column=array(),
                           $values=array(),
                           $where=null
    ) {
        if ((count($column)==count($values))&&(count($column)>0)) {
            $this->mysqli->autocommit(FALSE);
            foreach ($values as $key=>$val) {
                if (is_int($val)) {$values[$key]=$this->mysqli->escape_string($val);}
                elseif (is_null($val)) {$values[$key]='null';}
                else {$values[$key]='\''.$this->mysqli->escape_string($val).'\'';}
            }
            foreach ($column as $keyCol=>$valCol) {$column[$keyCol]=$valCol.'='.$values[$keyCol];}
            $query='UPDATE '.strval($table).' SET '.implode(',',$column);
            if (!is_null($where)) $query.=' WHERE '.strval($where);
            if ($this->mysqli->query($query)) {
                $this->mysqli->commit();
                return true;
            }
            else {
                $this->mysqli->rollback();
                return false;
            }
        } else {return false;}
    }
    public function delete(
                            $tables=array(),
                            $where=array()
    ) {
        if ((count($tables)==count($where))&&(count($tables)>0)) {
            $result=true;
            $this->mysqli->autocommit(FALSE);
            foreach ($tables as $key=>$table) {
                if ($result) {
                    $result = ($this->mysqli->query('DELETE FROM '.$this->mysqli->escape_string($table).' WHERE '.$where[$key])) ? true : false;
                }
                else break;
            }
            if ($result) {
                $this->mysqli->commit();
                return true;
            }
            else {
                $this->mysqli->rollback();
                return false;
            }
        }
        else {return false;}
    }
    public function query($query) {
        $result=array();
        $querySelect=$this->mysqli->query($query);
        if ($querySelect->num_rows>0) {
            while ($resSelect=$querySelect->fetch_assoc()) {
                $preArray=array();
                foreach ($resSelect as $key=>$val) {$preArray[$key]=$val;}
                $result[]=$preArray;
            }
            $querySelect->close();
        }
        return $result;
    }
    public function __destruct(){
        unset($this->mysqli);
    }
    private function oc() {
      if (class_exists('mysqli')) {
        $this->mysqli=new mysqli(
                                $this->DB_HOST,
                                $this->DB_USER,
                                $this->DB_PASSWORD,
                                $this->DB_NAME
        );
      }
        if ($this->mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (".$this->mysqli->connect_errno.") ".$this->mysqli->connect_error;
            exit();
        }
        $this->mysqli->set_charset("utf8");
    }
    public function cc() {
        unset($this->mysqli);
    }
    
    public function escape_string($str) {
        return $this->mysqli->escape_string($str);
    }
}
?>