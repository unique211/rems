@include('layouts.header')

<body>
        <style>
.tab-content > .tab-pane:not(.active) { display: block; height: 0; overflow-y: hidden; }
            </style>


    {{-- START PAGE CONTAINER --}}
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        {{-- START topbar --}}
        @include('layouts.topbar')
        {{-- End topbar --}}

        {{-- staty PAGE SIDEBAR --}}



        {{-- END PAGE SIDEBAR --}}
        {{-- PAGE CONTENT --}}

        <?php
        $editright=0;
        $deleteright=0;
        ?>





        <div class="app-main">
            @include('layouts.sidebar')

            @if(is_null($sidebar))

            @else


            @foreach($sidebar as $val)
            @if(($val->menuid==2  && $val->submenuid==1) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
                <?php

            $editright=$val->editright;
        $deleteright=$val->deleteright;
                  ?>

            <div class="app-main__outer">
                <div class="app-main__inner ">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                         <i class="fa fa-user icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                <div>
                                    Customer Master
                                </div>
                            </div>
                            <div class="page-title-actions">
                                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                                            data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                            <i class="fa fa-star"></i>
                                        </button> --}}
                                <div class="page-title-actions">
                                    @if($val->createright==1)
                                    <button class="btn btn-success  btnhideshow"
                                        style="background-color:#00B050;">
                                        <i class="fa fa-plus"></i> Add Customer</button>
                                        <button class="btn btn-danger  closehideshow"
                                        style="display:none;" >
                                        Close</button>
                                        @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row tablehideshow card">


                        <div class="col-sm-12">
                            <div class="table-responsive" id="show_master">
                                    <div id="wait" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php  echo url('/resources/sass/images/loader.gif'); ?>" width="100" height="100" /><br>
                                        <center>
                                            <h5>Please Wait...</h5>
                                        </center>
                                    </div>
                                {{-- <table style="width: 100%;" id="customermaster"
                                class="table table-hover table-striped  table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>First  Name</th>
                                            <th>Last  Name</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">City</th>
                                            <th class="text-center">State</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <th class="text-center">1</th>
                                                    <th>Customer 1</th>
                                                    <th>Pathan</th>
                                                    <th class="text-center">cus@gmail.com</th>
                                                    <th class="text-center">Rajkot</th>
                                                    <th class="text-center">Gujrat</th>
                                                    <td><button  class="edit btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>
                                                </tr>

                                    </tbody>
                                </table> --}}
                            </div>


                        </div>
                    </div>

                    <div class="row formhideshow" style="display:none;">
                        <div class="col-md-12">
                                <form id="customr_form" name="customr_form">
                            <div class="row">


                                        {{-- <div class="col-sm-12 col-md-6 col-xl-4">
                                                <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                                    <div class="dropdown-menu-header">
                                                        <div class="dropdown-menu-header-inner bg-alternate">
                                                            <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/abstract1.jpg');"></div>
                                                            <div class="menu-header-content btn-pane-right">
                                                                <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                                                    <div class="avatar-icon rounded"><img src="data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QMfaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzEzOCA3OS4xNTk4MjQsIDIwMTYvMDkvMTQtMDE6MDk6MDEgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkQ3MDQwMTFBRUNGMDExRThBNjRDQzQyMTE5Mjk5QTQ0IiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkQ3MDQwMTE5RUNGMDExRThBNjRDQzQyMTE5Mjk5QTQ0IiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE3IE1hY2ludG9zaCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSI0RjBENjMzNUYyM0RFMUYwNjM4MTY4RTUyODFERkI3QSIgc3RSZWY6ZG9jdW1lbnRJRD0iNEYwRDYzMzVGMjNERTFGMDYzODE2OEU1MjgxREZCN0EiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAOQWRvYmUAZMAAAAAB/9sAhAAGBAQEBQQGBQUGCQYFBgkLCAYGCAsMCgoLCgoMEAwM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" alt="Avatar 5"></div>
                                                                </div>
                                                                <div><label for="feFirstName">First Name</label><input type="text" name="firstname" id="firstname" placeholder="firstname"></div>
                                                                <div><label for="feFirstName">Last Name</label><input type="text" name="lastname" id="lastname" placeholder="Last name"></div>
                                                                <div><label for="feFirstName">Mobile No</label><input type="text" name="mobileno" id="mobileno" placeholder="Mobile no"></div>
                                                                <div><label for="feFirstName">  Email</label><input type="email" name="firstname" id="firstname" placeholder="Email"></div>
                                                                <div class="menu-header-btn-pane">
                                                                    <button type="button" class="btn-wide btn-hover-shine btn-pill btn btn-warning">Messages</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="widget-content pt-2 pl-0 pb-2 pr-0">
                                                                <div class="text-center"><h5 class="widget-heading opacity-4 mb-0"> First Name</h5></div>
                                                            </div>
                                                        </li>
                                                        <li class="p-0 list-group-item">
                                                            <div class="grid-menu grid-menu-2col">
                                                                <div class="no-gutters row">
                                                                    <div class="col-sm-6">
                                                                        <button class="btn-icon-vertical btn-square btn-transition br-bl btn btn-outline-link"><i class="lnr-license btn-icon-wrapper btn-icon-lg mb-3"> </i>View Profile</button>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <button class="btn-icon-vertical btn-square btn-transition br-br btn btn-outline-link"><i class="lnr-music-note btn-icon-wrapper btn-icon-lg mb-3"> </i>Leads Generated</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-4 card">

                                                    <div class="card-header pull-right"   >

                                                        <button class="btn btn-info" id="editperson" style="align: right;">Edit</button>

                                                    </div>


                                                    <div class="card-content">
                                                        <div class="card-content-member">
                                                                <div class="avatar-icon rounded mx-auto" align="center"> <img  id="infoimages" class="rounded-circle imgupload" src="https://saleserpnew.bdtask.com/saleserp_v9.3-demo/my-assets/image/employee/83b8682a418e6863d79ffab99a6227c0.jpg" class="img-circle" width="100px;" height="100px;"></div>

                                                           </div>
                                                           <div class="card-content-languages">
                                                    <div class="card-content-languages-group"></div>
                                                            <div class="card-content-languages-group">

                                                               <table class="table table-hover" width="100%">

                                                                <tbody>
                                                                    <tr>
                                                                            <th>Upload Img*</th>
                                                                        <td class="lbldata"><label id="uploadpic">Upload Img*</label> </td>
                                                                        <td class="edittb"><input	 class="form-control input-sm " type="file" id="uploadimg" name="uploadimg" accept="image/*">
                                                                            <input type="hidden" id="doc_file_hidden" value="">
                                                                            <div id="doc_msgid"></div>
                                                                        </td>
                                                                        <div id="wait1" style="width:100px;height:100px;position:absolute;top:;left:45%;padding:2px;"><img src="<?php  echo url('/resources/sass/images/loader.gif'); ?>" width="100" height="100" /><br>
                                                                            <center>
                                                                                <h5>Please Wait...</h5>
                                                                            </center>
                                                                        </div>
                                                                    </tr>

                                                                    <tr>
                                                                    <th>First Name*</th>
                                                                    <td class="lbldata"><label id="flable">Sagar</label> </td>
                                                                    <td class="edittb"><input  class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" required> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Last Name*</th>
                                                                    <td class="lbldata"><label id="llable">Sagar</label></td>
                                                                    <td class="edittb"><input class="form-control" type="text" id="lastname" name="lastname" placeholder="Lastname" required> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email*</th>
                                                                    <td class="lbldata"><label id="elable">Email</label></td>
                                                                    <td class="edittb"><input class="form-control" type="email" id="email" name="email" placeholder="Email" required> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th >Payment</th>
                                                                    <td colspan="2"><div class="progress-wrapper">

                                                                            <div class="progress progress-sm">
                                                                              <div class="progress-bar bg-primary" id="paymentbar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                                                                <span class="progress-value">80%</span>
                                                                              </div>
                                                                            </div>
                                                                          </div></td>
                                                                </tr>
                                                                <tr>
                                                                        <th colspan="3">Address</th>

                                                                    </tr>
                                                                 <tr>
                                                                    <th>City*</th>

                                                                    <td class="lbldata"><label id="clable">City</label></td>
                                                                    <td class="edittb"><input class="form-control" type="text" id="city" name="city" placeholder="City" required> </td>
                                                                </tr>
                                                                <tr>
                                                                        <th>State*</th>
                                                                        <td class="lbldata"><label id="slable">State</label></td>
                                                                        <td class="edittb"><input class="form-control" type="text" id="state" name="state" placeholder="State" required> </td>
                                                                </tr>
                                                                <tr>
                                                                        <th>Country*</th>
                                                                        <td class="lbldata"><label id="conlable">Contry</label></td>
                                                                        <td class="edittb"><input class="form-control" type="text" id="contry" name="contry" placeholder="Country" required> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Pin code*</th>
                                                                    <td class="lbldata"><label id="pinlable">Pin Code</label></td>
                                                                    <td class="edittb"><input class="form-control" type="text" id="pincode" name="pincode" placeholder="Pincode" required> </td>
                                                            </tr>
                                                            <tr>
                                                                    <th ></th>
                                                                    <td class="lbldata"></td>
                                                                    <td  class="edittb"><input class="btn btn-success pull-right" type="button" id="btnsaveinfo" name="btnsaveinfo" value="Save"></td>
                                                            </tr>
                                                        </tbody></table>

                                                    </div>

                                            </div>
                                            <div class="card-footer">
                                                <div class="card-footer-stats">
                                                    <div>
                                                        <p></p><span class="stats-small"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>

                                <div class="col-lg-8">
                                    <div class="card card-small mb-4">
                                        <div class="card-header border-bottom">
                                            <h6 class="m-0">Document Detalis</h6>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item p-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <form>

                                                                <div class="form-row">
                                                                    <input type="hidden" id="doc_row_id" name="doc_row_id" value="0">
                                                                    <input type="hidden" id="doc_save_update" name="doc_save_update" value="">
                                                                        <table id="documenttb" class="table table-hover" width="100%">
                                                                          <thead>
                                                                                <tr> <th>Document Tyepe</th>
                                                                                    <th>Document File</th>
                                                                                    <th>Action</th></tr>

                                                                          </thead>
                                                                          <tbody id="doctbody">
                                                                            {{-- <tr>
                                                                                <td>Pancard</td>
                                                                                <td>abc.png</td>
                                                                                <td><button  class="doc_edit_data1 btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>

                                                                            </tr> --}}
                                                                          </tbody>

                                                                        </table>
                                                                </div>
                                                            <div class="form-row">
                                                                <form id="document_detalis" name="document_detalis">
                                                                <div class="form-group col-md-4">
                                                                    <label for="feFirstName">Document Tyepe</label>
                                                                    <select id="doctype" class="form-control select2">
                                                                            <option selected disabled>Select</option>
                                                                            <option value="Pancard">Pancard</option>
                                                                            <option value="AdharCard">AdharCard</option>
                                                                            <option value="VoterID">VoterID</option>
                                                                        </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="feLastName">Document File</label>
                                                                    <input type="file" id="upload" name="upload"
                                                                        class="form-control">
                                                                    <div id="msgid"></div>
                                                                    <input type="hidden" id="filehidden1"
                                                                        value="">
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                        <br>
                                                                        <input style="margin-top:10px;" class="btn btn-success" type="button" id="btnupload" name="btnupload" value="Upload">
                                                                    </div>
                                                                </form>
                                                            </div>

                                                            <div class="card-header border-bottom">
                                                                    <h6 class="m-0">Relative Detalis</h6>
                                                                </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="feEmailAddress">Name*</label>
                                                                    <input type="text" class="form-control"
                                                                        id="relativenm" name="relativenm" placeholder="Relative Detalis"
                                                                       required >
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="fePassword">Mobile No*</label>
                                                                    <input type="number" class="form-control"
                                                                        id="mobileno" name="mobileno" placeholder="Mobile No" required>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                        <label for="feInputAddress">Address</label>
                                                                       <textarea id="address" name="address" class="form-control" ></textarea>
                                                                    </div>
                                                                    <div class="form-group col-md-12" align="right">
                                                                            <button type="submit"  id="btnsavedata" class="btn btn-success">Save
                                                                                    </button>
                                                                                    <input type="hidden" id="save_update" name="save_update" value="">
                                                                                    @if($val->deleteright==1)
                                                                                    <button type="button" class="btn delete_data btn-danger">Delete
                                                                                            </button>
                                                                                            @endif
                                                                        </div>
                                                            </div>




                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>


                            </div>

                        </form>
                        </div>
                        <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add Document</h4>
                                        </div>
                                        <div class="modal-body" style="width:100%">
                                        <form id="document_data" method="post"></form>
                                            <div class="col-lg-12">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Type OF Document*</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <select form="document_data" class="form-control input-sm placeholdesize" id="type_document" required>
                                                            <option value="" selected disabled>--Select--</option>
                                                            <option value="1">Invoice Copy</option>
                                                            <option value="2">Challan Copy</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <input type="text" form="document_data" class="form-control" id="des" name="des" placeholder="Descrption"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>File Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                    <div id="add_file">
                                                            <input	form="document_data" class="form-control input-sm " type="file" id="docupload" name="docupload" required>
                                                    </div>
                                                        <input type="hidden" id="file_hidden" value="">
                                                        <div id="msg"></div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <br><br>
                                            <br><br>
                                            </div>
                                            <br>  <br>  <br>  <br>
                                            <div class="modal-footer">
                                                <input type="hidden" id="doc_row_id" value="0">
                                                <input type="hidden" id="doc_save_update" value="">
                                                <input type="submit" form="document_data" name="btnsave" id="btnsave" value="Save" class="btn btn-success"/>
                                            <button type="button" class="btn btn-dangar" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>


                </div>



                @include('layouts.foter')

            </div>
            @endif

            @endforeach
            @endif

        </div>
    </div>
    {{-- END PAGE CONTAINER --}}




    {{-- END SCRIPTS --}}


</body>

</html>
<script>
      $(document).ready(function () {

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


});
    $('#customermaster').DataTable({});
    var doc_token="{{csrf_token()}}";
    var profileimgupload="{{url('uploadingfile')}}";
    var profileimgupload1="{{url('uploadingcustfile')}}";
    var add_data="{{route('customer.store') }}";
    var getalldata="{{url('getallcustomer')}}";
    var editurl="{{url('editcustomer')}}";
    var editdocurl="{{url('editdoccustomer')}}";
    var delete_data="{{url('deletecustomer')}}";
    var imgurl="<?php  echo url('/') ?>";
    var editrt="<?php  echo $editright; ?>";
    var delrt="<?php  echo $deleteright; ?>";
    var updatecust="{{url('updatecustomerinfo')}}";
    var getpaymentdata="{{url('getpaymentinfo')}}";



//     function setFocusMapCenter() {
//     var mapObj = $('#map').vectorMap('get', 'mapObject'),
//         center = mapObj.pointToLatLng(mapObj.width / 2, mapObj.height / 2);

//     var config = {
//         animate: true,
//         lat: center.lat,
//         lng: center.lng,
//         scale: 1
//     }

//     mapObj.setFocus(config)
// }
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/customer.js') }}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>

