<?php
	include_once('lib/Config.php');
	include_once('lib/CallerServices.php');
	
	$Caller = new CallerServices();
	$order = new CreatePreOrderRequestType();
	$order->ShopID = _ShopID;
	$order->FromShipDate= date('d/m/Y');
	$order->CyberCash = 50000;
	$order->InfoEx = urlencode('<InfoEx><CustomerEmail>abc@gmail.com</CustomerEmail><CustomerPhone>0908090807</CustomerPhone><Title>Tuyen: Ho Chi Minh -> Nha Trang</Title></InfoEx>');
	$order->OrderNo = 'ORD_'.date('YmdHis');
	$expireDate = strtotime('tomorrow');
	$order->PaymentExpireDate = date('YmdHis',$expireDate);
	$order->ShipNumDay = 1;
	//$order->BillingCode = $order->OrderNo; // neu su dung order_no lam ma thanh toan
	//$order->SessionShop = 'abc';
	//$order->HttpReference = 'www.dev.test.vn';
	//$order->ShopBackURL =  urlencode(_ShopBackUrl);
	//$order->ShopDomain = _ShopDomain;
	//$order->ShopTitle = 'ShopTitle';
	//$order->UserName = 'username';
	$order->NotifyUrl = urlencode(http://192.168.11.31:8333/Notifylistener.aspx); // _NotifyUrl link nhan thong tin thanh toan sau khi KH thanh toan don hang.
	$order->Description= '';
	//$order->BillingCode = 'DN_GNR_123456';
	
	//print_r($order);
	echo '<pre>';
	echo print_r($order);
	echo '</pre>';
	//die();
	$response = $Caller->Call('CreatePreOrder',$order);
	

	echo '<pre>';
	echo 'Ket qua lay thong tin MA THANH TOAN </br>';
	print_r($response); 
	if($response->Ack == "Success" || $response->Ack =="SuccessWithWarning")
	{
		echo 'Thong tin MA THANH TOAN.</br>';
		echo 'BillingCode = '.$response->BillingCode.'</br>';
	}
	else//$response->Ack==Failure
	{
		echo 'Co loi khi lay MA THANH TOAN.</br>';
		echo 'SeverityCode = '. $response->Error->SeverityCode.'</br>';
		echo 'ShortMessage = '. $response->Error->ShortMessage.'</br>';
		echo 'LongMessage = '. $response->Error->LongMessage.'</br>';
	}
	echo '</pre>';
?>