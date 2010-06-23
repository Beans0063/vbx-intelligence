<? 
error_reporting(0);
include_once('../applets/vbx-intelligence/widgets.php');
?>
var lastShownTime='';
var ajax_load = "<img src='../assets/i/ajax-loader-circle-4096EE.gif' alt='loading...' />";  
//	$("#result").html(ajax_load);
//	$("#result").html('');
/*
$.ajaxSetup({"error":function(XMLHttpRequest,textStatus, errorThrown) { 
	alert(errorThrown);

}});	*/

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