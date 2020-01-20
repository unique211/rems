$(document).ready(function() {

    var plotid = 0;
    var siteid = 0;




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
                        html += '<option selected  value="All" >All</option>';
                        //html += '<option   value="0" >N/A</option>';


                        for (i = 0; i < data.length; i++) {
                            var id = '';

                            name = data[i].site_name;
                            id = data[i].id;



                            html += '<option value="' + id + '">' + name + '</option>';
                        }
                        $('#sitenm').html(html);

                    } else {
                        swal("This Agent Not Allocate Site !!!");
                    }
                }
            });

        }
    });

    $(document).on('change', "#sitenm", function(e) {
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
                        html += '<option   value="All" >All</option>';


                        for (i = 0; i < data.length; i++) {
                            var id = '';

                            name = data[i].plots_no;
                            id = data[i].id;



                            html += '<option value="' + id + '">' + name + '</option>';
                        }
                        $('#plot').html(html);
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












    //for submite event of ploat allocation

    $(document).on('submit', '#agentrep_form', function(e) {
        e.preventDefault();

        var agentname = $('#agentname').val();
        var sitenm = $('#sitenm').val();
        var plot = $('#plot').val();



        var fromdate = '';
        var todate = '';
        if ($('#frmdate').prop("checked") == true) {
            var fromdate = $('#fromdate').val();
            var todate = $('#todate').val();

            var tdateAr = fromdate.split('/');
            fromdate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];
            var tdateAr = todate.split('/');
            todate = tdateAr[2] + '-' + tdateAr[1] + '-' + tdateAr[0];

        } else if ($('#frmdate').prop("checked") == false) {
            fromdate = '';
            todate = '';
        }



        $.ajax({
            data: {


                agentname: agentname,
                sitenm: sitenm,
                plot: plot,
                fromdate: fromdate,
                todate: todate,

            },
            url: getdata,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                var sr = 0;
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    // var fdateslt = data[i].date.split('-');
                    // var time = fdateslt[2].split(' ');
                    // var checkouttime = time[0] + '/' + fdateslt[1] + '/' + fdateslt[0];
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + data[i].date + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + data[i].site_name + "-" + data[i].plots_no + '</td>' +
                        // '<td id="email_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].cramt + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].amtinfo + '</td>' +
                        '<td id="balance' + data[i].id + '">' + data[i].balance + '</td>' +
                        '</tr>'
                }
                $('#categorytbody').html(html);
                //$('#myTable').DataTable({});


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
                        '<td  id="c_name_' + data[i].id + '">' + checkouttime + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + data[i].site_name + "-" + data[i].plots_no + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].crtoamt + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].amtinfo + '</td>' +


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