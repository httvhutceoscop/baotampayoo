<?php

    /****************************************
    *
    * Please edit the options below to reflect
    * your system configuration. If they are
    * incorrect, this program may not work as
    * expected.
    *
    ****************************************/
		
		
		define('_BusinessUsername','shopdemo_checksum');//Username of business account
		define('_ShopID',590);
		define('_ShopTitle','ShopDemo');
		define('_ShopDomain','http://toilamit.com');
		define('_ShopBackUrl','http://toilamit.com/ket-qua-thanh-toan.php');
		define('_NotifyUrl','http://192.168.11.31:8333/NotifyListener.aspx');
		
		// link cong thanh toan Payoo
		define('_PayooPaymentUrl','https://newsandbox.payoo.com.vn/v2/paynow');
		
		// link script lay ds ngan hang
		define('_Link_Script_Paynow','https://newsandbox.payoo.com.vn/v2/merchants/methods.js');
		
		//Callerservices Config
		define('_BusinessAPIUrl','https://bizsandbox.payoo.com.vn/BusinessAPI.asmx?WSDL');
		//define('_BusinessAPIUrl','http://localhost:50062/BusinessAPI/BusinessAPI.asmx?WSDL');
		
		define('_APIUsername','shopdemo_checksum_BizAPI');
		define('_APIPassword','abnGkfclvUBzpA5+');
		define('_APISignature','ll/sdDoGdiKW6H+siMfOfNX78Xu5gLczglJA38deQw7Ysq8dC1G+ypscNLAHmBVq');
		
		define('_ChecksumKey','704af2b5d3172856c30b6b7060db50a1');
		
		//Base Directory - Base directory where all files will be stored
		define ('_PayooPath', realpath (dirname (__FILE__).'/').'/');
		
		//define('_PrivateKey','certificate/biz_private_key.pem');
		//Your Public Certificate Filename
		//define('_PublicCertificate','certificate/biz_public_cert.pem');
		//Payoo's Public Certificate Filename
		//define('_PayooPublicCertificate','certificate/sandbox_payoo_public_cert.pem');
		
		
		//Temporary Directory - Where temporary files are stored regarding
		//the transaction. This should be under the base directory OR outside
		//the webroot, and only readable by you/the web server. Files from this
		//directory are automatically removed after use. The trailing slash is REQUIRED

		//Thu muc temp, co quyen ghi cho he thong.
		//define('_TempDirectory',_PayooPath.'tempdir');

		//include_once(_PayooPath.'DigitalSignature.php');

?>