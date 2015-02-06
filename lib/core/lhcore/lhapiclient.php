<?php

/**
 * Simple client class for consuming  Apps REST API
 *
 */

class ApiClient
{
    
    public static function setSystemInstall() {
        
        try {
            $service_url = 'http://eventizer.org/api/setinstall';
           
            $curl = curl_init($service_url);
            $curl_post_data =  $_SERVER;
        
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
            $curl_response = curl_exec($curl);
        
            curl_close($curl);
        
            $decoded = json_decode($curl_response);
       
            $status = $decoded->status;
            
            return $status; 
        } catch (Exception $e){}     
    }
    
    public static function getSystemRelease() {
        
        try {
            $service_url = 'http://eventizer.org/api/release';
           
            $curl = curl_init($service_url);
            $curl_post_data =  $_SERVER;
        
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            $curl_response = curl_exec($curl);
        
            curl_close($curl);
        
            $decoded = json_decode($curl_response);
            
            return $decoded; 
        } catch (Exception $e){}     
    }
    

    public static function executeRequest($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Some hostings produces wargning...
        $content = curl_exec($ch);
        
        return $content;
    }
}