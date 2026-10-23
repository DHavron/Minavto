<?php
class validator extends prepend
{
    private $methods=array('get','post','request');
    public $errors=array();
    public $values=array();
    public $savers=array();
    public $serverVars=array();
    
    public function __construct($method='post',$sessionRegen=false) {
        if (in_array($method,$this->methods)) {
            switch ($method) {
                case 'get': $this->method=$_GET;break;
                case 'request': $this->method=$_REQUEST;break;
                default: $this->method=$_POST;
            }
        } else {$this->method=$_POST;}
        $this->session($sessionRegen);
        if (!isset($_SESSION['vae'])) $_SESSION['vae']=array();
        $this->varsVarify();
    }
    
    public function dbc() {
        $this->dbc=new mysql('CRU');
    }
    
    public function validateSender() {return (stripos($this->serverVars['refer'],$this->_SITE_)!==false) ? true : false;}
    
    public function session($regen) {
        if (session_id() == '') session_start();
        if ($regen) session_regenerate_id(true);
    }
    
    private function varsVarify() {
        $vars=new vars;
        if (!$vars->verify(array('user-agent'))) $this->error404();
        $this->serverVars=$vars->getVars();
        unset($vars);
    }
    private function error404() {
        if (isset($this->dbc)) $this->dbc->cc();
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location: '.$this->_SITE_.'/404/');
        exit();
    }
    
    public function findData($name,$isEmpty=true,$isArray=false) {
        $result=false;
        if (isset($this->method[$name])) {
            $result=true;
            if ($isEmpty&&$result) {if (empty($this->method[$name])) $result=false;}
            if ($isArray&&$result) {if (!is_array($this->method[$name])) $result=false;}
        }
        return $result;
    }
    
    public function checkLogin($login) {
        return mb_strtolower(preg_replace("'/[\D\W]/'",'',$login),'utf-8');
    }
    
    public function checkEmail($email) {
        $result=false;
        $emailArray=explode("@",$email);
        if (isset($emailArray[1])) {
            if (strlen($emailArray[1])>0) {
                if (checkdnsrr($emailArray[1])) {
                    if (preg_match("/^[-\._a-zA-Z0-9]+/i", $emailArray[0])) {$result=true;}
                }
            }
        }
        unset($emailArray);
        return $result;
    }
    
    public function getValue($name) {return (isset($this->values[$name]))?$this->values[$name]:null;}
    public function setValue($name,$value) {$this->values[$name]=$value;}
    public function delValue($name) {unset($this->values[$name]);}
    
    public function getSaver($name) {return (isset($this->savers[$name]))?$this->savers[$name]:null;}
    public function setSaver($name,$value) {$this->savers[$name]=$value;}
    public function delSaver($name) {unset($this->savers[$name]);}
    
    public function getError($name) {return (isset($this->errors[$name]))?$this->errors[$name]:null;}
    public function setError($name,$value) {$this->errors[$name]=$value;}
    public function delError($name) {unset($this->errors[$name]);}
    
    public function readVAE() {
        $this->values=(isset($_SESSION['vae']['values']))?$_SESSION['vae']['values']:array();
        $this->errors=(isset($_SESSION['vae']['errors']))?$_SESSION['vae']['errors']:array();
        $this->savers=(isset($_SESSION['vae']['savers']))?$_SESSION['vae']['savers']:array();
    }
    public function clearVAE() {
        $this->values=array();
        $this->errors=array();
        $this->savers=array();
    }
    
    public function fixedValuesAndErrors() {
        $_SESSION['vae']['values']=$this->values;
        $_SESSION['vae']['errors']=$this->errors;
        $_SESSION['vae']['savers']=$this->savers;
    }
    
    public function generateKodVarify($login) {
        return sha1(rand(1000,9999999).time().$login);
    }
    
    public function isSetLogin($login) {
        return (count($this->dbc->select('`users`',array('`id`'),'`login`=\''.$login.'\'',null,'LIMIT 1'))==1)?true:false;
    }
    
    public function isSetEmail($email) {
        $result=false;
        if (count($this->dbc->select('`users`',array('`id`'),'`email`=\''.$email.'\' && `deleted`=\'of\'',null,'LIMIT 1'))==1) {$result=true;}
        if (!$result) {
            $inEmails=$this->dbc->select('`users_email`',array('`id_user`'),'`email`=\''.$email.'\'',null,'LIMIT 1');
            $result=(count($inEmails)==1)?true:false;
            unset($inEmails);
            if ($result) {
                $isDeleted=$this->dbc->select('`users`',array('`deleted`'),'`id`='.$inEmails[0]['id_user'],null,'LIMIT 1');
                if ((count($isDeleted)>0)&&($isDeleted[0]['deleted']=='on')) {$result=false;}
                unset($isDeleted);
            }
        }
        return $result;
    }
    
    public function isSetWebsite($website) {
        $result=false;
        $site=preg_match("/^http(s)?:\/\/(www\.)?[\w-]+\.[\w]{2,}/",$website,$checkerSite);
        if (isset($checkerSite[0])) {
            $site=preg_replace("/\.[\w]{2,}$/",'',preg_replace("/^http(s)?:\/\/(www\.)?/",'',$checkerSite[0]));
            $result=(count($this->dbc->select('`users_websites`',array('`id_user`'),'`website` LIKE \'%'.$site.'%\'',null,'LIMIT 1'))==1)?true:false;
        }
        return $result;
    }
    
    public function __destruct() {unset($this->dbc);}
}
?>