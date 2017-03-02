<?php session_start(); ?>
<?php

var_dump($_GET);
die('check ketqua thanh toan');
require_once "functions.php";

$customer_name = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : '';
$customer_email = isset($_SESSION['customer_email']) ? $_SESSION['customer_email'] : '';
$customer_phone = isset($_SESSION['customer_phone']) ? $_SESSION['customer_phone'] : '';
$payment_type = isset($_SESSION['payment_type']) ? $_SESSION['payment_type'] : '';
$payment_card_name = isset($_SESSION['payment_card_name']) ? $_SESSION['payment_card_name'] : '';
$payment_bank_name = isset($_SESSION['payment_bank_name']) ? $_SESSION['payment_bank_name'] : '';
$total = isset($_SESSION['total']) ? $_SESSION['total'] : '';
$customer_note = isset($_SESSION['customer_note']) ? $_SESSION['customer_note'] : '';
$bookingid = isset($_SESSION['bookingid']) ? $_SESSION['bookingid'] : '';
$token = isset($_SESSION['token']) ? $_SESSION['token'] : '';

$success = false;

if(isset($_GET['status']) && !empty($_GET['status']))
{   
    include 'vendor/libpayment.php';
    $libpayvtc = new libpay();

    $status = @$_GET['status'];
    $order_code = @$_GET['order_code'];
    $amount = @$_GET['amount'];
    $website_id = @$_GET['website_id'];
    $sign = @$_GET['sign'];
    $url = getBaseUrl();      
    $check = $libpayvtc->verifyPaymentUrl($status, $order_code, $amount, $website_id, $sign);
    $msg = '';      
    
    if($check === false) {
        $msg = 'Chữ ký sai, có sự can thiệp bên ngoài. Liên hệ hotline ngay.<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
    } else {
        if($check == 1 || $check == 2) {                
            $msg = 'Thanh toán thành công!<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
            $success = true;
        }
        elseif ($check == 0) {
            $msg = 'Thanh toán dang xử lý. <br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
        }
        elseif ($check == -1) {                
            $msg = 'Giao dịch thất bại. Xin thử lại hoặc liên hệ hotline.<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
        }
        elseif ($check == -5) {                
            $msg = 'Mã đơn hàng không hợp lý.<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
        }
        elseif ($check == -6) {                
            $msg = 'Số dư không đủ thanh toán.<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
        }
        else {                
            $msg = 'Có lỗii. Hãy thực hiện lại!<br/><a href = "'.$url.'">Quay lại trang chủ.</a>';
        }
    }
}
?>

<?php include_once "header.php"; ?>

<div class="main-content">
    <!-- You only need this form and the form-validation.css -->
    <div id="vtcTab" class="tabContent retry_pay">
        <h2 class="tabTitle">Kết quả thanh toán</h2>
        <span class="red"> <?= $msg; ?></span><br/><br/>
        <form action="<?= getBaseUrl();?>" method="POST">
            <div id="confirmStep" class="">
                <div class="form-row">
                    <label>
                        <span class="lbl">Họ tên: </span>
                        <span class="lblValue"> <?= $customer_name?> </span>
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span class="lbl">Email: </span>
                        <span class="lblValue"> <?= $customer_email?> </span>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span class="lbl">Số điện thoại: </span>
                        <span class="lblValue"> <?= $customer_phone?> </span>
                    </label>
                </div>

                <div class="form-row">
                    <label>
                        <span class="lbl">Số tiền: </span>
                        <span class="lblValue"> <?= number_format($total, 0, '', ' ');?> <small>VNĐ</small> </span>
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span class="lbl">Lý do thanh toán: </span>
                        <span class="lblValue"> <?= $customer_note?> </span>
                    </label>
                </div>
                <div class="form-row">
                    <span class="form-invalid-data-info" id="bankNameError"></span>
                    <label class="form-checkbox">
                        <span>Phương Thức Thanh Toán</span>
                    </label>
                    <div class="form-radio-buttons">
                        <div>
                            <label>
                                <input <?= $payment_type == 'Visa' ? 'checked' : ''; ?> class="selectPayMethod" type="radio" id="pay-by-visa" name="payment_type"
                                       value="Visa">
                                <input type="hidden" name="payment_card_name" value="<?= $payment_card_name;?>" id="interCardName">
                                <span>THẺ QUỐC TẾ VISA, MASTERCARD, JCB</span>
                            </label>
                            <div id="wrap-listCard-inter" class="clearfix">
                                <ul id="listCardInter" class="listCard">
                                    <li>
                                        <a id="card_Visa" style="cursor: pointer;">
                                            <img id="imgPaygate_Visa" class="cardInfo" src="images/visa.png" width="108"
                                                 height="48" border="0">
                                        </a>
                                    </li>
                                    <li>
                                        <a id="card_Master" style="cursor: pointer;">
                                            <img id="imgPaygate_Master" class="cardInfo" src="images/master.png"
                                                 width="108" height="48" border="0">
                                        </a>
                                    </li>
                                    <li>
                                        <a id="card_JCB" style="cursor: pointer;">
                                            <img id="imgPaygate_JCB" class="cardInfo" src="images/jcb.png" width="108"
                                                 height="48" border="0">
                                        </a>
                                    </li>
                                    <li id="select-other-bank-inter">
                                        <a style="cursor: pointer; border-radius: 9px;">
                                            <img class="otherBank" src="images/other-bank.jpg" width="108" height="48"
                                                 border="0">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div>
                            <label>
                                <input <?= $payment_type == 'Bank' ? 'checked' : ''; ?> class="selectPayMethod" id="pay-by-atm" type="radio" name="payment_type"
                                       value="Bank">
                                <input type="hidden" name="payment_bank_name" value="<?= $payment_bank_name;?>" id="atmBankName">
                                <span>THẺ ATM NỘI ĐỊA</span>
                            </label>
                            <div id="wrap-listCard" class="clearfix">
                                <?php include_once "listcard.php"; ?>
                                <img id="iconChoose" src="https://pay.vtc.vn/Content/images/icon-hover.png"
                                     style="position: absolute; bottom: -5px; right: -5px;">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div>
                            <label>
                                <input <?= $payment_type == 'VTCPay' ? 'checked' : ''; ?> class="selectPayMethod" type="radio" name="payment_type" value="VTCPay">
                                <span>TÀI KHOẢN VÍ ĐIỆN TỬ VTC PAY</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <button type="submit" id="btnSubmit" name="btnPayNow">THANH TOÁN NGAY</button>
                    <input type="hidden" name="customer_name" value="<?= $customer_name?>"/>
                    <input type="hidden" name="customer_email" value="<?= $customer_email?>"/>
                    <input type="hidden" name="customer_phone" value="<?= $customer_phone?>"/>
                    <input type="hidden" name="total" value="<?= $total?>"/>
                    <input type="hidden" name="customer_note" value="<?= $customer_note?>"/>
                    <input type="hidden" name="bookingid" value="<?= $bookingid?>"/>
                    <input type="hidden" name="token" value="<?= $token?>"/>
                </div>
            </div>
        </form>
    </div>

    <?php include_once "tabs/bankinfo.php";?>
    <?php include_once "tabs/payatoffice.php";?>
    <?php include_once "tabs/payathome.php";?>
</div>

<?php if ($success) {?>
<script>
    $('.main-content').find('input, textarea, button, select').attr('disabled','disabled');
    $('.main-content').find('#btnSubmit').hide();
</script>
<?php }?>

<?php include_once "footer.php"; ?>