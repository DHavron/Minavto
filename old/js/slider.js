jQuery(document).ready(function() {
jQuery("div#slider").css("display","block");
var imgSlide=jQuery("div#image-slide>img");
var timer;
jQuery("a#prev").css("display","block");
jQuery("a#next").css("display","block");
function slider_auto_run() {
    timer=setTimeout(function() {
        now++;
        if (now>=imgpreload.length) now=0;
        if (imgSlide.css("opacity")!=0) {imgSlide.animate({opacity: 0},500,changeAttr(now));}
        imgSlide.animate({opacity: 1},500);
        clearTimeout(timer);
        slider_auto_run();
    }, 5000);
};
function changeAttr(ii){
    jQuery("div.podrobnee>a").attr("href",imgpreload[ii].url);
    setTimeout(function() {imgSlide.attr("src",imgpreload[ii].src);imgSlide.attr("alt",imgpreload[ii].name);imgSlide.attr("title",imgpreload[ii].name);},500);
    imgSlide.stop();
}
jQuery("a#prev").click(function(){
    imgSlide.stop();
    now--;
    if (now<0) now=imgpreload.length-1;
    if (imgSlide.css("opacity")!=0) {imgSlide.animate({opacity: 0},500,changeAttr(now));}
    imgSlide.animate({opacity: 1},500);
    clearTimeout(timer);
    slider_auto_run();
    }
);
jQuery("a#next").click(function(){
    imgSlide.stop();
    now++;
    if (now>=imgpreload.length) now=0;
    if (imgSlide.css("opacity")!=0) imgSlide.animate({opacity: 0},500,changeAttr(now));
    imgSlide.animate({opacity: 1},500);
    clearTimeout(timer);
    slider_auto_run();
    }
);
slider_auto_run();
});