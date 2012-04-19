<?php
/*
Copyright (c) 2012 Aaron Shafovaloff

MIT License:

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

require_once "HTTP/Request2.php";

class ElasticSearch {
	protected $index = null;
	protected $type = null;
	protected $protocol = "http";
		
    public function __construct($options) {
    	$host = 'localhost';
		$port = '9200';
    	extract($options);
		
        $this->host = $host;
        $this->port = $port;
        $this->ch = curl_init();
    }
	
	public function setIndex($index) {
		$this->index = $index;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function search($options) {
		$index = $this->index;
		$type = $this->type;
		$query = '';
		$method = 'POST';
		extract($options);
		
		if(!empty($query) and is_array($query)) {
			$query = json_encode($query);
		} else if(substr($query,0,1) === '{'){
			
		} else if (is_string($query)){
			$query = json_encode(array(
				'query' => array(
					'query_string' => array(
						'query' => $query
					)
				)
			));
		}
		return $this->request(array($this->stringifyList($index),$this->stringifyList($type),'_search'),$method,$query);
	}
	
	private function stringifyList($list) {
		if(is_array($list)) {
			$list = implode(',', array_filter($list));
		}
		return $list;
	}

	//http://pear.php.net/manual/en/package.http.http-request2.php
    public function request($url = '/', $method="GET", $payload=false) {
    	if(is_array($url)) {
    		$url = "/" . implode("/", array_filter($url));
    	}
        $method = strtoupper($method);

    	$request = new HTTP_Request2($this->protocol . "://" . $this->host . ':' . $this->port . $url);
		$request->setMethod($method);
		
		if($method === 'POST') {
			if(!empty($payload) ) {
				if(is_array($payload)) {
					$payload = json_encode($payload);
				}
				$request->setBody($payload);
			}
		}
		
		try {
		    $response = $request->send();
			$body = $response->getBody();
		    if (200 == $response->getStatus()) {
				// ...
		    } else {
		        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' . $response->getReasonPhrase() . '<br/>';
		    }
		} catch (HTTP_Request2_Exception $e) {
		    echo 'Error: ' . $e->getMessage();
		}
		
        return $body;
    }
}
