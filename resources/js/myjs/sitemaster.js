$(document).ready(function() {



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

    $(document).on('click', "#btnupload", function(e) {
        e.preventDefault();


        var profdoc = $("#doctype").val();

        var profdocname = $("#doctype option:selected").text();

        var file = $("#filehidden1").val();


        var row_id = $('#doc_row_id').val();
        row_id = parseInt(row_id) + parseInt(1);
        var save_update = $('#doc_save_update').val();
        var dlt = 0;

        var r1 = $('table#docupload').find('tbody').find('tr');
        var r = r1.length;
        for (var i = 0; i < r; i++) {

            var profid = $(r1[i]).find('td:eq(1)').html();

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


            $('#profdoc_' + save_update).html(profdoc);
            $('#profdocname_' + save_update).html(profdocname);
            $('#file_' + save_update).html(file);
            $('#profdocno_' + save_update).html(profno);
            $('#doc_save_update').val('');


        } else {


            var html = '<tr class="project_tab_add_row" id="del_' + row_id + '" >' +


                '<td  id="profdocname_' + row_id + '">' + profdocname + '</td>' +

                '<td  id="file_' + row_id + '">' + file + '</td>' +
                '<td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  >Edit</button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  >delete</button>' +
                '</tr>';

            $("#docupload_tbody").append(html);
            $('#doc_row_id').val(row_id);
            $('#doc_save_update').val('');


        }
        $("#profdoc").val('').trigger('change');
        $("#file").val('');
        $("#filehidden1").val('');
        $("#msgid").html('');
        $("#proffno").val('');
    });


    $('#file').change(function() {

        if ($(this).val() != '') {
            profileupload(this);

        }
    });

    function profileupload(img) {

        var form_data = new FormData();
        form_data.append('file', img.files[0]);
        form_data.append('_token', '{{csrf_token()}}');

        $.ajax({
            url: profileupload,
            data: form_data,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data);

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

    $(document).on('blur', "#noofploats", function(e) {
        e.preventDefault();
        var noofploats = $('#noofploats').val();
        // var l1 = $('table#docupload').find('tbody').find('tr');
        // var r = l1.length;
        var id = $('#save_update').val();
        if (id > 0) {
            if (noofploats > 0) {
                var docid = $('#doc_row_id').val();
                var ploats = parseFloat(noofploats) - parseFloat(docid);
                if (ploats > 0) {
                    for (i = 0; i < ploats; i++) {
                        addploat();
                    }
                } else {

                    for (i = ploats; i < 0; i++) {


                        $('#ploattabletbody tr:last').remove();

                        var total = 0;
                        $('.areainsqf').each(function() {
                            var val = $(this).val();


                            if (val > 0) {
                                total = parseFloat(total) + parseFloat(val);
                            }

                        });
                        $('#totalarea').val(total);
                    }
                }

            }
        } else {
            if (noofploats > 0) {
                $('#ploattabletbody').html('');
                $('#doc_row_id').val(0);
                for (i = 0; i < noofploats; i++) {
                    addploat();
                }

            }
        }




    });


    function addploat() {
        var row_id = $('#doc_row_id').val();
        row_id = parseInt(row_id) + 1;
        var html = '<tr  class="proffinfodata"  id="proffinfo_' + row_id + '" >' +
            '<td>' + row_id + '</td>' +

            '<td style="display:none;">' +
            '<input type="text"  id="srpid_' + row_id + '" name="srid_' + row_id + '" value="0" class="form-control" placeholder="Plot No">' +

            '</td>' +

            '<td>' +
            '<input type="text" id="ploatno_' + row_id + '" name="ploatno_' + row_id + '" class="form-control" placeholder="Plot No">' +

            '</td>' +

            '<td>' +
            '<input type="number" id="areainsqft_' + row_id + '" name="areainsqft_' + row_id + '" value="0" class="areainsqf sumplotcost form-control" placeholder="Area (in sqft)">' +
            '</td>' +

            '<td>' +
            '<input type="number" id="persqftrate_' + row_id + '" name="persqftrate_' + row_id + '" value="0"   class="sumplotcost form-control" placeholder="Per Sqft Rate">' +
            '</td>' +

            '<td>' +
            '<input type="number" id="cost_' + row_id + '" name="cost_' + row_id + '" class="form-control" value="0"  placeholder="Cost" disabled>' +

            '</td>' +


            '</tr>';

        $('#ploattabletbody').append(html);
        $('#doc_row_id').val(row_id);



    }

    $(document).on('blur', ".sumplotcost", function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        id = id.split("_");


        var area = $('#areainsqft_' + id[1]).val();
        var rate = $('#persqftrate_' + id[1]).val();

        console.log("area" + area + "rate" + rate);

        var tamt = parseFloat(area) * parseFloat(rate);
        $('#cost_' + id[1]).val(tamt);



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

    //for submit event
    $(document).on('submit', '#site_master_form', function(e) {
        e.preventDefault();

        var flag = 0;

        var sitename = $('#sitename').val();
        var areaname = $('#areaname').val();
        var noofploats = $('#noofploats').val();
        var totalarea = $('#totalarea').val();
        var save_update = $('#save_update').val();

        studejsonObj = [];
        $(".proffinfodata").each(function() {
            var id1 = $(this).attr('id');
            console.log(id1);

            id1 = id1.split("_");


            student = {};
            var srpid = '';
            var ploatno = $('#ploatno_' + id1[1]).val();
            var areainsqft = $('#areainsqft_' + id1[1]).val();
            var persqftrate = $('#persqftrate_' + id1[1]).val();
            var cost = $('#cost_' + id1[1]).val();
            if (save_update > 0) {
                srpid_ = $('#srpid_' + id1[1]).val();
                if (srpid_ == "") {
                    srpid_ = 0;
                }
            }

            if (ploatno != "" && areainsqft != "" && cost != "") {
                if (save_update > 0) {
                    student["ploatno"] = ploatno;
                    student["areainsqft"] = areainsqft;
                    student["persqftrate"] = persqftrate;
                    student["cost"] = cost;
                    student["srpid"] = srpid_;
                } else {
                    student["ploatno"] = ploatno;
                    student["areainsqft"] = areainsqft;
                    student["persqftrate"] = persqftrate;
                    student["cost"] = cost;
                }




                for (var i = 0; i < studejsonObj.length; i++) {


                    // if (mobile == studejsonObj[i].mobile || email == studejsonObj[i].email || landline == studejsonObj[i].landline) {
                    //     flag = 1;

                    // }
                    if (ploatno == studejsonObj[i].ploatno) {
                        flag = 1;

                    }
                }
            } else {
                swal('Plot No And Area(in sqft) And Cost Is Required!!');
                flag = 1;
            }

            if (flag == 1) {


            } else {
                studejsonObj.push(student);
            }
        });
        if (flag == 0) {
            $.ajax({
                data: {
                    studejsonObj: studejsonObj,
                    sitename: sitename,
                    areaname: areaname,
                    noofploats: noofploats,
                    totalarea: totalarea,
                    save_update: save_update,

                },
                url: add_data,
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
        } else {
            swal('Plot No Already Existes !!');
        }
    });

    function form_clear() {
        $('#ploattabletbody').html('');
        $('#sitename').val('');
        $('#areaname').val('');
        $('#noofploats').val('');
        $('#totalarea').val('');
        $('#save_update').val('');
    }

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
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Site Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;"  >Area Name</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Total No Of Plots</th>' +
                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Total Area Of Plots</th>' +

                    '<th style="white-space:nowrap;text-align:left;padding:10px 10px;" >Action</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                for (var i = 0; i < data.length; i++) {
                    sr = sr + 1;
                    html += '<tr>' +
                        '<td id="id_' + data[i].id + '">' + sr + '</td>' +
                        '<td  id="site_name_' + data[i].id + '">' + data[i].site_name + '</td>' +
                        '<td  id="area_name_' + data[i].id + '">' + data[i].area_name + '</td>' +
                        '<td id="total_ploat_' + data[i].id + '">' + data[i].total_ploat + '</td>' +
                        '<td id="total_areaof_ploats_' + data[i].id + '">' + data[i].total_areaof_ploats + '</td>' +
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

        if (editrt == 1) {
            $('.formhideshow').show();
            $('.tablehideshow').hide();
        }

        var id = $(this).attr("id");
        $('#save_update').val(id);

        var sitename = $('#site_name_' + id).html();
        var area_name = $('#area_name_' + id).html();
        var total_ploat = $('#total_ploat_' + id).html();
        var total_areaof_ploats = $('#total_areaof_ploats_' + id).html();

        $('#sitename').val(sitename);
        $('#areaname').val(area_name);
        $('#noofploats').val(total_ploat);
        $('#totalarea').val(total_areaof_ploats);

        $.ajax({
            data: {
                id: id,

            },
            url: editploaturl,
            type: "POST",
            dataType: 'json',
            // async: false,
            success: function(data) {
                var row_id = 0;
                var cost = 0;
                for (i = 0; i < data.length; i++) {
                    row_id = row_id + 1;
                    cost = parseFloat(data[i].area_insqft) * parseFloat(data[i].persqftrate);
                    var html = '<tr  class="proffinfodata"  id="proffinfo_' + row_id + '" >' +
                        '<td>' + row_id + '</td>' +

                        '<td style="display:none;">' +
                        '<input type="text"  id="srpid_' + row_id + '" name="srid_' + row_id + '" value="' + data[i].id + '" class="form-control" placeholder="Plot No">' +

                        '</td>' +

                        '<td>' +
                        '<input type="text" id="ploatno_' + row_id + '" name="ploatno_' + row_id + '" value="' + data[i].plots_no + '" class="form-control" placeholder="Plot No">' +

                        '</td>' +

                        '<td>' +
                        '<input type="number" id="areainsqft_' + row_id + '" name="areainsqft_' + row_id + '" value="' + data[i].area_insqft + '"  class="sumplotcost areainsqf form-control" placeholder="Area (in sqft)">' +
                        '</td>' +

                        '<td>' +
                        '<input type="number" id="persqftrate_' + row_id + '" name="persqftrate_' + row_id + '" value="' + data[i].persqftrate + '"   class="sumplotcost form-control" placeholder="Per Sqft Rate">' +
                        '</td>' +

                        '<td>' +
                        '<input type="number" id="cost_' + row_id + '" name="cost_' + row_id + '" value="' + cost + '" class="form-control" placeholder="Cost">' +

                        '</td>' +


                        '</tr>';

                    $('#ploattabletbody').append(html);
                    $('#doc_row_id').val(row_id);

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