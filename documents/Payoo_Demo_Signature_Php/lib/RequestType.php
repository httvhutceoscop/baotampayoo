<?php

class RequestType
{
	var $DigitalSignature ;
}

class GetOrderInformationRequestType extends RequestType
{
	var $OrderID;
	var $ShopID;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<GetOrderInformationRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <OrderID xmlns="BusinessAPI">'.$this->OrderID.'</OrderID>
  <ShopID xmlns="BusinessAPI">'.$this->ShopID.'</ShopID>
</GetOrderInformationRequestType>';
		return $xml;
	}
}

class SendOrderRequestType extends RequestType
{
	var $BusinessID;
	var $ShopID;
	var $OrderID;
	var $CashAmount;
	var $StartShippingDate;
	var $ShippingDays;
	var $OrderDescription;
	var $HttpReference;
	var $ShopBackUrl;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<SendOrderRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <BusinessID xmlns="BusinessAPI">'.$this->BusinessID.'</BusinessID>
  <ShopID xmlns="BusinessAPI">'.$this->ShopID.'</ShopID>
  <OrderID xmlns="BusinessAPI">'.$this->OrderID.'</OrderID>
  <CashAmount xmlns="BusinessAPI">'.$this->CashAmount.'</CashAmount>
  <StartShippingDate xmlns="BusinessAPI">'.$this->StartShippingDate.'</StartShippingDate>
  <ShippingDays xmlns="BusinessAPI">'.$this->ShippingDays.'</ShippingDays>
  <OrderDescription xmlns="BusinessAPI">'.htmlspecialchars($this->OrderDescription,ENT_NOQUOTES).'</OrderDescription>
  <HttpReference xmlns="BusinessAPI">'.$this->HttpReference.'</HttpReference>
  <ShopBackUrl xmlns="BusinessAPI">'.$this->ShopBackUrl.'</ShopBackUrl>
</SendOrderRequestType>';
		return $xml;
	}
}

class UpdateOrderStatusRequestType extends RequestType
{
	var $ShopID;
	var $OrderID;
	var $NewStatus;
	var $UpdateLog;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<UpdateOrderStatusRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <ShopID xmlns="BusinessAPI">'.$this->ShopID.'</ShopID>
  <OrderID xmlns="BusinessAPI">'.$this->OrderID.'</OrderID>
  <NewStatus xmlns="BusinessAPI">'.$this->NewStatus.'</NewStatus>
  <UpdateLog xmlns="BusinessAPI">'.$this->UpdateLog.'</UpdateLog>
</UpdateOrderStatusRequestType>';
		return $xml;
	}
}
class ConfirmNotifyInformationRequestType extends RequestType
{
	var $NotifyData;
    	var $PayooSessionID;
    	var $NotifyCommand;
	
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<ConfirmNotifyInformationRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <NotifyData xmlns="BusinessAPI">'.$this->NotifyData.'</NotifyData>
  <PayooSessionID xmlns="BusinessAPI">'.$this->PayooSessionID.'</PayooSessionID>
  <NotifyCommand xmlns="BusinessAPI">'.$this->NotifyCommand.'</NotifyCommand>
</ConfirmNotifyInformationRequestType>';
		return $xml;

	}
}


class CreatePreOrderRequestType extends RequestType
{
	var $ShopId;
	var $OrderNo;
	var $FromShipDate;
	var $ShipNumDay;
	var $Description;
	var $CyberCash;
	var $HttpReference;
	var $ShopBackURL;
	var $SessionShop;
	var $PaymentExpireDate;
	var $InfoEx;
	var $UserName;
	var $ShopTitle;
	var $ShopDomain;
	var $NotifyUrl;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<CreatePreOrderRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <ShopID xmlns="BusinessAPI">'.$this->ShopID.'</ShopID>
  <OrderNo xmlns="BusinessAPI">'.$this->OrderNo.'</OrderNo>
  <FromShipDate xmlns="BusinessAPI">'.$this->FromShipDate.'</FromShipDate>
  <ShipNumDay xmlns="BusinessAPI">'.$this->ShipNumDay.'</ShipNumDay>
  ';
  
  if($this->Description == null)
  {
  	$xml .= '<Description xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<Description xmlns="BusinessAPI">'.$this->Description.'</Description>
  ';
  }
  
  $xml.= '<CyberCash xmlns="BusinessAPI">'.$this->CyberCash.'</CyberCash>
  ';
  
  if($this->HttpReference == null)
  {
  	$xml.= '<HttpReference xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<HttpReference xmlns="BusinessAPI">'.$this->HttpReference.'</HttpReference>
  ';
  }
  
  
  if($this->ShopBackURL == null)
  {
  	$xml.= '<ShopBackURL xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<ShopBackURL xmlns="BusinessAPI">'.$this->ShopBackURL.'</ShopBackURL>
  ';
  }
  
  
  if($this->SessionShop == null)
  {
  	$xml.= '<SessionShop xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<SessionShop xmlns="BusinessAPI">'.$this->SessionShop.'</SessionShop>
  ';
  }
  
  
  $xml.= '<PaymentExpireDate xmlns="BusinessAPI">'.$this->PaymentExpireDate.'</PaymentExpireDate>
  <InfoEx xmlns="BusinessAPI">'.$this->InfoEx.'</InfoEx>
  ';
  
  
  if($this->UserName == null)
  {
  	$xml.= '<UserName xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<UserName xmlns="BusinessAPI">'.$this->UserName.'</UserName>
  ';
  }
  
    
  if($this->ShopTitle == null)
  {
  	$xml.= '<ShopTitle xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<ShopTitle xmlns="BusinessAPI">'.$this->ShopTitle.'</ShopTitle>
  ';
  }
  
  
  if($this->ShopDomain == null)
  {
  	$xml.= '<ShopDomain xmlns="BusinessAPI" />
  ';
  }
  else
  {
  	$xml.= '<ShopDomain xmlns="BusinessAPI">'.$this->ShopDomain.'</ShopDomain>
  ';
  }
  $xml.= '<NotifyUrl xmlns="BusinessAPI">'.$this->NotifyUrl.'</NotifyUrl>
</CreatePreOrderRequestType>';
		return $xml;
	}
}
?>