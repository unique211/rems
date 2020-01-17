@include('layouts.header')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/main.css') }}" />
<body>



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
        $createright=0;
        ?>



        <div class="app-main">
            @include('layouts.sidebar')

            @if(is_null($sidebar))

            @else


            @foreach($sidebar as $val)
            @if(($val->menuid==2  && $val->submenuid==5) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
            <?php

            $editright=$val->editright;
        $deleteright=$val->deleteright;
        $createright=$val->createright;
                  ?>

            <div class="app-main__outer">
                <div class="app-main__inner ">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                       <i class="fa fa-dollar icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                <div>
                                   Agent Commission
                                </div>
                            </div>
                            <div class="page-title-actions">
                                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip"
                                            data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                            <i class="fa fa-star"></i>
                                        </button> --}}
                                <div class="page-title-actions">
                                    {{-- <button class="btn btn-success  btnhideshow"
                                        style="background-color:#00B050;">
                                        Add Detail</button>
                                        <button class="btn btn-danger  closehideshow"
                                        style="display:none;">
                                        Close</button> --}}
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row tablehideshow card">


                        <div class="col-md-12" style="width:100%">
                            <div class="table-responsive" id="show_master">
                                {{-- <table id="customermaster"
                                    class="table table-hover table-striped  table-bordered dataTable dtr-inline" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>  Agent  Name</th>
                                            <th>Site  Name</th>
                                            <th class="text-center">Plot</th>
                                            <th class="text-center">Amount</th>

                                     <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <th class="text-center">1</th>
                                                    <th>Agent 1</th>
                                                    <th>Site 1</th>
                                                    <th class="text-center">Plot 1</th>
                                                    <th class="text-center">100</th>

                                                    <td><button  class="edit btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>
                                                </tr>

                                    </tbody>
                                </table> --}}
                            </div>


                        </div>
                    </div>

                    <div class="row formhideshow card">
                        <div class="col-md-12">
                            <form id="agent_commssion" name="agent_commssion">
                            <div class="row card">
                                    <div class="card-header border-bottom">
                                            <h6 class="m-0">Agent Commission
                                                </h6>
                                        </div>
                                        <div class="row" style="margin-top:5px;">
                                            <!--agent allocation details-->
                                            <div class="col-md-6">
                                                    <div class="form-row">

                                                            <div class="form-group col-md-4">
                                                                    <label style="margin-left:10%;" for="feEmailAddress">Agent Name*</label>

                                                                </div>
                                                            <div class="form-group col-md-8">

                                                                    <select id="agentname" class="form-control select2" required>
                                                                            <option selected disabled>Select</option>
                                                                            {{-- <option value="1">Customer 1</option>
                                                                            <option value="2">Customer 2</option>
                                                                            <option value="3">Customer 3</option> --}}
                                                                        </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">

                                                                <div class="form-group col-md-4">
                                                                        <label style="margin-left:10%;" for="feEmailAddress">Site Name*</label>

                                                                    </div>
                                                                <div class="form-group col-md-8">

                                                                        <select id="sitename" class="form-control select2" required>
                                                                                <option selected disabled>Select</option>
                                                                                {{-- <option value="1">Site 1</option>
                                                                                <option value="2">Site 2</option>
                                                                                <option value="3">Site 3</option> --}}
                                                                            </select>
                                                                    </div>

                                                        </div>
                                                        <div class="form-row">
                                                                <div class="form-group col-md-4">
                                                                        <label style="margin-left:10%;" for="feEmailAddress"> Plot*</label>

                                                                    </div>
                                                                <div class="form-group col-md-8">

                                                                        <select id="ploats" class="form-control select2" required>
                                                                                <option selected disabled>Select</option>
                                                                                {{-- <option value="1">Ploats 1</option>
                                                                                <option value="2">Ploats 2</option>
                                                                                <option value="3">Ploats 3</option> --}}
                                                                            </select>
                                                                </div>
                                                        </div>

                                            </div>
                                            <!--payment allocation details-->
                                            <div class="col-md-6">
                                                    <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                    <label style="margin-left:10%;" for="feEmailAddress">Opening Balance</label>

                                                                </div>

                                                                    <div class="form-group col-md-8">
                                                                            <input class="form-control" type="number" id="openingbalance" name="openingbalance" value="Amount" style="margin-left:-3%;" disabled>

                                                                        </div>


                                                    </div>
                                                    <div class="form-row">
                                                            <div class="form-group col-md-2">
                                                                    <label style="margin-left:10%;" for="feEmailAddress"> Paid*</label>

                                                                </div>
                                                            <div class="form-group col-md-2">
                                                                    <input  style="margin-left:10%;" class="crradio" type="radio" id="credit" name="amtinfo" value="cr"> Credit

                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                        <input type="radio" id="debit" class="crradio" name="amtinfo" value="dr"> Debit

                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                            <input class="form-control amtdata"  type="number" id="amt" name="amt" value="Amount" style="margin-left:-3%;" <?php if($val->createright==0){echo "disabled"; }?> >

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                            <div class="form-group col-md-4">
                                                                                    <label style="margin-left:10%;" for="feEmailAddress">Ramain Amount*</label>

                                                                                </div>
                                                                            <div class="form-group col-md-8">
                                                                                    <input class="form-control" type="number" id="remainamt" name="remainamt" style="margin-left:-3%;" value="Amount" disabled>

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

                                    <div class="card-header border-bottom">
                                            <h6 class="m-0">History </h6>
                                        </div>
                                    <div class="form-row">
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
                                                                  </tr> --}}

                                                    </tbody>
                                            </table>
                                    </div>



                                    <div class="form-group col-md-12" align="right">
                                            <button type="submit"  id="btnsavedata" class="btn btn-success" <?php if($val->createright==0){echo "disabled"; }?>>Save
                                                    </button>
                                                    <input type="hidden" name="save_update" id="save_update" value="">
                                                    {{-- <button type="button" class="btn btn-danger">Delete
                                                            </button> --}}
                                        </div>



                            </div>
                        </form>
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

    var profileupload="{{url('uploadingfile')}}";
    var getallsitename="{{url('getdropagent')}}";
    var getallsite="{{url('getagentsite')}}";
    var getsiteploat="{{url('getagentsiteploat')}}"
    var add_data="{{route('agentcommission.store') }}";
    var getalldata="{{url('getagentcommssioninfo')}}";
    var getcommssioninfo="{{url('getagentallcommssion')}}";
    var getcommssiondata="{{url('getagenthistory')}}";
    var editrt="<?php  echo $editright; ?>";
    var delrt="<?php  echo $deleteright; ?>";
    var creatert="<?php  echo $createright; ?>";
    var delete_data="{{url('deleteagentcommsion')}}";

</script>
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/agentcommssion.js') }}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
