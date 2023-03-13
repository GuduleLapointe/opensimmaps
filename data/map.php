<?php
/**
 * map.php for use with Flexible Helper Scripts or w4os.
 */

# For use with Flexible Helpers script, adjust to actual config files location
require_once("../config.php");
require_once("../class-mysql.php");
// require_once("../../helpers/config/config.php");
// require_once("../../helpers/opensim.phplib/mysql.func.php");

//Creates XML string and XML document using the DOM
$dom = new DomDocument('1.0', "UTF-8");
$map = $dom->appendChild($dom->createElement('Map'));

$DbLink = new DB(OPENSIM_DB_HOST, OPENSIM_DB_NAME, OPENSIM_DB_USER, OPENSIM_DB_PASS );
$DbLink->query("SELECT uuid,regionName,locX,locY,sizeX,sizeY FROM regions");

while(list($UUID,$regionName,$locX,$locY,$dbsizeX,$dbsizeY) = $DbLink->next_record())
{
	$grid = $map->appendChild($dom->createElement('Grid'));

	$uuid = $grid->appendChild($dom->createElement('Uuid'));
	$uuid->appendChild($dom->createTextNode($UUID));

	$region = $grid->appendChild($dom->createElement('RegionName'));
	$region->appendChild($dom->createTextNode($regionName));

	$locationX = $grid->appendChild($dom->createElement('LocX'));
	$locationX->appendChild($dom->createTextNode($locX/256));

	$locationY = $grid->appendChild($dom->createElement('LocY'));
	$locationY->appendChild($dom->createTextNode($locY/256));

	$sizeX = $grid->appendChild($dom->createElement('SizeX'));
	$sizeX->appendChild($dom->createTextNode($dbsizeX));

	$sizeY = $grid->appendChild($dom->createElement('SizeY'));
	$sizeY->appendChild($dom->createTextNode($dbsizeY));
}

$dom->formatOutput = true; // set the formatOutput attribute of domDocument to true

$test1 = $dom->saveXML(); // save XML as string or file

header("Content-type: text/xml");
echo $test1;
