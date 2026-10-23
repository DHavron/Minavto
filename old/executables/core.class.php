<?php
final class core {
    public $core=array( 'languages'=>array(),
                        'table'=>array(),
                        'links'=>array(),
                        'name_chpu'=>array(),
                        'tpls'=>array(),
                        'dependents'=>array('dependents'=>array(),'tables'=>array()),
                        'components'=>array('tpls'=>array(),'urls'=>array()),
                        'filters'=>array(),
                        'styles'=>array(),
                        'scripts'=>array(),
                        'multilanguage'=>'of',
                        'alternate'=>'of'
    );
    public function __construct($file) {
        $this->load($file);
    }
    private function load($file) {
        $coreFile=new SimpleXmlElement($file,LIBXML_NOERROR,true);
        if (isset($coreFile->languages[0])&&(count($coreFile->languages[0]->children())>0)) {
            $this->core['alternate']=$this->isAttrAlternate($coreFile->languages);
            foreach ($coreFile->languages[0]->children() as $language) {
                $this->core['languages'][]=mb_strtolower($language['lang'],'UTF-8');
                if ($this->core['multilanguage']=='of') $this->core['multilanguage']='on';
            }
        } elseif ($this->isSetAttr($coreFile->languages,'default')) {
            $this->core['languages'][]=strval($coreFile->languages['default']);
        } else {$this->core['languages'][]='ru';}
        foreach ($coreFile->tables_db[0]->children() as $table) {
            $arrayNLT=array();
            foreach ($this->core['languages'] as $lang) {$arrayNLT[$lang]=strval($table[$lang]);}
            $this->core['table'][strval($table['name'])]=$arrayNLT;
        }
        foreach ($coreFile->links[0]->children() as $link) {
            $arrayValues=array();
            $valueLink=strval($link['value']);
            $arrayValues['name-tpl']=strval($link['name-tpl']);
            $arrayValues['show']=$this->isAttrZeroShow($link);
            foreach ($this->core['languages'] as $lang) {
                $arrayValues[$lang]= ($this->isSetAttr($link,$lang)) ? strval($link[$lang]): '';
            }
            $sortTpl=array();
            foreach ($link->children() as $name_tpl) {
                $nameLinkTable=strval($name_tpl[0]['name-tpl']);
                $sortTpl[]=array('name-tpl'=>$nameLinkTable);
            }
            array_push($this->core['name_chpu'],$valueLink);
            $arrayValues['sort-tpl']=$sortTpl;
            $this->core['links'][$valueLink]=$arrayValues;
        }
        foreach ($coreFile->tpls[0]->children() as $tpl) {
            $table=strval($tpl['table']);
            if (array_key_exists($table,$this->core['table'])) {
            $this->core['tpls'][strval($tpl['name'])]=array('table'=>$table,'num-on-page'=>$this->isAttrNavigation($tpl),"dependent"=>$this->isAttrDependent($tpl));
            }
        }
        foreach ($coreFile->dependents[0]->children() as $dependent) {
            $table=strval($dependent['table']);
            $dependentTable=strval($dependent['dependent-table']);
            $column=strval($dependent['column']);
            $dependentColumn=strval($dependent['dependent-column']);
            $this->core['dependents']['tables'][]=$table;
            $this->core['dependents']['dependents'][$table]=array('dependent-table'=>$dependentTable,'column'=>$column,'dependent-column'=>$dependentColumn);
        }
        foreach ($coreFile->components[0]->children() as $component) {
            $nameTpl=strval($component['name-tpl']);
            $url=strval($component['url']);
            $ruComponent=($this->isSetAttr($component,'ru'))?strval($component['ru']):'';
            $enComponent=($this->isSetAttr($component,'en'))?strval($component['en']):'';
            $deComponent=($this->isSetAttr($component,'de'))?strval($component['de']):'';
            $plComponent=($this->isSetAttr($component,'pl'))?strval($component['pl']):'';
            $byComponent=($this->isSetAttr($component,'by'))?strval($component['by']):'';
            $this->core['components']['tpls'][]=$nameTpl;
            $this->core['components']['urls'][$url]=array('name-tpl'=>$nameTpl,'num-on-page'=>$this->isAttrNavigation($component),'session-array'=>$this->isSessionArray($component),'ru'=>$ruComponent,'en'=>$enComponent,'de'=>$deComponent,'pl'=>$plComponent,'by'=>$byComponent);
        }
        if (isset($coreFile->filters[0])) {//-------------------------------
        foreach ($coreFile->filters[0]->children() as $filter) {
            $nameTpl=strval($filter['use-tpl']);
            foreach ($filter->children() as $nameFilter) {
                $this->core['filters'][$nameTpl][strval($nameFilter['name'])]=strval($nameFilter['table']);
            }
        }
        unset($nameTpl,$namescript,$typescript);
        }
        if (isset($coreFile->scripts[0])) {
        foreach ($coreFile->scripts[0]->children() as $script) {
            $nameTpl=strval($script['tpl']);
            $namescript=strval($script['namescript']);
            $typescript=strval($script['type']);
            $this->core['scripts'][$nameTpl][]=array('src'=>$namescript,'type'=>$typescript);
        }
        unset($nameTpl,$namescript,$typescript);
        }
        if (isset($coreFile->styles[0])) {
        foreach ($coreFile->styles[0]->children() as $style) {
            $nameTpl=strval($style['tpl']);
            $href=strval($style['href']);
            $media=strval($style['media']);
            if ($this->isSetAttr($style,'if')) {
                $if=$style['if'];
            } else $if='of';
            $this->core['styles'][$nameTpl][]=array('href'=>$href,'media'=>$media,'if'=>$if);
        }
        unset($nameTpl,$href,$media,$if);
        }
    }
    private function isAttrZeroShow($row) {
        if (isset($row['page-zero-show'])) {
            if ($row['page-zero-show']=='of') {return 'of';} else {return 'on';}
        } else {return 'on';}
    }
    private function isSetAttr($row,$nameAttr) {
        return (isset($row[$nameAttr])) ? true : false;
    }
    private function isAttrNavigation($row) {
        return ($this->isSetAttr($row,'num-on-page')) ? intval($row['num-on-page']) : 0;
    }
    private function isAttrDependent($row) {
        if ($this->isSetAttr($row,'dependent')&&($row['dependent']=='on')) {return 'on';} else {return 'of';}
    }
    private function isAttrAlternate($row) {
        if ($this->isSetAttr($row,'alternate')&&($row['alternate']=='on')) {return 'on';} else {return 'of';}
    }
    private function isSessionArray($row) {
        if ($this->isSetAttr($row,'session-array')) {
            $nameArray=strval($row['session-array']);
            if (!isset($_SESSION[$nameArray])) $_SESSION[$nameArray]=array();
            return $nameArray;
        } else {return '';}
    }
}
?>