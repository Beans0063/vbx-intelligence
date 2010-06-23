<?
/*
	Dashboard for vbx-intelligence
	display a list of calls
	poll the ajax file for new calls
	when a call is clicked, pass the call data to each widget and display
*/

include_once('plugins/vbx-intelligence/applets/vbx-intelligence/widgets.php');
OpenVBX::addJS('pages/intel_js.php');

$intelCalls = (array) PluginStore::get('IntelCalls', array());  

// hack to handle ajax requests
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
<!-- maps library -->
<script charset="UTF-8" type="text/javascript" src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.2&mkt=en-us"></script>

<div class="vbx-content-menu vbx-content-menu-top"> 
	<h2 class="vbx-content-heading">VBX-Intelligence Dashboard</h2> 
	<ul class="phone-numbers-menu vbx-menu-items-right"> </ul> 
</div>

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