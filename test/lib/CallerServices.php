<?php

include_once('SOAPCaller.php');
include_once('RequestType.php');
include_once('ResponseType.php');

class CallerServices
{
	var $sign = NULL;
	
	function CallerServices()
	{
		$this->sign = new DigitalSignature();
		$this->sign->LoadPrivateKey(_PrivateKey);
		$this->sign->LoadPublicCertificate(_PublicCertificate);
		$this->sign->SetTempDir(_TempDirectory);
	}
	function Call($APIName, $APIParam)
	{
		$Caller	= new SOAPCaller();
		//echo '<pre>';
		//print_r($APIParam->GetXml());
		
		$APIParam->DigitalSignature = $this->sign->sign($APIParam->GetXml());		
		$response = $Caller->Call($APIName, $APIParam);
		//return $response;
		$response = $this->GetResponseObject($APIName, $response->CallResult);
		return $response;
		if($this->VerifySignature($response->GetXml(),$response->DigitalSignature)!= TRUE)
		{
			throw new Exception('Division by zero.');
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
	
	function FormatDigitalSignature($DigitalSignature)
	{
		if (strlen($DigitalSignature) <= 0)
		{
			return;
		}
		else
		{
			$str = '';
			$n= ceil(strlen($DigitalSignature)/64);
			for($j=1; $j<=$n; $j++)
			{
				$str = $str.substr($DigitalSignature, ($j-1)*64, 64).chr(10);
			}
		}
		return $str;
	}
	
	function VerifySignature($signedData, $DigitalSignature)
	{
		$this->sign->SetPartnerPubCertPath(_PayooPublicCertificate);
		if($this->sign->Verify($signedData,$this->FormatDigitalSignature($DigitalSignature))!=1)
		{
			return FALSE;
		}
		return TRUE;
	}
}

?>