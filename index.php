<?php
require_once("vendor/autoload.php");

use Crazymeeks\Countries\Countries;

/******************************
 *           Usage:           *
 *                            *
 ******************************/

// Find countries by name
// work like sql 'LIKE' query
$country = Countries::find('Afghanistan');

// Get all countries
//$countries = Countries::all();

echo "<pre>";
echo $country;