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







        <div class="app-main">
            @include('layouts.sidebar')


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
                                <div class="page-title-actions"> <button class="btn btn-success  btnhideshow"
                                        style="background-color:#00B050;">
                                        Add Detail</button>
                                        <button class="btn btn-danger  closehideshow"
                                        style="display:none;">
                                        Close</button>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row tablehideshow card">


                        <div class="col-md-12" style="width:100%">
                            <div class="table-responsive" >
                                <table id="customermaster"
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
                                </table>
                            </div>


                        </div>
                    </div>

                    <div class="row formhideshow card" style="display:none;">
                        <div class="col-md-12">
                            <div class="row card">
                                    <div class="card-header border-bottom">
                                            <h6 class="m-0">Agent Commission
                                                </h6>
                                        </div>

                                    <div class="form-row">

                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress">Agent Name</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="customername" class="form-control select2">
                                                            <option selected disabled>Select</option>
                                                            <option value="1">Customer 1</option>
                                                            <option value="2">Customer 2</option>
                                                            <option value="3">Customer 3</option>
                                                        </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <label for="feEmailAddress">Site Name</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="sitename" class="form-control select2">
                                                            <option selected disabled>Select</option>
                                                            <option value="1">Site 1</option>
                                                            <option value="2">Site 2</option>
                                                            <option value="3">Site 3</option>
                                                        </select>
                                                </div>

                                    </div>

                                    <div class="form-row">
                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress"> Ploats</label>

                                                </div>
                                            <div class="form-group col-md-4">

                                                    <select id="ploats" class="form-control select2">
                                                            <option selected disabled>Select</option>
                                                            <option value="1">Ploats 1</option>
                                                            <option value="2">Ploats 2</option>
                                                            <option value="3">Ploats 3</option>
                                                        </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                    <input type="radio" id="credit" name="amtinfo" value="credit"> Credit

                                                </div>
                                                <div class="form-group col-md-2">
                                                        <input type="radio" name="debit" value="amtinfo"> Debit

                                                    </div>
                                                    <div class="form-group col-md-2">
                                                            <input class="form-control" type="number" id="amt" name="amt" value="Amount">

                                                        </div>

                                    </div>

                                    <div class="card-header border-bottom">
                                            <h6 class="m-0">History </h6>
                                        </div>
                                    <div class="form-row">
                                        <input type="hidden" id="doc_row_id" name="doc_row_id" value="0">
                                            <table  class="table table-bordered table-striped" id="docupload">
                                                    <thead>
                                                        <tr>
                                                          <th>Date</th>
                                                          <th>Opening Balance</th>
                                                          <th>Amount</th>
                                                          <th>Credit/Debit</th>
                                                          <th>Remain</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="paymenttabletbody">
                                                            <tr>
                                                                    <th>10/01/2020</th>
                                                                    <th>100</th>
                                                                    <th>50</th>
                                                                    <th>Credit</th>
                                                                    <th>50</th>
                                                                  </tr>

                                                    </tbody>
                                            </table>
                                    </div>



                                    <div class="form-group col-md-12" align="right">
                                            <button type="submit"  id="btnsavedata" class="btn btn-success">Save
                                                    </button>
                                                    <button type="button" class="btn btn-danger">Delete
                                                            </button>
                                        </div>



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

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});


});
    $('#customermaster').DataTable({});

    var profileupload="{{url('uploadingfile')}}";


</script>
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/plotallocation.js') }}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
