<?php
class auth extends prepend
{
    private $typeForValid=array('admin','user');
    private $dirForValid=array('admin'=>'/admin/online','user'=>'/include/users');
    private $access=array(0=>'R$OO$T',1=>'C$RU$D',2=>'R$U',3=>'R$EA$D',4=>'U$SE$R');
    public function __construct($timeInterval=1800,$sessionRegen=true) {
        $this->timeInterval=$timeInterval;
        $this->prefix=preg_replace("/\.[\w]{2,}$/",'',preg_replace("/^http(s)?:\/\//",'',$this->_SITE_));
        if (session_id()=='') {session_start();}
        if ($sessionRegen) {session_regenerate_id(true);}
        if (!isset($_SESSION[$this->prefix.'_auth'])) $_SESSION[$this->prefix.'_auth']=array('id'=>-1,'access'=>null);
    }
    public function setAuth($type,$idUser,$passUser,$accessUser) {
      if (in_array($type,$this->typeForValid)&&key_exists($accessUser,$this->access)&&file_exists($this->_DIR_.$this->dirForValid[$type])) {
        $toFile=fopen($this->_DIR_.$this->dirForValid[$type].'/'.sha1(md5($idUser.$passUser)).'.uson', "w+");
        fwrite($toFile,time().'#%#'.$this->access[$accessUser]);
        fclose($toFile);
        $_SESSION[$this->prefix.'_auth']=array('id'=>sha1(md5($idUser.$passUser)),'access'=>$this->access[$accessUser]);
        $this->addToCookie();
      }
    }
    public function validAuth($type) {
        $resultAuth=false;
        if (in_array($type,$this->typeForValid)) {
            if (isset($_COOKIE[$this->prefix.'_auth'])&&!isset($_SESSION[$this->prefix.'_auth'])) {
                $_SESSION[$this->prefix.'_auth']=json_decode($_COOKIE[$this->prefix.'_auth'],true);
            }
            if (file_exists($this->_DIR_.$this->dirForValid[$type])&&file_exists($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson')) {
                $readFile=fopen($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson',"r");
                $fileValue=fread($readFile,filesize($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson'));
                fclose($readFile);
                if ($fileValue!==false) {
                    $expFileValue=explode('#%#',$fileValue);
                    if ((count($expFileValue)==2)&&((time()-$expFileValue[0])<$this->timeInterval)&&($expFileValue[1]==$_SESSION[$this->prefix.'_auth']['access'])) {
                        $resultAuth=true;
                        $toFile=fopen($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson', "w+");
                        fwrite($toFile,time().'#%#'.$_SESSION[$this->prefix.'_auth']['access']);
                        fclose($toFile);
                        unset($toFile);
                        $this->addToCookie();
                    }
                    else {unlink($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson');}
                    unset($expFileValue);
                }
            unset($readFile,$fileValue);
            }
        }
        return $resultAuth;
    }
    private function addToCookie() {
        setcookie($this->prefix.'_auth',json_encode($_SESSION[$this->prefix.'_auth']),time()+$this->timeInterval+86400);
    }
    public function checkRight($validRights=array()) {
        $resultChecker=false;
        if ($this->access[0]==$_SESSION[$this->prefix.'_auth']['access']) $resultChecker=true;
        if (!$resultChecker) {
          for ($i=0;$i<count($validRights);++$i) {
            if ($this->access[$i]==$_SESSION[$this->prefix.'_auth']['access']) {
                $resultChecker=true;
                break;
            }
          }
        }
        return $resultChecker;
    }
    public function exitUser($type) {
        if (in_array($type,$this->typeForValid)) {
            if (isset($_COOKIE[$this->prefix.'_auth'])) {setcookie($this->prefix.'_auth',json_encode($_SESSION[$this->prefix.'_auth']),time()-86400);}
        }
        if (file_exists($this->_DIR_.$this->dirForValid[$type])&&file_exists($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson')) {
            unlink($this->_DIR_.$this->dirForValid[$type].'/'.$_SESSION[$this->prefix.'_auth']['id'].'.uson');
        }
        unset($_SESSION[$this->prefix.'_auth']);
    }
    public function clearUsers($type){
        if (in_array($type,$this->typeForValid)&&file_exists($this->_DIR_.$this->dirForValid[$type])) {
            $allUsers=glob($this->_DIR_.$this->dirForValid[$type].'/*');
            if ($allUsers) {
                foreach ($allUsers as $userOnline) {
                    if (!is_dir($userOnline)) {
                        $user=fopen($userOnline,"r");
                        $userValue=fread($user,filesize($userOnline));
                        fclose($user);
                        if ($userValue!==false) {
                            $expUserValue=explode('#%#',$userValue);
                            if ((time()-$expUserValue[0])>60*60*12) {unlink($userOnline);}
                        }
                        else {unlink($userOnline);}
                    }
                }
            }
        }
    }
    public function __destruct() {unset($this->prefix,$this->access,$this->dirForValid,$this->typeForValid,$this->timeInterval);}
}
?>