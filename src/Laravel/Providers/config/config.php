<?php

return [

  'api'=>[
  	'key'                  =>env("VUMA_API_KEY",""),
  	'secret'               =>env("VUMA_API_SECRET",""),
  ],
  'default_sender'         =>env('VUMASMS_DEFAULT_SENDERID',"VUMA"),
  'onReceivePayment'         =>env("VUMASMS_CALLBACK",""),

];