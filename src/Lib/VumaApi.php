<?php
namespace Vumasms\Lib; 

class VumaApi{
	protected $data = [];
	protected $key;
	protected $secret;
	// static $baseUrl = "http://localhost:8000/api/";
	static $baseUrl = "https://www.vumasms.com/api/";

	public function __construct($key,$secret)
	{
	  $this->key = $key;
	  $this->secret = $secret;
	}

}