<? $call = json_decode(stripslashes($_REQUEST['call']), true); ?>

<?
/*
	connect to an external database or web service and perform your own lookup here 
	associative array $call contains  data about the incoming call
	$call["caller"] is their telephone number
	You can key lookups  by "caller", the incoming phone number, or any of the following:
	called caller city date lat lon sid state time
*/
	
	//real call data
	$city = $call["city"];
	$number = $call["caller"];
	//fake some data that we should have looked up from an external system
	$first = array("Joe", "Jane", "Debby", "Kyle", "Sugih");
	$last = array("Sample", "Example", "Doe", "Smith", "Hollingsworth");
	$notes = array("Long time customer", "Enjoys long walks on the beach", "Executive VP of Faxing", "Allergic to peanuts", "Decision maker");
	$first_rand = array_rand($first, 1);
	$last_rand = array_rand($last, 1);
	$notes_rand = array_rand($notes, 1);
?>

<div class="gradient-box"  style="position:relative;"><h1>Customer Profile</h1>
<table>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><?= $first[$first_rand] ?> <?= $last[$last_rand] ?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?= $first[$first_rand] ?>@gmail.com</td>
	</tr>
	<tr>
		<td>Phone:</td>
		<td>(<?= substr($number,0,3) ?>) <?= substr($number,3,3) ?>-<?= substr($number,6,4) ?></td>
	</tr>
	<tr>
		<td>City:</td>
		<td><?= $city ?></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
<table>
	<tr>
		<td>Average Order:</td>
		<td>$<?= rand(100,10000)?></td>
	</tr>
	<tr>
		<td>Last Purchase:</td>
		<td><?= rand(1,12)?>/<?= rand(1,29)?>/2010</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
Notes:<br/><?= $notes[$notes_rand] ?>
</div>