<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Management</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="{{asset('dashboard\img\logo.png')}}">



    <!-- Favicon -->
    @include('dashboard.layout.css')
</head>


<body>
  
    <div id="hrupreloader">
        <div class="loader">
            <div class="loader-container">
                <div class="loader-icon">
                    
                    <img src="{{asset('dashboard\img\logo.png')}}"
                        alt="Preloader">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <!-- Sidebar Start -->
     
        @include('dashboard.layout.admin_sidebar')

        <!-- Sidebar End -->