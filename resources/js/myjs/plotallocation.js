$(document).ready(function() {

    var plotid = 0;

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


    //for getting all Customer
    getallcustomer();

    function getallcustomer() {
        $.ajax({
            url: "getdropcustomer",
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {

                html = '';
                var name = '';

                html += '<option selected disabled value="" >Select</option>';

                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].first_name + "" + data[i].last_name;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#customername').html(html);

            }
        });
    }

    getallsites();

    function getallsites() {
        $.ajax({
            url: "getdropsites",
            type: "GET",

            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(data) {


                html = '';
                var name = '';

                html += '<option selected disabled value="" >Select</option>';



                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].site_name;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#sitename').html(html);

            }
        });
    }

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
                html += '<option   value="0" >N/A</option>';


                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].first_name + "" + data[i].last_name;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#agent').html(html);

            }
        });
    }

    $(document).on('change', "#sitename", function(e) {
        e.preventDefault();
        var id = $(this).val();
        var saveid = $('#save_update').val();
        $.ajax({
            data: {
                id: id,
                saveid: saveid,
            },
            url: getsiteploat,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                html = '';
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

            }
        });

    });

    $(document).on('change', "#ploats", function(e) {
        e.preventDefault();
        var id = $(this).val();

        var saveid = $('#save_update').val();
        $.ajax({
            data: {
                id: id,

            },
            url: getploatamtsqft,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                $('#amount').val(data[0].cost);
                $('#totalarea').val(data[0].area_insqft);

                if (saveid == "") {
                    $('#openingbalance').val(data[0].cost);
                }
            }
        });
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

    //for submite event of ploat allocation

    $(document).on('submit', '#ploat_allocation_form', function(e) {
        e.preventDefault();

        var customername = $('#customername').val();
        var sitename = $('#sitename').val();
        var totalarea = $('#totalarea').val();
        var amount = $('#amount').val();
        var ploats = $('#ploats').val();
        var agent = $('#agent').val();
        var openingbalance = $('#openingbalance').val();

        var payamount = $('#payamount').val();
        var remainamt = $('#remainamt').val();
        var paymentmode = $('#paymentmode').val();
        var remark = $('#remark').val();
        var bankname = $('#bankname').val();
        var branch = $('#branch').val();
        var chequeno = $('#chequeno').val();
        var checktime = $('#checktime').val();
        var accountno = $('#accountno').val();
        var tnote = $('#tnote').val();


        var save_update = $('#save_update').val();

        if (checktime != "") {
            var tdateAr = checktime.split('/');
            checktime = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
        }





        $.ajax({
            data: {

                save_update: save_update,
                customername: customername,
                sitename: sitename,
                totalarea: totalarea,
                amount: amount,
                ploats: ploats,
                agent: agent,
                openingbalance: openingbalance,
                payamount: payamount,
                remainamt: remainamt,
                paymentmode: paymentmode,
                remark: remark,
                bankname: bankname,
                branch: branch,
                chequeno: chequeno,
                checktime: checktime,
                accountno: accountno,
                tnote: tnote,
            },
            url: add_data,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {


                successTost("Opration Save Success fully!!!");
                $('.closehideshow').trigger('click');
                if (editrt == 1) {
                    $('.formhideshow').hide();
                    $('.tablehideshow').show();
                }
                datashow();
                form_clear();
            }
        });


    });

    datashow()

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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Customer  Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"  >Site  Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Plot</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Amount</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Agent</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    if (data[i].agent_name == "" && data[i].agent_lastname == "") {
                        agent = "N/A";
                    } else {
                        agent = data[i].agent_name + "" + data[i].agent_lastname;
                    }

                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + data[i].c_name + "" + data[i].c_lastanme + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + data[i].s_name + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].ploat_name + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].amt + '</td>' +
                        '<td id="agent_name_' + data[i].id + '">' + agent + '</td>' +

                        '<td style="display:none;" id="c_id' + data[i].id + '">' + data[i].c_id + '</td>' +
                        '<td style="display:none;" id="s_id' + data[i].id + '">' + data[i].s_id + '</td>' +
                        '<td style="display:none;" id="ploat_id' + data[i].id + '">' + data[i].ploat_id + '</td>' +
                        '<td style="display:none;" id="agent_id' + data[i].id + '">' + data[i].agent_id + '</td>' +




                        '<td class="not-export-column" >';
                    if (editrt == 1) {
                        html += '<button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                            data[i].id +
                            '  status=' + data[i].status + '><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delrt == 1) {
                        html += '<button name = "delete" value = "Delete" class = "delete_data btn btn-xs btn-danger" id = ' + data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    if (delrt == 0 && editrt == 0) {
                        html += "N/A";
                    }
                    html += '</td>' +
                        // <button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                        // data[i].id +
                        // '  status=' + data[i].status + '><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                        // data[i].id + '><i class="fa fa-trash"></i></button></td>' +
                        '</tr>';

                }
                $('#show_master').html(html);
                $('#myTable').DataTable({});

            }

        });
    }

    //fpr edit

    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();

        $('.btnhideshow').trigger('click');
        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }

        var id = $(this).attr("id");
        $('#save_update').val(id);

        var c_id = $('#c_id' + id).html();
        var s_id = $('#s_id' + id).html();
        var ploat_id = $('#ploat_id' + id).html();
        var agent_id = $('#agent_id' + id).html();
        var amt_ = $('#amt_' + id).html();

        plotid = ploat_id;


        $('#customername').val(c_id).trigger('change');

        $('#sitename').val(s_id).trigger('change');
        // $('#totalarea').val().trigger('change');
        $('#amount').val(amt_);

        $('#agent').val(agent_id).trigger('change');


        $.ajax({
            data: {
                id: id,

            },
            url: editurl,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                $('#paymenttabletbody').html('');
                var sumofamt = 0;
                var intial = amt_;
                var paidamt = 0;
                var remainamt = 0;
                var html = '';

                for (var i = 0; i < data.length; i++) {
                    var date = data[i].create_at;
                    var fdateslt = date.split('-');
                    var time = fdateslt[2].split(' ');
                    var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0];

                    paidamt = data[i].amount;
                    sumofamt = parseFloat(sumofamt) + parseFloat(paidamt);
                    var remainamt = parseFloat(intial) - parseFloat(paidamt);
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + checkouttime + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].payment_mode + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + intial + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + paidamt + '</td>' +
                        '<td id="email_' + data[i].id + '">' + remainamt + '</td>' +

                        '</tr>';

                    intial = parseFloat(intial) - parseFloat(paidamt);
                    $('#openingbalance').val(intial);
                }
                $('#paymenttabletbody').html(html);


            }
        });





    });

    function form_clear() {
        $('#save_update').val('');
        $('#customername').val('').trigger('change');
        $('#sitename').val('').trigger('change');
        $('#totalarea').val('');
        $('#amount').val('');
        $('#ploats').val('').trigger('change');
        $('#agent').val('').trigger('change');
        $('#openingbalance').val('');

        $('#payamount').val('');
        $('#remainamt').val('');
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
        if (id1 > 0) {

        } else {
            id1 = $('#save_update').val();
        }


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
                                datashow(); //call function show all data
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
