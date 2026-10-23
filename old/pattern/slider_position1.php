<?php
$slider->initialSlider(1);
if ($slider->show) {
?>
<script type="text/javascript">
var now=0;
var imgpreload=new Array();
<?php
for($i=0;$i<count($slider->slides);++$i)
{
?>
	imgpreload[<?php echo $i; ?>]=new Image();
	imgpreload[<?php echo $i; ?>].src="<?php echo $slider->slides[$i]['img']; ?>";
    imgpreload[<?php echo $i; ?>].name="<?php echo $slider->slides[$i]['name']; ?>";
<?php } ?>
</script>
<div id="slider">
    <div id="slide">
        <div id="image-slide"><img src="<?php echo $slider->slides[0]['img']; ?>" alt="<?php echo $slider->slides[0]['name']; ?>" title="<?php echo $slider->slides[0]['name']; ?>" /></div>
        <div id="slide-text"><div id="text-for-slide">
            <?php echo $slider->slides[0]['text']; ?>
        </div></div>
    </div>
    <a id="prev"></a>
    <a id="next"></a>
</div>
<script type="text/javascript" src="<?php echo $this->_SITE_; ?>/js/slider.js"></script>
<?php
}
?>