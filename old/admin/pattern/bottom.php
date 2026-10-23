<?php $init->dbc->cc(); ?>
<script type="text/javascript">
$(document).ready(function() {
setTimeout(function() {$("#errors-show").animate({opacity: 0},1000);}, 3000);
});
</script>
<?php
if (in_array($idmenu,$ckeEditor)) {
?>
<script>
CKEDITOR.replace('text');
CKEDITOR.config.protectedSource.push(/<(span)[^>]*>.*<\/span>/ig);
CKEDITOR.config.protectedSource.push(/<(script)[^>]*>.*<\/script>/ig);
</script>
<?php
}
?>
  </div>
</div>
</body>
</html>