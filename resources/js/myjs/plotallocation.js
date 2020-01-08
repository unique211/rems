$(document).ready(function() {



    /*---------btnhideshow-----------------*/
    $(document).on("click", ".btnhideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Save');


    });
    /*---------login-----------------*/

    $(document).on("click", ".closehideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').show();

        $('.closehideshow').hide();
        $('.btnhideshow').show();


    });
    $('.edittb').hide();
    $(document).on("click", "#editperson", function(e) {
        e.preventDefault();
        $('.edittb').show();
        $('.lbldata').hide();


    });

    $(document).on("click", "#btnsave", function(e) {
        e.preventDefault();
        $('.edittb').hide();
        $('.lbldata').show();


    });


    $(document).on('click', ".edit", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Update');



    });





    $(document).on('blur', ".areainsqf", function(e) {
        e.preventDefault();
        var total = 0;
        $('.areainsqf').each(function() {
            var val = $(this).val();


            if (val > 0) {
                total = parseFloat(total) + parseFloat(val);
            }

        });
        $('#totalarea').val(total);

    });


    $(document).on('change', "#paymentmode", function(e) {
        e.preventDefault();
        var mode = $(this).val();

        if (mode == "Cash") {

            $('.cashinfo').show();
            $('.chequeinfo').hide();
            $('.neftinfo').hide();
        } else if (mode == "Cheque") {
            $('.cashinfo').hide();
            $('.chequeinfo').show();
            $('.neftinfo').hide();

        } else if (mode == "NEFT" || mode == "RTGS" || mode == "Other") {
            $('.cashinfo').hide();
            $('.chequeinfo').hide();
            $('.neftinfo').show();
        }


    });
    $('.chequeinfo').hide();
    $('.neftinfo').hide();

});