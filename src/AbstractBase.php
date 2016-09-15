<?php namespace Crazymeeks\Countries;

abstract class AbstractBase{
	

	public function arrayCountries(){
		$file = file_get_contents("countries.json");
		return $file;
	}


	protected function response($data){
		header("Content-Type: application/json");

		return json_encode($data);
	}

}