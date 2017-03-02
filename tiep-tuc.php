<div id="confirmStep" class="">
    <h1>Xác nhận thông tin</h1>
    <div class="form-row">
        <label>
            <span class="lbl">Họ tên: </span>
            <span class="lblValue"> Cao Van Minh </span>
        </label>
    </div>
    <div class="form-row">
        <label>
            <span class="lbl">Email: </span>
            <span class="lblValue"> caovanminh@gmail.com </span>
        </label>
    </div>

    <div class="form-row">
        <label>
            <span class="lbl">Số điện thoại: </span>
            <span class="lblValue"> 9347859435 </span>
        </label>
    </div>

    <div class="form-row">
        <label>
            <span class="lbl">Số tiền: </span>
            <span class="lblValue"> 500,000 <small>đ</small> </span>
        </label>
    </div>
    <div class="form-row">
        <label>
            <span class="lbl">Phương Thức Thanh Toán: </span>
            <span class="lblValue"> THẺ ATM NỘI ĐỊA <br/><em>Ngân hàng Ngoại thương Việt Nam (Vietcombank)</em></span>
        </label>
    </div>
    <div class="form-row">
        <form action="#" method="POST">
            <button type="submit" id="btnSubmit" name="btnPayNow">THANH TOÁN NGAY</button>
            <button type="button" name="btnback" id="btnBack"> SỬA THÔNG TIN</button>
            <input type="hidden" name="customer_name" value="Cao Van Minh"/>
            <input type="hidden" name="customer_email" value="caovanminh@gmail.com"/>
            <input type="hidden" name="customer_phone" value="9347859435"/>
            <input type="hidden" name="payment_type" value="Bank"/>
            <input type="hidden" name="payment_card_name" value=""/>
            <input type="hidden" name="payment_bank_name" value="Vietcombank"/>
            <input type="hidden" name="total" value="500000"/>
            <input type="hidden" name="customer_note" value=""/>
            <input type="hidden" name="bookingid" value=""/>
            <input type="hidden" name="token" value=""/>
        </form>
    </div>
</div>