<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayooSignature
 *
 * @author Long
 */
 include_once('Lib/Config.php');
class PayooSignature {
   
	var $prvKey = NULL;//Private key
	var $pubCert = NULL;//Public certificate
	var $partnerPubCertPath =  _PayooPublicCertificate;//'certificate/payoo_public_cert_sandbox.pem';//Partner public certificate
    var $tempDir = _TempDirectory; //'tempdir/';//Temporary directory, it is used for store temporary signed file.
	
    function LoadPrivateKey($prvKeyPath)
	{
		if($prvKeyPath===NULL || trim($prvKeyPath) == '')
		{
			return;
		}
		if (!file_exists($prvKeyPath))
		{
			return;
		}
		$this->prvKey = openssl_get_privatekey(file_get_contents($prvKeyPath));
	}
	
	function LoadPublicCertificate($pubCertPath)
	{
		if($pubCertPath===NULL || trim($pubCertPath) == '')
		{
			return;
		}
		if (!file_exists($pubCertPath))
		{
			return;
		}
		$this->pubCert = openssl_x509_read(file_get_contents($pubCertPath));
	}
	function SetPartnerPubCertPath($path)
	{
		if($path === NULL || trim($path) == '')
		{
			return;
		}
		if (!file_exists($path))
		{
			return;
		}
		$this->partnerPubCertPath = $path;
	}
	function SetTempDir($path)
	{
		if($path===NULL || trim($path)=='')
			return;
		if (!is_dir($path)) 
		{
			if (!@mkdir($path)) 
			{
				return;
			}
		}
		if(substr($path,-1)!='/'||substr($path,-1)!='\\')
		{
			$this->tempDir = $path.'/';
		}
		else
		{
			$this->tempDir = $path;
		}
	}
	
	function Sign($inputData)
	{
		if(trim($this->tempDir)=='')
			return;
		if($this->prvKey === NULL)
			return;
		if($this->pubCert === NULL)
			return;
		if (!is_dir($this->tempDir))
		{
			if (!@mkdir($this->tempDir))
			{
				return;
			}
		}
		$rndFileName = $this->tempDir;
		do
		{
			$rndFileName = $rndFileName.rand(100000, 999999);
		}
		while(file_exists($rndFileName.'.in')||file_exists($rndFileName.'.out'));
		$out = fopen($rndFileName.'.in', 'w');
		fwrite($out, $inputData);
		fclose($out);
		if (!openssl_pkcs7_sign($rndFileName.'.in', $rndFileName.'.out', $this->pubCert, $this->prvKey, array(), PKCS7_DETACHED)) 
		{
			@unlink($rndFileName.'.in');
			@unlink($rndFileName.'.out');
			return;
		}
		$signedData = explode("\n\n", file_get_contents($rndFileName.'.out'));
		
		@unlink($rndFileName.'.in');
		@unlink($rndFileName.'.out');
		
		if(count($signedData)<4)
			return NULL;
		return $signedData[3];
	}
    function Verify($inputData, $signature)
    {
        if(trim($this->tempDir)=='')
                return;
        //if($this->pubCert === NULL)
        //        return;

        $signedFile = $this->BuildDataVerify($inputData, $this->FormatDigitalSignature($signature));
        if(!copy($this->partnerPubCertPath,$signedFile.'pem'))
        {
            return;
        }
        
        $result = openssl_pkcs7_verify(realpath($signedFile), PKCS7_NOVERIFY, realpath($signedFile.'pem'), array(), realpath($signedFile.'pem'));
        @unlink($signedFile);
        @unlink($signedFile.'pem');
        return $result;
    }
    function BuildDataVerify($inputData, $signature)
    {
        $rndFileName = $this->tempDir;
        $header = 'MIME-Version: 1.0'."\n";
        $header = $header.'Content-Type: multipart/signed; protocol="application/x-pkcs7-signature"; micalg=sha1; boundary="----BA933EBBE691110E5201E47A054785A7"'."\n\n";
        $header = $header.'This is an S/MIME signed message'."\n";

        $boundary = "\n".'------BA933EBBE691110E5201E47A054785A7';

        $headerContent = 'Content-Type: application/x-pkcs7-signature; name="smime.p7s"'."\n";
        $headerContent = $headerContent.'Content-Transfer-Encoding: base64'."\n";
        $headerContent = $headerContent.'Content-Disposition: attachment; filename="smime.p7s"'."\n\n";

        $content = $header.$boundary."\n".$inputData.$boundary."\n".$headerContent.$signature."\n".$boundary.'--';
        do
        {
            $rndFileName = $rndFileName.rand(100000, 999999);
        }
        while(file_exists($rndFileName.'.vin'));

        $out = fopen($rndFileName.'.vin', 'w');
        fwrite($out, $content);
        fclose($out);

        return $rndFileName.'.vin';
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
    
    
}
?>
