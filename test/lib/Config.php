<?php

    /****************************************
    *
    * Please edit the options below to reflect
    * your system configuration. If they are
    * incorrect, this program may not work as
    * expected.
    *
    ****************************************/
		
		
		define('_BusinessUsername','ShopDemo');//Username of business account
		define('_ShopID',557);
		define('_ShopTitle','ShopDemo');
		define('_ShopDomain','http://localhost');
		define('_ShopBackUrl','http://localhost:8080');
		define('_NotifyUrl','http://192.168.11.31:8333/NotifyListener.aspx	');
		define('_PayooPaymentUrl','https://newsandbox.payoo.com.vn/v2/paynow');

		//Callerservices Config
		define('_BusinessAPIUrl','https://bizsandbox.payoo.com.vn/BusinessAPI.asmx?WSDL');
		define('_APIUsername','ShopDemo_BizAPI');
		define('_APIPassword','tmDcPELIzoTDSe6r');
		define('_APISignature','rxRuZjKS9cwp2NWqwzTrmFL80UGvMh/ZGolP7Ix31I38g2iFieK/bg97XsiYfaj9');
		define('_ChecksumKey','1a05217dc08342b78de28328b8bc7dbe');
		
		//Base Directory - Base directory where all files will be stored
		define ('_PayooPath', realpath (dirname (__FILE__).'/').'/');
		
		define('_PrivateKey','certificate/biz_private_key.pem');
		//Your Public Certificate Filename
		define('_PublicCertificate','certificate/biz_public_cert.pem');
		//Payoo's Public Certificate Filename
		define('_PayooPublicCertificate','certificate/sandbox_payoo_public_cert.pem');
		
		
		//Temporary Directory - Where temporary files are stored regarding
		//the transaction. This should be under the base directory OR outside
		//the webroot, and only readable by you/the web server. Files from this
		//directory are automatically removed after use. The trailing slash is REQUIRED

		//Thu muc temp, co quyen ghi cho he thong.
		define('_TempDirectory',_PayooPath.'tempdir');

		include_once(_PayooPath.'DigitalSignature.php');

?>