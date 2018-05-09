<?php
	try
{
	$mdb = new MongoDB\Driver\Manager("mongodb://sirasemambya:simba008@ds215370.mlab.com:15370/it635");
	$command = new MongoDB\Driver\Command(['ping' => 1]);
	$mdb->executeCommand('db', $command);
	$servers = $mdb->getServers();
	print_r($servers);
	$filter = array('name'=>'coachaccount');
	$query = new MongoDB\Driver\Query($filter);
	$results = $mdb->executeQuery("it635.coachaccount",$query);
	print_r($results->toArray());
}
catch(exception $e)
{
	print_r($e);
}
?>
