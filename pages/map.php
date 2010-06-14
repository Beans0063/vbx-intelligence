<? $call = json_decode(stripslashes($_REQUEST['call']), true); ?>
<div class="gradient-box" style="position:relative; height:400px; width:400px;">
	<div id='myMap' style="position:absolute; width:400px; height:400px;"></div>
	<script>
		var map = new VEMap('myMap');
		var showctrl=false;
	//	map.SetDashboardSize('small');
		map.HideDashboard();
		map.LoadMap(new VELatLong(<?= $call["lat"] ?>, <?= $call["lon"] ?>, 0, VEAltitudeMode.RelativeToGround), 10, VEMapStyle.Road, false, VEMapMode.Mode2D, true, 1);
		var point = new VELatLong(<?= $call["lat"] ?>, <?= $call["lon"] ?>);
		var marker = new VEShape(VEShapeType.Pushpin, point);
//		var adicon = new VECustomIconSpecification();
//		adicon.Image = loc.pinurl;
//		adicon.ImageOffset = new VEPixel(-5,-6);

//		marker.SetCustomIcon(adicon);
		map.AddShape(marker);
		marker.SetTitle("<?=$call["city"]?>, <?=$call["state"]?>");
		<?php $thedate=(array)$call["date"]; ?>
		marker.SetDescription("<?= (string)$thedate["weekday"] ?> <?= (string)$thedate["month"] ?> <?= (string)$thedate["mday"] ?> <?= (string)$thedate["hours"] ?>:<?= (string)$thedate["minutes"] ?> <br/> <?=$call["caller"]?>");

		function toggleCtrl(){
			if (showctrl){
				map.HideDashboard();
				showctrl=false;
			} else {
				showctrl=true;
				map.ShowDashboard();
			}
		}
	</script>
	<div style="position:absolute; top:412px;padding:0; margin:0;"><a style="font-size:10px; color:white; " href="javascript:toggleCtrl();"><b>Toggle Map Controls</b></a></div>
</div>

