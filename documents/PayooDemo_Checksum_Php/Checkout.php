
<?php

// Code mẫu thử nghiệm kết nối thanh toán điện tử với Payoo Payoo
// Code nhận dữ liệu feedback về từ Server Payoo sau khi thanh toán xong
// Doanh nghiệp viết xử lý dựa trên kết quả feedback ghi nhận tiền thanh toán của khách hàng cho 1 hóa đơn
// Hỗ trợ: Phạm Hoàng Hải - Yahoo: phhai@ymail.com

	include_once('Lib/PayooPayment.php');
	
	// Tạo ra 1 đối tượng thnah toán
	$pay = new PayooPayment();
	
	// Tạo ra form thanh toán, tích hợp vào trang của thanh nghiệp, thông qua hàm createRequestURL
	/** // Thông tin thanh toán của đơn hàng 
	* 	$order_no						Ex: 123					//	Mã đơn hàng
	*	$order_ship_date				Ex: date('d/m'Y')		// Ngay chuyen hang, dinh dang dd/mm/YYYY vd: 31/12/2011, Ngay chuyen hang phai >= ngay hien tai
	*	$order_ship_days				Ex: 1					// Số ngày chuyển hàng
	*	$order_cash_amount				Ex: 2000 đồng			// Tổng số tiền thanh toán cho đơn hàng
	*	$chi_tiet_don_hang				Ex: Mô tả chi tiết...	// Thông tin chi tiết đơn hàng
	*/
	$pay->createRequestUrl(	time(), 
							date('d/m/Y'), 
							3,
							10000,
							"<p>Mô tả chi tiết về sản phẩm, thanh toán cho mã đơn hàng ".time()."<p>");
?>
