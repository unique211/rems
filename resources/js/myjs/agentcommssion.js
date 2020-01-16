$(document).ready(function() {

    var plotid = 0;
    var siteid = 0;

    /*---------btnhideshow-----------------*/
    $(document).on("click", ".btnhideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Save');
        form_clear();


    });
    /*---------login-----------------*/

    $(document).on("click", ".closehideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').show();

        $('.closehideshow').hide();
        $('.btnhideshow').show();
        form_clear();

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






    getallagent();

    function getallagent() {
        $.ajax({
            url: "getdropagent",
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {


                html = '';
                var name = '';

                html += '<option selected disabled value="" >Select</option>';
                //html += '<option   value="0" >N/A</option>';


                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].first_name + "" + data[i].last_name;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#agentname').html(html);

            }
        });
    }

    $(document).on('change', "#agentname", function(e) {
        e.preventDefault();
        var id = $(this).val();
        var saveid = $('#save_update').val();

        if (id > 0) {

            $.ajax({
                data: {
                    id: id,

                },
                url: getallsite,
                type: "POST",
                dataType: 'json',
                // async: false,
                success: function(data) {


                    var html = '';
                    if (data.length > 0) {
                        var name = '';

                        html += '<option selected disabled value="" >Select</option>';
                        //html += '<option   value="0" >N/A</option>';


                        for (i = 0; i < data.length; i++) {
                            var id = '';

                            name = data[i].site_name;
                            id = data[i].id;



                            html += '<option value="' + id + '">' + name + '</option>';
                        }
                        $('#sitename').html(html);

                    } else {
                        swal("This Agent Not Allocate Site !!!");
                    }
                }
            });
            if (saveid > 0) {

                $('#sitename').val(siteid).trigger('change');
            }
        }
    });

    $(document).on('change', "#sitename", function(e) {
        e.preventDefault();
        var id = $(this).val();
        var agent = $('#agentname').val();
        var saveid = $('#save_update').val();
        if (id > 0) {
            $.ajax({
                data: {
                    id: id,
                    agent: agent,
                },
                url: getsiteploat,
                type: "POST",
                dataType: 'json',
                // async: false,
                success: function(data) {
                    html = '';
                    if (data.length > 0) {
                        var name = '';


                        html += '<option selected disabled value="" >Select</option>';

                        for (i = 0; i < data.length; i++) {
                            var id = '';

                            name = data[i].plots_no;
                            id = data[i].id;



                            html += '<option value="' + id + '">' + name + '</option>';
                        }
                        $('#ploats').html(html);
                        if (saveid > 0) {
                            $('#ploats').val(plotid).trigger('change');
                        }

                    } else {
                        swal("This Site  Not Allocate Plot To This Agent !!!");
                    }
                }
            });
        }

    });

    $(document).on('change', "#ploats", function(e) {
        e.preventDefault();
        var id = $(this).val();
        var agent = $('#agentname').val();
        var sitename = $('#sitename').val();

        var saveid = $('#save_update').val();

        $.ajax({
            data: {
                id: id,
                agent: agent,
                sitename: sitename,
            },
            url: getcommssioninfo,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {




                $('#openingbalance').val(data);

            }
        });

        getcommsioninformation();


    });

    function getcommsioninformation() {
        var id = $('#ploats').val();
        var agent = $('#agentname').val();
        var sitename = $('#sitename').val();

        $.ajax({
            data: {
                id: id,
                agent: agent,
                sitename: sitename,
            },
            url: getcommssiondata,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                var html = '';
                var remain = 0;
                var opening = 0;
                var credit = '';
                $('#paymenttabletbody').html('');
                // if ($.fn.DataTable.isDataTable('#commssiontb')) {
                //     $('#commssiontb').DataTable().destroy();
                // }

                for (var i = 0; i < data.length; i++) {

                    if (data[i].amtinfo == "cr") {
                        remain = parseFloat(opening) + parseFloat(data[i].amount);
                        credit = 'Credit';
                    } else {
                        remain = parseFloat(opening) - parseFloat(data[i].amount);
                        credit = 'Debit';
                    }

                    html = '<tr>' +
                        '<td id="id_' + data[i].id + '">' + data[i].created_at + '</td>' +
                        '<td  id="opening_' + data[i].id + '">' + opening + '</td>' +

                        '<td  id="acamount_' + data[i].id + '">' + data[i].amount + '</td>' +
                        '<td id="creditamt_' + data[i].id + '">' + credit + '</td>' +
                        '<td id="remainamt_' + data[i].id + '">' + remain + '</td>' +
                        '<td class="not-export-column" >';
                    if (editrt == 1) {
                        html += '<button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                            data[i].id +
                            '><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delrt == 1) {
                        html += '<button name = "delete" value = "Delete" class = "delete_data btn btn-xs btn-danger" id = ' + data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    if (delrt == 0 && editrt == 0) {
                        html += "N/A";
                    }

                    html += '</td>' +
                        '</tr>';

                    opening = remain;

                    $('#paymenttabletbody').append(html);

                }
                // $('#commssiontb').DataTable({});





            }
        });

    }

    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();

        $('.btnhideshow').trigger('click');

        var id = $(this).attr("id");
        $('#save_update').val(id);

        var opening_ = $('#opening_' + id).html();
        var acamount_ = $('#acamount_' + id).html();
        var remainamt_ = $('#remainamt_' + id).html();
        var amtinfo_ = $('#creditamt_' + id).html();

        if (creatert == 0) {
            $('#btnsavedata').prop("disabled", false);
            $('#amt').prop("disabled", false);
        }


        if (amtinfo_ == "Credit") {
            $("#credit").prop("checked", true);
        } else {
            $("#debit").prop("checked", true);
        }
        $('#openingbalance').val(opening_);
        $('#amt').val(acamount_);
        $('#remainamt').val(remainamt_);

    });

    $(document).on('blur', "#payamount", function(e) {
        e.preventDefault();
        var openingbalance = $('#openingbalance').val();
        var payamount = $('#payamount').val();
        var remainamt = 0;

        if (payamount > 0 && openingbalance > 0) {
            remainamt = parseFloat(openingbalance) - parseFloat(payamount);
        }
        $('#remainamt').val(remainamt);
    });

    $(document).on('change', ".crradio", function(e) {
        e.preventDefault();
        var crdr = $('input[name=amtinfo]:checked').val();

        var openingbalance = $('#openingbalance').val();
        var amt = $('#amt').val();
        var remain = 0;
        if (amt > 0 && openingbalance >= 0)
            if (crdr == "cr") {
                remain = parseFloat(openingbalance) + parseFloat(amt);
            } else {
                remain = parseFloat(openingbalance) - parseFloat(amt);
            }
        $('#remainamt').val(remain);
    });

    $(document).on('blur', ".amtdata", function(e) {
        e.preventDefault();
        var crdr = $('input[name=amtinfo]:checked').val();

        var openingbalance = $('#openingbalance').val();
        var amt = $('#amt').val();
        var remain = 0;
        if (amt > 0 && openingbalance >= 0)
            if (crdr == "cr") {
                remain = parseFloat(openingbalance) + parseFloat(amt);
            } else {
                remain = parseFloat(openingbalance) - parseFloat(amt);
            }
        $('#remainamt').val(remain);
    });

    //for submite event of ploat allocation

    $(document).on('submit', '#agent_commssion', function(e) {
        e.preventDefault();

        var agentname = $('#agentname').val();
        var sitename = $('#sitename').val();
        var ploats = $('#ploats').val();
        var amount = $('#amt').val();
        var openingbalance = $('#openingbalance').val();

        var crdr = $('input[name=amtinfo]:checked').val();



        var save_update = $('#save_update').val();

        $.ajax({
            data: {

                save_update: save_update,
                agentname: agentname,
                sitename: sitename,
                amount: amount,
                crdr: crdr,
                ploats: ploats,
                openingbalance: openingbalance,

            },
            url: add_data,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                getcommsioninformation();
                successTost("Opration Save Success fully!!!");

                if (creatert == 0) {
                    $('#btnsavedata').prop("disabled", true);
                    $('#amt').prop("disabled", true);
                }
                form_clear();
            }
        });


    });

    // datashow()

    function datashow() {
        $.ajax({
            url: getalldata,
            type: "GET",
            //   data: new FormData(this),
            data: {

            },
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {
                var html = '';
                var sr = 0;
                var agent = "";
                html += '<table id="myTable" class="table table-hover table-striped  table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" ># </th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Agent Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"  >Site  Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Plot</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Amount</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Credit</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;


                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + data[i].firstname + "" + data[i].lastname + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + data[i].site_name + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].amount + '</td>' +


                        '<td style="display:none;" id="agent_id_' + data[i].id + '">' + data[i].agent_id + '</td>' +
                        '<td style="display:none;" id="site_id_' + data[i].id + '">' + data[i].site_id + '</td>' +
                        '<td style="display:none;" id="ploats_id_' + data[i].id + '">' + data[i].ploats_id + '</td>' +
                        '<td style="display:none;" id="amtinfo_' + data[i].id + '">' + data[i].amtinfo + '</td>' +





                        '<td class="not-export-column" ><button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                        data[i].id +
                        '  status=' + data[i].status + '><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                        data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';

                }
                $('#show_master').html(html);
                $('#myTable').DataTable({});

            }

        });
    }

    //fpr edit



    function form_clear() {
        $('#save_update').val('');
        $('#customername').val('').trigger('change');
        $('#sitename').val('').trigger('change');
        $('#totalarea').val('');
        $('#amount').val('');
        $('#ploats').val('').trigger('change');
        $('#agent').val('').trigger('change');
        $('#openingbalance').val('0');
        $('#amt').val('0');
        //$('#remainamt').val('0');

        $('#payamount').val('');

        $('#paymentmode').val('');
        $('#remark').val('');
        $('#bankname').val('');
        $('#branch').val('');
        $('#chequeno').val('');
        $('#checktime').val('');
        $('#accountno').val('');
        $('#tnote').val('');

    }

    //Delete  Button Code Strat  Here------

    $(document).on('click', '.delete_data', function() {
        var id1 = $(this).attr('id');

        if (id1 != "") {
            swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this Data !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        type: "GET",
                        url: delete_data + '/' + id1,
                        success: function(data) {

                            if (data == true) {
                                swal("Deleted !!", "Hey, your Data has been deleted !!", "success");
                                $('.closehideshow').trigger('click');
                                $('#save_update').val("");
                                getcommsioninformation(); //call function show all data
                            } else {
                                errorTost("Data Delete Failed");
                            }

                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });


                    return false;
                });
        }
    });




});
