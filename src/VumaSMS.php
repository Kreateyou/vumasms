<?php 
namespace Vumasms;
use Vumasms\Lib\Helper; 
use Vumasms\Lib\VumaApi;
use Vumasms\Lib\VumaException;

class VumaSMS extends VumaApi{
  

  use Helper;

  public function __construct($key,$secret){
  	parent::__construct($key,$secret);
  }

  public function withFile($filePath='')
  {

  	if(file_exists($filePath)){
          $this->data['file_contents'][] = "$filePath";
  	 }else{
  	 	throw new VumaException("Error Processing Request", 1);
  	 	
  	 }
     return $this;
  }
  public function compose($template)
  {
  	$this->data['template'] = $template;
  }
  public function mapColumn($colMap)
  {
  	$this->data['col_map'] = $colMap;
  	return $this;
  }
  public function attachFile($filePath='')
  {
  	 if(file_exists($filePath)){
           $this->data['file_contents'][] = "$filePath";
  	 }else{
  	 	throw new VumaException("Error Processing Request", 1);
  	 	
  	 }
  	 return $this;
  }
  public function send($messageBags=null)
  {
  	if(!is_null($messageBags)){
      if(!isset($messageBags['scheduled_date'])){
 
         $messageBags['scheduled_date'] = null;
      }
      if(!isset($messageBags['scheduled_type'])){

        $messageBags['scheduled_type'] =null;
      }      
       $this->data['payload'] = json_encode($messageBags);
       return $this->post_to_url("send/sms");
  	}else{
  	   return $this->post_to_url("sms/send/file");
  	}
  	
  }
  public function balance($config)
  {
  	return $this->post_to_url("account/balance");
  }
  public function importContact($contacts=[],$group="")
  {
  	$this->data['group'] = $group;
  	if(empty($contacts)){
        $this->data['contacts'] = $contacts;	  	
	  	return $this->post_to_url("contact/import");
     }else{
     	return $this->post_to_url("contact/import/file");
     }
  }
}