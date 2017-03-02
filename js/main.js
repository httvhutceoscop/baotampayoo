$(document).ready(function(){

    //for init
    if ($(".selectPayMethod:checked") !== null && $(".selectPayMethod:checked").val() == 'Bank') {
        // show and select bank
        var bankName = $("#atmBankName").val();
        if (bankName != '') {
            var currentBank = $("#imgPaygate_"+bankName);
            $("#iconChoose").show().appendTo($(currentBank).parent());
            currentBank.parent().addClass("chooseBank");
            currentBank.closest("li").siblings("li").hide();
            $("#select-other-bank").show();
        }
        $("#wrap-listCard").show();
    } else if ($(".selectPayMethod:checked") !== null && $(".selectPayMethod:checked").val() == 'Visa') {
        var bankNameInter = $("#interCardName").val();
        if (bankNameInter != '') {
            var currentBankInter = $("#imgPaygate_"+bankNameInter);
            $("#iconChoose").show().appendTo($(currentBankInter).parent());
            currentBankInter.parent().addClass("chooseBank");
            currentBankInter.closest("li").siblings("li").hide();
            $("#select-other-bank-inter").show();
        }
        $("#wrap-listCard-inter").show();
    }

    //when choose payment method
    $(".selectPayMethod").click(function(){
        var idPay = $(this).attr("id");
        if (idPay == "pay-by-atm") {
            if (!$("#wrap-listCard").is(":visible")) {
                $("#wrap-listCard").slideDown();
                $("#iconChoose").hide();
            }
            if ($("#wrap-listCard-inter").is(":visible")) {
                $("#wrap-listCard-inter").slideUp();

                $("#listCardInter a.chooseBank").removeClass("chooseBank");
                $("#iconChoose").hide();
                $("#interCardName").val('');
                $("#select-other-bank-inter").hide().siblings("li").show();
            }
        } else if(idPay == "pay-by-visa"){
            if (!$("#wrap-listCard-inter").is(":visible")) {
                $("#wrap-listCard-inter").slideDown();
                $("#iconChoose").hide();
            }
            if ($("#wrap-listCard").is(":visible")) {
                $("#wrap-listCard").slideUp();

                $("#listCard a.chooseBank").removeClass("chooseBank");
                $("#iconChoose").hide();
                $("#atmBankName").val('');
                $("#select-other-bank").hide().siblings("li").show();
            }
        } else{
            if ($("#wrap-listCard").is(":visible")) {
                $("#wrap-listCard").slideUp();

                $("#listCard a.chooseBank").removeClass("chooseBank");
                $("#iconChoose").hide();
                $("#atmBankName").val('');
                $("#select-other-bank").hide().siblings("li").show();
            } else if ($("#wrap-listCard-inter").is(":visible")) {
                $("#wrap-listCard-inter").slideUp();

                $("#listCardInter a.chooseBank").removeClass("chooseBank");
                $("#iconChoose").hide();
                $("#interCardName").val('');
                $("#select-other-bank-inter").hide().siblings("li").show();
            }
        }

    });


    $(".bankInfo").click(function(e){
        var bankName = $(this).attr("id").split('_')[1];
        $("#atmBankName").val(bankName);

        $("#iconChoose").show().appendTo($(this).parent());
        $("#listCard a.chooseBank").removeClass("chooseBank");
        $(this).parent().addClass("chooseBank");
        $(this).closest("li").siblings("li").hide();
        $("#select-other-bank").show();
    });
    $(".cardInfo").click(function(e){
        var cardName = $(this).attr("id").split('_')[1];
        $("#interCardName").val(cardName);

        $("#iconChoose").show().appendTo($(this).parent());
        $("#listCardInter a.chooseBank").removeClass("chooseBank");
        $(this).parent().addClass("chooseBank");
        $(this).closest("li").siblings("li").hide();
        $("#select-other-bank-inter").show();
    });

    $("#select-other-bank").click(function(){
        $(this).hide().siblings("li").show();
        $("#listCard a.chooseBank").removeClass("chooseBank");
        $("#iconChoose").hide();
        $("#atmBankName").val('');
    })

    $("#select-other-bank-inter").click(function(){
        $(this).hide().siblings("li").show();
        $("#listCardInter a.chooseBank").removeClass("chooseBank");
        $("#iconChoose").hide();
        $("#interCardName").val('');
    })



    // For tooltip
    $('[data-toggle="tooltip"]').tooltip();



    $(".menu-item").click(function (e) {
            e.preventDefault();
            $(this).addClass("current-menu-item").siblings().removeClass("current-menu-item");
            var contentId = $(this).find("a").attr("href");
            $(contentId).show().siblings(".tabContent").hide();
            if ($("#colslapMenu").is(":visible")) {
                $("#bottom-header").slideUp();
            }
        })

        $("#btnBack").click(function (e) {
            e.preventDefault();
            $("#confirmStep").hide();
            $("#payment-info").show();
            return false;
        })

        $("#colslapMenu").click(function (e) {
            e.preventDefault();
            $("#bottom-header").slideToggle(1);
        })
})