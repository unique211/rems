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

    $(document).on('click', "#btnupload", function(e) {
        e.preventDefault();



        var profdoc = $("#doctype").val();

        var profdocname = $("#doctype option:selected").text();

        var file = $("#filehidden1").val();
        if (profdoc != "" && file != "") {

            var row_id = $('#doc_row_id').val();
            row_id = parseInt(row_id) + parseInt(1);
            var save_update = $('#doc_save_update').val();
            var dlt = 0;

            var r1 = $('table#documenttb').find('tbody').find('tr');
            var r = r1.length;
            for (var i = 0; i < r; i++) {

                var profid = $(r1[i]).find('td:eq(0)').html();

                if (save_update == "") {
                    if (profid == profdoc) {
                        dlt = parseInt(dlt) + parseInt(1);
                    }
                }
            }

            if (dlt > 0) {
                if (dlt == 1) {
                    swal("Selected Document Already Exists !!!");
                }
                var dlt = 0;

            } else if (save_update != "") {


                $('#profdoctype_' + save_update).html(profdoc);
                $('#profdocname_' + save_update).html(profdocname);
                $('#file_' + save_update).html(file);
                $('#doc_save_update').val('');
                $('#docimages_' + save_update).attr('src', imgurl + '/uploads/' + file);

            } else {


                var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +

                    '<td  style="display:none;" id="profdoctype_' + row_id + '">' + profdoc + '</td>' +
                    '<td  id="profdocname_' + row_id + '">' + profdocname + '</td>' +

                    '<td style="display:none;" id="file_' + row_id + '">' + file + '</td>' +
                    '<td id="fileimgupload_' + row_id + '"> <img  id="docimages_' + row_id + '"  src="' + imgurl + '/uploads/' + file + '"  width="50px;" height="50px;"></td>' +
                    //'<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                    '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>' +
                    '</tr>';

                $("#doctbody").append(html);
                $('#doc_row_id').val(row_id);
                $('#doc_save_update').val('');


            }
            $("#doctype").val('').trigger('change');
            $("#file").val('');
            $("#filehidden1").val('');
            $("#msgid").html('');
        } else {
            swal("Document Tyepe And Document File Is Required", "success");
        }

    });

    $(document).on('click', '.doc_edit_data1', function(e) {
        e.preventDefault();

        var row = $(this).attr('id');

        var profdoc = $("#profdoctype_" + row).html();
        var file = $("#file_" + row).html();

        $("#doctype").val(profdoc).trigger('change');
        // $("#file").html('');
        $("#filehidden1").val(file);

        $('#doc_save_update').val(row);
        $('#msgid').html(file);

    });

    $(document).on('click', '.regional_delete_data1', function(e) {
        e.preventDefault();
        var save_update = $(this).attr('id');
        save_update = save_update.split("_");
        if (save_update[1] != "") {
            $("#del_" + save_update[1]).remove();
            $('#doc_save_update').val('');

        }

    });



    $('#uploadimg').change(function() {

        if ($(this).val() != '') {
            profileupload1(this);
            $('#wait1').show();
        }
    });

    function profileupload1(img) {


        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        // form_data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: profileimgupload1,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {

                $('#wait1').hide();
                $('#doc_msgid').html(data);
                $('#doc_file_hidden').val(data);
                $('#infoimages').attr('src', imgurl + '/profile/' + data);
            }
        });
    }



    $('#upload').change(function() {

        if ($(this).val() != '') {
            profileupload(this);

        }
    });

    function profileupload(img) {


        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        // form_data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: profileimgupload,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {


                $('#msgid').html(data);
                $('#filehidden1').val(data);

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

    $(document).on('click', ".imgupload", function(e) {
        e.preventDefault();

        $('#myModal').modal('show');
    });

    $(document).on('submit', '#customr_form', function(e) {
        e.preventDefault();


        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var contry = $('#contry').val();
        var pincode = $('#pincode').val();
        var relativenm = $('#relativenm').val();
        var mobileno = $('#mobileno').val();
        var address = $('#address').val();
        var profileimg = $('#doc_file_hidden').val();
        var save_update = $('#save_update').val();


        studejsonObj = [];


        var l1 = $('table#documenttb').find('tbody').find('tr');
        var r = l1.length;

        if (r > 0) {

            for (var i = 0; i < r; i++) {


                student = {}
                var doctype = $(l1[i]).find('td:eq(0)').html();

                var file = $(l1[i]).find('td:eq(2)').html();

                student["doctype"] = doctype;
                student["file"] = file;
                studejsonObj.push(student);
            }

            $.ajax({
                data: {
                    studejsonObj: studejsonObj,
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    city: city,
                    state: state,
                    contry: contry,
                    pincode: pincode,
                    address: address,
                    mobileno: mobileno,
                    relativenm: relativenm,
                    save_update: save_update,
                    profileimg: profileimg,

                },
                url: add_data,
                type: "POST",
                dataType: 'json',
                // async: false,
                success: function(data) {
                    if (data == 0) {
                        swal('Email Already Exists !!');
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
        } else {
            swal("Atleast One Document Required !!!");
        }
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
                        '</tr>';

                }
                $('#show_master').html(html);
                $('#myTable').DataTable({});

            }
        });
    }


    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();

        $('.btnhideshow').trigger('click');
        var id = $(this).attr("id");
        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }
        $('#save_update').val(id);
        $('#btnsaveinfo').show();
        $('.lbldata').show();
        $('.edittb').hide();
        $('#editperson').show();
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
                $('#contry').val(data[0].contry);
                $('#conlable').text(data[0].contry);

                $('#pincode').val(data[0].pincode);
                $('#pinlable').text(data[0].pincode);

                $('#relativenm').val(data[0].relativename);

                $('#mobileno').val(data[0].mobileno);
                $('#address').val(data[0].address);
                if (data[0].cust_profile != null) {
                    $('#doc_msgid').html(data[0].cust_profile);
                    $('#doc_file_hidden').val(data[0].cust_profile);

                    $('#uploadpic').text(data[0].cust_profile);
                    $('#infoimages').attr('src', imgurl + '/profile/' + data[0].cust_profile);
                }
            }
        });
        $.ajax({
            data: {
                id: id,

            },
            url: editdocurl,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                var row_id = 0;
                for (i = 0; i < data.length; i++) {
                    row_id = row_id + 1;
                    var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +

                        '<td  style="display:none;" id="profdoctype_' + row_id + '">' + data[i].customer_doc + '</td>' +
                        '<td  id="profdocname_' + row_id + '">' + data[i].customer_doc + '</td>' +

                        '<td  id="file_' + row_id + '">' + data[i].file + '</td>' +

                        '<td id="fileimgupload_' + row_id + '"> <img  id="docimages_' + row_id + '"  src="' + imgurl + '/uploads/' + data[i].file + '"  width="50px;" height="50px;"></td>' +
                        //'<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                        '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>' +
                        '</tr>';

                    $("#doctbody").append(html);
                    $('#doc_row_id').val(row_id);
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

    function form_clear() {
        $('#firstname').val('');
        $('#lastname').val('');
        $('#email').val('');
        $('#city').val('');
        $('#state').val('');
        $('#contry').val('');
        $('#pincode').val('');
        $('#relativenm').val('');
        $('#mobileno').val('');
        $('#address').val('');
        $("#doctbody").html('');
        $('#infoimages').attr('src', imgurl + '/resources/sass/images/userpic.jpg');
        $('#save_update').val('');
        $('#paymentbar').css('width', '0%');
        $('.progress-value').text('0%');
        $('#doc_msgid').html('');
        $('#doc_file_hidden').val('');
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

    $(document).on('click', "#btnsaveinfo", function(e) {
        e.preventDefault();


        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var city = $('#city').val();
        var state = $('#state').val();
        var contry = $('#contry').val();
        var pincode = $('#pincode').val();
        var profileimg = $('#doc_file_hidden').val();

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
            },
            url: updatecust,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                if (data == '100') {
                    swal('Email Already Exists !!');
                } else {
                    successTost("Opration Save Success fully!!!");
                    datashow();
                }


            }
        });

    });

});