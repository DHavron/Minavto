        <div class="disp_none"><input type="hidden" name="table" value="<?php echo $table; ?>" /></div>
        <table class="table global table-condensed table-bordered">
            <thead>
                <th class="check">&nbsp;</th>
                <th class="num">#</th>
                <th class="name">Название</th>
                <?php if (!in_array($idmenu,$idNotView)) { ?><th class="level">Уровень</th><?php } ?>
                <th class="act">Действия</th>
            </thead>
        <?php
        $order= (in_array($idmenu,$idNotView)) ? null : '`t`.`level` DESC,`t`.`id` DESC';
        $queryVivod=$init->dbc->select('`'.$table.'` `t`,`name` `n`',array(),$where.'`n`.`id_row`=`t`.`id` && `n`.`id_table`=(SELECT `id` FROM `tables` WHERE `name`=\''.$table.'\')',$order);
        if (count($queryVivod)>0) {
            $resName=$init->names($table);
        ?>
            <tbody>
            <?php
            for ($i=0;$i<count($queryVivod);++$i) {
                $idVivod=$queryVivod[$i]['id'];
                if ($queryVivod[$i]['parent']==0) {
            ?>
                <tr>
                <td class="check"><label class="checkbox">&nbsp;</td>
                <td class="num"><?php echo $idVivod; ?></td>
                <td class="name"><?php echo $resName[$idVivod]; ?></td>
                <?php if (!in_array($idmenu,$idNotView)) { ?>
                <td class="level">
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/down_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod; ?>" title="-1" class="btn btn-mini"><i class="icon-minus"></i></a>
                    <?php echo $queryVivod[$i]['level']; ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod; ?>" title="+1" class="btn btn-mini"><i class="icon-plus"></i></a>
                </td>
                <?php } ?>
                <td class="act">
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $idVivod; ?>" title="Редактировать" class="btn btn-mini"><i class="icon-edit"></i></a>
                    <?php
                    if (isset($queryVivod[$i]['show'])) {
                        $view=$init->show($queryVivod[$i]['show']);
                    ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_show.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod; ?>" title="<?php echo $view['title']; ?>" class="btn btn-mini<?php echo $view['btn']; ?>"><i class="icon-eye-<?php echo $view['class']; ?>"></i></a>
                    <?php } ?>
                    <?php if (key_exists($idmenu,$idCopy)&&$auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?id=<?php echo $idVivod; ?>&idmenu=<?php echo $idCopy[$idmenu]; ?>" title="Копировать" class="btn btn-mini"><i class="icon-tags"></i></a>
                    <?php } ?>
                    <?php if ($auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/<?php echo $table; ?>/delete_<?php echo $table; ?>.php?id=<?php echo $idVivod; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a>
                    <?php } ?>
                </td>
                </tr>
            <?php
            //-------------------------------------------------------- level 2 ----------------------------------------------
                    for($i2=0;$i2<count($queryVivod);++$i2) {
                    $idVivod2=$queryVivod[$i2]['id'];
                    if ($queryVivod[$i2]['parent']==$idVivod) {
            ?>
                <tr>
                <td class="check"><label class="checkbox"><input type="checkbox" name="del[]" value="<?php echo $idVivod2; ?>" /></label></td>
                <td class="num"><?php echo $idVivod2; ?></td>
                <td class="name"><?php echo '<span  class="muted">'.$resName[$idVivod].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;'.$resName[$idVivod2]; ?></td>
                <?php if (!in_array($idmenu,$idNotView)) { ?>
                <td class="level">
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/down_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod2; ?>" title="-1" class="btn btn-mini"><i class="icon-minus"></i></a>
                    <?php echo $queryVivod[$i2]['level']; ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod2; ?>" title="+1" class="btn btn-mini"><i class="icon-plus"></i></a>
                </td>
                <?php } ?>
                <td class="act">
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $idVivod2; ?>" title="Редактировать" class="btn btn-mini"><i class="icon-edit"></i></a>
                    <?php
                    if (isset($queryVivod[$i2]['show'])) {
                        $view=$init->show($queryVivod[$i2]['show']);
                    ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_show.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod2; ?>" title="<?php echo $view['title']; ?>" class="btn btn-mini<?php echo $view['btn']; ?>"><i class="icon-eye-<?php echo $view['class']; ?>"></i></a>
                    <?php } ?>
                    <?php if (key_exists($idmenu,$idCopy)&&$auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?id=<?php echo $idVivod2; ?>&idmenu=<?php echo $idCopy[$idmenu]; ?>" title="Копировать" class="btn btn-mini"><i class="icon-tags"></i></a>
                    <?php } ?>
                    <?php if ($auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/<?php echo $table; ?>/delete_<?php echo $table; ?>.php?id=<?php echo $idVivod2; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a>
                    <?php } ?>
                </td>
                </tr>
            <?php
                        for ($i3=0;$i3<count($queryVivod);++$i3) {
                            $idVivod3=$queryVivod[$i3]['id'];
                            if ($queryVivod[$i3]['parent']==$idVivod2) {
            ?>
            <tr>
                <td class="check"><label class="checkbox"><input type="checkbox" name="del[]" value="<?php echo $idVivod3; ?>" /></label></td>
                <td class="num"><?php echo $idVivod3; ?></td>
                <td class="name"><?php echo '<span  class="muted">'.$resName[$idVivod].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;<span  class="muted">'.$resName[$idVivod2].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;'.$resName[$idVivod3]; ?></td>
                <?php if (!in_array($idmenu,$idNotView)) { ?>
                <td class="level">
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/down_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod3; ?>" title="-1" class="btn btn-mini"><i class="icon-minus"></i></a>
                    <?php echo $queryVivod[$i3]['level']; ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod3; ?>" title="+1" class="btn btn-mini"><i class="icon-plus"></i></a>
                </td>
                <?php } ?>
                <td class="act">
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $idVivod3; ?>" title="Редактировать" class="btn btn-mini"><i class="icon-edit"></i></a>
                    <?php
                    if (isset($queryVivod[$i3]['show'])) {
                        $view=$init->show($queryVivod[$i3]['show']);
                    ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_show.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod3; ?>" title="<?php echo $view['title']; ?>" class="btn btn-mini<?php echo $view['btn']; ?>"><i class="icon-eye-<?php echo $view['class']; ?>"></i></a>
                    <?php } ?>
                    <?php if (key_exists($idmenu,$idCopy)&&$auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?id=<?php echo $idVivod3; ?>&idmenu=<?php echo $idCopy[$idmenu]; ?>" title="Копировать" class="btn btn-mini"><i class="icon-tags"></i></a>
                    <?php } ?>
                    <?php if ($auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/<?php echo $table; ?>/delete_<?php echo $table; ?>.php?id=<?php echo $idVivod3; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a>
                    <?php } ?>
                </td>
                </tr>
            <?php
                            for ($i4=0;$i4<count($queryVivod);++$i4) {
                                $idVivod4=$queryVivod[$i4]['id'];
                                if ($queryVivod[$i4]['parent']==$idVivod3) {
            ?>
            <tr>
                <td class="check"><label class="checkbox"><input type="checkbox" name="del[]" value="<?php echo $idVivod4; ?>" /></label></td>
                <td class="num"><?php echo $idVivod4; ?></td>
                <td class="name"><?php echo '<span  class="muted">'.$resName[$idVivod].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;<span  class="muted">'.$resName[$idVivod2].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;<span  class="muted">'.$resName[$idVivod3].'</span>&nbsp;<i class="icon-chevron-right"></i>&nbsp;'.$resName[$idVivod4]; ?></td>
                <?php if (!in_array($idmenu,$idNotView)) { ?>
                <td class="level">
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/down_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod4; ?>" title="-1" class="btn btn-mini"><i class="icon-minus"></i></a>
                    <?php echo $queryVivod[$i4]['level']; ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_level.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod4; ?>" title="+1" class="btn btn-mini"><i class="icon-plus"></i></a>
                </td>
                <?php } ?>
                <td class="act">
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $idVivod4; ?>" title="Редактировать" class="btn btn-mini"><i class="icon-edit"></i></a>
                    <?php
                    if (isset($queryVivod[$i4]['show'])) {
                        $view=$init->show($queryVivod[$i4]['show']);
                    ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/ls/up_show.php?tab=<?php echo $table; ?>&id=<?php echo $idVivod4; ?>" title="<?php echo $view['title']; ?>" class="btn btn-mini<?php echo $view['btn']; ?>"><i class="icon-eye-<?php echo $view['class']; ?>"></i></a>
                    <?php } ?>
                    <?php if (key_exists($idmenu,$idCopy)&&$auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?id=<?php echo $idVivod4; ?>&idmenu=<?php echo $idCopy[$idmenu]; ?>" title="Копировать" class="btn btn-mini"><i class="icon-tags"></i></a>
                    <?php } ?>
                    <?php if ($auth->checkRight(0,1)) { ?>
                    <a href="<?php echo $init->_ADMIN_; ?>/performing/<?php echo $table; ?>/delete_<?php echo $table; ?>.php?id=<?php echo $idVivod4; ?>" title="Удалить" class="btn btn-mini"><i class="icon-trash"></i></a>
                    <?php } ?>
                </td>
                </tr>
            <?php
                                }
                            }
                            }
                        }
                        }
                    }
                }
            }
            ?>
            </tbody>
        <?php
        }
        ?>
        </table>