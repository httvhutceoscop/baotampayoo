<?php

class RequestType
{
	var $DigitalSignature ;
	var $RequestData ;
}

class GetOrderInformationRequestType extends RequestType
{
	var $OrderID;
	var $ShopID;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
<GetOrderInformationRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <OrderID>'.$this->OrderID.'</OrderID>
  <ShopID>'.$this->ShopID.'</ShopID>
</GetOrderInformationRequestType>';
		return $xml;
	}
}

class CreatePreOrderRequestType extends RequestType
{
	var $ShopID;
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
	var $BillingCode;
	function GetXml()
	{
		$xml = '<?xml version="1.0"?>
		<CreatePreOrderRequestType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
		  <ShopID>'.$this->ShopID.'</ShopID>
		  <OrderNo>'.$this->OrderNo.'</OrderNo>
		  <FromShipDate>'.$this->FromShipDate.'</FromShipDate>
		  <ShipNumDay>'.$this->ShipNumDay.'</ShipNumDay>';
		  if($this->BillingCode == null)
		  {
			$xml .= '<BillingCode />';
		  }
		  else
		  {
			$xml.= '<BillingCode>'.$this->BillingCode.'</BillingCode>';
		  }
		  if($this->Description == null)
		  {
			$xml .= '<Description />';
		  }
		  else
		  {
			$xml.= '<Description>'.$this->Description.'</Description>';
		  }
		  
		  $xml.= '<CyberCash>'.$this->CyberCash.'</CyberCash>';
		  
		  if($this->HttpReference == null)
		  {
			$xml.= '<HttpReference />';
		  }
		  else
		  {
			$xml.= '<HttpReference>'.$this->HttpReference.'</HttpReference>';
		  }
		  
		  
		  if($this->ShopBackURL == null)
		  {
			$xml.= '<ShopBackURL />';
		  }
		  else
		  {
			$xml.= '<ShopBackURL>'.$this->ShopBackURL.'</ShopBackURL>';
		  }
		  
		  
		  if($this->SessionShop == null)
		  {
			$xml.= '<SessionShop />';
		  }
		  else
		  {
			$xml.= '<SessionShop>'.$this->SessionShop.'</SessionShop>';
		  }
		  
		  
		  $xml.= '<PaymentExpireDate>'.$this->PaymentExpireDate.'</PaymentExpireDate>
		  <InfoEx>'.$this->InfoEx.'</InfoEx>';
		  
		  
		  if($this->UserName == null)
		  {
			$xml.= '<UserName />';
		  }
		  else
		  {
			$xml.= '<UserName>'.$this->UserName.'</UserName>';
		  }
		  
			
		  if($this->ShopTitle == null)
		  {
			$xml.= '<ShopTitle />';
		  }
		  else
		  {
			$xml.= '<ShopTitle>'.$this->ShopTitle.'</ShopTitle>';
		  }
		  
		  
		  if($this->ShopDomain == null)
		  {
			$xml.= '<ShopDomain />';
		  }
		  else
		  {
			$xml.= '<ShopDomain>'.$this->ShopDomain.'</ShopDomain>';
		  }
		   if($this->ShopDomain == null)
		  {
			$xml.= '<ShopDomain />';
		  }
		  else
		  {
			$xml.= '<ShopDomain>'.$this->ShopDomain.'</ShopDomain>';
		  }
		  $xml.= '<NotifyUrl>'.$this->NotifyUrl.'</NotifyUrl></CreatePreOrderRequestType>';		
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
  <ShopID>'.$this->ShopID.'</ShopID>
  <OrderID>'.$this->OrderID.'</OrderID>
  <NewStatus>'.$this->NewStatus.'</NewStatus>
  <UpdateLog>'.$this->UpdateLog.'</UpdateLog>
</UpdateOrderStatusRequestType>';
		return $xml;
	}
}
?>