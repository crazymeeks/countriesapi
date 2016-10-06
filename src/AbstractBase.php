<?php namespace Crazymeeks\Countries;

abstract class AbstractBase{
	

	public function arrayCountries(){
		$file = file_get_contents(__DIR__ ."/../countries.json");
		return $file;
	}


	protected function response($data){
		header("Content-Type: application/json");

		return json_encode($data);
	}

}