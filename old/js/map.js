 function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?v=3.9&sensor=true&language="+$("html").attr("lang")+"&callback=initialize";
  document.body.appendChild(script);
}
function initialize() {
    document.getElementById("map").style.display="block";
    var mPos=new google.maps.LatLng(54.186112, 27.831884);
    var myOptions = {
      zoom: 12,
      scrollwheel: false,
      center: mPos,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      sensor: 'true'
    }
    var map = new google.maps.Map(document.getElementById("map"), myOptions);
    var image='http://minavto.by/imgcss/location.png';
    var marker = new google.maps.Marker({
        position: mPos,
        map: map,
        icon: image,
        title: '«Minavto»'
    });
    google.maps.event.addListener(marker, "click", function(e) {
      var infoBox = new InfoBox({latlng: marker.getPosition(), map: map});
    });
    google.maps.event.trigger(marker, "click");
  }
window.onload=loadScript;