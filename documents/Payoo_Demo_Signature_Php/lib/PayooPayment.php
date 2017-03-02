<?php

/**
 *	
 *		Phiên bản: 0.1   
 *		Tên lớp: PayooPayment
 *		Chức năng: Tích hợp thanh toán qua Payoo.com.vn cho các merchant site có đăng ký API
 *		Xây dựng URL chuyển thông tin tới Payoo.com.vn để xử lý việc thanh toán cho merchant site.
 *		Xác thực tính chính xác của thông tin đơn hàng được gửi về từ Payoo.com.vn.
 *		
 */
include_once('Lib/Config.php');
class PayooPayment
{
	
	// Thông tin ví điện tử & website của doanh nghiệp
	private $vdt= _BusinessUsername;						// Ten Ví điện tử của doanh nghiệp đăng kí tại website Payoo
	private $shop_id= _ShopID;								// Mã số Shop của doanh nghiệp do Payoo cung cấp
	private $shop_title = _ShopTitle;						// Tên shop của donah nghiệp do Payoo cung cấp
	private $shop_domain = _ShopDomain;			// Website bán hàng của doanh nghiệp
	private $key=_ChecksumKey;	// Checksume Key của doanh nghiệp do Payoo cung cấp

	// Url trả về khi thanh toán thành công bên Payoo
	private $shop_back_url =_ShopBackUrl; // Đường dẫn trợ về sau khi thanh toán xong
	private $notify_url = _NotifyUrl;  // Trang nhận kết quả thông báo từ payoo
	
	/** // Thông tin thanh toán của đơn hàng 
	* 	$order_no								//	Mã đơn hàng
	*	$order_ship_date						// Ngay chuyen hang, dinh dang dd/mm/YYYY vd: 31/12/2011, Ngay chuyen hang phai >= ngay hien tai
	*	$order_ship_days						// Số ngày chuyển hàng
	*	$order_cash_amount						// Tổng số tiền thanh toán cho đơn hàng
	*	$chi_tiet_don_hang						// Thông tin chi tiết đơn hàng
	*/

	private $order_description;

	// Hàm xây dựng url chuyển đến Payoo.vn thực hiện thanh toán, trong đó có tham số mã hóa (còn gọi là public key)
	public function createRequestUrl($order_no, $order_ship_date, $order_ship_days, $order_cash_amount, $chi_tiet_don_hang)
	{
		$Cus_Name = 'Nguyen Van A';
		$Cust_Phone = '0900111111';
		$Cus_Address = 'Số 5, khu phố 3, phường Tam Phong';
		$Cus_City = '24000';
		$Cus_Email = 'email@yahoo.com';
		$validity_time =  date('YmdHis', strtotime('+1 day', time()));
		
		$str='<shops><shop><session>'.$order_no.'</session><username>'.$this->vdt.'</username><shop_id>'.$this->shop_id.'</shop_id><shop_title>'.$this->shop_title.'</shop_title><shop_domain>'.$this->shop_domain.'</shop_domain><shop_back_url>'.$this->shop_back_url.'</shop_back_url><order_no>'.$order_no.'</order_no><order_cash_amount>'.$order_cash_amount.'</order_cash_amount><order_ship_date>'.$order_ship_date.'</order_ship_date><order_ship_days>'.$order_ship_days.'</order_ship_days><order_description>'.urlencode($chi_tiet_don_hang).'</order_description><validity_time>'.$validity_time.'</validity_time><notify_url>'.$this->notify_url.'</notify_url><customer><name>'.$Cus_Name.'</name><phone>'.$Cust_Phone.'</phone><address>'.$Cus_Address.'</address><city>'.$Cus_City.'</city><email>'.$Cus_Email.'</email></customer></shop></shops>';

		$checksum=	hash('sha512',$this->key.$str);//sha1($this->key.$str);
		
		//$checkouturl = 'https://sandbox.payoo.com.vn/m/api/action/get_billing_code'; //pay later
		$checkouturl = _PayooPaymentUrl;//'https://sandbox.payoo.com.vn/new/paynow'; //sandbox paynow2
		//$checkouturl = 'https://sandbox.payoo.com.vn/m/payorder'; //sandbox paynow1
		//$checkouturl = 'https://www.payoo.com.vn/m/payorder'; //paynow1
		print($chi_tiet_don_hang);
		print("<script src=\"https://newsandbox.payoo.com.vn/v2/merchants/methods.js\"></script>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
		<form id=\"frmPayByPayoo\" class=\"test-form\"  name=\"frmPayByPayoo\" action=\"" .$checkouturl. "\" method=\"POST\">
		<div id=\"payoo-methods\" style=\"width: 710px;\"></div>
        <input type=\"hidden\" name=\"cmd\" value=\"_cart\" />
        <input type=\"hidden\" name=\"OrdersForPayoo\" value='".$str."'/>
        <input type=\"hidden\" value=\"".$checksum."\" name=\"CheckSum\" />
        </form>
		<script>
			function validate(){
				return confirm(\"Are your sure?\");
			};
			Payoo.init({
				id: ".$this->shop_id.",
				url: '".$this->shop_domain."',
				wrapper: 'Ecommerce',
				selector: '#payoo-methods',
				type: 'full',
				autohide: false,
				order: {
					seller: '".$this->vdt."',
					amount: 200000
				},
				form: {
					selector: '.test-form',
					submit: function(form) {
						//return validate(form);
					}
				}
			});
			
		</script>");
	}
	
	
	/**
	 * Hàm thực hiện xác minh tính chính xác thông tin trả về từ Payoo.com.vn
	 * @param $_GET chứa tham số trả về trên url
	 * @return true nếu thông tin là chính xác, false nếu thông tin không chính xác
	 */
	public function verifyResponseUrl($_GETx)
	{
		//--lay thong tin tra ve tu Payoo redirect
		$order_no=$_GETx['order_no'];
		$session=$_GETx['session'];
		$status=$_GETx['status'];
		//tao checksum de kiem tra 
		$cs=sha1($key.$session.'.'.$order_no.'.'.$status);

		if($cs==$_GETx['checksum'])
			return true;
		
		return false;
	}
}
?>