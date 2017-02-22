<?php namespace Crazymeeks\Countries;

use Crazymeeks\Countries\AbstractBase as Base;
class Countries extends Base{
	
	protected $results = array();

	protected $countries;

	protected $lists;

	public function __construct(){

		$this->lists = json_decode($this->arrayCountries());
		
	}
	

	public static function find($country = null){
		$instance = new static();
		if(!is_null($country) && !empty($country)){
			foreach($instance->lists as $key => $object){
				// search ?
				if($instance->search($country)){
					return $instance->response($instance->results);
				}
			}	
		}
		return $instance->response($instance->lists);
	}

	/**
	 * Get all countries
	 * @return json
	 */
	public static function all($name = null){
		$instance = new static();
		
		return $instance->response($instance->lists);
	}

	/**
	 * Search country/ies from the list
	 * Execute search like sql LIKE operator
	 *
	 * @param string $country
	 * @return array(json encoded)
	 */
	protected function search($country){
		
		if(!is_null($country) && !empty($country)){
				foreach($this->lists as $value){
					if(stripos($value->name, $country) !== FALSE){
						$this->results[] = $value;
					}
				}
				
				//return $this->response((!empty($this->results)) ? $this->results : 'Country not found');
				return (!empty($this->results)) ? true : false;
			}
	}
}