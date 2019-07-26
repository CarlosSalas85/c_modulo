<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function setJson($url){
	$url = $url; 
	error_reporting(0);
	$url = $url;
	$json = file_get_contents($url, true);
	$json = json_decode($json,true); 
	return $json;
}

function setCurl($url,$metodo, $data){
	$ch = curl_init($url);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: master"));
	$response = curl_exec($ch);
	curl_close($ch);
	if(!$response) {
		return false;
	}else{
		return $response;
	}
} 

?>
