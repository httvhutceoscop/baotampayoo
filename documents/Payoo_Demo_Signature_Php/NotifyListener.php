<?php
include_once('lib/Config.php');
include_once('lib/PayooNotify.php');
include_once('lib/CallerServices.php');
// Make sure the user is posting
if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
{
	$NotifyMessage = stripcslashes($_POST["NotifyData"]);
	
	if($NotifyMessage == null || '' === $NotifyMessage)
		return;
	
	$listener = new PayooNotify($NotifyMessage);
	//$invoice = $listener->GetPaymentNotify();	
	$notifyData = $listener->GetNotifyData();
	$signature = $listener->GetSignature();
		
		
	//Xác thực chữ ký của payoo trong gói notify
	$caller = new CallerServices();
	$res = $caller->VerifySignature($notifyData,$signature);
	//echo '<p>Verify -->'.$res.'<p>';
	// Kiểm tra dữ liệu trả ra có phải từ server Payoo không? Nếu dữ liệu lấy từ Server Payoo thì bắt xử lý, ghi nhập vào database
	if($res === true)
	{
		$invoice = $listener->GetPaymentNotify();	
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
?>