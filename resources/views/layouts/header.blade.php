<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Analytics Dashboard - This is an example dashboard created using build-in elements and components.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link rel="stylesheet" href="{{ URL::asset('resources/datatable/css/jquery.dataTables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/css/main.css') }}" />
  {{--  datatable CSS  --}}


  <link rel="stylesheet" href="{{ URL::asset('resources/sass/select2/select2.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" type="text/css" href="{{ URL::asset('/resources/sass/sweetalert/sweetalert.css',true) }}" />

   {{--  tost msg  --}}
   <link href="{{ URL::asset('/resources/sass/toastr/toastr.min.css',true) }}" rel="stylesheet">

 <!-- datepicker -->
 <link rel="stylesheet" type="text/css"
 href="{{ URL::asset('/resources/sass/datepicker/bootstrap-datepicker3.min.css',true) }}" />

</head>
