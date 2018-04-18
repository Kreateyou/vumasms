<?php
namespace Vumasms\Laravel\Controllers;
use Illuminate\Http\Request;
/**
* 
*/
class Callback 
{
	
	public function act(Request $request)
	{
		$message = $request->getContent();
		$Callback = config("vumasms.onReceiveMessage");
		if(isJson($message)){
			if(is_callable($Callback)){
				$return = call_user_func_array($Callback,[json_decode($message),$request->all()]);
				
			}
		}
		return ['success'=>true,'message'=>null];
	}
}