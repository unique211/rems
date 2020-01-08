$(document).ready(function() {



    /*---------btnhideshow-----------------*/
    $(document).on("click", ".btnhideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').show();
        $('.tablehideshow').hide();
        $('.closehideshow').show();
        $('.btnhideshow').hide();
        $('#btnsavedata').text('Save');


    });
    /*---------login-----------------*/

    $(document).on("click", ".closehideshow", function(e) {
        e.preventDefault();
        $('.formhideshow').hide();
        $('.tablehideshow').show();

        $('.closehideshow').hide();
        $('.btnhideshow').show();


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

});