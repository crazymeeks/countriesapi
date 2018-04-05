<?php

namespace Tests\Unit;

use Tests\TestCase;
use Crazymeeks\Country;

class CountryTest extends TestCase
{


	protected $url = 'https://restcountries.eu/rest/v2';

	/**
	 * This will return a json encoded response
	 * 
	 * @test
	 */
	public function it_can_find_country_by_name()
	{
		$name = 'Philippines';

		$country = $this->country()
						->name($name)
						->get();

		$found = false;

		foreach($country as $c){

			if (strtolower($c->name) == strtolower($name)) {
				$found = true;
				break;
			}

		}
		
		$this->assertTrue($found);

	}

	/**
	 * Find country by its code
	 * 
	 * @test
	 */
	public function it_can_find_by_country_code()
	{
		$code = 'ph';

		$country = $this->country()
						->code($code)
						->get();
	
		$this->assertSame(strtoupper($code), $country->alpha2Code);
	}

	/**
	 * Find countries by its codes
	 * 
	 * @test
	 */
	public function it_can_find_country_by_codes()
	{
		$codes = array(
			'col', // columbia
			'no', // norway
			'ee', // estonia
		);

		$countries = $this->country()
						->code($codes)
						->asJson()
						->get();

		
		$this->assertCount(3, $countries);
	}

	/**
	 * Find country by region
	 * 
	 * @test
	 */
	public function it_can_find_country_by_region()
	{
		$region = 'europe';
		$countries = $this->country()
						  ->inRegion($region)
						  ->get();

		$region = ucfirst($region);

		foreach($countries as $country){

			$this->assertEquals($region, $country->region);

		}

	}

	/**
	 * Get all countries
	 * 
	 * @test
	 */
	public function it_can_get_all_countries()
	{
		$countries = $this->country()->all();

		$this->assertEquals(250, count($countries));
	}

	/**
	 * @return Crazymeeks\Country
	 */
	private function country()
	{
		return new Country();
	}

}