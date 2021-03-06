<?php
include_once('lib/Config.php');
include_once('lib/CallerServices.php');
$Caller = new CallerServices();
$order = new GetOrderInformationRequestType();
$order->OrderID = 'ORD_20161007093335'; //1458177089 (cancel) - 1458175860
$order->ShopID = _ShopID;//_ShopID;
print_r($order);
$response = $Caller->Call('GetOrderInformation',$order);

echo '<pre>';
echo 'Ket qua lay thong tin hoa don </br>';
print_r($response); 
if($response->Ack == "Success" || $response->Ack =="SuccessWithWarning")
{
	echo 'Thong tin hoa don.</br>';
	echo 'OrderStatus = '.$response->OrderStatus.'</br>';
	echo 'OrderCash = '.$response->OrderCash.'</br>';
	echo 'OrderFee = '.$response->OrderFee.'</br>';
	echo 'PaymentDate = '.$response->PaymentDate.'</br>';
	echo 'ShippingDate = '.$response->ShippingDate.'</br>';
	echo 'DeliveryDate = '.$response->DeliveryDate.'</br>';
}
else//$response->Ack==Failure
{
	echo 'Co loi khi lay thong tin hoa don.</br>';
	echo 'SeverityCode = '. $response->Error->SeverityCode.'</br>';
	echo 'ShortMessage = '. $response->Error->ShortMessage.'</br>';
	echo 'LongMessage = '. $response->Error->LongMessage.'</br>';
}
echo '</pre>';
?>