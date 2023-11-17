<!DOCTYPE html>
<html lang="en" data-theme="lightMode">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--  Bootstrap v5.1.3 -->
	<link href="{{asset($globalVariable .'assetsClinet')}}/css/bootstrap.min.css" rel="stylesheet">

	<!--  font Awesome -->
	<link href="{{asset($globalVariable .'assetsClinet')}}/fonts/all.min.css" rel="stylesheet">
	<!--  Style css -->
    <link href="{{asset($globalVariable .'assetsClinet')}}/css/animate.css" rel="stylesheet"/>
    <link href="{{asset($globalVariable .'assetsClinet')}}/css/shared.css" rel="stylesheet"/>
    <link href="{{asset($globalVariable .'assetsClinet')}}/fonts/Oswald-VariableFont_wght" rel="stylesheet"/>

    @yield('style')
	<title> Masar Group | </title>
</head>
<body>
    <div id="loadingOverlay">
        <div class="loading">
            <div class="boxLogo">
                <img src="{{asset($globalVariable .'assetsClinet')}}/imgs/Masar-Social-media-ابيض--.png"/>
            </div>
            <div>
                <div id="loop" class="center"></div>
                <span class="lineStreet"></span>
                <div id="bike-wrapper" class="center">
                <div id="bike" class="centerBike"></div>
                </div>
            </div>
        </div>
    </div>
@yield('content')




    <!-- Jquery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/jquery.slim.min.js"></script>
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/popper.js"></script>
	<script src="{{asset($globalVariable .'assetsClinet')}}/js/bootstrap.min.js"></script>
    <!-- fonts -->
    <script src="{{asset($globalVariable .'assetsClinet')}}/fonts/all.min.js"></script>

    <script src="{{asset($globalVariable .'assetsClinet')}}/js/shared.js"></script>


    <!-- Js particles -->
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/particles.js"></script>
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/app.js"></script>
    <script src="{{asset($globalVariable .'assetsClinet')}}/js/stats.js"></script>
    
    <script>
    window.addEventListener('load', function () {
        var loadingOverlay = document.getElementById('loadingOverlay');
        loadingOverlay.style.display = 'none'; // يخفي شاشة التحميل عندما تحمل الصفحة بالكامل
    });
    </script>
    @yield('script')

</body>
</html>
