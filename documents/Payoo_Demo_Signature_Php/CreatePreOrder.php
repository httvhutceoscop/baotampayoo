<?php
include_once('lib/Config.php');
include_once('lib/CallerServices.php');
$Caller = new CallerServices();


$order = new CreatePreOrderRequestType();
$order->Description= '';
$order->FromShipDate= date('d/m/Y');
$order->CyberCash = 50000;
$order->HttpReference = 'www.dev.test.vn';
$order->InfoEx = urlencode('<InfoEx><CustomerEmail>Shopdemo@gmail.com</CustomerEmail><Title>Test Shopdemo </Title></InfoEx>');
$order->OrderNo = date('YmdHis');
$expireDate = strtotime('tomorrow');
$order->PaymentExpireDate = date('YmdHis',$expireDate);
$order->SessionShop = 'abc';
$order->ShipNumDay = 1;
$order->ShopBackURL =  urlencode(_ShopBackUrl);
$order->ShopDomain = _ShopDomain;
$order->ShopID = _ShopID;
$order->ShopTitle = 'Test CreatePreOrder Shopdemo';
$order->UserName = 'Shopdemo';
$order->NotifyUrl=urlencode(_NotifyUrl);
$response = $Caller->Call('CreatePreOrder',$order);

echo '<pre>';
echo 'Ket qua lay thong tin hoa don </br>';
print_r($response); 
if($response->Ack == "Success" || $response->Ack =="SuccessWithWarning")
{
	echo 'Thong tin hoa don.</br>';
	echo 'BillingCode = '.$response->BillingCode.'</br>';
	echo 'OrderNo = '.$order->OrderNo.'</br>';}
else//$response->Ack==Failure
{
	echo 'Co loi khi lay thong tin hoa don.</br>';
	echo 'SeverityCode = '. $response->Error->SeverityCode.'</br>';
	echo 'ShortMessage = '. $response->Error->ShortMessage.'</br>';
	echo 'LongMessage = '. $response->Error->LongMessage.'</br>';
	print_r($order);
}
echo '</pre>';
?>