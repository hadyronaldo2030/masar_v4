



<!doctype html>
<html lang="en" data-theme="lightMode">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset($globalVariable . 'assets') }}/img/M-.png">
    <title>Masar</title>

    <!--  Bootstrap v5.1.3 -->
    <link href="{{ asset($globalVariable . 'assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <!--  font Awesome -->
    <link href="{{ asset($globalVariable . 'assets') }}/fonts/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!--  Style css -->
    <link href="{{ asset($globalVariable . 'assets') }}/css/sharedAdmin.css" rel="stylesheet">
    @yield('style')
</head>

<body dir="rtl">
    <div id="loadingOverlay">
        <div class="loading">
            <div class="boxLogo">
                <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/Masar-Social-media-ابيض--.png" />
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

  
    <div dir="ltr" class="body">
        
        @yield('content')

    </div>
    <script>
        window.addEventListener('load', function() {
            var loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.style.display = 'none'; // يخفي شاشة التحميل عندما تحمل الصفحة بالكامل
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="{{ asset($globalVariable . 'assets') }}/js/jquery.slim.min.js"></script>
    <script src="{{ asset($globalVariable . 'assets') }}/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset($globalVariable . 'assets') }}/js/popper.js"></script>
    <script src="{{ asset($globalVariable . 'assets') }}/js/bootstrap.min.js"></script>


    <!-- Font Awesome -->
    {{-- <script src="{{asset($globalVariable . 'assets')}}/fonts/all.min.js"></script> --}}

    <script src="{{ asset($globalVariable . 'assets') }}/js/jquery.star-rating.js"></script>
    <!-- Js Index Java Script -->
    <script src="{{ asset($globalVariable . 'assets') }}/js/shared.js"></script>

    @yield('scripts')


</body>

</html>

