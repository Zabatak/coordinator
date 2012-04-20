

<a class="fullscreenmap_click" href="#">Full Screen</a>
<div id="map_canvas" style="width:100%; height:300px"></div>

<script type="text/javascript">
    var centerMap = new google.maps.LatLng(29.422853,30.665);
    //var stockholm = new google.maps.LatLng(59.32522, 18.07002);
    //var parliament = new google.maps.LatLng(59.327383, 18.06747);
    var marker;
    var map;
    var circle;
    

    function initialize() {
        var mapOptions = { zoom: 11,mapTypeId: google.maps.MapTypeId.ROADMAP,center: centerMap};
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
          
          
<?php foreach ($reporters as $reporter): ?>
                                        
            marker = new google.maps.Marker({map:map,title:'<?php echo $reporter->user->name ?>',draggable:true,animation: null ,position: <?php echo $reporter->lat != NULL ? "new google.maps.LatLng($reporter->lat,$reporter->lng)" : 'new google.maps.LatLng(29.422853,30.665)'; ?>});
            google.maps.event.addListener(marker, 'mouseout', function(event){
                $('#reporter_lat<?php echo $reporter->id ?>').val(event.latLng.lat());
                $('#reporter_lng<?php echo $reporter->id ?>').val(event.latLng.lng());    
            });
                    
            circle = new google.maps.Circle({map:map, radius: 2000, center:marker.position,strokeWeight:1,strokeOpacity:0.5, fillColor:'yellow'});
            marker.bindTo('position',circle,'center');
                    
            //
<?php endforeach; ?>
    } //end of initialize()

                    
    initialize();
    
    
   
$(document).ready(function() {
	var orig_width = $("#map_canvas").width();
	var orig_height = $("#map_canvas").height();
	
	currZoom = map.getZoom();
	currCenter = map.getCenter();
	
	$(".fullscreenmap_click").colorbox({
		width:"100%", 
		height:"100%", 
		inline:true, 
		href:"#map_canvas",
		// Resize Map DIV and Refresh
		onComplete:function(){
		    $("#map_canvas").width("99%");
			$("#map_canvas").height("99%");
			map.setCenter(currCenter, currZoom, false, false);
		},
		// Return DIV to original state
		onClosed:function(){
			$("#map_canvas").width(orig_width);
			$("#map_canvas").height(orig_height);
			$("#map_canvas").show();
			map.setCenter(currCenter, currZoom, false, false);
		}
	});
});
</script>
<?php

//var counts = array();
//print_r($counts);

?>
<form method="post">
    <table  border="1" width="60%" cellpadding="4">
        <tr>
            <th>Name (<?php echo count($reporters) ?> Reporters)</th>
			<th>Total #</th>
			<th>Accepted #</th>
			<th>Valid #</th>
            <th>Lat</th>
            <th>Lng</th>
        </tr>
        <?php foreach ($reporters as $reporter): ?>
            <tr>
                <td style="padding:4px 10px"><b>
                        <a href="http://zabatak.com/profile/user/<?php echo $reporter->user->username ?>" target="_blank" >
                            <?php echo $reporter->user->name ?> 
                        </a>
                    </b>
                </td>
				
				<td style="text-align: center"><?php echo array_key_exists($reporter->user_id,$counts)?$counts[$reporter->user_id]:0; ?></td>
				<td style="text-align: center"><?php echo array_key_exists($reporter->user_id,$accepted)?$accepted[$reporter->user_id]:0; ?></td>
				<td style="text-align: center"><?php echo array_key_exists($reporter->user_id,$verified)?$verified[$reporter->user_id]:0; ?></td>

                <td>
                    <input type="hidden" name="reporter[<?php echo $reporter->id ?>][user_id]" value="<?php echo $reporter->user->id ?>" />
                    <input type="text" value="<?php echo $reporter->lat ?>" id="reporter_lat<?php echo $reporter->id ?>" name="reporter[<?php echo $reporter->id ?>][lat]" readonly="readonly"></td>
                <td>
                    <input type="text" value="<?php echo $reporter->lng ?>" id="reporter_lng<?php echo $reporter->id ?>" name="reporter[<?php echo $reporter->id ?>][lng]" readonly="readonly"> 
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <input type="submit" >
</form>