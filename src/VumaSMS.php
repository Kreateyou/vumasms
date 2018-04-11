<?php 
namespace Vumasms;
use Vumasms\Lib\Helper; 
use Vumasms\Lib\VumaApi;


class VumaSMS extends VumaApi{
  

  use Helper;

  public function __construct($key,$secret){
  	parent::__construct($key,$secret);
  }

  public function withFile($filePath='')
  {
  	if(file_exists($filePath)){
           $this->data['file_contents'] = "@$filePath";
  	 }else{
  	 	throw new VumaException("Error Processing Request", 1);
  	 	
  	 }
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
           $this->data['file_contents'] = "@$filePath";
  	 }else{
  	 	throw new VumaException("Error Processing Request", 1);
  	 	
  	 }
  	 return $this;
  }
  public function send($messageBags="")
  {
  	if(!is_null($messageBags)){
       $this->data['payload'] = $messageBags;
       return post_to_url("sms/send");
  	}else{
  	   return post_to_url("sms/file");
  	}
  	
  }
  public function balance($config)
  {
  	return post_to_url("account/balance");
  }
  public function importContact($contacts=[],$group="")
  {
  	$this->data['group'] = $group;
  	if(empty($contacts){
        $this->data['contacts'] = $contacts;	  	
	  	return post_to_url("contact/import");
     }else{
     	return post_to_url("contact/import/file");
     }
  }
}