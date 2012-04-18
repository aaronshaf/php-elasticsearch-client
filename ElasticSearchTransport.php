<?php
require_once "HTTP/Request2.php";
require_once "HTTPTransport.php";

if (!defined('CURL_OPERATION_TIMEDOUT'))
    define('CURL_OPERATION_TIMEDOUT', 28);

class ElasticSearchTransport extends HTTPTransport {	
    public function __construct($host='localhost', $port=9200) {
        parent::__construct($host,$port);
    }
	
	public function search($options) {
		//index
		//types
				
	}
	
	public function createIndex() {
		
	}
}
