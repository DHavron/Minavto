<?php
class admin_img
{
    function __construct($site,$dir,$folder,$nameImg=null)
    {
        $this->SITE=$site;
        $this->_DIR_=$dir;
        $this->folder=$folder;
        $this->img=$nameImg;
    }
    public function show_image()
    {
        if (!is_null($this->img)&&file_exists($this->_DIR_.'/img'.$this->folder.$this->img)) {
            $image=getimagesize($this->_DIR_.'/img'.$this->folder.$this->img);
            if ($image[1]>150) {
                echo '<img src="'.$this->SITE.'/img'.$this->folder.$this->img.'" alt="Изображение" />';
            }
            else {echo '<img src="'.$this->SITE.'/img'.$this->folder.$this->img.'" alt="Изображение" />';}
        } else {echo '<img src="'.$this->SITE.'/img/no_img.png" alt="Изображение" />';}
    }
    /*function razmForDelete()
    {
        if (!is_null($this->img)&&file_exists($this->folder.$this->img)) {
            $imageForDelete=getimagesize($this->folder.$this->img);
            if ($imageForDelete[1]>150) {
                return ceil(150*$imageForDelete[0]/$imageForDelete[1]);
            }
            else {return $imageForDelete[0];}
        }
        else {return 0;}
    }*/
    function __destruct() {unset($this->folder,$this->img,$this->SITE);}
}
?>