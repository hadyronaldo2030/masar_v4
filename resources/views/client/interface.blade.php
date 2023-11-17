@extends('client.layout.shardClient')

@section('style')
<link href="{{asset($globalVariable .'assetsClinet')}}/css/home.css"  rel="stylesheet">

@endsection


@section('content')
<div id="particles-js"></div>

	<!-- Navbar -->
    <div class="body">
        <nav>
            <div class="d-flex">
                {{-- Button Slider --}}
                {{-- <button id="btnSlider" class="icon">
                    <i class="fa-solid fa-bars-staggered fa-lg"></i>
                </button> --}}
                {{-- Full Screen --}}
                <button class="icon" id="fullscreenButton">
                    <img src="{{ asset($globalVariable . 'assets') }}/img/maximize.png" id="fullscreenIcon" />
                </button>
                {{-- Dark Mode --}}
                <button class="icon d-none d-lg-inline themeicons">
                    <i class="fa-solid fa-lightbulb fa-lg themeicon btnLight"></i>
                    <i class="fa-solid fa-moon fa-lg themeicon d-none"></i>
                </button>
            </div>
            {{-- <!-- user Nav --> --}}

            {{-- Start Auth  --}}
            <span class='userNav'>
                <div class="d-flex flex-column align-items-end">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-chevron-down fa-2xs mx-2"></i>
                        {{ Auth::user()->name }}
                    </div>
                    <div style="font-size: 14px;" class="d-block">{{ Auth::user()->jobTitle }}</div>
                </div>
                <div class="dropdownUser d-none">
                    <a href="{{ route('admin.hr.show', Auth::user()->id  ) }}">Profile </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <span class="boxuser">
                    @if(Auth::user()->image)
                    <img style="object-fit: cover; object-position:center;" src="{{ asset($globalVariable .'images')}}/{{Auth::user()->image}}"  alt="{{ Auth::user()->name }} ">
                    @else 
                    <img src="{{ asset($globalVariable . 'assets') }}/img/user.png" alt=""></span>
                    @endif           
                </span>
            {{-- End Auth  --}}

        </nav>
        <!-- End Navbar -->

        <!-- Start Header -->
        <header>
            <div id="myDIV" class="boxSection">
                <!-- Card Followe -->
                <button class="buttonHeader tablink btnCards" onclick="openPage('Followe', this)">
                    <div class="mb-3">
                        <span>
                            <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/2icons.png" alt="">
                        </span>
                        <h5 class="d-inline-block">Customer Followe</h5>
                    </div>
                    <ul class="timeline">
                        <li " class="dotsTop"><i class="fa-solid fa-circle"></i> Test</li>
                        <li "><i class="fa-solid fa-circle"></i>Test</li>
                        <li " class="dotsBottom"><i class="fa-solid fa-circle"></i>Test</li>
                    </ul>
                </button>
                <!-- Card System -->
                <button class="buttonHeader default tablink btnCards active" onclick="openPage('System', this)" id="defaultOpen">
                    <div class="mb-3">
                        <span>
                            <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/company.png" alt="">
                        </span>
                        <h5 class="d-inline-block">System Company</h5>
                    </div>
                    <ul class="timeline">
                        <li class="dotsTop"><i class="fa-solid fa-circle"></i> HR</li>
                        <li><i class="fa-solid fa-circle"></i>Finance</li>
                        <li><i class="fa-solid fa-circle"></i>Manager</li>
                        <li class="dotsBottom"><i class="fa-solid fa-circle"></i>Tasks</li>
                    </ul>
                </button>
                <!-- Card Service -->
                <button class="buttonHeader tablink btnCards" onclick="openPage('Service', this)">
                    <div class="mb-3">
                        <span>
                            <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/1icons.png" alt="">
                        </span>
                        <h5 class="d-inline-block">Customer Service</h5>
                    </div>
                    <ul class="timeline">
                        <li class="dotsTop"><i class="fa-solid fa-circle"></i> Marketing</li>
                        <li><i class="fa-solid fa-circle"></i>Programing</li>
                        <li class="dotsBottom"><i class="fa-solid fa-circle"></i>Other Service</li>
                    </ul>
                </button>
            </div>
            <div class="detailsCards">
                <div id="Followe" class="tabcontent">
                    <h4> Customer Followe</h4>
                    <div class="boxBtnSection">
                        <a href="#" class="btnSection">
                            <p>Test</p>
                        </a>
                        <a href="#" class="btnSection">
                            <p>Test</p>
                        </a>
                        <a href="#" class="btnSection">
                            <p>Test</p>
                        </a>
                     
                    </div>
                </div>

                <div>
                    <div id="System" class="tabcontent">
                    <h4>System Company</h4>
                    <div class="boxBtnSection">
                        {{-- <button href="{{url('/admin/hr/empList')}}" class="btnSection" {{ (Auth::user()->role != 'hr' && Auth::user()->role != 'admin') ? 'disabled' : '' }} >
                            <p>HR</p>
                        </button> --}}
                        <a href="{{ (Auth::user()->role != 'hr' && Auth::user()->role != 'admin' && Auth::user()->role != 'dataentry') ? '#' : url('/admin/hr/empList') }}" class="btnSection {{ (Auth::user()->role != 'hr' && Auth::user()->role != 'admin' && Auth::user()->role != 'dataentry') ? 'cursor-no-drop' : "" }}">
                            <p>HR</p>
                        </a>
                        <a href="{{ (Auth::user()->role != 'finance' && Auth::user()->role != 'admin') ? '#' : url('/admin/finance/dashboard') }}" class="btnSection {{ (Auth::user()->role != 'finance' && Auth::user()->role != 'admin') ? 'cursor-no-drop' : "" }}">
                            <p>Finance</p>
                        </a>
                        <a href="{{ (Auth::user()->role != 'manager' && Auth::user()->role != 'admin') ? '#' : route('manager.listEmployee') }}" class="btnSection  {{ (Auth::user()->role != 'admin' && Auth::user()->role != 'manager') ? 'cursor-no-drop' : "" }}" >
                            <p>Manager</p>
                        </a>
                        <a href="{{ route('admin.hr.show', Auth::user()->id  ) }}" class="btnSection ">
                            <p>Employee</p>
                        </a>
                    </div>
                </div>

                <div id="Service" class="tabcontent">
                    <h4> Customer Service</h4>
                    <div class="boxBtnSection">
                        {{-- @can('isAdmin') --}}
                        <a href="#" class="btnSection">
                            {{-- <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/content.png" alt=""> --}}
                            <p>Marketing</p>
                        </a>
                        
                        {{-- @endcan --}}
                        <a href="#" class="btnSection">
                            {{-- <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/coding.png" alt=""> --}}
                            <p>Programing</p>
                        </a>
                        <a href="#" class="btnSection">
                            {{-- <img class="iconImg" src="{{asset($globalVariable .'assetsClinet')}}/imgs/add.png" alt=""> --}}
                            <p>Other Service</p>
                        </a>
                    </div>
                </div>
            </div>
        </header>
    </div>
	<!-- End Header -->



@endsection




@section('script')
<script src="{{asset($globalVariable .'assetsClinet')}}/js/home.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    particlesJS('particles-js', {
        "particles": {
        "number": {
            "value": 100, // عدد الجسيمات
            "density": {
            "enable": true,
            "value_area": 800
            }
        },
        "color": {
            "value": "#1778fb"  // لون الجسيمات
        },
        "shape": {
            "type": "circle",  // نوع الشكل (يمكن أن يكون "circle", "edge", "triangle", "polygon", "star", "image")
            "stroke": {
            "width": 0,
            "color": "#000000"  // عرض ولون الحدود
            },
            "polygon": {
            "nb_sides": 5  // عدد الأضلاع لشكل مضلع (إذا كان الشكل من نوع "polygon")
            },
            "image": {
            "src": "img/github.svg",
            "width": 100,
            "height": 100
            }
        },
        "opacity": {
            "value": 0.5,  // شفافية الجسيمات
            "random": false,
            "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
            }
        },
        "size": {
            "value": 6,  // حجم الجسيمات
            "random": true,
            "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
            }
        },
        "line_linked": {
            "enable": true,  // تفعيل الارتباطات بين الجسيمات
            "distance": 150,  // المسافة بين الجسيمات التي تتصل بخط
            "color": "#1778fb",  // لون الارتباطات
            "opacity": 0.3,  // شفافية الارتباطات
            "width": 2  // عرض الارتباطات
        },
        "move": {
            "enable": true,  // تفعيل حركة الجسيمات
            "speed": 6,  // سرعة حركة الجسيمات
            "direction": "none",  // اتجاه الحركة ("none", "top", "top-right", "right", "bottom-right", "bottom", "bottom-left", "left", "top-left")
            "random": false,  // تحديد حركة عشوائية أو ثابتة
            "straight": false,  // حركة مباشرة أم لا
            "out_mode": "out",  // ماذا يحدث عند خروج الجسيمات من المنطقة ("out", "bounce")
            "bounce": false,  // تمكين أو تعطيل الانعكاس عند الحدود
            "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
            }
        }
        },
        "interactivity": {
        "detect_on": "canvas",  // أين يتم اكتشاف التفاعل ("canvas", "window")
        "events": {
            "onhover": {
            "enable": true,
            "mode": "repulse"  // وضع التفاعل عند تحويل الماوس فوقها ("grab", "bubble", "repulse", "image", "trail")
            },
            "onclick": {
            "enable": true,
            "mode": "push"  // وضع التفاعل عند النقر ("push", "remove", "bubble")
            },
            "resize": true  // تمكين تفاعل عند تغيير حجم الشاشة
        },
        "modes": {
            "grab": {
            "distance": 400,  // المسافة عندما يتم الاستيلام ("grab" mode)
            "line_linked": {
                "opacity": 1
            }
            },
            "bubble": {
            "distance": 400,  // المسافة عندما يتم النقر لإنشاء فقاعات ("bubble" mode)
            "size": 40,   // حجم الفقاعات
            "duration": 2,  // مدة الفقاعات (ثانية)
            "opacity": 8,
            "speed": 3
            },
            "repulse": {
            "distance": 200,  // المسافة عندما تتم دفع الجسيمات ("repulse" mode)
            "duration": 0.4  // مدة الدفع (ثانية)
            },
            "push": {
            "particles_nb": 4  // عدد الجسيمات عند الدفع ("push" mode)
            },
            "remove": {
            "particles_nb": 2  // عدد الجسيمات عند الإزالة ("remove" mode)
            }
        }
        },
        "retina_detect": true  // كشف العينات عالية الوضوح
    });
    });
</script>
@endsection
