@include('layouts.header')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/main.css') }}" />
<body>

    <style>
        .main_menu {
            font-weight: bold;
            background: #00FF00;

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


        <?php
        $editright=0;
        $deleteright=0;
        ?>





        <div class="app-main">
            @include('layouts.sidebar')

            @if(is_null($sidebar))

            @else


            @foreach($sidebar as $val)
            @if(($val->menuid==2  && $val->submenuid==7) && ($val->viewright==1 || $val->editright==1 || $val->deleteright==1 || $val->createright==1 ))
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
                                       <i class="fa fa-id-card icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                <div>
                                   Right Management
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
                                        <i class="fa fa-plus"></i> Add Right</button>
                                        <button class="btn btn-danger  closehideshow"
                                        style="display:none;">
                                        Close</button>
                                        @endif
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row tablehideshow card">


                        <div class="col-md-12" style="width:100%">
                            <div class="table-responsive" id="show_master" >
                                <table id="customermaster"
                                    class="align-middle mb-0 table table-borderless table-striped table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>  Role  Name</th>


                                     <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                    <th class="text-center">1</th>
                                                    <th>Agent 1</th>


                                                    <td><button  class="edit btn btn-sm btn-primary"   id="' + row_id + '"  ><i class="fa fa-edit"></i></button>&nbsp;&nbsp;<button  class="regional_delete_data1 btn btn-sm btn-danger"   id="del_' + row_id + '"  ><i class="fa fa-trash"> </i></button></td>
                                                </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                    <div class="row formhideshow card" style="display:none;" >
                        <div class="col-md-12">
                                <form id="rightmanagement_form" name="rightmanagement_form">
                            <div class="row card">
                                    <div class="card-header border-bottom">
                                            <h6 class="m-0">Right Management
                                                </h6>
                                        </div>

                                    <div class="form-row" style="margin-top:5px;">
                                            <br>
                                            <div class="form-group col-md-2">
                                                    <label style="margin-left:10%;" for="feEmailAddress">Role Name*</label>

                                                </div>
                                            <div class="form-group col-md-4">
                                                    <input type="text" class="form-control"
                                                    id="rolename" name="rolename" placeholder="Role Name"
                                                   required >

                                            </div>


                                    </div>


                                    <div class="card">
                                        <input type="hidden" id="doc_row_id" name="doc_row_id" value="0">
                                            <table  class="table table-bordered table-striped" id="docupload">
                                                    <thead>
                                                        <tr>
                                                          <th>Menu Name</th>
                                                          <th>View</th>
                                                          <th>Create</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbd_user_rights">
                                                            <tr>
                                                                    <th  bgcolor="#00FF00" colspan="6" ><input type="checkbox" name="master" id="master"> Master</th>

                                                             </tr>
                                                             <tr>

                                                                    <td><input type="checkbox" class="allsel" name="customer" id="customer">Customer</td>
                                                                    <td> <input type="checkbox"  class="allsel"  name="cview" id="cview"></td>
                                                                    <td><input type="checkbox" class="allsel"  name="crview" id="crview"></td>
                                                                    <td><input type="checkbox" class="allsel"  name="eview" id="eview"></td>
                                                                    <td><input type="checkbox" class="allsel"  name="dview" id="dview"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="agent" id="agent">Agent</td>
                                                                    <td> <input type="checkbox" name="agentview" id="agentview"></td>
                                                                    <td><input type="checkbox" name="agentcreate" id="agentcreate"></td>
                                                                    <td><input type="checkbox" name="agentedit" id="agentedit"></td>
                                                                    <td><input type="checkbox" name="agentdel" id="agentdel"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="site" id="site">Site Master</td>
                                                                    <td> <input type="checkbox" name="siteview" id="siteview"></td>
                                                                    <td><input type="checkbox" name="sitecreate" id="sitecreate"></td>
                                                                    <td><input type="checkbox" name="siteedit" id="siteedit"></td>
                                                                    <td><input type="checkbox" name="sitedel" id="sitedel"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="site" id="site">Plot Allocation</td>
                                                                    <td> <input type="checkbox" name="siteview" id="siteview"></td>
                                                                    <td><input type="checkbox" name="sitecreate" id="sitecreate"></td>
                                                                    <td><input type="checkbox" name="siteedit" id="siteedit"></td>
                                                                    <td><input type="checkbox" name="sitedel" id="sitedel"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="site" id="site">Agent Commission</td>
                                                                    <td> <input type="checkbox" name="siteview" id="siteview"></td>
                                                                    <td><input type="checkbox" name="sitecreate" id="sitecreate"></td>
                                                                    <td><input type="checkbox" name="siteedit" id="siteedit"></td>
                                                                    <td><input type="checkbox" name="sitedel" id="sitedel"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="site" id="site">Employ</td>
                                                                    <td> <input type="checkbox" name="siteview" id="siteview"></td>
                                                                    <td><input type="checkbox" name="sitecreate" id="sitecreate"></td>
                                                                    <td><input type="checkbox" name="siteedit" id="siteedit"></td>
                                                                    <td><input type="checkbox" name="sitedel" id="sitedel"></td>
                                                             </tr>
                                                             <tr>
                                                                    <td><input type="checkbox" name="site" id="site">Right Management</td>
                                                                    <td> <input type="checkbox" name="siteview" id="siteview"></td>
                                                                    <td><input type="checkbox" name="sitecreate" id="sitecreate"></td>
                                                                    <td><input type="checkbox" name="siteedit" id="siteedit"></td>
                                                                    <td><input type="checkbox" name="sitedel" id="sitedel"></td>
                                                             </tr>


                                                    </tbody>
                                            </table>
                                    </div>



                                    <div class="form-group col-md-12" align="right">
                                            <button type="submit"  id="btnsavedata" class="btn btn-success">Save
                                                    </button>
                                                    <input type="hidden" id="save_update" name="save_update">
                                                    @if($val->deleteright==1)
                                                    <button type="button" class="btn btn-danger">Delete
                                                            </button>
                                                            @endif
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
    var getallmenudata="{{url('get_menu')}}";
    var add_data="{{route('rolemanagement.store') }}";
    var getalldata="{{url('getallrole')}}";
    var geturight="{{url('getuserright')}}";
    var editrt="<?php  echo $editright; ?>";
    var delrt="<?php  echo $deleteright; ?>";
    var delete_data="{{url('deleterole')}}";
</script>
<script type='text/javascript' src="{{ URL::asset('/resources/js/myjs/rolemanage.js') }}"></script>
<script src="{{ URL::asset('resources/sass/scripts/main.js') }}"></script>
