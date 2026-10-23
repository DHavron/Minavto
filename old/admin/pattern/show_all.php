<?php
if (in_array($idmenu,$idCatFilter)) {require_once($init->_DIR_.'/admin/pattern/show_catalog_filters.php');}
if (in_array($idmenu,$idPotfolioFilter)) {require_once($init->_DIR_.'/admin/pattern/show_portfolio_filters.php');}
?>
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
            ?>
                <tr>
                <td class="check">&nbsp;</td>
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
            }
            ?>
            </tbody>
        <?php
        }
        ?>
        </table>