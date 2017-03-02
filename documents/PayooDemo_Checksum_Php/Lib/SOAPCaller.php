<?php
include_once('nusoap/nusoap.php');

class APICredential
{
    var $APIUsername;
    var $APIPassword;
    var $APISignature;
}

class SOAPCaller
{
	var $client = NULL;
	var $APICredential = NULL;
	function SOAPCaller()
	{
		$this->client = new nusoap_client(_BusinessAPIUrl, true);
		$err = $this->client->getError();
		if ($err) {
			throw new Exception($err);
		}
		$this->APICredential = new APICredential();
		$this->APICredential->APIUsername = _APIUsername;
		$this->APICredential->APIPassword = _APIPassword;
		$this->APICredential->APISignature = _APISignature;
	}

	function Call($APIName, $APIParam)
	{
		$properties = get_object_vars($this->APICredential);
		$header  = "<APICredential xmlns=\"BusinessAPI\">";
		foreach ($properties as $key => $value) {
			$header .= "<$key>$value</$key>";
		}
		$header .= "</APICredential>";
		$this->client->setHeaders($header);

		$_APIParam = '';
		$properties = get_object_vars($APIParam);
		foreach ($properties as $key => $val) {
			$_APIParam .= "<$key>$val</$key>";
		}
		//echo '<pre>';
		//echo print_r($header);
		//echo '</pre>';
		//echo '<pre>';
		//echo print_r($APIName);
		//echo '</pre>';
		//echo '<pre>';
		//echo print_r($_APIParam);
		//echo '</pre>';
		$result = $this->client->call('Call', array(array('APIName'=>$APIName, 'APIParam'=>$_APIParam)) );
		
		//echo '<pre>';
		//echo print_r($this->client);
		//echo '</pre>';
		//die();
		
		if ($this->client->fault) {
			$fault = $this->client->fault;
			throw new Exception('Code:'.$fault->faultcode.'; Actor:'.$fault->faultactor.'; String:'.$fault->faultstring.'; Detail:'.$fault->faultdetail);
		}
		$err = $this->client->getError();
		if ($err) {
			//print_r(array(array('APIName'=>$APIName, 'APIParam'=>$_APIParam)));
			throw new Exception($err);
		}

		$response = SOAPCaller::arrayToObjectDeep($result);
		return $response;
	}

	function arrayToObjectDeep($arr)
	{
		if (!is_array($arr)) {
			return;//throw new Exception('SOAPCaller.arrayToObjectDeep() requires an array as param');
		}
		$obj = new stdClass();
		foreach ($arr as $key => $value) {
			if (!is_numeric($key)) {
				if (is_array($value)){
					$obj->$key = SOAPCaller::arrayToObjectDeep($value);
				} else {
					$obj->$key = $value;
				}
			}
		}
		return $obj;
	}
}
?>