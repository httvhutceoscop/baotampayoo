<?php

include_once('SOAPCaller.php');
include_once('RequestType.php');
include_once('ResponseType.php');

class CallerServices
{	
	function CallerServices()
	{

	}
	function Call($APIName, $APIParam)
	{
		$Caller	= new SOAPCaller();
		$checksum = _ChecksumKey;
		
		//var_dump($APIParam);
		
		foreach($APIParam as $key => $value)
		{
			if(!empty($value))
			{
				$checksum.='|'. $value;
			}
		}
		//echo '<br>';
		//echo $checksum; 
		//die();
		
		//$APIParam->RequestData = $checksum;
		$APIParam->DigitalSignature = hash('sha512',$checksum);//sha1($checksum);//$this->sign->sign($APIParam->GetXml());	

		$response = $Caller->Call($APIName, $APIParam);

		$response = $this->GetResponseObject($APIName, $response->CallResult);
		//echo '<pre>';
		//echo print_r($response);
		//echo '</pre>';
		if($this->VerifyChecksum($response,$response->DigitalSignature)!= TRUE)
		{
			throw new Exception('Invalid checksum.');
			return;
		}
		return $response;	
	}
	
	function GetResponseObject($APIName, $stdObject)
	{
		$APIName = $APIName.'ResponseType';
		$return = new $APIName;
		$return->LoadData($stdObject);
		return $return;
	}
	
	function VerifyChecksum($DataResponse, $Checksum)
	{
		$strData = _ChecksumKey;
		unset($DataResponse->DigitalSignature);
		foreach($DataResponse as $key => $value)
		{
			if (is_object($value)) 
			{
				foreach($value as $k => $v) 
				{
					if(!empty($v))
						$strData .= '|' . (string)$v;
				}
			} 
			else 
			{
				if(!empty($value) || is_numeric($value))
				{
					$strData.='|'. (string)$value;
				}
			}			
		}
		if(strtoupper(hash('sha512',$strData))!= strtoupper($Checksum))
		{
			return FALSE;
		}
		return TRUE;
	}
}

?>