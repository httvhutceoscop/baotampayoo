<?php //session_start(); ?>
<?php
require_once "functions.php";

$customer_name     = '';
$email             = '';
$phone             = '';
$bookingid         = '';
$total             = '';
$note              = '';

// msg for invalid input
$msg_customer_name = '';
$msg_email         = '';
$msg_phone         = '';
$msg_bookingid     = '';
$msg_total         = '';
$msg_note          = '';

$confirmStep       = false;
$paymentForm       = false;

$aCustomerInfo     = [];

//tooltip
$tt_name = 'Vui lòng nhập tên không có dấu.';
$tt_email = 'Vui lòng nhập đúng địa chỉ email.';
$tt_phone = 'Vui lòng nhập đúng số điện thoại. Bắt dầu bằng số 0 hoặc +84';
$tt_total = 'Số tiền chỉ bao gồm chữ số không chứa khoảng trắng và các ký tự khác.';


if ($_POST) {

    if (isset($_POST['btnSubmit'])) {
        if (isset($_POST['customer_name'])) {
            $customer_name = $_POST['customer_name'];
            $msg_customer_name = validName($customer_name);
        }

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $msg_email = validEmail($email);
        }

        if (isset($_POST['phone'])) {
            $phone = $_POST['phone'];
            $msg_phone = validPhone($phone);
        }

        if (isset($_POST['bookingid']) && !empty($_POST['bookingid'])) {
            $bookingid = $_POST['bookingid'];
        } else {
            $bookingid = time();
        }

        if (isset($_POST['total'])) {
            $total = $_POST['total'];
            $msg_total = validCost($total);
        }

        if (isset($_POST['note']) && !empty($_POST['note']))
            $note = $_POST['note'];
        else 
            $note = 'Thanh toán vé máy bay';

        if (empty($msg_customer_name) && empty($msg_email) && empty($msg_phone) && empty($msg_total) 
            && empty($msg_payment_type) && empty($msg_bank_type)) {
            $confirmStep = true;    

            // lưu thông tin vào session
            $_SESSION['customer_name'] = $customer_name;
            $_SESSION['customer_email'] = $email;
            $_SESSION['customer_phone'] = $phone;
            $_SESSION['bookingid'] = $bookingid;
            $_SESSION['total'] = $total;
            $_SESSION['customer_note'] = $note;
        }
    }

    if (isset($_POST['btnPayNow'])) {
        $paymentForm = true;
        $aCustomerInfo = [
            'customer_name' => $_SESSION['customer_name'],
            'customer_email' => $_SESSION['customer_email'],
            'customer_phone' => $_SESSION['customer_phone'],
            'bookingid' => $_SESSION['bookingid'],
            'total' => $_SESSION['total'],
            'customer_note' => $_SESSION['customer_note'],
        ];
    }
}

$aMsgInvalid = [
    'customer_name' => $msg_customer_name,
    'email'         => $msg_email,
    'phone'         => $msg_phone,
    'bookingid'     => $msg_bookingid,
    'total'         => $msg_total,
    'note'          => $msg_note,
];

?>

<?php include_once "header.php";?>

<div class="main-content">
    <!-- You only need this form and the form-validation.css -->
    <div id="vtcTab" class="tabContent">
        <h2 class="tabTitle">Thanh Toán Online</h2>

        <!--script src="https://newsandbox.payoo.com.vn/v2/merchants/methods.js"></script>

        <form id="frmPayByPayoo" class="test-form" name="frmPayByPayoo" action="" method="POST">
            <div id="payoo-methods" style="width: 710px;"></div>
            <input type="hidden" name="cmd" value="_cart" />
            <input type="hidden" name="OrdersForPayoo" value="100"/>
            <input type="hidden" name="CheckSum" value="123456" />
        </form>

        <script type="text/javascript">
            //function validate(){ return confirm("Are your sure?"); };
                Payoo.init({
                    id: 590,
                    url: 'http://toilamit.com',
                    wrapper: 'Ecommerce',
                    selector: '#payoo-methods',
                    type: 'full',
                    autohide: false,
                    order: {
                        seller: 'shopdemo_checksum',
                        amount: 200000
                    },
                    form: {
                        selector: '.test-form',
                        submit: function(form) {
                            return validate(form);
                        }
                    }
                });
        </script-->



        <form class="form-validation" id="payment-info" method="post" action="#" style="display:<?= $confirmStep || $paymentForm ? 'none' : 'block'?>">
            <div style="text-align: left;font-weight: normal;line-height: 1.5em;" class="form-row">

            </div>
            <div class="form-row">
                <h2 class="titleBlock">Thông tin khách hàng</h2>
            </div>
            <div class="form-row form-input-name-row">
                <label>
                    <span>Họ tên<strong class="required-field">*</strong></span>
                    <input data-toggle="tooltip" data-placement="top" title="<?= $tt_name;?>" type="text" 
                            name="customer_name" value="<?= $customer_name ?>">
                </label>
                <span class="form-invalid-data-info"><?= $aMsgInvalid['customer_name']; ?></span>

            </div>

            <div class="form-row form-input-email-row">
                <label>
                    <span>Email<strong class="required-field">*</strong></span>
                    <input data-toggle="tooltip" data-placement="top" title="<?= $tt_email;?>" type="text" 
                            name="email" value="<?= $email ?>">
                </label>
                <span class="form-invalid-data-info"><?= $aMsgInvalid['email']; ?></span>
            </div>

            <div class="form-row">

                <label>
                    <span>Số điện thoại<strong class="required-field">*</strong></span>
                    <input data-toggle="tooltip" data-placement="top" title="<?= $tt_phone;?>" type="text" 
                            name="phone" value="<?= $phone ?>">
                </label>
                <span class="form-invalid-data-info"><?= $aMsgInvalid['phone']; ?></span>

            </div>

            <div class="form-row">
                <h2 class="titleBlock">Thông tin thanh toán</h2>
            </div>

            <div class="form-row">

                <label>
                    <span>Mã đơn hàng <small>(nếu có)</small></span>
                    <input type="text" name="bookingid" value="<?= $bookingid ?>">
                </label>
                <span class="form-invalid-data-info"><?= $aMsgInvalid['bookingid']; ?></span>

            </div>

            <div class="form-row">

                <label>
                    <span>Số tiền <small>(VNĐ)<strong class="required-field">*</strong></small></span>
                    <input data-toggle="tooltip" data-placement="top" title="<?= $tt_total;?>" type="text" 
                            name="total" value="<?= $total ?>">
                </label>
                <span class="form-invalid-data-info"><?= $aMsgInvalid['total']; ?></span>

            </div>


            <div class="form-row">

                <label class="form-checkbox">
                    <span>Lý do thanh toán</span>
                    <textarea name="note"><?= $note ?></textarea>
                </label>

            </div>            

            <div class="form-row">
                <button type="submit" id="btnSubmit" name="btnSubmit">TIẾP TỤC</button>
            </div>
        </form>


        <?php // Hiển thị các phương thức thanh toán ?>
        <?php if ($paymentForm) { ?>
        <div class="form-row">
            <label class="form-checkbox">
                <span>Phương Thức Thanh Toán<strong class="required-field">*</strong></span>
            </label>

            <?php

                include_once('Lib/PayooPayment.php');
                $pay = new PayooPayment();                    
                
                // Tạo ra form thanh toán, tích hợp vào trang của thanh nghiệp, thông qua hàm createRequestURL
                /** // Thông tin thanh toán của đơn hàng 
                *   $order_no                       Ex: 123                 //  Mã đơn hàng
                *   $order_ship_date                Ex: date('d/m'Y')       // Ngay chuyen hang, dinh dang dd/mm/YYYY vd: 31/12/2011, Ngay chuyen hang phai >= ngay hien tai
                *   $order_ship_days                Ex: 1                   // Số ngày chuyển hàng
                *   $order_cash_amount              Ex: 2000 đồng           // Tổng số tiền thanh toán cho đơn hàng
                *   $chi_tiet_don_hang              Ex: Mô tả chi tiết...   // Thông tin chi tiết đơn hàng
                */
                $pay->createRequestUrl( $_SESSION['bookingid'], 
                                        date('d/m/Y'), 
                                        3,
                                        $_SESSION['total'],
                                        $_SESSION['customer_note'], 
                                        $aCustomerInfo);
            ?>
        </div>
        <?php }?>

        <?php //TODO: xac nhan thanh toan?>
        <?php if ($confirmStep) { ?>

        <div id="confirmStep" class="">
            <h1>Xác nhận thông tin</h1>
            <div class="form-row">
                <label>
                    <span class="lbl">Họ tên: </span>
                    <span class="lblValue"> <?= $customer_name;?> </span>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span class="lbl">Email: </span>
                    <span class="lblValue"> <?= $email;?> </span>
                </label>
            </div>

            <div class="form-row">
                <label>
                    <span class="lbl">Số điện thoại: </span>
                    <span class="lblValue"> <?= $phone;?> </span>
                </label>
            </div>
            <div class="form-row">
                <label>
                    <span class="lbl">Mã đơn hàng: </span>
                    <span class="lblValue"> <?= $bookingid;?></span>
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
                    <span class="lblValue"> <?= $note;?> </span>
                </label>
            </div>
            <div class="form-row">
                <form action="#" method="POST">
                    <button type="submit" id="btnSubmit" name="btnPayNow">THANH TOÁN NGAY</button>
                    <button type="button" name="btnback" id="btnBack"> SỬA THÔNG TIN</button>
                    <input type="hidden" name="customer_name" value="<?= $customer_name;?>"/>
                    <input type="hidden" name="customer_email" value="<?= $email;?>"/>
                    <input type="hidden" name="customer_phone" value="<?= $phone;?>"/>
                    <input type="hidden" name="bookingid" value="<?= $bookingid;?>"/>
                    <input type="hidden" name="total" value="<?= $total;?>"/>
                    <input type="hidden" name="customer_note" value="<?= $note;?>"/>                    
                </form>
            </div>
        </div>

        <?php }?>

    </div>


    <?php include_once "tabs/bankinfo.php";?>
    <?php include_once "tabs/payatoffice.php";?>
    <?php include_once "tabs/payathome.php";?>    

    <div class="tabContent" id="instruction">
        <h2 class="tabTitle">Hướng dẫn</h2>
        <div class="post-editor clearfix">
            <p style="color: #222222; text-align: justify;">Đang cập nhật</p></div><!--.post-editor-->
    </div>
</div>

<?php include_once "footer.php";?>
