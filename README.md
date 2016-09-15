# countries
# Package for the list of countries
# Data credits to https://restcountries.eu/

#Usage

#Use this code in your php file
use Crazymeeks\Countries\Countries;

// Find countries by name
// work like sql 'LIKE' query
$country = Countries::find('Afghanistan');

// Get all countries
$countries = Countries::all();


echo $country;