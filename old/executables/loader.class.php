<?php
class loader extends translit
{
    public $valuesErrors=array(
                                400 => 'Дириктория для загрузки файла не найдена',
                                401 => 'Файл не имеет названия',
                                402 => 'Пустой файл',
                                403 => 'Слишком большой размер файла',
                                404 => 'Неправильно указан тип файла',
                                405 => 'Запрещенное разрешение изображения',
                                406 => 'Новое имя файла не определено.',
                                407 => 'Файл с таким именем уже существует',
                                408 => 'Ширина изображения меньше минимально допустимой',
                                409 => 'Ширина изображения больше максимально допустимой',
                                410 => 'Высота изображения меньше минимально допустимой',
                                411 => 'Высота изображения больше максимально допустимой',
                                412 => 'Файл не найден',
                                
                                499 => 'Ошибка загрузки файла на сервер'
                            );
    private $typesOfFile=array('image'=>array(1,2,3),'file'=>array());
    public $preLoadedFiles=array();
    public $loadedFiles=array();
    public $errors=array();
    private $valueType=array(1=>'gif',2=>'jpg',3=>'png');
    
    public function __construct($dirPreLoad) {
        $this->_PRE_DIR_=$dirPreLoad;
    }
    
    private function isValidTypeImage($src) {
        $imgSize=getimagesize($src);
        if (in_array($imgSize[2],$this->typesOfFile['image'])) {return true;} else {return false;};
        unset($imgSize);
    }
    
    public function preload(
                            $type,
                            $nameINPUT,
                            $nameForFile,
                            $minWidth=1,
                            $maxWidth=4000,
                            $minHeight=1,
                            $maxHeight=4000,
                            $minSize=1,
                            $maxSize=10240000
                    ) {
        if (in_array($type,array_keys($this->typesOfFile))) {
          $this->_FILE_=$_FILES[$nameINPUT];
          if (is_array($this->_FILE_)) {
            if ($this->_FILE_['size']>$minSize) {
              if ($this->_FILE_['size']<$maxSize) {
                if ($this->_FILE_['name']!='') {
                  if (is_dir($this->_PRE_DIR_)) {
                    if ($type=='image') {
                      if ($this->isValidTypeImage($this->_FILE_['tmp_name'])) {
                        $newName=$this->getTranslitFile($nameForFile);
                        if (strlen($newName)>0) {
                          $mime=getimagesize($this->_FILE_['tmp_name']);
                          $tip=explode("/",$mime["mime"]);
                          $tip=$tip[1];
                          $nameFile=mb_strtolower($newName,'UTF-8').'.'.$tip;
                          unset($newName);
                          if (!is_file($this->_PRE_DIR_.'/'.$nameFile)) {
                            if ($mime[0]>$minWidth) {
                              if ($mime[0]<$maxWidth) {
                                if ($mime[1]>$minHeight) {
                                  if ($mime[1]<$maxHeight) {
                                    if (is_uploaded_file($this->_FILE_['tmp_name'])) {
                                      if (move_uploaded_file($this->_FILE_['tmp_name'],$this->_PRE_DIR_.'/'.$nameFile)) {
                                        $this->preLoadedFiles[]=$nameFile;
                                      } else {@unlink($this->_FILE_['tmp_name']);$this->errors[]=499;}
                                    } else {@unlink($this->_FILE_['tmp_name']);$this->errors[]=499;}
                                  } else {$this->errors[]=411;}
                                } else {$this->errors[]=410;}
                              } else {$this->errors[]=409;}
                            } else {$this->errors[]=408;}
                          } else {$this->errors[]=407;}
                        } else {unset($newName);$this->errors[]=406;}
                      } else {$this->errors[]=405;}
                    }
                  } else {$this->errors[]=400;}
                } else {$this->errors[]=401;}
              } else {$this->errors[]=403;}
            } else {$this->errors[]=402;}
          }
        } else {$this->errors[]=404;}
    }
    public function upload($dir) {
      $this->errors=array();
      if (is_dir($dir)) {
        for($i=0;$i<count($this->preLoadedFiles);++$i) {
          if (!is_file($dir.'/'.$this->preLoadedFiles[$i])) {
            if (copy($this->_PRE_DIR_.'/'.$this->preLoadedFiles[$i],$dir.'/'.$this->preLoadedFiles[$i])) {
              $this->loadedFiles[]=$this->preLoadedFiles[$i];
            } else {$this->errors[]=499;}
          } else {$this->errors[]=407;}
        }
      } else {$this->errors[]=400;}
    }
    public function moveFile($from,$to,$nameFile) {
        $this->errors=array();
        if (is_dir($from)) {
          if (is_dir($to)) {
            if (is_file($from.'/'.$nameFile)) {
              if (!is_file($to.'/'.$nameFile)) {
                rename($from.'/'.$nameFile, $to.'/'.$nameFile);
              } else {$this->errors[]=407;}
            } else {$this->errors[]=412;}
          } else {$this->errors[]=400;}
        } else {$this->errors[]=400;}
    }
    protected function imageCreate($type,$img) {
        switch ($type) {
        case 1:$image=imagegif($img);break;
        case 2:$image=imagejpeg($img);break;
        case 3:$image=imagepng($img);break;
        }
        return $image;
        unset($img,$type,$image);
    }
    protected function imageCreateFrom($src) {
        $imgSize=getimagesize($src);
        switch ($imgSize[2]) {
            case 1: $imageFrom=imagecreatefromgif($src);break;
            case 2: $imageFrom=imagecreatefromjpeg($src);break;
            case 3: $imageFrom=imagecreatefrompng($src);break;
        }
        unset($imgSize,$src);
        return $imageFrom;
    }
    public function resizeImageTo($newWidth,$newHeight,$nameImage,$newNameImage,$copyToDir) {
      $this->errors=array();
      if (is_dir($copyToDir)) {
        if ($this->isValidTypeImage($this->_PRE_DIR_.'/'.$nameImage)) {
          if (!is_file($this->_PRE_DIR_.'/'.$newNameImage)) {
            $imgNow=getimagesize($this->_PRE_DIR_.'/'.$nameImage);
            $tip=explode("/",$imgNow["mime"]);
            $tip=$tip[1];
            $k=1;
            if (($imgNow[0]/$newWidth)>($imgNow[1]/$newHeight)) {
              $k=floor($imgNow[1]/$newHeight);
            } else {
              $k=floor($imgNow[0]/$newWidth);
            }
            $newImage=imagecreatetruecolor($newWidth,$newHeight);
            imagealphablending($newImage, false);
            imagecopyresampled($newImage,$this->imageCreateFrom($this->_PRE_DIR_.'/'.$nameImage),0,0,0,0,$newWidth,$newHeight,$newWidth*$k,$newHeight*$k);
            switch($imgNow[2]) {
                case 1: imagegif($newImage,$copyToDir.'/'.$newNameImage.'.'.$tip);break;
                case 2: imagejpeg ($newImage,$copyToDir.'/'.$newNameImage.'.'.$tip,50);break;
                case 3: imagesavealpha($newImage, true);imagepng($newImage,$copyToDir.'/'.$newNameImage.'.'.$tip,9,PNG_NO_FILTER);break;
            }
            imagedestroy($newImage);
            unset($imgNow,$k,$tip);
          } else {$this->errors[]=407;}
        } else {$this->errors[]=405;}
      } else {$this->errors[]=400;}
    }
    public function clearPreFolder() {
      if (is_dir($this->_PRE_DIR_)) {
        $glob=glob($this->_PRE_DIR_.'/*');
        foreach ($glob as $file) {
          if (is_file($file)) {@unlink($file);}
          else {
            foreach (glob($file.'/*') as $file2) {
              @unlink($file.'/'.$file2);
            }
          }
        }
      } else {$this->errors[]=400;}
    }
    public function deletePreFiles() {
      if (is_dir($this->_PRE_DIR_)) {
        foreach ($this->preLoadedFiles as $file) {
          if (is_file($this->_PRE_DIR_.'/'.$file)) {@unlink($this->_PRE_DIR_.'/'.$file);}
        }
      } else {$this->errors[]=400;}
    }
    public function deleteLoadedFiles($dir) {
      if (is_dir($dir)) {
        foreach ($this->loadedFiles as $file) {
          if (is_file($dir.'/'.$file)) {@unlink($dir.'/'.$file);}
        }
      } else {$this->errors[]=400;}
    }
    public function __destruct() {}
}
?>