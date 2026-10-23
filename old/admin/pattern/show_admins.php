        <table class="table global table-condensed table-bordered">
            <thead>
                <th class="check">&nbsp;</th>
                <th class="num">#</th>
                <th class="name">Логин</th>
                <th class="level">E-mail</th>
                <th class="level">Доступ</th>
                <th class="act">Действия</th>
            </thead>
        <?php
        $queryVivod=$init->dbc->select('`'.$table.'`',array(),$where,"`id` DESC");
        $rights=array();
        foreach ($init->dbc->select('`admin_right`',array('`id`','`name_'.$init->lang.'`'),'`id`>0') as $adminRight) {
            $rights[$adminRight['id']]=$adminRight['name_'.$init->lang];
        }
        if (count($queryVivod)>0) {
        ?>
            <tbody>
            <?php
            for ($i=0;$i<count($queryVivod);++$i) {
                $idVivod=$queryVivod[$i]['id'];
            ?>
                <tr>
                <td class="check">&nbsp;</td>
                <td class="num"><?php echo $idVivod; ?></td>
                <td class="name"><?php echo $queryVivod[$i]['login']; ?></td>
                <td class="level"><?php echo $queryVivod[$i]['email']; ?></td>
                <td class="level"><?php echo $rights[$queryVivod[$i]['id_right']]; ?></td>
                <td class="act">
                    <a href="<?php echo $init->_ADMIN_.'/'.$to_url; ?>.php?idmenu=<?php echo $edit; ?>&id=<?php echo $idVivod; ?>" title="Редактировать" class="btn btn-mini"><i class="icon-edit"></i></a>
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