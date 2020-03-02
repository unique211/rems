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
            url: "getallagentdrop",
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
                html += '<option selected  value="All" >All</option>';


                for (i = 0; i < data.length; i++) {
                    var id = '';

                    name = data[i].agent_name;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#agentname').html(html);

            }
        });
    }

    getallsiteinfo();

    function getallsiteinfo() {
        $.ajax({
            data: {


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

                }
            }
        });
    }


    $(document).on('change', "#sitenm", function(e) {
        e.preventDefault();
        var id = $(this).val();

        if (id > 0) {
            $.ajax({
                data: {
                    id: id,

                },
                url: siteploats,
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

                    }
                }
            });
        }

    });




    $(document).on('change', "#plot", function(e) {
        e.preventDefault();
        var id = $(this).val();

        if (id > 0) {
            $.ajax({
                data: {
                    id: id,

                },
                url: getploatsagent,
                type: "POST",
                dataType: 'json',
                // async: false,
                success: function(data) {
                    html = '';
                    $('#agentname').html('');
                    if (data.length > 0) {
                        var name = '';


                        html += '<option selected disabled value="" >Select</option>';



                        for (i = 0; i < data.length; i++) {
                            var id = '';

                            name = data[i].agent_name;
                            id = data[i].id;



                            html += '<option value="' + id + '">' + name + '</option>';
                        }
                        $('#agentname').html(html);


                    }
                }
            });
        } else {
            getallagent();
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
                var table = $('#categorytb').DataTable();
                table.destroy();
                $('#categorytbody').html('');
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + data[i].sitename + '</td>' +
                        '<td  id="lastname_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].agentnm + '</td>' +
                        '<td style="text-align:right;" id="amt_' + data[i].id + '">' + data[i].commssion + '</td>' +
                        '<td style="text-align:right;" id="balance' + data[i].id + '">' + data[i].paid + '</td>' +
                        '<td style="text-align:right;" id="remain' + data[i].id + '">' + data[i].remain + '</td>' +
                        '</tr>';
                }
                $('#categorytbody').html(html);
                //$('#myTable').DataTable({});
                $('#categorytb').DataTable({
                    dom: 'Bfrtip',
                    buttons: [

                        'excelHtml5',

                        'pdfHtml5'
                    ]

                });

                $(".buttons-pdf").removeClass("btn")
                $(".buttons-excel").removeClass("btn")
            }
        });


    });

    datashow()



    function datashow() {
        $.ajax({
            url: getagentrep,
            type: "POST",
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
                var table = $('#categorytb').DataTable();
                table.destroy();
                $('#categorytbody').html('');
                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="c_name_' + data[i].id + '">' + data[i].sitename + '</td>' +

                        '<td  id="lastname_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        // '<td id="email_' + data[i].id + '">' + data[i].plots_no + '</td>' +
                        '<td id="amt_' + data[i].id + '">' + data[i].agentnm + '</td>' +

                        '<td style="text-align:right;" id="amt_' + data[i].id + '">' + data[i].commssion + '</td>' +
                        '<td style="text-align:right;" id="balance' + data[i].id + '">' + data[i].paid + '</td>' +
                        '<td style="text-align:right;" id="remain' + data[i].id + '">' + data[i].remain + '</td>' +
                        '</tr>';

                }
                $('#categorytbody').html(html);
                $('#categorytb').DataTable({
                    dom: 'Bfrtip',
                    buttons: [

                        'excelHtml5',

                        'pdfHtml5'
                    ]

                });

                $(".buttons-pdf").removeClass("btn")
                $(".buttons-excel").removeClass("btn")
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

    $(document).on('change', '.dateinfo', function() {

        var minbooktime = DateCheck();

        if (minbooktime == 1) {
            swal('From Date is Grather Than To Date ');
            $('#btnsavedata').attr('disabled', true);
        } else {
            $('#btnsavedata').attr('disabled', false);
        }
    });

    function DateCheck() {
        var StartDate = $('#fromdate').val();

        var EndDate = $('#todate').val();
        if (Date.parse(StartDate) <= Date.parse(EndDate)) {
            return 0;
        } else {
            return 1;
        }



    }



});