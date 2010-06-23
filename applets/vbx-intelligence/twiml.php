<?php

/*
vbx-intelligence plugin - Framework for realtime display of contextual business intelligence
Customize with your own logic to display relevant information, presented in real time as the calls come in.
You will need to add vbx-intelligence to a call flow to allow it to begin collecting information.
vbx-intelligence will store the caller, called, city, state, time and geocode lat and lon for each incoming call
vbx-intelligence adds a dashboard to the open-vbx system.  Look for the "Intel Dashboard" link in the left nav.
Open the dashboard to view a realtime stream of incoming calls
For each call, you can customize a series of widgets.
Defaultly, a map widget is included, as well as a demo customer information widget, and a simple wikipedia lookup by city name.
You can easily customize these widgets to provide the intelligence you need.

Customization instructions:
1) Define your widget list.  Edit the file at ./items.php
2) Implement your custom view - create a file in ../pages/widgetname.php
    Add this code to your page to access call data: <? $call = json_decode(stripslashes($_REQUEST['call']), true); ?>
   See ../pages/custom_example.php for further instructions
*/


// Gather Twilio Call Url Properties
$city =  isset($_REQUEST['CallerCity'])? $_REQUEST['CallerCity'] : '';
$state =  isset($_REQUEST['CallerState'])? $_REQUEST['CallerState'] : '';
$caller =  isset($_REQUEST['Caller'])? $_REQUEST['Caller'] : '';
$called =  isset($_REQUEST['Called'])? $_REQUEST['Called'] : '';
$CallGuid = isset($_REQUEST['CallGuid'])? $_REQUEST['CallGuid'] : '';
$lat="";
$lon="";
$err="";

try{
	// Geocode the city and state
	$sAddress = $city . "%20" . $state;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://api.local.yahoo.com/MapsService/V1/geocode?appid=mapbuilder.net&location=$sAddress");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$sResponse = curl_exec($ch);

	$xml = new SimpleXMLElement($sResponse);
	if ($xml->Result[0]!=null){
		$lat = $xml->Result[0]->Latitude;
		$lon =  $xml->Result[0]->Longitude;
	}
} 	catch(Exception $e) {
	$err = $err . " $e";
}



// Create an associative array of incoming call properties
$callInfo = array();
$callInfo[ "city" ] = $city;
$callInfo[ "state" ] = $state;
$callInfo[ "caller" ] = $caller;
$callInfo[ "called" ] = $called;
$callInfo[ "sid" ] = $CallGuid;
$callInfo[ "lat" ] = (string)$lat;
$callInfo[ "lon" ] = (string)$lon;
$callInfo[ "time" ] =  time();
$callInfo[ "date" ] =  getdate();
$callInfo[ "err" ] =  $err;

// append our array of call props to to a plugin-managed variable
$intelCalls = PluginStore::get('IntelCalls', array());  // get our array of calls or default to new array if undefined
array_push($intelCalls, $callInfo);
PluginStore::set('IntelCalls', $intelCalls);  

// respond with nothing 
$response = new Response();
$response->addRedirect( AppletInstance::getDropZoneUrl('next'));
$response->Respond();
?>
