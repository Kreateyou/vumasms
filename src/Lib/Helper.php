<?php
namespace Vumasms\Lib; 

trait Helper{
    function post_to_url($url) {
        
        $fields = http_build_query($this->data);    

        $post = curl_init();

        curl_setopt($post, CURLOPT_URL, self::$baseUrl."/$url");
        curl_setopt($post, CURLOPT_POST, count($this->data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($post);

        curl_close($post);
        return $result;
    }

}