
<head>
<style type="text/css">
.auto-style1 {
	margin-left: 40px;
}
</style>
</head>

<?php

class ResponseType
{
    var $DigitalSignature;
    var $Ack;
    var $Error;
}

class ErrorType
{
		var $SeverityCode;
    var $ShortMessage;
    var $LongMessage;
}

class GetOrderInformationResponseType extends ResponseType
{
	var $OrderStatus;
	var $OrderCash;
	var $OrderFee;
	var $PaymentDate;
	var $ShippingDate;
	var $DeliveryDate;
	
	function LoadData($stdObject)
	{
		$this->DigitalSignature = $stdObject->DigitalSignature;
		$this->Ack = $stdObject->Ack;
		$this->OrderStatus = $stdObject->OrderStatus;
		$this->OrderCash = $stdObject->OrderCash;
		$this->OrderFee = $stdObject->OrderFee;
		if(!($stdObject ->Ack == 'Success'))
		{
			$this->Error = new ErrorType();
			$this->Error->SeverityCode = $stdObject->Error->SeverityCode;
			$this->Error->ShortMessage = $stdObject->Error->ShortMessage;
			$this->Error->LongMessage = $stdObject->Error->LongMessage;
			return $this;
		}
		$this->PaymentDate = $stdObject->PaymentDate;
		$this->ShippingDate = $stdObject->ShippingDate;
		$this->DeliveryDate = $stdObject->DeliveryDate;
		return $this;
	}
	
	function GetXml()
	{
		$xml = '';
		if($this->Ack == 'Success')
		{
			$xml = '<?xml version="1.0"?>
<p class="auto-style1">
<GetOrderInformationResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <OrderStatus xmlns="BusinessAPI">'.$this->OrderStatus.'</OrderStatus>
  <OrderCash xmlns="BusinessAPI">'.$this->OrderCash.'</OrderCash>
  <OrderFee xmlns="BusinessAPI">'.$this->OrderFee.'</OrderFee>
  <PaymentDate xmlns="BusinessAPI">'.$this->PaymentDate.'</PaymentDate>
  <ShippingDate xmlns="BusinessAPI">'.$this->ShippingDate.'</ShippingDate>
  <DeliveryDate xmlns="BusinessAPI">'.$this->DeliveryDate.'</DeliveryDate>
</GetOrderInformationResponseType>';
		}
		else if($this->Ack == 'Failure')
		{
$xml = '<?xml version="1.0"?>
<GetOrderInformationResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <Error xmlns="BusinessAPI">
    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
  </Error>
  <OrderStatus xmlns="BusinessAPI">'.$this->OrderStatus.'</OrderStatus>
  <OrderCash xmlns="BusinessAPI">'.$this->OrderCash.'</OrderCash>
  <OrderFee xmlns="BusinessAPI">'.$this->OrderFee.'</OrderFee>
</GetOrderInformationResponseType>';
		}
		else
		{
			$xml = '<?xml version="1.0"?>
<GetOrderInformationResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <Error xmlns="BusinessAPI">
    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
  </Error>
  <OrderStatus xmlns="BusinessAPI">'.$this->OrderStatus.'</OrderStatus>
  <OrderCash xmlns="BusinessAPI">'.$this->OrderCash.'</OrderCash>
  <OrderFee xmlns="BusinessAPI">'.$this->OrderFee.'</OrderFee>
  <PaymentDate xmlns="BusinessAPI">'.$this->PaymentDate.'</PaymentDate>
  <ShippingDate xmlns="BusinessAPI">'.$this->ShippingDate.'</ShippingDate>
  <DeliveryDate xmlns="BusinessAPI">'.$this->DeliveryDate.'</DeliveryDate>
</GetOrderInformationResponseType>';
}
return $xml;
}
}

class SendOrderResponseType extends ResponseType
{
var $PayooOrderID;

function SendOrderResponseType()
{

}

function LoadData($stdObject)
{
	$this->DigitalSignature = $stdObject->DigitalSignature;
	$this->Ack = $stdObject->Ack;
	$this->PayooOrderID = $stdObject->PayooOrderID;
	if(!($stdObject ->Ack == 'Success'))
	{
		$this->Error = new ErrorType();
		$this->Error->SeverityCode = $stdObject->Error->SeverityCode;
		$this->Error->ShortMessage = $stdObject->Error->ShortMessage;
		$this->Error->LongMessage = $stdObject->Error->LongMessage;
		return $this;
	}
	return $this;
}

function GetXml()
{
$xml = '';
if($this->Ack == 'Success')
{
$xml ='<?xml version="1.0"?>
<SendOrderResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <PayooOrderID xmlns="BusinessAPI">'.$this->PayooOrderID.'</PayooOrderID>
</SendOrderResponseType>';
		}
		else
		{
			$xml ='<?xml version="1.0"?>
<SendOrderResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <Error xmlns="BusinessAPI">
    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
  </Error>
  <PayooOrderID xmlns="BusinessAPI">'.$this->PayooOrderID.'</PayooOrderID>
</SendOrderResponseType>';
		}
		return $xml;
	}
}

class UpdateOrderStatusResponseType extends ResponseType
{
	function LoadData($stdObject)
	{
		$this->DigitalSignature = $stdObject->DigitalSignature;
		$this->Ack = $stdObject->Ack;
		if(!($stdObject ->Ack == 'Success'))
		{
			$this->Error = new ErrorType();
			$this->Error->SeverityCode = $stdObject->Error->SeverityCode;
			$this->Error->ShortMessage = $stdObject->Error->ShortMessage;
			$this->Error->LongMessage = $stdObject->Error->LongMessage;
		}
		return $this;
	}
	function GetXml()
	{
		$xml = '';
		if($this->Ack == 'Success')
		{
			$xml = '<?xml version="1.0"?>
<UpdateOrderStatusResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
</UpdateOrderStatusResponseType>';
		}
		else
		{
$xml = '<?xml version="1.0"?>
<UpdateOrderStatusResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <Error xmlns="BusinessAPI">
    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
  </Error>
</UpdateOrderStatusResponseType>';
}
return $xml;
}
}
class ConfirmNotifyInformationResponseType extends ResponseType
{
var $ConfirmResult;
function LoadData($stdObject)
{
$this->DigitalSignature = $stdObject->DigitalSignature;
$this->Ack = $stdObject->Ack;
if(!($stdObject ->Ack == 'Success'))
{
$this->Error = new ErrorType();
$this->Error->SeverityCode = $stdObject->Error->SeverityCode;
$this->Error->ShortMessage = $stdObject->Error->ShortMessage;
$this->Error->LongMessage = $stdObject->Error->LongMessage;
}
$this->ConfirmResult = $stdObject->ConfirmResult;
return $this;
}
function GetXml()
{
$xml = '';
if($this->Ack == 'Success')
{
$xml = '<?xml version="1.0"?>
<ConfirmNotifyInformationResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <ConfirmResult xmlns="BusinessAPI">'.$this->ConfirmResult.'</ConfirmResult>
</ConfirmNotifyInformationResponseType>';
		}
		else
		{
			$xml = '<?xml version="1.0"?>
<ConfirmNotifyInformationResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
  <Error xmlns="BusinessAPI">
    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
  </Error>
</ConfirmNotifyInformationResponseType>';
		}
	return $xml;
	}
}

class CreatePreOrderResponseType extends ResponseType

{
	var $BillingCode;
	var $ReturnCode;	
	function LoadData($stdObject)
	{
		$this->DigitalSignature = $stdObject->DigitalSignature;
		$this->Ack = $stdObject->Ack;
		$this->BillingCode = $stdObject->BillingCode;
		$this->ReturnCode = $stdObject->ReturnCode;
		if(!($stdObject ->Ack == 'Success'))
		{
			$this->Error = new ErrorType();
			$this->Error->SeverityCode = $stdObject->Error->SeverityCode;
			$this->Error->ShortMessage = $stdObject->Error->ShortMessage;
			$this->Error->LongMessage = $stdObject->Error->LongMessage;
			return $this;
		}
		return $this;
	}
	
	function GetXml()
	{
		$xml = '';
		if($this->Ack == 'Success')
		{
			$xml = '<?xml version="1.0"?>
		<CreatePreOrderResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
		  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
		  <BillingCode xmlns="BusinessAPI">'.$this->BillingCode.'</BillingCode>
		  <ReturnCode xmlns="BusinessAPI">'.$this->ReturnCode.'</ReturnCode>
		</GetOrderInformationResponseType>';
		}
		else if($this->Ack == 'Failure')
		{
			$xml = '<?xml version="1.0"?>
			<CreatePreOrderResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
			  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
			  <Error xmlns="BusinessAPI">
			    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
			    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
			    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
			  </Error>
			  <BillingCode xmlns="BusinessAPI">'.$this->BillingCode.'</BillingCode>
			  <ReturnCode xmlns="BusinessAPI">'.$this->ReturnCode.'</ReturnCode>			
			</CreatePreOrderResponseType>';
		}
		else
		{
			$xml = '<?xml version="1.0"?>
			<CreatePreOrderResponseType xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
			  <Ack xmlns="BusinessAPI">'.$this->Ack.'</Ack>
			  <Error xmlns="BusinessAPI">
			    <SeverityCode>'.$this->Error->SeverityCode.'</SeverityCode>
			    <ShortMessage>'.$this->Error->ShortMessage.'</ShortMessage>
			    <LongMessage>'.$this->Error->LongMessage.'</LongMessage>
			  </Error>
			  <BillingCode xmlns="BusinessAPI">'.$this->BillingCode.'</BillingCode>
			  <ReturnCode xmlns="BusinessAPI">'.$this->ReturnCode.'</ReturnCode>
			</CreatePreOrderResponseType>';
		}
		return $xml;
	}
}
?></p>
