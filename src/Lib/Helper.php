<?php
namespace Vumasms\Lib; 

trait Helper{
    function post_to_url($url) {
        $files = array();
       if(isset($this->data['file_contents'])){    
            
            foreach ($this->data['file_contents'] as $f){
               $files[$f] = file_get_contents($f);
            }
            unset($this->data['file_contents']);
        }
        $boundary = uniqid();
        $delimiter = '-------------' . $boundary;
        $post_data = $this->build_data_files($boundary, $this->data, $files);

        $post = curl_init();
        $header = ['Authorization: Bearer '.$this->key,
                   "Content-Type: multipart/form-data; boundary=" . $delimiter,
                   "Content-Length: " . strlen($post_data)
                  ];
        
        curl_setopt($post, CURLOPT_URL, self::$baseUrl."$url");
        curl_setopt($post, CURLOPT_POST, strlen($post_data));
        curl_setopt($post, CURLOPT_POSTFIELDS,  $post_data);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($post, CURLOPT_HTTPHEADER, $header);



        $result = curl_exec($post);
        curl_close($post);
        return $result;
    }
    function build_data_files($boundary, $fields, $files){
        
        $data = '';
        $eol = "\r\n";

        $delimiter = '-------------' . $boundary;

        foreach ($fields as $name => $content) {
            $data .= "--" . $delimiter . $eol
                . 'Content-Disposition: form-data; name="' . $name . "\"".$eol.$eol
                . $content . $eol;
        }


        foreach ($files as $name => $content) {
            $data .= "--" . $delimiter . $eol
                . 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $name . '"' . $eol
                //. 'Content-Type: image/png'.$eol
                . 'Content-Transfer-Encoding: binary'.$eol
                ;

            $data .= $eol;
            $data .= $content . $eol;
        }
        $data .= "--" . $delimiter . "--".$eol;


        return $data;
    }

}