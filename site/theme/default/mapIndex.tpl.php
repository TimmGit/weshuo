<?php subView("header")?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php load('js/jquery.timers-1.2.js')?>
<?php load('js/jquery.cookie.js')?>
<div style="clear:both"></div>
<div id="map" style="width: 1000px; height: 500px;margin:0 auto"></div>
<script type="text/javascript">
  var geocoder;
  var map;
  var oldinfo=null;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(34.016, 103.535);
    var myOptions = {
      zoom: 6,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
   codeAddress('<?php echo $newTopic['address']?>',showMapBlog('ws_60_<?php echo $newTopic['icon']?>','<?php echo $newTopic['nickName']?>','<?php echo $newTopic['time']?>','<?php echo siteUrl("show/".$newTopic["topicId"])?>','<?php echo $newTopic['title']?>','<?php echo $newTopic['address']?>'));
  }
  function codeAddress(address,html) {
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location
        });
      var contentString = html;
      var infowindow = new google.maps.InfoWindow({ content: contentString });
        infowindow.open(map,marker);
        if(oldinfo!=null)
        {
            oldinfo.close();
        }
        oldinfo=infowindow;
      } else {
            return false;
      }
    });
  }
</script>
<script type="text/javascript">
$(function(){
	initialize();
	$.cookie('mapid',null);
	$('body').everyTime('10s',function(){
		showOnMap('<?php echo $newTopic['numTime']?>');
	});
});
function showOnMap(id)
{
	var showid=$.cookie('mapid');
	if(showid==null)
	{
		$.cookie('mapid',id);
		showid=id;
	}		
	$.ajax({
		   type: "POST",
		   url: "<?php echo siteUrl('map/last')?>",
		   data: "id="+showid,
		   dataType:'json',
		   success: function(msg){
				if(msg==0000)
				{
					return false;
				}
				else
				{
					var minfo=msg;
					var isshow=$.cookie('mapid');
					$.cookie('mapid',minfo.numTime);
                    codeAddress(minfo.address,showMapBlog(minfo.icon,minfo.userName,minfo.time,minfo.url,minfo.title,minfo.address));
				}
		   }
	});
}
</script>
<div class="clear"></div>
<?php subView("footer")?>