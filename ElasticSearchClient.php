<?php
require_once "HTTP/Request2.php";

class ElasticSearch {	
    public function __construct($host='localhost', $port=9200) {
        $this->host = $host;
        $this->port = $port;
        $this->ch = curl_init();
    }
	
	public function search($options) {
		//index
		//types
				
	}
	
	public function createIndex() {
		
	}

	//http://pear.php.net/manual/en/package.http.http-request2.php
    public function request($url, $method="GET", $payload=false) {
        $method = strtoupper($method);
        $protocol = "http";
        $requestURL = $protocol . "://" . $this->host . ':' . $this->port . $url;
			
    	$request = new HTTP_Request2($requestURL);
		$request->setMethod($method);
		
		if($method === 'POST') {
			if(!empty($payload) ) {
				if(is_array($payload)) {
					$payload = json_encode($payload);
				}
			}
			$request->setBody($payload);
		}
		
		try {
		    $response = $request->send();
		    if (200 == $response->getStatus()) {
		        $body = $response->getBody();
		    } else {
		        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
		             $response->getReasonPhrase() . '<br/>';
				echo $response->getBody();
		    }
		} catch (HTTP_Request2_Exception $e) {
		    echo 'Error: ' . $e->getMessage();
		}
		
        return $body;
    }
}
