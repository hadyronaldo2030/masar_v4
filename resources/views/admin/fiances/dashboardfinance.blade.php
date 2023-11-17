@extends('admin.fiances.layouts.shardfiances')

@section('style')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link href="{{asset($globalVariable .'assets')}}/css/dashbordfinanci.css" rel="stylesheet">
@endsection

@section('content')

    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Finance | Dashbord</h3>
        </div>
        <!-- View Bar -->
        <div class="viewBar">
            <div style="margin-left: 0" class="col boxBar totalEmp">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Employees</h6>
                        <h3>12</h3>
                    </span>
                    <span class="boxIcon boxOrange">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </span>
                </div>
                <div class="statusBar">
                    <span class="upArrow text-danger"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                    <span class="mx-2 text-warning">29</span>
                    <span class="opacityText">For Month</span>
                </div>
            </div>
            <div class="col boxBar department">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Department</h6>
                        <h3>3</h3>
                    </span>
                    <span class="boxIcon boxBlue">
                        <i class="fa-solid fa-signal fa-xl"></i>
                    </span>
                </div>
                <div class="statusBar">
                    <span class="upArrow text-success"><i class="fa-solid fa-arrow-trend-up fa-2xs"></i></span>
                    <span class="mx-2 text-success">3</span>
                    <span class="opacityText">For Last Month</span>
                </div>
            </div>
            <div class="col boxBar expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Expenses</h6>
                        <h3>130</h3>
                    </span>
                    <span class="boxIcon boxGreen">
                        <i class="fa-solid fa-dollar fa-xl"></i>
                    </span>
                </div>
                <div class="statusBar">
                    <span class="upArrow text-danger"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                    <span class="mx-2 text-warning">122</span>
                    <span class="opacityText">For Last Month</span>
                </div>
            </div>
            <div style="margin-right: 0" class="col boxBar expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Clients</h6>
                        <h3>324</h3>
                    </span>
                    <span class="boxIcon boxGray">
                        <i class="fa-solid fa-handshake-simple fa-xl"></i>
                    </span>
                </div>
                <div class="statusBar">
                    <span class="upArrow text-danger"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                    <span class="mx-2 text-warning">543</span>
                    <span class="opacityText">For Last Month</span>
                </div>
            </div>
        </div>

        <!-- view heade -->
        <div class="viewplan">
            <div class="boxHead totalEmp">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Clients</h6>
                        <h3>324</h3>
                    </span>
                    {{-- <span class="boxIcon boxOrange">
                        <i class="fa-solid fas fa-user fa-xl"></i>
                    </span> --}}
                </div>
                <canvas id="ChartLine"></canvas>
            </div>
            <div class="boxHead expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Clients</h6>
                        <h3>324</h3>
                    </span>
                    {{-- <span class="boxIcon boxGray">
                        <i class="fa-solid fas fa-feather fa-xl"></i>
                    </span> --}}
                </div>
                <canvas id="ChartBar" ></canvas>
            </div>
        </div>
    </header>
    <!-- End Header -->

@endsection


@section('scripts')
<script src="{{asset($globalVariable .'assets')}}/js/dashbordfinanci.js"></script>

@endsection
