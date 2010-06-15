<?
/*
	Dashboard for vbx-intelligence
	display a list of calls
	poll the ajax file for new calls
	when a call is clicked, pass the call data to each widget and display
*/

<script type="text/javascript" src="<?php echo base_url() ?>/assets/j/frameworks/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/assets/j/plugins/jquery.validate.js"></script>

include_once('plugins/vbx-intelligence/applets/vbx-intelligence/widgets.php');
$intelCalls = (array) PluginStore::get('IntelCalls', array());  

// hack to handle ajax requests - may need to patch vbx 
if(!empty($_REQUEST['ajax'])) {
   include_once('ajax.php');
   exit;
}

if(!empty($_REQUEST['clearData'])) {
	$temp = PluginStore::set('IntelCalls', array());  //clear  data
	echo("<script>document.location.href='vbx-intelligence-dashboard';</script>");
	exit;
}

?>
<script charset="UTF-8" type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.2&mkt=en-us"></script>

<script>
	var lastShownTime='';
    var ajax_load = "<img src='../assets/i/ajax-loader-circle-4096EE.gif' alt='loading...' />";  
//	$("#result").html(ajax_load);
//	$("#result").html('');
	
	function getCalls(){
		var jsonUrl = 'vbx-intelligence-dashboard?ajax=1&toShow=' + lastShownTime;
		$.getJSON(jsonUrl, {}, 
			function(json, textStatus) {
				$.each(json, function(index, value) { 
					if (value.time > lastShownTime)
						lastShownTime=value.time;
						var a = $('<li class="callClass" style="display:none;" id="i' + value.sid + '"><a href="">' + formatPhpDate(value.date) + ' ' + formatPhone(value.caller) + '</a></li>');
						a.click(function(e) {
							e.preventDefault(); // this will disallow clickthrough on the a link
							showCall(value);
						});
						$("#callDiv").prepend(a);
						$("#i" + value.sid).fadeIn();
						if (index==json.length-1) {
							a.click();
							$("#i" + value.sid).css("border","2px solid red");
						}
					});
			});
			setTimeout ( getCalls, 3000 );
		}
	function showCall(data){
        $("#intelMain").hide(); <?# clear old contents ?>
        $("#intelMain").html(''); <?# clear old contents ?>
		<? 
		for($i = 0; $i < count($intelItems); $i++) { 
			?>
			$.get('../plugins/vbx-intelligence/pages/<?= $intelItems[$i] ?>.php', "call=" + JSON.stringify(data), function(dataz) { $('#intelMain').append( $(dataz) ); },'html');
		<? } ?>
		<?  foreach ($intelItems as $itemItem) { ?> <?# ajax in the content of each intel page, passing all intel data as json ?>
//			$.get('../plugins/vbx-intelligence/pages/<?= $itemItem ?>.php', "call=" + JSON.stringify(data), function(dataz) { $('#intelMain').append( $(dataz) ); },'html');
		<?  } ?>
		$(".callClass").css("border","0px");
		$("#i" + data.sid).css("border","2px solid red");
		$("#intelMain").fadeIn();
	}
	function formatPhpDate(inDate){
		var out = inDate.mon + '/' + inDate.mday + ' ' + inDate.hours + ':';		
		if (inDate.minutes < 10)
			out = out + '0';
		out = out + inDate.minutes;
		return out
	}
	function formatPhone(num){
		var out = '(' + num.substring(0,3) + ') ' + num.substring(3,6) + '-' + num.substring(6,10);
		return out
	}
   getCalls();
</script>
<div class="vbx-content-menu vbx-content-menu-top"> 
	<h2 class="vbx-content-heading">VBX-Intelligence Dashboard</h2> 
	<ul class="phone-numbers-menu vbx-menu-items-right"> 
		<!--<li class="menu-item"><button class="add-button add number"><span>Next</span></button></li> -->
	</ul> 
</div><!-- .vbx-content-menu --> 


<div class="vbx-table-section"> 
	<div style="padding:10px;">
		<div class="gradient-box">
			Calls:<div id="callDiv"></div>
		</div>
		<div id="intelMain"><? if (count($intelCalls)==0) echo("Awaiting incoming calls.  Add VBX-Intelligence to a call flow to display call information.");?></div>
	</div>
</div>
<a href="javascript:if(confirm('Are you sure you want to clear your existing call list?')) document.location.href='vbx-intelligence-dashboard?clearData=1';" style="color:white; ">clear call data</a>

<style>
.gradient-box {
	float:left;
			background-color:#000;
			background-image:-webkit-gradient(linear, 0% 1%, 0% 95%, from(rgba(255,255,255,0.9)), to(rgba(64,64,64,0.9)), color-stop(.8,rgba(64,64,64,0.25)),color-stop(.25,rgba(32,32,32,0.5)));
			background-image:-moz-linear-gradient(top, bottom,from(rgba(255,255,255,0.9)),color-stop(80%, rgba(64,64,64,0.25)),color-stop(25%, rgba(32,32,32,0.5)),to(rgba(64,64,64,0.9)));
			border:3px solid #000;
			padding:1em;
			-moz-border-radius:10px;
			-webkit-border-radius:10px;
			-opera-border-radius:10px;
			-khtml-border-radius:10px;
			border-radius:10px;
			color:white;
			margin-right:20px;
			margin-bottom:20px;
		}
#callDiv {margin-top:8px; line-height:1.5em; }
#callDiv li a {color:white; font-size:15px; text-decoration:none;}
#callDiv li a:hover {text-decoration:underline;}
</style>