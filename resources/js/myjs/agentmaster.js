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
                form_clear();

                successTost("Opration Save Success fully!!!");
                $('.closehideshow').trigger('click');
                datashow();
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

                var html = '';
                var sr = 0;
                html += '<table id="myTable" class="table table-hover table-striped  table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" ># </th>' +
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
                        '<td  id="first_name_' + data[i].id + '">' + data[i].first_name + '</td>' +
                        '<td  id="lastname_' + data[i].id + '">' + data[i].last_name + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].email + '</td>' +
                        '<td id="city_' + data[i].id + '">' + data[i].city + '</td>' +
                        '<td id="state_' + data[i].id + '">' + data[i].state + '</td>' +
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


    function form_clear() {
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

        $('#save_update').val('');
    }


    $('#docupload').change(function() {

        if ($(this).val() != '') {
            profileupload(this);

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
        var id = $(this).attr("id");
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
                $('#lastname').val(data[0].last_name);
                $('#email').val(data[0].email);
                $('#city').val(data[0].city);
                $('#state').val(data[0].state);
                $('#contry').val(data[0].contry);
                $('#pincode').val(data[0].pincode);
                $('#bankname').val(data[0].bankname);
                $('#branch').val(data[0].branch_name);
                $('#accno').val(data[0].account_no);
                $('#ifsccode').val(data[0].ifsc_code);
                $('#accountholder').val(data[0].account_holder_name);
                if (data[0].profilepicture != null) {
                    $('#msgid').html(data[0].profilepicture);
                    $('#file_hidden').val(data[0].profilepicture);
                    $('#infoimages').attr('src', imgurl + '/profile/' + data[0].profilepicture);

                }


            }
        });
    });

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