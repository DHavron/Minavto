<?php
class vars {
    public $serverVars=array('refer'=>null,'ip'=>null,'user-agent'=>null,'lang'=>'','port'=>null);
    private $blackIP=array();
    private $blackUser=array('Linkpad','Monitorus','SurveyBot','WinHttp.WinHttpRequest');
    private $mobileUser=array('Opera Tablet','Android','Opera Mobi','Mobile','MIDP','OVI','X11','zbov','iPad','iPhone','Tablet','Opera Mini','Symbian');
    
    public function __construct() {
        $this->initialVars();
    }
    private function initialVars() {
        if (isset($_SERVER['HTTP_REFERER'])) $this->serverVars['refer']=$_SERVER['HTTP_REFERER'];
        if (isset($_SERVER['REMOTE_ADDR'])&&!empty($_SERVER['REMOTE_ADDR'])) $this->serverVars['ip']=$_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_USER_AGENT'])&&!empty($_SERVER['HTTP_USER_AGENT'])) $this->serverVars['user-agent']=$_SERVER['HTTP_USER_AGENT'];
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])&&!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) $this->serverVars['lang']=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
        if (isset($_SERVER['REMOTE_PORT'])&&!empty($_SERVER['REMOTE_PORT'])) $this->serverVars['port']=$_SERVER['REMOTE_PORT'];
    }
    public function getVars() {return $this->serverVars;}
    public function verify($arg=array()) {
        $trueFalse=true;
        if (count($arg)>0) {
            foreach ($arg as $argument) {
                if (is_null($this->serverVars[$argument])) $trueFalse=false;
                if (!$trueFalse) break;
            }
        }
        if ($trueFalse) {
            foreach ($this->blackUser as $user) {
                $isBlackUser=strripos(strtolower($this->serverVars['user-agent']),strtolower($user));
                if ($isBlackUser !== false) {$trueFalse=false;break;}
            }
        }
        if ($trueFalse) {if (in_array($this->serverVars['ip'],$this->blackIP)) $trueFalse=false;}
        return $trueFalse;
    }
    public function __destruct() {}
}
?>