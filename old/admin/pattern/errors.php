<?php
if (!is_null($error)) {
?>
<table class="table table-condensed" id="errors-show"><tbody>
<?php if($error==0) { ?><tr class="<?php echo $classError; ?>"><td><?php echo $error; ?></td></tr><?php } ?>
<!--<tr class="warning"><td>Предуприждение</td></tr>-->
</tbody></table>
<?php
}
?>