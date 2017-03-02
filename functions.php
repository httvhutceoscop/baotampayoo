<?php

function validName($str)
{

    if (empty($str)) {
        return 'Vui lòng nhập tên.';
    } else {
        preg_match('/^[a-zA-Z\s]+$/', $str, $match);

        if (count($match) == 0)
            return 'Vui lòng nhập đúng định dạng tên.';
    }
}

function validEmail($email)
{
    if (empty($email)) {
        return 'Vui lòng nhập email.';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Sai định dạng email.";
        }
    }
}

function validPhone($phone)
{
    if (empty($phone)) {
        return 'Vui lòng nhập số điện thoại.';
    } else {
        preg_match('/^(?:(?:0|(?:\+84))\d{9})/', $phone, $match);

        if (count($match) == 0)
            return 'Sai định dạng số điện thoại.';
    }
}

function validCost($cost)
{
    if (empty($cost)) {
        return 'Vui lòng nhập số tiền.';
    } else {
        preg_match('/^[0-9]+$/', $cost, $match);

        if (count($match) == 0)
            return 'Sai định dạng số tiền.';
    }
}

function validPayment($str)
{
    if (empty($str)) {
        return 'Vui lòng chọn phương thức thanh toán.';
    }
}

function getUrl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getBaseUrl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

function sendEmail($orderNumber, $fullName, $email, $phone, $amount, $paymentMethod, $paymentName, $remarks = '') {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $to      = $email.',dieuhanh.baotam@gmail.com';
    $subject = "HTML email";

    $tdStyle = 'style="border:1px solid #aaa;padding:4px 10px;text-align:left;vertical-align:top"';
    $tdStyle = '';
    
    $message = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <style type="text/css">
                    * {
                        margin: 0;
                        padding: 0;
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        font-size: 100%;
                        line-height: 1.6;
                    }
                    body { font-family:Times New Roman; font-size:12pt; margin:10px}
                    table { border:none; border-collapse:collapse; margin: 0 auto; }
                    table td {border:1px solid #aaa;padding:4px 10px;text-align:left;vertical-align:top}
                </style>
            </head>
            <body>';
    $message .= '<div id="bao-tam-payment">';
    $message .= '<div style="text-align:center;margin-bottom:1em">
        <h3 style="font-size:14pt">BIÊN LAI THANH TOÁN</h3>
        (<i>Payment Receipt</i>)
    </div>';

    $message .= '<table cellpadding="5" cellspacing="0">
    <tbody><tr>
        <td>
            <b>Ngày, giờ giao dịch</b><br>
            <i>Trans. Date, Time</i>
        </td>
        <td colspan="3">
            '.date("d/m/Y H:i:s").'
        </td>
    </tr>
    <tr>
        <td>
            <b>Số lệnh giao dịch</b><br>
            <i>Order Number</i>
        </td>
        <td colspan="3">
            0510160894303002
        </td>
    </tr>
    
    <tr>
        <td>
            <b>Họ tên</b><br>
            <i>Full Name</i>
        </td>
        <td colspan="3">
            '.$fullName.'
        </td>
    </tr>

    <tr>
        <td>
            <b>Email</b><br>
            <i>Email</i>
        </td>
        <td colspan="3">
            '.$email.'
        </td>
    </tr>

    <tr>
        <td>
            <b>Số điện thoại</b><br>
            <i>Phone</i>
        </td>
        <td colspan="3">
            '.$phone.'
        </td>
    </tr>

    <tr>
        <td>
            <b>Số tiền</b><br>
            <i>Amount</i>
        </td>
        <td colspan="3">
            '.number_format($amount, 0, '', ',').' VND
        </td>
    </tr>

    <tr>
        <td>
            <b>Phương thức thanh toán</b><br>
            <i>Payment Method</i>
        </td>
        <td colspan="3">
            <strong> '.$paymentMethod.' </strong><br><em>'.$paymentName.'</em>
        </td>
    </tr>
    
    <tr>
        <td>
            <b>Nội dung thanh toán</b><br>
            <i>Details of Payment</i>
        </td>
        <td colspan="3">
            '.$remarks.'
        </td>
    </tr>
    
    </tbody></table>';

    $message .= '<div style="text-align:center;margin-top:1em">
        <b>Cám ơn Quý khách đã sử dụng dịch vụ của Bảo Tâm Travel!</b><br>
        <i>Thank you for using Bao Tam services!</i>
    </div>';
    $message .= '<div>
        <font color="#cc0000" size="4" face="times new roman, serif">*<u>&nbsp;Lưu ý:</u>&nbsp;Sau khi nhận được thông báo này đề nghị quý khách liên hệ lại với số 04.6260.1133 hoặc 096.270.1133 để xác nhận lại thông tin thanh toán và đặt dịch vụ.&nbsp;</font>
    </div>';
    $message .= '</div>';
    $message .= '</body></htm>';
    
    // Always set content-type when sending HTML email
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    //$headers[] = "Content-type:text/html;charset=UTF-8";
    $headers[] = "Content-type:text/html;charset=ISO-8859-1";
    
    // More headers
    $headers[] = 'From: <tienvietnguyen1110@gmail.com>';
    //$headers[] = 'Cc: myboss@example.com';

    // send email
    mail($to,$subject,$message,implode("\r\n",$headers));
    //var_dump(mail($to,$subject,$message,implode("\r\n",$headers)));die;
}