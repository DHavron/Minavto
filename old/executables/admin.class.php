<?php
class admin extends prepend {
    private $refer=null;
    private $NUMMODULS=3;
    private $NUMPOSSLIDER=2;
    private $urlForParent=array('url'=>array(),'name'=>array());
    public $lang;
    
    public function __construct() {
        if (isset($_SERVER['HTTP_REFERER'])) {$this->refer=$_SERVER['HTTP_REFERER'];}
        $this->_ADMIN_=$this->_SITE_.'/admin';
        $this->validTypes=array(1,2,3);
        $this->core=$this->loadCore();
        $this->detectLang();
        $this->dbc=new mysql('CRUD');
    }
    private function detectLang() {
        $this->lang=(isset($_REQUEST['lang'])&&in_array($_REQUEST['lang'],$this->core['languages']))?$_REQUEST['lang']:$this->core['languages'][0];
    }
    
    private function loadCore() {
        $coreLoad=new core($this->_DIR_.'/core/core.xml');
        return $coreLoad->core;
    }
    public function back($error) {
        $simbol='?';
        if (!is_null($this->refer)) {
            $num=strlen($this->refer);
                for ($i=0; $i<$num; $i++) {
                if ($this->refer[$i]==$simbol) {$simbol="&";break;}
            }
            $simbol;
            $this->refer=preg_replace('/(?|&)error=(\w+)/','',$this->refer);
            $this->refer=$this->refer.$simbol.'error='.$error;
            $this->dbc->cc();
            header("Location: ".$this->refer);
        } else {
            header('HTTP/1.1 404 Not Found');
            header('Status: 404 Not Found');
            require_once($this->_DIR_.'/tpls/404.php');
            exit();
        }
    }
    public function validateSender() {
        $valid=stripos($this->refer,$this->_SITE_);
        return ($valid!==false) ? true : false;
    }
    public function isValidTypeImage($src) {
        $imgSize=getimagesize($src);
        if (in_array($imgSize[2],$this->validTypes)) {return true;} else {return false;};
        unset($imgSize);
    }
    
    public function show($show) {
        switch ($show) {
            case 'on': $resShow=array('class'=>'open','title'=>'Скрыть','btn'=>' btn-success');break;
            default: $resShow=array('class'=>'close','title'=>'Показать','btn'=>' btn-danger');
        }
        return $resShow;
    }
    /**************************************************************menu*********************************************/
    public function selectLink($link='') {
        $arrayTablesForShow=array();
        foreach ($this->core['links'] as $li) {
            if (count($li['sort-tpl'])>0) {
                foreach ($li['sort-tpl'] as $tmp) {
                    if (!in_array($this->core['tpls'][$tmp['name-tpl']]['table'],$arrayTablesForShow)&&($this->core['tpls'][$tmp['name-tpl']]['table']!='none')) $arrayTablesForShow[]=$this->core['tpls'][$tmp['name-tpl']]['table'];
                }
            }
        }
        $allTables=array();
        $queryTables=$this->dbc->query("SHOW TABLES");
        foreach ($queryTables as $resTables) {
            if (array_key_exists($resTables['Tables_in_'.$this->dbc->DB_NAME],$this->core['table'])&&($resTables['Tables_in_'.$this->dbc->DB_NAME]!='none')&&in_array($resTables['Tables_in_'.$this->dbc->DB_NAME],$arrayTablesForShow)) array_push($allTables,$resTables['Tables_in_'.$this->dbc->DB_NAME]);}
        unset($queryTables,$arrayTablesForShow);
        $check_index= ($link=='')?' checked="checked" autofocus':'';
        $classCheck=($link=='')?' info':'';
        echo '<div class="span8 links popover bottom">
            <h3 class="popover-title">Ссылки</h3>
            <div class="popover-content">
            <label class="radio'.$classCheck.'" for="index"><input type="radio" name="link" id="index" value=""'.$check_index.' class="radio"> Главная страница сайта</label>';
        $arrayPreName=array();
        if (count($this->core['links'])>0) {
            foreach ($this->core['links'] as $key=>$val) {
                if (($val['show']=='on')&&($key!='default')) {
                    $check_chpu= ($link=='/'.$key.'/') ? ' checked="checked" autofocus' : '';
                    $classCheck=($link=='/'.$key.'/')?' info':'';
                    echo '<label class="radio'.$classCheck.'" for="'.$key.'"><input type="radio" name="link" id="'.$key.'" class="radio" value="/'.$key.'/"'.$check_chpu.'>'.$val[$this->lang].'</label>';
                }
                if (!array_key_exists($key,$arrayPreName)) $arrayPreName[$this->core['tpls'][$val['sort-tpl'][0]['name-tpl']]['table']]=$key;
            }
            foreach ($this->core['components']['urls'] as $key=>$component) {
                $check_chpuComp= ($link=='/'.$key.'/') ? ' checked="checked" autofocus' : '';
                $classCheck=($link=='/'.$key.'/')?' info':'';
                echo '<label class="radio'.$classCheck.'" for="'.$key.'"><input type="radio" name="link" id="'.$key.'" class="radio" value="/'.$key.'/"'.$check_chpuComp.'>'.$component[$this->lang].'</label>';
            }
        }
        echo '</div>
            </div>';
        $dependensTables=array();
        foreach ($this->core['dependents']['dependents'] as $k=>$v) {
            $dependensTables[$k]=$v['dependent-table'];
        }
        foreach ($allTables as $isTable) {
            echo '<div class="span8 links popover bottom">
            <h3 class="popover-title">'.$this->core['table'][$isTable][$this->lang].'</h3>
            <div class="popover-content">';
            if (in_array($isTable,$dependensTables)) {
                $parentTable=null;
                foreach (array_reverse($dependensTables) as $key=>$val) {
                    if ($isTable==$val) {$parentTable=$key;break;}
                }
                if (!is_null($parentTable)) {
                    $columnParentTable=$this->core['dependents']['dependents'][$parentTable]['column'];
                    $columnIsTable=$this->core['dependents']['dependents'][$parentTable]['dependent-column'];
                    /*if ($this->isHaveChildren($isTable)) {
                        $queryIsTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`id`','`t`.`url`','`n`.`name_'.$this->lang.'`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryIsTable)>0) {
                            foreach ($queryIsTable as $resIsTable) {
                                $id=$resIsTable['id'];
                                $name=$resIsTable['name_'.$this->lang];
                                $url='/'.$resIsTable['url'].'/';
                                $this->parent($isTable,$id);
                                echo $url='/'.implode('/',array_reverse($this->urlForParent['url'])).$url;
                                $name=$name.' < '.implode(' < ',$this->urlForParent['name_'.$this->lang]);
                                echo '<li title="'.$name.'"><input type="radio" name="link" class="menu" value="'.$url.'" />'.$name.'</li>';
                            }
                        }
                    }
                    else {*/
                        $queryIsTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`','`t`.`'.$columnIsTable.'`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryIsTable)>0) {
                            foreach ($queryIsTable as $resIsTable) {
                                $col=$resIsTable[$columnIsTable];
                                $name=$resIsTable['name_'.$this->lang];
                                $url='/'.$resIsTable['url'].'/';
                                if ($this->isHaveChildren($parentTable)) {
                                    $this->parent($parentTable,$col);
                                    $url=$this->prefix($parentTable).'/'.implode('/',array_reverse($this->urlForParent['url'])).$url;
                                    $name=$name.' <i class="icon-chevron-left"></i> '.implode(' <i class="icon-chevron-left"></i> ',$this->urlForParent['name']);
                                    $this->urlForParent['url']=array();
                                    $this->urlForParent['name']=array();
                                }
                                else {
                                    $queryParentTable=$this->dbc->select('`'.$parentTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`'),'`t`.`'.$columnParentTable.'`=\''.$col.'\' && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$parentTable.'\') && `n`.`id_row`=`t`.`id`',null,'LIMIT 1');
                                    if (count($queryParentTable)>0) {
                                        $url=$this->prefix($parentTable).'/'.$queryParentTable[0]['url'].$url;
                                        $name=$name.' <i class="icon-chevron-left"></i> '.$queryParentTable[0]['name_'.$this->lang];
                                    }
                                    else {exit('Ошибка ядра');}
                                }
                                $check= ($link==$url) ? ' checked="checked" autofocus' : '';
                                $classCheck=($link==$url)?' info':'';
                                echo '<label class="radio'.$classCheck.'" for="'.$url.'"><input type="radio" name="link" id="'.$url.'" class="radio" value="'.$url.'"'.$check.'>'.$name.'</label>';
                            }
                        }
                    /*}*/
                }
                else {exit('Ошибка ядра');}
            } else {
                if ($this->isHaveChildren($isTable)) {
                    $this->children($isTable,false,$link);
                } else {
                    $queryTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryTable)>0) {
                            foreach ($queryTable as $resTable) {
                                $url=$this->prefix($isTable).'/'.$resTable['url'].'/';
                                $check= ($link==$url) ? ' checked="checked" autofocus' : '';
                                $classCheck=($link==$url)?' info':'';
                                echo '<label class="radio'.$classCheck.'" for="'.$url.'"><input type="radio" name="link" id="'.$url.'" class="radio" value="'.$url.'"'.$check.'>'.$resTable['name_'.$this->lang].'</label>';
                            }
                        }
                    }
                }
            echo '</div></div><div style="clear: both;">&nbsp;</div>'."\n";
        }
    }
    protected function children($table,$isSetPrefix=false,$link,$parent=0,$preUrl='/',$afterName='') {
        $pref= ($parent==0) ? $this->prefix($table) : '';
        $queryPar=$this->dbc->select('`'.$table.'` `t`,`name` `n`',array('`t`.`id`','`t`.`url`','`n`.`name_'.$this->lang.'`'),'`t`.`parent`='.$parent.' && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
        if (count($queryPar)>0) {
            foreach ($queryPar as $resPar) {
                $url=$pref.$preUrl.$resPar['url'].'/';
                $name=$resPar['name_'.$this->lang].$afterName;
                $check_index= ($link==$url)?' checked="checked" autofocus':'';
                $classCheck=($link==$url)?' info':'';
                echo '<label class="radio'.$classCheck.'" for="'.$url.'"><input type="radio" name="link" id="'.$url.'" class="radio" value="'.$url.'"'.$check_index.'>'.$name.'</label>';
                $this->children($table,$isSetPrefix,$link,$resPar['id'],$url,' <i class="icon-chevron-left"></i> '.$name);
            }
        }
    }
    protected function prefix($table) {
        $prefix='';
        foreach (array_reverse($this->core['links']) as $key=>$val) {
            if (($table==$this->core['tpls'][$val['name-tpl']]['table'])&&($key!='default')&&($key!='none')) {$prefix='/'.$key;break;}
        }
        return $prefix;
    }
    protected function parent($table,$id) {
        $queryPar=$this->dbc->select('`'.$table.'` `tab`,`name` `n`',array('`tab`.`parent`','`tab`.`url`','`n`.`name_'.$this->lang.'`'),'`tab`.`id`='.intval($id).' && `n`.`id_row`=`tab`.`id` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')',null,'LIMIT 1');
        if (count($queryPar)>0) {
            $this->urlForParent['url'][]=$queryPar[0]['url'];
            $this->urlForParent['name'][]=$queryPar[0]['name_'.$this->lang];
            $par=$queryPar[0]['parent'];
            if ($par>0) {$this->parent($table,$par);}
        }
    }
    private function isHaveChildren($table) {
        $queryIsParent=$this->dbc->query('SHOW COLUMNS FROM '.$table);
        $result=false;
        foreach ($queryIsParent as $resIsParent) {
            if ($resIsParent['Field']=='parent') {
                $result=true;
                break;
            }
        }
        return $result;
    }
    /***************************************************** parent ************************************************/
    function selectParent($table,$parent=0,$idNow=0) {
        $parent=intval($parent);
        $id_now=intval($idNow);
        $del_id= ($id_now>0) ? ' && `tab`.`id`!='.$id_now : '';
        
        $print='<select name="parent" class="span4">';
        $selected0= ($parent==0) ? ' selected="selected"' : '';
        $print.='<option value="0"'.$selected0.'></option>';
        $query_parent_all=$this->dbc->select('`'.$table.'` `tab`,`name` `n`',array('`tab`.`id`','`tab`.`show`','`n`.`name_'.$this->lang.'`'),'`tab`.`parent`=0 && `tab`.`id` = `n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')'.$del_id,'`tab`.`level` DESC');
        foreach ($query_parent_all as $res_parent_all) {
            $id=$res_parent_all['id'];
            $show= ($res_parent_all['show']==='on') ? '' : ' (x)';
            $selected= ($id==$parent) ? ' selected="selected"' : '';
            $print.='<option value="'.$id.'"'.$selected.'>'.$res_parent_all['name_'.$this->lang].$show.'</option>';
            $query_parent_1=$this->dbc->select('`'.$table.'` `tab`,`name` `n`',array('`tab`.`id`','`tab`.`show`','`n`.`name_'.$this->lang.'`'),'`tab`.`parent`='.$id.' && `tab`.`id` = `n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')'.$del_id,'`tab`.`level` DESC');
            foreach ($query_parent_1 as $res_parent_1) {
                $id1=$res_parent_1['id'];
                $show1= ($res_parent_1['show']==='on') ? '' : ' (x)';
                $selected1= ($id1==$parent) ? ' selected="selected"' : '';
                $print.='<option value="'.$id1.'"'.$selected1.'>'.'&nbsp;&nbsp;&nbsp;'.$res_parent_1['name_'.$this->lang].$show1.'</option>';
                $query_parent_2=$this->dbc->select('`'.$table.'` `tab`,`name` `n`',array('`tab`.`id`','`tab`.`show`','`n`.`name_'.$this->lang.'`'),'`tab`.`parent`='.$id1.' && `tab`.`id` = `n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')'.$del_id,'`tab`.`level` DESC');
                foreach ($query_parent_2 as $res_parent_2) {
                    $id2=$res_parent_2['id'];
                    $show2= ($res_parent_2['show']==='on') ? '' : ' (x)';
                    $selected2= ($id2==$parent) ? ' selected="selected"' : '';
                    $print.='<option value="'.$id2.'"'.$selected2.'>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$res_parent_2['name_'.$this->lang].$show2.'</option>';
                }
            }
        }
        $print.='</select>';
        return $print;
    }
    function selectCategory($table,$id_now=0,$dependent=false) {
        $parent=intval($id_now);
        $print='<select name="id_category" class="span4" id="inputIdCategory">';
        $print.='<option value="0">Выбрать категорию</option>';
        $query_parent_all=$this->dbc->select('`'.$table.'` `c`,`name` `n`',array('`c`.`id`','`c`.`show`','`n`.`name_'.$this->lang.'`'),'`parent`=0 && `c`.`id`=`n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')','`c`.`level` DESC');
        foreach ($query_parent_all as $res_parent_all)
        {
            $id=$res_parent_all['id'];
            $query_parent_1=$this->dbc->select('`'.$table.'` `c`,`name` `n`',array('`c`.`id`','`c`.`show`','`n`.`name_'.$this->lang.'`'),'`parent`='.$id.' && `c`.`id`=`n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')','`c`.`level` DESC');
            $show= ($res_parent_all['show']=='on') ? '' : ' (x)';
            $disabled_1= ((count($query_parent_1)>0)&&(boolean)$dependent) ? ' disabled="disabled"' : '';
            $selected= ($id==$parent) ? ' selected="selected"' : '';
            $print.='<option value="'.$id.'"'.$selected.$disabled_1.'>'.$res_parent_all['name_'.$this->lang].$show.'</option>';
            foreach ($query_parent_1 as $res_parent_1) {
                $id1=$res_parent_1['id'];
                $query_parent_2=$this->dbc->select('`'.$table.'` `c`,`name` `n`',array('`c`.`id`','`c`.`show`','`n`.`name_'.$this->lang.'`'),'`parent`='.$id1.' && `c`.`id`=`n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')','`c`.`level` DESC');
                $show1= ($res_parent_1['show']=='on') ? '' : ' (x)';
                $disabled_2= ((count($query_parent_2)>0)&&(boolean)$dependent) ? ' disabled="disabled"' : '';
                $selected1= ($id1==$parent) ? ' selected="selected"' : '';
                $print.='<option value="'.$id1.'"'.$selected1.$disabled_2.'>'.'&nbsp;&nbsp;'.$res_parent_1['name_'.$this->lang].$show1.'</option>';
                foreach ($query_parent_2 as $res_parent_2) {
                    $id2=$res_parent_2['id'];
                    $query_parent_3=$this->dbc->select('`'.$table.'` `c`,`name` `n`',array('`c`.`id`','`c`.`show`','`n`.`name_'.$this->lang.'`'),'`parent`='.$id2.' && `c`.`id`=`n`.`id_row` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')','`c`.`level` DESC');
                    $show2= ($res_parent_2['show']=='on') ? '' : ' (x)';
                    $disabled_3= ((count($query_parent_3)>0)&&(boolean)$dependent) ? ' disabled="disabled"' : '';
                    $selected2= ($id2==$parent) ? ' selected="selected"' : '';
                    $print.='<option value="'.$id2.'"'.$selected2.$disabled_3.'>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$res_parent_2['name_'.$this->lang].$show2.'</option>';
                    foreach ($query_parent_3 as $res_parent_3) {
                        $id3=$res_parent_3['id'];
                        $show3= ($res_parent_3['show']=='on') ? '' : ' (x)';
                        if ($id3==$parent) {$selected3=' selected="selected"';} else {$selected3='';}
                        $print.='<option value="'.$id3.'"'.$selected3.'>'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$res_parent_3['name_'.$this->lang].$show3.'</option>';
                    }
                }
            }
        }
        $print.='</select>';
        return $print;
    }
    public function selectManufacturer($idNow=0) {
        echo '<select name="id_manufacturer" class="span4" id="inputIdMan">';
        echo '<option value="0">Выбрать производителя</option>';
        foreach ($this->dbc->select('`catalog_manufacturer` `m`,`name` `n`',array('`m`.`id`','`m`.`show`','`n`.`name_'.$this->lang.'`'),'`m`.`id`=`n`.`id_row` && `n`.`id_table`=4','`level` DESC,`id` DESC') as $man) {
            $select=($man['id']==$idNow)?' selected="selected"':null;
            $show=($man['show']=='of')?' (X)':'';
            echo '<option value="'.$man['id'].'"'.$select.'>'.$man['name_'.$this->lang].$show.'</option>';
        }
        echo '</select>';
    }
    public function allChildrenCategory($table,$id_category)
    {
        $category=intval($id_category);
        $arrayCategoryChildren=array($category);
        $result=$this->dbc->select('`'.$table.'`',array('`id`','`parent`'),null,'`parent`,`level` DESC');
        foreach ($result as $res) {
            if (in_array($res['parent'],$arrayCategoryChildren)) array_push($arrayCategoryChildren,intval($res['id']));
        }
        return implode(",",$arrayCategoryChildren);
    }
    public function allParentCategory($table,$idCategory)
    {
        $idCategory=intval($idCategory);
        $arrayParent=array($idCategory);
        $queryParent1=$this->dbc->select('`'.$table.'`',array('`parent`'),'`id`='.$idCategory,null,'LIMIT 1');
        if ($queryParent1[0]['parent']>0) {
            array_push($arrayParent,$queryParent1[0]['parent']);
            $queryParent2=$this->dbc->select('`'.$table.'`',array('`parent`'),'`id`='.$queryParent1[0]['parent'],null,'LIMIT 1');
            if ($queryParent2[0]['parent']>0) {
                array_push($arrayParent,$queryParent2[0]['parent']);
                $queryParent3=$this->dbc->select('`'.$table.'`',array('`parent`'),'`id`='.$queryParent2[0]['parent'],null,'LIMIT 1');
                if ($queryParent3[0]['parent']>0) {
                    array_push($arrayParent,$queryParent3[0]['parent']);
                }
            }
        }
        return $arrayParent;
    }
    public function getAllAttributes($lang) {
        return  $this->dbc->select('`attribute` `a`,`name` `n`, `unit_attributes` `u`',array('`a`.`id`','`n`.`name_'.$lang.'`','`u`.`name_'.$lang.'` as `unit_name_'.$lang.'`'),'`n`.`id_table`=23 && `n`.`id_row`=`a`.`id` && `a`.`show`=\'on\' && `u`.`id`=`a`.`id_unit`','`a`.`level` DESC');
    }
    
    /********************************************************moduls******************************************/
    public function positionModul($now=0) {
        $print='<select class="span4" id="selectPosition" name="position">';
        for ($i=0; $i<$this->NUMMODULS; $i++)
        {
            $i1=$i+1;
            if ($now==$i1) {$sel=' selected="selected"';} else {$sel='';}
            $print.='<option value="'.$i1.'"'.$sel.'>Позиция '.$i1.'</option>';
        }
        $print.='</select>';
        return $print;
    }
    public function isPosInModul($pos) {return (($pos<=$this->NUMMODULS)||($pos>0)) ? true : false;}
    
    /********************************************************positionSlider******************************************/
    public function positionSlider($now=0)
    {
        $print='<select name="position" id="selectPosition" class="span4">';
        for ($i=0; $i<$this->NUMPOSSLIDER; $i++)
        {
            $i1=$i+1;
            if ($now==$i1) {$sel=' selected="selected"';} else {$sel='';}
            $print.='<option value="'.$i1.'"'.$sel.'>Позиция '.$i1.'</option>';
        }
        $print.='</select>';
        return $print;
    }
    public function isPosInSlider($pos) {return (($pos<=$this->NUMPOSSLIDER)||($pos>0)) ? true : false;}
    /***********************************************translit*******************************************************/
    public function translit($str) {
        $converter = array('а' => 'a','б' => 'b','в' => 'v',
                            'г' => 'g','д' => 'd','е' => 'e',
                            'ё' => 'jo', 'ж' => 'zh','з' => 'z',
                            'и' => 'i', 'й' => 'j', 'к' => 'k',
                            'л' => 'l', 'м' => 'm', 'н' => 'n',
                            'о' => 'o', 'п' => 'p', 'р' => 'r',
                            'с' => 's', 'т' => 't', 'у' => 'u',
                            'ф' => 'f', 'х' => 'h', 'ц' => 'c',
                            'ч' => 'ch','ш' => 'sh','щ' => 'shh',
                            'ь' => '','ы' => 'y', 'ъ' => '#',
                            'э' => 'je', 'ю' => 'ju','я' => 'ja',
                            ' '=>'-','!'=>'','?'=>'','~'=>'','\\'=>'',
                            '/'=>'',','=>'',':'=>'',';'=>'','\''=>'','"'=>'','«'=>'','»'=>'',
                            'А' => 'A', 'Б' => 'B', 'В' => 'V',
                            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
                            'Ё' => 'Jo', 'Ж' => 'Zh','З' => 'Z',
                            'И' => 'I', 'Й' => 'J', 'К' => 'K',
                            'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                            'О' => 'O', 'П' => 'P', 'Р' => 'R',
                            'С' => 'S', 'Т' => 'T', 'У' => 'U',
                            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
                            'Ч' => 'Ch','Ш' => 'Sh','Щ' => 'Shh',
                            'Ь' => '','Ы' => 'Y', 'Ъ' => '#',
                            'Э' => 'Je', 'Ю' => 'Ju','Я' => 'Ja',
        );
        $input=strtr($str,$converter);
        return $input;
    }
    
    public function down_level($table,$id) {
        $res=$this->dbc->select('`'.$table.'`',array('`level`'),'`id`='.$id);
        $level=$res[0]['level'];
        if ($level>0) $level--;
        return ($this->dbc->update('`'.$table.'`',array('`level`'),array($level),'`id`='.$id)) ? true : false;
    }
    public function up_level($table,$id) {
        $res=$this->dbc->select('`'.$table.'`',array('`level`'),'`id`='.$id);
        $level=$res[0]['level'];
        $level++;
        return ($this->dbc->update('`'.$table.'`',array('`level`'),array($level),'`id`='.$id)) ? true : false;
    }
    
    public function up_show($table,$id) {
        $res=$this->dbc->select('`'.$table.'`',array('`show`'),'`id`='.$id);
        $show=$res[0]['show'];
        switch ($show) {
            case 'of': $resShow='on';break;
            default: $resShow='of';
        }
        return $this->dbc->update('`'.$table.'`',array('`show`'),array($resShow),'`id`='.$id);
    }
    public function loadFile($nameInput,$name,$dir,$file=false) {
        $result=array('name-file'=>null,'error'=>0);
        if (($_FILES[$nameInput]['size']>0)&&($_FILES[$nameInput]['size']<=10240000)&&($_FILES[$nameInput]['error']==0)&&(trim($_FILES[$nameInput]['name'])!='')) {
            if (!$file) {
                if($this->isValidTypeImage($_FILES[$nameInput]['tmp_name'])) {
                    $mime=getimagesize($_FILES[$nameInput]['tmp_name']);
                    $tip=explode("/",$mime["mime"]);
                    $tip=$tip[1];
                    $nameFile=mb_strtolower($this->translit($name),'UTF-8').'.'.$tip;
                    $fileName=$dir.$nameFile;
                    if (!is_file($fileName)) {
                    if (is_uploaded_file($_FILES[$nameInput]['tmp_name'])) {
                            if (move_uploaded_file($_FILES[$nameInput]['tmp_name'],$fileName)) {
                            @unlink($_FILES[$nameInput]['tmp_name']);
                            $result['name-file']=$nameFile;
                        }
                        else {
                            @unlink($_FILES[$nameInput]['tmp_name']);
                            $result['error']=3072;
                        }
                    }
                    else {$result['error']=3072;}
                    }
                    else {
                        @unlink($_FILES[$nameInput]['tmp_name']);
                        $result['error']=3002;
                    }
                } else {$result['error']=3072;}
            }
            else {
                $tip = end(explode('.',$_FILES[$nameInput]['name']));
                $nameFile=mb_strtolower($this->translit($name),'UTF-8').'.'.$tip;
                $fileName=$dir.$nameFile;
                if (!is_file($fileName)) {
                if (is_uploaded_file($_FILES[$nameInput]['tmp_name'])) {
                    if (move_uploaded_file($_FILES[$nameInput]['tmp_name'],$fileName)) {
                        @unlink($_FILES[$nameInput]['tmp_name']);
                        $result['name-file']=$nameFile;
                    }
                    else {
                        @unlink($_FILES[$nameInput]['tmp_name']);
                        $result['error']=3072;
                    }
                }
                else {$result['error']=3072;}
                }
                else {
                    @unlink($_FILES[$nameInput]['tmp_name']);
                    $result['error']=3002;
                }
            }
        }
        return $result;
    }
    public function names($table,$where=null) {
        $res=$this->dbc->select('`name`',array('`name_'.$this->lang.'`','`id_row`'),'`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')');
        $result=array();
        foreach ($res as $val) {
            $id=$val['id_row'];unset($val['id_row']);
            $result[$id]=$val['name_'.$this->lang];
        }
        return $result;
    }
    public function delete_img($table,$column,$id,$dir) {
        $res=$this->dbc->select($table,array($column),'`id`='.$id);
        if (count($res)>0) {
            $value=$res[0][preg_replace('/\`/','',$column)];
            if (!is_null($value)) {
                if ($this->dbc->update($table,array($column),array(null),'`id`='.$id)) {
                    @unlink($dir.$value);
                    return true;
                }
                else {return false;}
            }
            return true;
        }
        else {return false;}
    }
    public function checkLinks($link=array()) {
        $arrayTablesForShow=array();
        foreach ($this->core['links'] as $li) {
            if (count($li['sort-tpl'])>0) {
                foreach ($li['sort-tpl'] as $tmp) {
                    if (!in_array($this->core['tpls'][$tmp['name-tpl']]['table'],$arrayTablesForShow)&&($this->core['tpls'][$tmp['name-tpl']]['table']!='none')) $arrayTablesForShow[]=$this->core['tpls'][$tmp['name-tpl']]['table'];
                }
            }
        }
        $allTables=array();
        $queryTables=$this->dbc->query("SHOW TABLES");
        foreach ($queryTables as $resTables) {if (array_key_exists($resTables['Tables_in_'.$this->dbc->DB_NAME],$this->core['table'])&&($resTables['Tables_in_'.$this->dbc->DB_NAME]!='none')&&in_array($resTables['Tables_in_'.$this->dbc->DB_NAME],$arrayTablesForShow)) array_push($allTables,$resTables['Tables_in_'.$this->dbc->DB_NAME]);}
        unset($queryTables,$arrayTablesForShow);
        $check_index=(in_array('index',$link))?' checked="checked"':'';
        $classCheck=(in_array('index',$link))?' info':'';
        echo '<div class="span8 links popover bottom">
            <h3 class="popover-title">Ссылки</h3>
            <div class="popover-content">
            <label class="checkbox'.$classCheck.'" for="index"><input type="checkbox" name="link[]" id="index" value="index"'.$check_index.' class="checkbox"> Главная страница сайта</label>';
        $arrayPreName=array();
        if (count($this->core['links'])>0) {
            foreach ($this->core['links'] as $key=>$val) {
                if (($val['show']=='on')&&($key!='default')) {
                    $check_chpu= (in_array('/'.$key.'/',$link))?' checked="checked"':'';
                    $classCheck=(in_array('/'.$key.'/',$link))?' info':'';
                    echo '<label class="checkbox'.$classCheck.'" for="'.$key.'"><input type="checkbox" name="link[]" id="'.$key.'" class="checkbox" value="/'.$key.'/"'.$check_chpu.'>'.$val[$this->lang].'</label>';
                }
                if (!array_key_exists($key,$arrayPreName)) $arrayPreName[$this->core['tpls'][$val['sort-tpl'][0]['name-tpl']]['table']]=$key;
            }
            foreach ($this->core['components']['urls'] as $key=>$component) {
                $check_chpuComp=(in_array('/'.$key.'/',$link))?' checked="checked"':'';
                $classCheck=(in_array('/'.$key.'/',$link))?' info':'';
                echo '<label class="checkbox'.$classCheck.'" for="'.$key.'"><input type="checkbox" name="link[]" id="'.$key.'" class="checkbox" value="/'.$key.'/"'.$check_chpuComp.'>'.$component[$this->lang].'</label>';
            }
        }
        echo '</div>
            </div>';
        $dependensTables=array();
        foreach ($this->core['dependents']['dependents'] as $k=>$v) {
            $dependensTables[$k]=$v['dependent-table'];
        }
        foreach ($allTables as $isTable) {
            echo '<div class="span8 links popover bottom">
            <h3 class="popover-title">'.$this->core['table'][$isTable][$this->lang].'</h3>
            <div class="popover-content">';
            if (in_array($isTable,$dependensTables)) {
                $parentTable=null;
                foreach (array_reverse($dependensTables) as $key=>$val) {
                    if ($isTable==$val) {$parentTable=$key;break;}
                }
                if (!is_null($parentTable)) {
                    $columnParentTable=$this->core['dependents']['dependents'][$parentTable]['column'];
                    $columnIsTable=$this->core['dependents']['dependents'][$parentTable]['dependent-column'];
                    /*if ($this->isHaveChildren($isTable)) {
                        $queryIsTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`id`','`t`.`url`','`n`.`name_ru`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryIsTable)>0) {
                            foreach ($queryIsTable as $resIsTable) {
                                $id=$resIsTable['id'];
                                $name=$resIsTable['name_'.$this->lang];
                                $url='/'.$resIsTable['url'].'/';
                                $this->parent($isTable,$id);
                                echo $url='/'.implode('/',array_reverse($this->urlForParent['url'])).$url;
                                $name=$name.' < '.implode(' < ',$this->urlForParent['name_'.$this->lang]);
                                echo '<li title="'.$name.'"><input type="checkbox" name="link[]" class="menu" value="'.$url.'" />'.$name.'</li>';
                            }
                        }
                    }
                    else {*/
                        $queryIsTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`','`t`.`'.$columnIsTable.'`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryIsTable)>0) {
                            foreach ($queryIsTable as $resIsTable) {
                                $col=$resIsTable[$columnIsTable];
                                $name=$resIsTable['name_'.$this->lang];
                                $url='/'.$resIsTable['url'].'/';
                                if ($this->isHaveChildren($parentTable)) {
                                    $this->parent($parentTable,$col);
                                    $url=$this->prefix($parentTable).'/'.implode('/',array_reverse($this->urlForParent['url'])).$url;
                                    $name=$name.' <i class="icon-chevron-left"></i> '.implode(' <i class="icon-chevron-left"></i> ',$this->urlForParent['name']);
                                    $this->urlForParent['url']=array();
                                    $this->urlForParent['name']=array();
                                }
                                else {
                                    $queryParentTable=$this->dbc->select('`'.$parentTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`'),'`t`.`'.$columnParentTable.'`=\''.$col.'\' && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$parentTable.'\') && `n`.`id_row`=`t`.`id`',null,'LIMIT 1');
                                    if (count($queryParentTable)>0) {
                                        $url=$this->prefix($parentTable).'/'.$queryParentTable[0]['url'].$url;
                                        $name=$name.' <i class="icon-chevron-left"></i> '.$queryParentTable[0]['name_'.$this->lang];
                                    }
                                    else {exit('Ошибка ядра');}
                                }
                                $check= (in_array($url,$link))?' checked="checked"':'';
                                $classCheck=(in_array($url,$link))?' info':'';
                                echo '<label class="checkbox'.$classCheck.'" for="'.$url.'"><input type="checkbox" name="link[]" id="'.$url.'" class="checkbox" value="'.$url.'"'.$check.'>'.$name.'</label>';
                            }
                        }
                    /*}*/
                }
                else {exit('Ошибка ядра');}
            } else {
                if ($this->isHaveChildren($isTable)) {
                    $this->childrenCheckLinks($isTable,false,$link);
                } else {
                    $queryTable=$this->dbc->select('`'.$isTable.'` `t`,`name` `n`',array('`t`.`url`','`n`.`name_'.$this->lang.'`'),'`n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$isTable.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
                        if (count($queryTable)>0) {
                            foreach ($queryTable as $resTable) {
                                $url=$this->prefix($isTable).'/'.$resTable['url'].'/';
                                $check= (in_array($url,$link))?' checked="checked"':'';
                                $classCheck=(in_array($url,$link))?' info':'';
                                echo '<label class="checkbox'.$classCheck.'" for="'.$url.'"><input type="checkbox" name="link[]" id="'.$url.'" class="checkbox" value="'.$url.'"'.$check.'>'.$resTable['name_'.$this->lang].'</label>';
                            }
                        }
                    }
                }
            echo '</div></div><div style="clear: both;">&nbsp;</div>'."\n";
        }
    }
    protected function childrenCheckLinks($table,$isSetPrefix=false,$link,$parent=0,$preUrl='/',$afterName='') {
        $pref= ($parent==0) ? $this->prefix($table) : '';
        $queryPar=$this->dbc->select('`'.$table.'` `t`,`name` `n`',array('`t`.`id`','`t`.`url`','`n`.`name_'.$this->lang.'`'),'`t`.`parent`='.$parent.' && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\') && `n`.`id_row`=`t`.`id`','`t`.`level` DESC,`t`.`id` DESC');
        if (count($queryPar)>0) {
            foreach ($queryPar as $resPar) {
                $url=$pref.$preUrl.$resPar['url'].'/';
                $name=$resPar['name_'.$this->lang].$afterName;
                $check=(in_array($url,$link))?' checked="checked"':'';
                $classCheck=(in_array($url,$link))?' info':'';
                echo '<label class="checkbox'.$classCheck.'" for="'.$url.'"><input type="checkbox" name="link[]" id="'.$url.'" class="checkbox" value="'.$url.'"'.$check.'>'.$name.'</label>';
                $this->childrenCheckLinks($table,$isSetPrefix,$link,$resPar['id'],$url,' <i class="icon-chevron-left"></i> '.$name);
            }
        }
    }
    public function deleteAndClearDir($dir) {
        $glob=glob($dir.'/*');
        foreach ($glob as $allFiles) {
            if (is_dir($allFiles)) {
                $this->deleteAndClearDir($allFiles);
            }
            else {
                @unlink($allFiles);
            }
        }
        @rmdir($dir);
    }
    public function selectProductsInDiscounts($arrayId=array()) {
        $mans=$this->dbc->select('`catalog_manufacturer` `m`,`name` `n`',array('`m`.`id`','`n`.`name_'.$this->lang.'`'),'`n`.`id_row`=`m`.`id` && `n`.`id_table`=4','`m`.`level` DESC, `m`.`id` DESC');
        if (count($mans)>0) {
          echo '<select multiple="multiple" class="span4" name="prods[]" id="inputDiscount" size="10">';
          foreach ($mans as $man) {
            echo '<optgroup label="'.$man['name_'.$this->lang].':">';
            $prod=$this->dbc->select('`catalog_product` `p`,`name` `n`',array('`p`.`id`','`n`.`name_'.$this->lang.'`'),'`n`.`id_row`=`p`.`id` && `n`.`id_table`=5 && `p`.`id_manufacturer`='.$man['id'],'`p`.`level` DESC,`p`.`id` DESC');
            foreach ($prod as $valProd) {
                $check=(in_array($valProd['id'],$arrayId))?' selected="selected"':'';
                echo '<option value="'.$valProd['id'].'"'.$check.'>'.$valProd['name_'.$this->lang].'</option>';
            }
            echo '</optgroup>';
          }
          echo '</select>';
        }
    }
    public function updateLinks($table,$nowUrl,$newUrl) {
        if (in_array($table,$this->core['dependents']['tables'])) {
            $replaceInMenu=$this->dbc->select('`menu`',array('`link`'),'`link` LIKE \'%'.$nowUrl.'%\'');
            foreach ($replaceInMenu as $inMenu) {
                $this->dbc->update('`menu`',array('`link`'),array(preg_replace('/'.addcslashes($nowUrl,'/').'/',$newUrl,$inMenu['link'])),'`link`=\''.$inMenu['link'].'\'');
            }
            $replaceInML=$this->dbc->select('`moduls_links`',array('`link`'),'`link` LIKE \'%'.$nowUrl.'%\'');
            foreach ($replaceInML as $inML) {
                $this->dbc->update('`moduls_links`',array('`link`'),array(preg_replace('/'.addcslashes($nowUrl,'/').'/',$newUrl,$inML['link'])),'`link`=\''.$inML['link'].'\'');
            }
            $replaceInSL=$this->dbc->select('`slider_links`',array('`link`'),'`link` LIKE \'%'.$nowUrl.'%\'');
            foreach ($replaceInSL as $inSL) {
                $this->dbc->update('`slider_links`',array('`link`'),array(preg_replace('/'.addcslashes($nowUrl,'/').'/',$newUrl,$inSL['link'])),'`link`=\''.$inSL['link'].'\'');
            }
            $replaceInS=$this->dbc->select('`slides`',array('`link`'),'`link` LIKE \'%'.$nowUrl.'%\'');
            foreach ($replaceInS as $inS) {
                $this->dbc->update('`slides`',array('`link`'),array(preg_replace('/'.addcslashes($nowUrl,'/').'/',$newUrl,$inS['link'])),'`link`=\''.$inS['link'].'\'');
            }
        }
        else {
            $this->dbc->update('`menu`',array('`link`'),array($newUrl),'`link`=\''.$nowUrl.'\'');
            $this->dbc->update('`moduls_links`',array('`link`'),array($newUrl),'`link`=\''.$nowUrl.'\'');
            $this->dbc->update('`slider_links`',array('`link`'),array($newUrl),'`link`=\''.$nowUrl.'\'');
            $this->dbc->update('`slides`',array('`link`'),array($newUrl),'`link`=\''.$nowUrl.'\'');
        }
    }
    
    public function __destruct() {unset($this->dbc);}
}
?>