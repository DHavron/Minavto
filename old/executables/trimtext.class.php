<?php
class trimText
{
    function __construct() {}
    
    function trim($num,$text,$dot=false) {
        $num=intval($num);
        $text=trim($text);
        $chto = array("\r" => " ", "\n" => " ", "<br />" => " ", "<br>" => " ");
        $str=strtr($text,$chto);
        $lenght=strlen($str);
        if ($lenght<=$num) {
            return $str;
        }
        else {
            $string=substr($str,0,$num);
            $next_symb=str_split($str);
            $n=$num+1;
            $stroke="";
            if ($next_symb[$n]==' ') {
                $stroke.=substr($str,0,$n);
                return ($dot) ? $stroke.'...' :$stroke;
            }
            else
            {
                $str2=explode(' ',$string);
                $number=count($str2);
                if ($number>2) {
                    for ($i=0;$i<=$number-2;$i++) {
                        if ($i==$number-2) {$end= ($dot) ? '...' : '';}
                        else {$end=($dot) ? ' ' : '';}
                        $stroke.=$str2[$i].$end;
                    }
                }
                else {
                    $stroke.=$string;
                }
                return $stroke;
            }
        }
    }
    function probeli($number) {
        $str_num=strval($number);
        $str_arr=explode('.',$str_num);
        $str_lenght=strlen($str_arr[0]);
        $revstr=strrev($str_arr[0]);
        $revstr_s_probel='';
        $kol_str=0;
        for ($istr=0;$istr<$str_lenght;$istr++)
        {
            if ($kol_str==3) {$kol_str=0;$revstr_s_probel.=' ';}
            $kol_str++;
            $revstr_s_probel.=$revstr{$istr};
        }
        $chislo=strrev($revstr_s_probel);
        unset($revstr_s_probel,$kol_str,$str_lenght);
        return (isset($str_arr[1]))?$chislo.'.'.$str_arr[1]:$chislo;
    }
    public function __destruct() {}
}
?>