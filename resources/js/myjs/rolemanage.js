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
        getallmenu();
        form_clear();

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

    getallmenu();

    function getallmenu() {

        $.ajax({
            type: "GET",
            url: getallmenudata,
            dataType: "JSON",

            async: false,
            success: function(data) {

                var table = "";
                for (var i = 0; i < data.length; i++) {


                    if (data[i].submenudata.length > 0) {

                        table += '<tr class="main_menu">' +
                            '<td><span ><input type="checkbox"   class="main_chk"  id="_' + data[i].menuid + '" name="' + data[i].menuid + '" value="1"></span>' + data[i].menu_name + '</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                        for (var j = 0; j < data[i].submenudata.length; j++) {
                            table += '<tr class="sub_menu">' +
                                '<td ><span >' + data[i].submenudata[j].submenuname + '</span></td>' +
                                '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '_' + data[i].submenudata[j].submenu_id + '"  id="view_' + data[i].submenudata[j].submenu_id + '" value="0" /></td>' +
                                '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '_' + data[i].submenudata[j].submenu_id + '"  id="create_' + data[i].submenudata[j].submenu_id + '"  value="0" /></td>' +
                                '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '_' + data[i].submenudata[j].submenu_id + '"  id="edit_' + data[i].submenudata[j].submenu_id + '"  value="0" /></td>' +
                                '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '_' + data[i].submenudata[j].submenu_id + '"  id="delete_' + data[i].submenudata[j].submenu_id + '"  value="0" /></td>' +
                                '</tr>';
                        }

                    } else {
                        table += '<tr class="main_menu">' +
                            '<td><span ><input type="checkbox"   class="main_chk"  id="_' + data[i].menuid + '" name="' + data[i].menuid + '" value="1"></span>' + data[i].menu_name + '</td>' +
                            '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '"  id="mview_' + data[i].menuid + '" value="0" /></td>' +
                            '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '"  id="mcreate_' + data[i].menuid + '"  value="0" /></td>' +
                            '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '"  id="medit_' + data[i].menuid + '"  value="0" /></td>' +
                            '<td><input type="checkbox" class="submenu_' + data[i].menuid + '" name="main_chk_' + data[i].menuid + '"  id="mdelete_' + data[i].menuid + '"  value="0" /></td>' +
                            '</tr>';
                    }
                }
                $('#tbd_user_rights').html(table);

            }


        });

    }
    $(document).on('submit', '#rightmanagement_form', function(e) {
        e.preventDefault();

        // alert("in submit");
        //$(':input[type="submit"]').prop('disabled', true);
        var save_update = $("#save_update").val();
        var rolename = $("#rolename").val();

        var studejsonObj = [];

        $(".main_chk").each(function() {
            var id1 = $(this).attr('id');




            if ($(this).prop("checked") == true) {

                student = {};
                student["menuid"] = id1[1];

                student["submenu"] = 0;

                if ($("#mcreate_" + id1[1]).prop("checked") == true) {

                    student["createpermission"] = 1;

                    $('#mview_' + id1[1]).prop('checked', true);

                } else {
                    student["createpermission"] = 0;
                }

                if ($("#medit_" + id1[1]).prop("checked") == true) {

                    student["editpermission"] = 1;
                    $('#mview_' + id1[1]).prop('checked', true);



                } else {
                    student["editpermission"] = 0;
                }

                if ($("#mdelete_" + id1[1]).prop("checked") == true) {

                    student["deletepermission"] = 1;
                    $('#mview_' + id1[1]).prop('checked', true);



                } else {
                    student["deletepermission"] = 0;
                }




                if ($("#mview_" + id1[1]).prop("checked") == true) {

                    student["viewpermission"] = 1;





                } else {
                    student["viewpermission"] = 0;
                }


                studejsonObj.push(student);






                $(".submenu_" + id1[1]).each(function() {
                    var submenu = $(this).attr('id');

                    submenu = submenu.split("_");
                    student = {};
                    student["menuid"] = id1[1];

                    student["submenu"] = submenu[1];

                    if ($("#create_" + submenu[1]).prop("checked") == true) {

                        student["createpermission"] = 1;

                        $('#view_' + submenu).prop('checked', true);

                    } else {
                        student["createpermission"] = 0;
                    }

                    if ($("#edit_" + submenu[1]).prop("checked") == true) {

                        student["editpermission"] = 1;
                        $('#view_' + submenu).prop('checked', true);



                    } else {
                        student["editpermission"] = 0;
                    }

                    if ($("#delete_" + submenu[1]).prop("checked") == true) {

                        student["deletepermission"] = 1;
                        $('#view_' + submenu).prop('checked', true);



                    } else {
                        student["deletepermission"] = 0;
                    }




                    if ($("#view_" + submenu[1]).prop("checked") == true) {

                        student["viewpermission"] = 1;





                    } else {
                        student["viewpermission"] = 0;
                    }


                    studejsonObj.push(student);

                });

            }

        });
        console.log(studejsonObj);

        $.ajax({
            data: {
                studejsonObj: studejsonObj,
                save_update: save_update,
                rolename: rolename,


            },
            url: add_data,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                successTost("Saved Successfully");
                datashow();
                $('.closehideshow').trigger('click');
                if (editrt == 1) {
                    $('.formhideshow').hide();
                    $('.tablehideshow').show();
                }
            }
        });
    });

    datashow();

    function form_clear() {
        $("#save_update").val('');
        $("#rolename").val('');
        getallmenu();
    }

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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Role</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="rolename_' + data[i].id + '">' + data[i].rolename + '</td>' +

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


    //for edit----start
    $(document).on('click', ".edit_data", function(e) {
        e.preventDefault();

        $('.btnhideshow').trigger('click');
        var id = $(this).attr("id");
        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }

        var role = $('#rolename_' + id).html();

        $("#rolename").val(role);
        $("#save_update").val(id);

        $.ajax({
            data: {

                id: id,

            },
            url: geturight,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {

                for (var i = 0; i < data.length; i++) {



                    if (data[i].viewright == 1) {


                        $('#view_' + data[i].submenuid).prop('checked', true);


                    } else {
                        $('#view_' + data[i].submenuid).prop('checked', false);
                    }
                    if (data[i].createright == 1) {


                        $('#create_' + data[i].submenuid).prop('checked', true);


                    } else {
                        $('#create_' + data[i].submenuid).prop('checked', false);
                    }

                    if (data[i].editright == 1) {


                        $('#edit_' + data[i].submenuid).prop('checked', true);


                    } else {
                        $('#edit_' + data[i].submenuid).prop('checked', false);
                    }

                    if (data[i].deleteright == 1) {


                        $('#delete_' + data[i].submenuid).prop('checked', true);


                    } else {
                        $('#delete_' + data[i].submenuid).prop('checked', false);
                    }


                    if (data[i].menuid > 0 && data[i].submenuid == 0) {
                        $('#_' + data[i].menuid).prop('checked', true);


                        if (data[i].viewright == 1) {


                            $('#mview_' + data[i].menuid).prop('checked', true);


                        } else {
                            $('#mview_' + data[i].menuid).prop('checked', false);
                        }
                        if (data[i].createright == 1) {


                            $('#mcreate_' + data[i].menuid).prop('checked', true);


                        } else {
                            $('#mcreate_' + data[i].menuid).prop('checked', false);
                        }

                        if (data[i].editright == 1) {


                            $('#medit_' + data[i].menuid).prop('checked', true);


                        } else {
                            $('#medit_' + data[i].menuid).prop('checked', false);
                        }

                        if (data[i].deleteright == 1) {


                            $('#mdelete_' + data[i].menuid).prop('checked', true);


                        } else {
                            $('#mdelete_' + data[i].menuid).prop('checked', false);
                        }



                    }

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

});
