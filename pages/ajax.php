<?
/* 
	ajax.php
	this file is polled to feed incoming call data to the dashboard
	return call data as a json array
*/

$intelCalls = (array) PluginStore::get('IntelCalls', array());  

$toShow =  isset($_REQUEST['toShow'])? $_REQUEST['toShow'] : '';

if ($toShow==""){
	// return all calls
	$toReturn = $intelCalls;
} else {
	// return all calls more recent than the specified time
	$toReturn = array();
	foreach ($intelCalls as $call) {
		if ($call->time > $toShow){
			array_push($toReturn,$call);
		}
	}
}

//header('Content-type: application/json');
?>

<?= json_encode($toReturn); ?>