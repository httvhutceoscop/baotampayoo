<?php
include_once('lib/Config.php');
include_once('lib/PayooNotify.php');
// Make sure the user is posting
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
{
	$NotifyMessage = stripcslashes($_POST["NotifyData"]);
	
	if($NotifyMessage == null || '' === $NotifyMessage)
		return;
	
	$listener = new PayooNotify($NotifyMessage);
	$signature = $listener->GetSignature();
	$invoice = $listener->GetPaymentNotify();	
		
		
	// Xác thực checksum payoo tra trong gói notify
	// Kiểm tra dữ liệu trả ra có phải từ server Payoo không? Nếu dữ liệu lấy từ Server Payoo thì bắt xử lý, ghi nhập vào database
	if(VerifyChecksum($invoice,$signature)== TRUE)
	{	
		if($invoice->getState() == 'PAYMENT_RECEIVED')
		{
			$out = fopen('invoice.txt', 'a');  
			fwrite($out, "\r\nDate: ".date("Y-m-d H:i:s"));
			fwrite($out, "\r\nREMOTE ADDR (expect 118.69.206.8) : ".$_SERVER['REMOTE_ADDR']);
			fwrite($out, "\r\nOrderNo: ".$invoice->getOrderNo());
			fwrite($out, "\r\nOrderCashAmount: ".$invoice->getOrderCashAmount());
			
			//PAYMENT_RECEIVED là trạng thái khách hàng đã thanh toán bằng payoo
			fwrite($out, "\r\nState: ".$invoice->getState());
			
			fwrite($out, "\r\nNotify Url: ".$invoice->getNotifyUrl());
			fwrite($out, "\r\nShop Domain: ".$invoice->getShopDomain());
			fwrite($out, "\r\nShop back url: ".$invoice->getShopBackUrl());
			fwrite($out, "\r\n");
			//... so on...
			fclose($out);
			echo 'NOTIFY_RECEIVED';
		}	
	}
	else
	{
		//Verify digital signature fail. Log for manual investigation.
		$out = fopen('error.txt', 'a');
		fwrite($out, "\r\nDate: ".date("Y-m-d H:i:s"));
		fwrite($out, "\r\nREMOTE ADDR (expect 118.69.206.8) : ".$_SERVER['REMOTE_ADDR']);
		fwrite($out, "\r\n: Không phải tin nhận được từ payoo\r\n");
		//... so on...
		fclose($out);
	}
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
	//echo $strData;
	if(strtoupper(hash('sha512',$strData))!= strtoupper($Checksum))
	{
		return FALSE;
	}
	return TRUE;
}


?>