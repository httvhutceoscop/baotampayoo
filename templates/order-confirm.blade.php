<!DOCTYPE html>
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
    </style>
</head>
<body bgcolor="#f6f6f6">
<table width="100%"  style="margin-top: 10px;" >
    <tr>
        <td></td>
        <td bgcolor="#1fb5ad" width="600" height="47">
            <div>
                <table>
                    <tr>
                        <td align="left" style="padding-left: 10px">
                            <img src="{{{ URL::asset('img/logo_company.png') }}}" alt="Company Logo" width="120"/>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td>
        </td>
    </tr>
</table>

<table width="100%">
    <tr>
        <td></td>
        <td bgcolor="#ffffff" style="color:#5a5a5a;" width="600" >
            <div>
                <table>
                    <tr>
                        <td width="600">
                            <table width="100%" style="font-family:Arial,Helvetica,sans-serif;font-size:13px;background:#ffffff" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td width="4%"></td>
                                    <td width="558" align="left"><strong>Kính gửi {{{ @$company->company_name }}},</strong></td>
                                    <td width="25"></td>
                                </tr>
                                <tr>
                                    <td width="4%"></td>
                                    <td height="10">&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="4%"></td>
                                    <td style="color:#555;line-height:18px">Chúng tôi đã nhận được đơn đặt hàng của bạn tại &nbsp;<a href="http://job365.com.vn" target="_blank">Job365.<span class="il">com</span>.vn</a>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25"></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25"></td>
                                    <td>
                                        Mã đơn hàng <strong>{{{ @$order->reference }}}</strong> <span class="il">mua</span> lúc {{{ date('d/m/Y H:i', strtotime(@$order->updated_at))  }}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="4%"></td>
                                    <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;line-height:25px;font-size:13px;font-family:Arial,Helvetica,sans-serif">
                                            <tbody>
                                            <tr>
                                                <th colspan="2" width="100%" align="left" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">
                                                    Thông tin công ty
                                                </th>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    Họ tên
                                                </td>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    {{{ @$company->order_username }}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    Tên công ty
                                                </td>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    {{{ @$company->company_name }}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    Địa chỉ
                                                </td>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    {{{ @$company->address }}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    Mã số thuế
                                                </td>
                                                <td align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    {{{ @$company->mst }}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="4%"></td>
                                </tr>
                                <tr>
                                    <td width="4%"></td>
                                    <td>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;line-height:25px;font-size:13px;font-family:Arial,Helvetica,sans-serif">
                                            <tbody>
                                                <tr>
                                                    <th width="36%" align="left" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">Dịch vụ</th>
                                                    <th width="15%" align="center" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">Số lượng</th>
                                                    <th width="17%" align="center" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">Đơn giá</th>
                                                    <th width="15%" align="center" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">Tiết kiệm</th>
                                                    <th width="17%" align="right" style="background:#efefef;color:#000000;padding:5px;border:1px solid #e0e0e0">Thành tiền</th>
                                                </tr>
                                                @if(@$order_details)
                                                    @foreach($order_details as $detail)
                                                        <tr>
                                                            <td width="36%" align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;line-height:21px;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                                {{{ @$m_order_service[$detail->service_id] }}}
                                                            </td>
                                                            <td width="15%" align="center" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                                {{{ number_format($detail->amount) }}}
                                                            </td>
                                                            <td width="17%" align="center" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                                {{{ number_format($detail->price) }}}
                                                            </td>
                                                            <td width="15%" align="center" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                               {{{ $detail->sale_off }}} %
                                                            </td>
                                                            <td width="17%" align="right" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                                {{{ number_format($detail->total_price) }}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            <tr>

                                                <td colspan="4" align="right" valign="middle" style="padding:3px;border-bottom:1px dotted #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    <div><strong>Tổng cộng tiền thanh toán</strong></div>
                                                    <div>(đã bao gồm VAT)</div>
                                                </td>
                                                <td align="right" valign="middle" style="padding:3px;border-bottom:1px dotted #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555">
                                                    <strong>{{{ number_format($order->total_price) }}} VND</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="left" valign="middle" style="padding:3px;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555;line-height:16px">
                                                    <strong>Hình thức thanh toán: Chuyển Khoản</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="left" valign="middle" style="padding:3px;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555;line-height:16px">
                                                    <ul style="padding-left: 40px">
                                                        <li>
                                                            Ngân hàng <strong>Vietcombank</strong> (Chi nhánh Hà Nội): <strong>0211000422932</strong> - Chủ Tài Khoản: <strong>Le Thanh Hai</strong>
                                                        </li>
                                                    </ul>&nbsp;
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="left" valign="middle" style="padding:3px;border-bottom:1px solid #e0e0e0;border-left:1px solid #e0e0e0;border-right:1px solid #e0e0e0;color:#555;line-height:16px">
                                                    Vui lòng nhập mã đơn hàng <strong> {{{ @$order->reference }}} </strong> vào nội dung chuyển khoản để tiện việc kiểm tra
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                    <td width="4%"></td>
                                </tr>
                                <tr>
                                    <td width="4%"></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="25"></td>
                                    <td>&nbsp;</td>
                                    <td width="4%"></td>
                                </tr>

                                <tr>
                                    <td width="25"></td>
                                    <td><span style="font-size:13px;padding:5px 0"><span class="il">Job365</span> rất cảm ơn và mong tiếp tục nhận được sự ủng hộ của bạn</span><br>
                                    </td>
                                    <td width="25"></td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="color:#dfdfe0;text-align:center">
                    <tbody>
                    <tr height="20">
                        <td colspan="3"></td>
                    </tr>
                    <tr height="1">
                        <td height="1" width="600" bgcolor="#f1f1f1"></td>
                    </tr>
                    <tr height="10">
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td width="600">
                            <p style="font-size:16px;color:#1fb5ad"><b>Copyright © Group365 Ltd</b></p>
                            <p style="margin:0;font-size:13px;color:#505050">{{{trans('site/common.company_address')}}}</p>
                            <p style="margin:0;font-size:13px;color:#505050">Email: <a href="mailto:{{{trans('site/common.company_email')}}}" style="color:#505050" target="_blank">{{{trans('site/common.company_email')}}}</a></p>
                        </td>
                    </tr>
                    <tr height="20">
                        <td colspan="3"></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </td>
        <td>
        </td>
    </tr>
</table>

</body>
</html>
