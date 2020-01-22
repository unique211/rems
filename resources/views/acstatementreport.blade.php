@include('layouts.header')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/main.css') }}" />

<body>

        <style>
                div.picture1 {
                    width: 100px;
                    /*width of your image*/
                    height: 100px;
                    /*height of your image*/

                    margin: 0;
                    /* If you want no margin */
                    padding: 0;
                    /*if your want to padding */
                }
            </style>

    {{-- START PAGE CONTAINER --}}
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        {{-- START topbar --}}
        @include('layouts.topbar')
        {{-- End topbar --}}

        {{-- staty PAGE SIDEBAR --}}



        {{-- END PAGE SIDEBAR --}}
        {{-- PAGE CONTENT --}}







        <div class="app-main">
            @include('layouts.sidebar')



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
                                    Ac Statement Of Agent
                                </div>
                            </div>
                            <div class="page-title-actions">
                                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                                            data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                            <i class="fa fa-star"></i>
                                        </button> --}}
                                <div class="page-title-actions">
                                    {{-- <button class="btn btn-success  btnhideshow" style="background-color:#00B050;">
                                    <i class="fa fa-plus"></i>Add Category</button>
                                    <button class="btn btn-danger  closehideshow" style="display:none;">
                                        Close</button> --}}
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="row" >
                        <div class="col-md-12">
                            <form id="agentrep_form" name="agentrep_form">
                                <div class="row card">
                                    <div class="card-header border-bottom">
                                        <h6 class="m-0">Ac Statement Of Agent
                                        </h6>
                                    </div>


                                        <div class="form-row" style="margin-top:5px;">

                                            <div class="form-group col-md-2">
                                                <label style="margin-left:10%" for="agentname">Agent*</label>

                                            </div>
                                            <div class="form-group col-md-2">
                                                <select id="agentname" name="agentname" class="form-control select2" required>
                                                    <option selected disabled>Select</option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label style="margin-left:10%" for="sitenm">Site*</label>

                                            </div>
                                            <div class="form-group col-md-2">
                                                <select id="sitenm" name="sitenm" class="form-control select2" required>


                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label style="margin-left:10%" for="plot">Plot</label>

                                            </div>
                                            <div class="form-group col-md-2" style="margin-left:-10px">
                                                <select id="plot" name="plot" class="form-control select2" >


                                                </select>
                                            </div>


                                        </div>
                                        <div class="form-row" style="margin-top:5px;">
                                            <div class="form-group col-md-2">
                                               <input style="margin-left:10%" type="checkbox" id="frmdate" >
                                            <label  for="fromdate">From Date</label>
                                            </div>
                                            <div class="form-group col-md-3" style="margin-left:-10px">
                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input type='text' class="form-control" style="width:100%"
                                                        id="fromdate" name="fromdate"  />
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-2">

                                            <label style="margin-left:10%" for="todate">To Date</label>
                                            </div>
                                            <div class="form-group col-md-3" style="margin-left:-10px">
                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input type='text' class="form-control" style="width:100%"
                                                        id="todate" name="todate"  />
                                                    <div class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>






                                    <!-- <div class="form-row">

                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress">Agent Name*</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="agentname" class="form-control select2" required>
                                                            <option selected disabled>Select</option>
                                                            {{-- <option value="1">Customer 1</option>
                                                            <option value="2">Customer 2</option>
                                                            <option value="3">Customer 3</option> --}}
                                                        </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label for="feEmailAddress">Site Name*</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="sitename" class="form-control select2" required>
                                                            <option selected disabled>Select</option>
                                                            {{-- <option value="1">Site 1</option>
                                                            <option value="2">Site 2</option>
                                                            <option value="3">Site 3</option> --}}
                                                        </select>
                                                </div>

                                    </div>-->

                                    <!-- <div class="form-row">
                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress"> Plot*</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="ploats" class="form-control select2" required>
                                                            <option selected disabled>Select</option>
                                                            {{-- <option value="1">Ploats 1</option>
                                                            <option value="2">Ploats 2</option>
                                                            <option value="3">Ploats 3</option> --}}
                                                        </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress">Opening Balance</label>

                                                </div>

                                                    <div class="form-group col-md-4">
                                                            <input class="form-control" type="number" id="openingbalance" name="openingbalance" value="Amount">

                                                        </div>

                                    </div>
                                    <div class="form-row">

                                            <div class="form-group col-md-2">
                                                    <input  style="margin-left:10%;" class="crradio" type="radio" id="credit" name="amtinfo" value="cr"> Credit

                                                </div>
                                                <div class="form-group col-md-2">
                                                        <input type="radio" id="debit" class="crradio" name="amtinfo" value="dr"> Debit

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                            <input class="form-control amtdata"  type="number" id="amt" name="amt" value="Amount">

                                                        </div>
                                                        <div class="form-group col-md-2">
                                                                <label style="margin-left:10%;" for="feEmailAddress">Ramain Amount*</label>

                                                            </div>
                                                        <div class="form-group col-md-4">
                                                                <input class="form-control" type="number" id="remainamt" name="remainamt" value="Amount">

                                                        </div>

                                    </div>-->

                                    {{-- <div class="card-header border-bottom">
                                        <h6 class="m-0">History </h6>
                                    </div> --}}
                                    {{-- <div class="form-row">
                                        <input type="hidden" id="doc_row_id" name="doc_row_id" value="0">
                                            <table style="margin-right:5px;margin-left:5px;"  class="table table-bordered table-striped" id="commssiontb">
                                                    <thead>
                                                        <tr>
                                                          <th>Date</th>
                                                          <th>Opening Balance</th>
                                                          <th>Amount</th>
                                                          <th>Credit/Debit</th>
                                                          <th>Remain</th>
                                                          <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="paymenttabletbody">
                                                            {{-- <tr>
                                                                    <th>10/01/2020</th>
                                                                    <th>100</th>
                                                                    <th>50</th>
                                                                    <th>Credit</th>
                                                                    <th>50</th>
                                                                  </tr>

                                                    </tbody>
                                            </table>
                                    </div> --}}



                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" id="btnsavedata" class="btn btn-success">Generate
                                        </button>
                                        <input type="hidden" name="save_update" id="save_update" value="">
                                        {{-- <button type="button" id="deleteinfo" class="btn delete_data btn-danger delete">Delete
                                        </button> --}}
                                    </div>



                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row tablehideshow card">


                        <div class="col-md-12" style="width:100%">
                            <div class="table-responsive" id="show_master">
                                <table id="categorytb"
                                    class="table table-hover table-striped  table-bordered dataTable dtr-inline"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Date</th>
                                            <th>Particular</th>
                                            <th>Cr / Dr</th>
                                            <th>Amount</th>
                                            <th>Balance</th>


                                        </tr>
                                    </thead>
                                    <tbody id="categorytbody">
                                        {{-- <tr>
                                            <th class="text-center">1</th>
                                            <th>Agent 1</th>
                                            <th>Site 1</th>
                                            <th class="text-center">Plot 1</th>
                                            <th class="text-center">100</th>

                                            <td><button class="edit btn btn-sm btn-primary" id="' + row_id + '"><i
                                                        class="fa fa-edit"></i></button>&nbsp;&nbsp;<button
                                                    class="regional_delete_data1 btn btn-sm btn-danger"
                                                    id="del_' + row_id + '"><i class="fa fa-trash"> </i></button></td>
                                        </tr> --}}

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>


                </div>



                @include('layouts.foter')

            </div>


        </div>
    </div>

    {{-- END PAGE CONTAINER --}}




    {{-- END SCRIPTS --}}


</body>

</html>

<script>


    $(document).ready(function () {
        $('.date').datepicker({
'todayHighlight': true,
format: 'dd/mm/yyyy',
autoclose: true,
});
var date = new Date();
date = date.toString('dd/MM/yyyy');
$('#todate').val(date);
$('#fromdate').val(date);

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


});
    $('#customermaster').DataTable({});

    var getallsite="{{url('getagentsite')}}";
    var getsiteploat="{{url('getagentsiteploat')}}"
    var getdata="{{url('getagentrepdata')}}"

</script>
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/acstatementrep.js') }}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
