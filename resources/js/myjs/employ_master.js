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
        $('#passhide').show();
        $('#password').prop('required', true);
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
        $('#passhide').show();
        $('#password').prop('required', true);
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
    $(document).on('submit', '#employee_form', function(e) {
        e.preventDefault();


        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var mobileno = $('#mobileno').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var role = $('#role').val();
        var profilepic = $('#file_hidden').val();

        var save_update = $('#save_update').val();


        $.ajax({
            data: {

                firstname: firstname,
                lastname: lastname,
                email: email,
                profilepic: profilepic,
                mobileno: mobileno,
                username: username,
                password: password,

                role: role,
                save_update: save_update,

            },
            url: adddata,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                form_clear();

                successTost("Opration Save Success fully!!!");
                $('.closehideshow').trigger('click');
                if (editrt == 1) {
                    $('.formhideshow').hide();
                    $('.tablehideshow').show();
                }
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

                $('#wait').hide();
                var html = '';
                var sr = 0;
                html += '<table id="myTable" class="table table-hover table-striped  table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">' +
                    '<thead>' +
                    '<tr>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" ># </th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >First Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"  >Last Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Email</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Mobile NO</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px; " >Role</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none;" >Role</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;display:none; " >Role</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;

                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="first_name_' + data[i].id + '">' + data[i].firstname + '</td>' +
                        '<td  id="lastname_' + data[i].id + '">' + data[i].last_name + '</td>' +
                        '<td id="email_' + data[i].id + '">' + data[i].email + '</td>' +
                        '<td id="mobile_no_' + data[i].id + '">' + data[i].mobile_no + '</td>' +
                        '<td id="rolename_' + data[i].id + '">' + data[i].rolename + '</td>' +
                        '<td  style="display:none;" id="role_' + data[i].id + '">' + data[i].role + '</td>' +
                        '<td style="display:none;" id="profilepic_' + data[i].id + '">' + data[i].profile_pic + '</td>' +
                        '<td class="not-export-column" >';
                    // <button name="edit"  value="edit" class="edit_data btn btn-xs btn-success" id=' +
                    // data[i].id +
                    // '  status=' + data[i].status + '><i class="fa fa-edit"></i></button>&nbsp;<button name="delete" value="Delete" class="delete_data btn btn-xs btn-danger" id=' +
                    // data[i].id + '><i class="fa fa-trash"></i></button></td>' +
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
        $('#infoimages').attr('src', imgurl + '/resources/sass/images/userpic.jpg');
        $('#save_update').val('');
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
        var id = $(this).attr("id");
        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }
        $('#save_update').val(id);
        var first_name = $('#first_name_' + id).html();
        var lastname = $('#lastname_' + id).html();
        var email = $('#email_' + id).html();
        var mobile_no_ = $('#mobile_no_' + id).html();
        var role_ = $('#role_' + id).html();
        var profilepic_ = $('#profilepic_' + id).html();


        $('#firstname').val(first_name);
        $('#lastname').val(lastname);
        $('#email').val(email);
        $('#mobileno').val(mobile_no_);

        $('#role').val(role_).trigger('change');


        if (profilepic_ != "null") {
            $('#msgid').html(profilepic_);
            $('#file_hidden').val(profilepic_);
            $('#infoimages').attr('src', imgurl + '/profile/' + profilepic_);

        }


        $.ajax({
            data: {
                id: id,

            },
            url: editurl,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                $('#username').val(data[0].user_name);
                $('#passhide').hide();
                $('#password').prop('required', false);

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
    getallrole();

    function getallrole() {
        $.ajax({
            url: "getdroprole",
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

                    name = data[i].rolename;
                    id = data[i].id;



                    html += '<option value="' + id + '">' + name + '</option>';
                }
                $('#role').html(html);

            }
        });
    }


});