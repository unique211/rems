$(document).ready(function() {


    /*---------btnhideshow-----------------*/
    $(document).on("click", ".btnhideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Save');
        $('#editperson').hide();
        $('.edittb').show();
        $('.lbldata').hide();
        $('#btnsaveinfo').hide();
        form_clear();
        $('#wait1').hide();

    });
    /*---------login-----------------*/

    $(document).on("click", ".closehideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').show();

        $('.closehideshow').hide();
        $('.btnhideshow').show();
        $('#editperson').hide();
        $('.edittb').show();
        $('.lbldata').hide();
        $('#btnsaveinfo').hide();
        form_clear();
        $('#wait1').hide();


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

    //for submit event
    $(document).on('submit', '#agent_form', function(e) {
        e.preventDefault();


        var advisor_id = $('#advisor_id').val();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var contry = $('#contry').val();
        var pincode = $('#pincode').val();
        var bankname = $('#bankname').val();
        var branch = $('#branch').val();
        var accno = $('#accno').val();
        var ifsccode = $('#ifsccode').val();
        var accountholder = $('#accountholder').val();
        var profileimg = $('#file_hidden').val();

        var save_update = $('#save_update').val();

        $.ajax({
            data: {
                advisor_id: advisor_id,
                firstname: firstname,
                lastname: lastname,
                email: email,
                city: city,
                state: state,
                contry: contry,
                pincode: pincode,

                bankname: bankname,
                branch: branch,
                accno: accno,
                ifsccode: ifsccode,
                save_update: save_update,
                profileimg: profileimg,
                accountholder: accountholder,
            },
            url: add_data,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                if (data == "0") {
                    swal("Agent Advisor id is Exists !");
                } else {
                    form_clear();
                    successTost("Opration Save Success fully!!!");
                    $('.closehideshow').trigger('click');
                    if (editrt == 1) {
                        $('.formhideshow').hide();
                        $('.tablehideshow').show();
                    }
                    datashow();
                }
            }
        });
    });

    datashow();

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
                $('#wait').hide();
                var html = '';
                var sr = 0;
                html += '<table id="myTable" class="table table-hover table-striped  table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" ># </th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Advisor id</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >First Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"  >Last Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Email</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >City</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px; " >State</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="advisorid_' + data[i].id + '">' + data[i].advisor_id + '</td>' +
                        '<td  id="first_name_' + data[i].id + '">' + data[i].first_name + '</td>' +
                        '<td  id="lastname_' + data[i].id + '">' + data[i].last_name + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].email + '</td>' +
                        '<td id="city_' + data[i].id + '">' + data[i].city + '</td>' +
                        '<td id="state_' + data[i].id + '">' + data[i].state + '</td>' +
                        '<td class="not-export-column" >';
                    if (editrt == 1) {
                        html += '<button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                            data[i].id +
                            '  status=' + data[i].status + '><i class="fa fa-edit"></i></button>&nbsp;';
                    }
                    if (delrt == 1) {


                        html += '<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                            data[i].id + '><i class="fa fa-trash"></i></button>';
                    }
                    if (delrt == 0 && editrt == 0) {
                        html += "N/A";
                    }

                    '</td>' +
                    '</tr>';

                }
                $('#show_master').html(html);
                $('#myTable').DataTable({});

            }
        });
    }


    function form_clear() {
        $('#advisor_id').val('');
        $('#firstname').val('');
        $('#lastname').val('');
        $('#email').val('');
        $('#city').val('');
        $('#state').val('');
        $('#contry').val('');
        $('#pincode').val('');
        $('#bankname').val('');
        $('#branch').val('');
        $('#accno').val('');
        $('#ifsccode').val('');
        $('#accountholder').val('');
        $('#infoimages').attr('src', imgurl + '/resources/sass/images/userpic.jpg');
        $('#paymentbar').css('width', '0%');
        $('.progress-value').text('0%');
        $('#save_update').val('');
        $('#msgid').html('');
        $('#file_hidden').val('');
    }


    $('#docupload').change(function() {

        if ($(this).val() != '') {
            profileupload(this);
            $('#wait1').show();

        }
    });

    function profileupload(img) {

        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        // form_data.append('_token', '{{csrf_token()}}');
        //alert(img);
        $.ajax({
            url: profileupload1,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {;
                $('#wait1').hide();
                $('#msgid').html(data);
                $('#file_hidden').val(data);

                $('#infoimages').attr('src', imgurl + '/profile/' + data);


            }
        });
    }

    $(document).on('click', ".edit", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Update');



    });

    //for edit----start
    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();

        $('.btnhideshow').trigger('click');
        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }
        var id = $(this).attr("id");


        $('.edittb').hide();
        $('.lbldata').show();
        $('#btnsaveinfo').show();
        $('#editperson').show();
        $('#save_update').val(id);
        $.ajax({
            data: {
                id: id,

            },
            url: editurl,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                $('#firstname').val(data[0].first_name);
                $('#flable').text(data[0].first_name);


                $('#lastname').val(data[0].last_name);
                $('#llable').text(data[0].last_name);

                $('#email').val(data[0].email);
                $('#elable').text(data[0].email);

                $('#city').val(data[0].city);
                $('#clable').text(data[0].city);

                $('#state').val(data[0].state);
                $('#slable').text(data[0].state);

                $('#advisor_id').val(data[0].advisor_id);
                $('#advidlable').text(data[0].advisor_id);


                $('#contry').val(data[0].contry);
                $('#conlable').text(data[0].contry);

                $('#pincode').val(data[0].pincode);
                $('#pinlable').text(data[0].pincode);

                $('#bankname').val(data[0].bankname);
                $('#branch').val(data[0].branch_name);
                $('#accno').val(data[0].account_no);
                $('#ifsccode').val(data[0].ifsc_code);
                $('#accountholder').val(data[0].account_holder_name);
                if (data[0].profilepicture != null) {
                    $('#msgid').html(data[0].profilepicture);
                    $('#uploadimg').text(data[0].profilepicture);
                    $('#file_hidden').val(data[0].profilepicture);
                    $('#infoimages').attr('src', imgurl + '/profile/' + data[0].profilepicture);

                }


            }
        });

        $.ajax({
            data: {
                id: id,

            },
            url: getpaymentdata,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                var per = data + "%";


                if (data > 0) {
                    $('#paymentbar').css('width', per);
                    $('.progress-value').text(per);
                } else {
                    $('#paymentbar').css('width', per);
                    $('.progress-value').text(per);
                }

            }
        });
    });

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

    $(document).on('click', "#btnsaveinfo", function(e) {
        e.preventDefault();


        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var contry = $('#contry').val();
        var pincode = $('#pincode').val();
        var advisor_id = $('#advisor_id').val();

        var profileimg = $('#file_hidden').val();

        var save_update = $('#save_update').val();

        $.ajax({
            data: {
                save_update: save_update,
                firstname: firstname,
                lastname: lastname,
                email: email,
                city: city,
                state: state,
                contry: contry,
                pincode: pincode,
                profileimg: profileimg,
                advisor_id: advisor_id,
            },
            url: updateagent,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                if (data == '100') {
                    swal("Agent Advisor id is Exists !");
                } else {
                    successTost("Opration Save Success fully!!!");
                    datashow();
                }

            }
        });

    });


});