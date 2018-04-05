<?php

namespace Crazymeeks;

use Ixudra\Curl\CurlService;

class Country
{

	const ENDPOINT = 'https://restcountries.eu/rest/v2';

	/**
	 * Determine whether the data will be returned as json
	 * @var boolean
	 */
	protected $toJson = false;

	/**
	 * The country rest api endpoint
	 * @var string
	 */
	protected $endpoint;

	/**
	 * Curl
	 * 
	 * @var \Ixudra\Curl\CurlService
	 */
	protected $curlservice;

	/**
	 * Constructor
	 * 
	 * @param string $endpoint        The country rest api endpoint
	 */
	public function __construct($endpoint = null)
	{
		$this->setEndpoint($endpoint);

		$this->curlservice = new CurlService();
	}

	/**
	 * Find country by name
	 * 
	 * @param  string $name     The country name
	 * 
	 * @return \Ixudra\Curl\CurlService
	 */
	public function name($name)
	{
		return $this->to("name/$name");
	}

	/**
	 * Find country by its code
	 *
	 * @param  string $code         The 1-2 or 3 letters country code
	 * 
	 * @return \Ixudra\Curl\CurlService
	 */
	public function code($code)
	{

		if ( is_array($code) ) {
			$code = implode(';', $code);

			$endpoint = "alpha?codes=$code";
		} else {
			
			$endpoint = "alpha/$code";
		}

		return $this->to($endpoint);
	}

	/**
	 * Get all countries
	 * 
	 * @return json
	 */
	public function all()
	{
		return $this->to('all')->get();
	}

	/**
	 * Get countries in a particular region
	 *
	 * @param  string $region             The region name. europe
	 * 
	 * @return \Ixudra\Curl\CurlService
	 */
	public function inRegion($region)
	{
		return $this->to("region/$region");
	}

	/**
	 * An alias to \Ixudra\Curl\CurlService::to()
	 * 
	 * @param  string $resource
	 * 
	 * @return \Ixudra\Curl\CurlService
	 */
	protected function to($resource)
	{
		$resource = $this->getEndpoint() . "/$resource";

		return $this->curlservice->to($resource)->asJson();
	}

	/**
	 * An alias for all()
	 * 
	 * @return json
	 */
	public function get()
	{
		return $this->all();
	}

	/**
	 * Determine whether the data will be returned as json
	 * 
	 * @return $this
	 */
	public function toJson()
	{
		$this->toJson = true;

		return $this;
	}


	/**
	 * Set country rest api endpoint
	 * 
	 * @param string $endpoint       The country rest api endpoint
	 *
	 * @return  void
	 */
	public function setEndpoint($endpoint = null)
	{
		$this->endpoint = $endpoint ? $endpoint : static::ENDPOINT;
	}

	/**
	 * Get country rest api endpoint
	 * 
	 * @return string
	 */
	public function getEndpoint() : string
	{
		return rtrim($this->endpoint, '/');
	}
}