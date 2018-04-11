
<?php
namespace Vumasms\Lib; 

class VumaApi{
	protected $data = [];
	protected $key;
	protected $secret;

	public function __construct($key,$secret)
	{
	  $this->key = $key;
	  $this->secret = $secret;
	}

}