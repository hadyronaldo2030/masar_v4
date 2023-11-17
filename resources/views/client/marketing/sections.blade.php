@extends('client.layout.shardClient')

@section('style')
    <link href="{{ asset($globalVariable . 'assetsClinet') }}/css/sections.css" rel="stylesheet"">
@endsection


@section('content')
    <!-- Navbar -->
    <div class="container">
        <nav>
            <!-- user Nav -->
            <span class='userNav'>
                <span class="boxuser"><img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/user.png"
                        alt=""></span>
                {{ Auth::user()->name }}
                <i class="fa-solid fa-chevron-down  fa-2xs"></i>
                <div class="dropdownUser d-none">
                    <a href="#">Profile </a>

                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </span>
            <!-- logo Navbar -->
            <a href="{{route('home')}}" class='logoNav'>
                <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/Masar-Social-media-ابيض--.png" />
            </a>
            <!-- Lang Navbar -->
            <span class='lang'>
                <i class="fa-solid fa-chevron-down fa-2xs"></i>
                <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/united-states.png" alt="">
                <div class="dropdownLang d-none">
                    <a href="#"><img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/egypt.png"
                            alt=""></a>
                    <a href="#"><img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/united-states.png"
                            alt=""> </a>
                </div>
            </span>
        </nav>
    </div>
    <!-- End Navbar -->

    <!-- Start Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <!-- Section Marketing -->
                    <div class="sections nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="btnCards nav-link active" id="v-pills-digitalMarketing-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-digitalMarketing" type="button" role="tab"
                            aria-controls="v-pills-digitalMarketing" aria-selected="true">Digital Marketing</button>
                        <button class="btnCards nav-link" id="v-pills-digitalPrint-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-digitalPrint" type="button" role="tab"
                            aria-controls="v-pills-digitalPrint" aria-selected="false">Digital Print</button>
                        <button class="btnCards nav-link" id="v-pills-affiliateMarketing-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-affiliateMarketing" type="button" role="tab"
                            aria-controls="v-pills-affiliateMarketing" aria-selected="false">Affiliate Marketing</button>
                        <button class="btnCards nav-link" id="v-pills-realEstate-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-realEstate" type="button" role="tab"
                            aria-controls="v-pills-realEstate" aria-selected="false">Real Estate Marketing</button>
                        <button class="btnCards nav-link" id="v-pills-mediaProduction-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-mediaProduction" type="button" role="tab"
                            aria-controls="v-pills-mediaProduction" aria-selected="false">Media Production</button>
                        <button class="btnCards nav-link" id="v-pills-customerService-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-customerService" type="button" role="tab"
                            aria-controls="v-pills-customerService" aria-selected="false">Customer Service</button>
                    </div>
                </div>

                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-digitalMarketing" role="tabpanel"
                            aria-labelledby="v-pills-digitalMarketing-tab" tabindex="0">
                            <!-- Digital Marketing -->
                            <div class="sectionsRow nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="btnCards nav-link active" id="v-pills-SEO-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-SEO" type="button" role="tab"
                                    aria-controls="v-pills-SEO" aria-selected="true">SEO</button>
                                <button class="btnCards nav-link" id="v-pills-Social-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-Social" type="button" role="tab"
                                    aria-controls="v-pills-Social" aria-selected="false">Social Media</button>
                                <button class="btnCards nav-link" id="v-pills-googleMarketing-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-googleMarketing" type="button" role="tab"
                                    aria-controls="v-pills-googleMarketing" aria-selected="false">Google
                                    Marketing</button>
                                <button class="btnCards nav-link" id="v-pills-contentMarketing-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-contentMarketing" type="button" role="tab"
                                    aria-controls="v-pills-contentMarketing" aria-selected="false">Content
                                    Marketing</button>
                                <button class="btnCards nav-link" id="v-pills-E-mail-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-E-mail" type="button" role="tab"
                                    aria-controls="v-pills-E-mail" aria-selected="false">E-mail Marketing</button>
                                <button class="btnCards nav-link" id="v-pills-Viral-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-Viral" type="button" role="tab"
                                    aria-controls="v-pills-Viral" aria-selected="false">Viral Marketing</button>
                                <button class="btnCards nav-link" id="v-pills-Analysis-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-Analysis" type="button" role="tab"
                                    aria-controls="v-pills-Analysis" aria-selected="false">Analysis Marketing</button>
                            </div>
                            <div class="tab-content contentSection" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-SEO" role="tabpanel"
                                    aria-labelledby="v-pills-SEO-tab" tabindex="0">
                                    <!-- ========================== -->

                                    <div class="container">
                                        <input type="radio" name="slider" class="d-none" id="s1" checked>
                                        <input type="radio" name="slider" class="d-none" id="s2">
                                        <input type="radio" name="slider" class="d-none" id="s3">
                                        <input type="radio" name="slider" class="d-none" id="s4">
                                        <input type="radio" name="slider" class="d-none" id="s5">

                                        <div class="cards">
                                            <label for="s1" id="slide1">
                                                <div class="card">
                                                    <div class="image">
                                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/facebook.png"
                                                            alt="">
                                                        <div class="dots">
                                                            <div></div>
                                                            <div></div>
                                                            <div></div>
                                                        </div>
                                                    </div>
                                                    <h4>Face Book</h4>
                                                </div>
                                            </label>

                                            <label for="s2" id="slide2">
                                                <div class="card">
                                                    <div class="image">
                                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/messenger.png"
                                                            alt="">
                                                        <div class="dots">
                                                            <div class="dot1"></div>
                                                            <div class="dot2"></div>
                                                            <div class="dot3"></div>
                                                        </div>
                                                    </div>
                                                    <h4>Messenger</h4>
                                                </div>
                                            </label>

                                            <label for="s3" id="slide3">
                                                <div class="card">
                                                    <div class="image">
                                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/tiktok.png"
                                                            alt="">
                                                        <div class="dots">
                                                            <div class="dot1"></div>
                                                            <div class="dot2"></div>
                                                            <div class="dot3"></div>
                                                        </div>
                                                    </div>
                                                    <h4>Tiktok</h4>
                                                </div>
                                            </label>

                                            <label for="s4" id="slide4">
                                                <div class="card">
                                                    <div class="image">
                                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/twitter.png"
                                                            alt="">
                                                        <div class="dots">
                                                            <div class="dot1"></div>
                                                            <div class="dot2"></div>
                                                            <div class="dot3"></div>
                                                        </div>
                                                    </div>
                                                    <h4>Twitter</h4>
                                                </div>
                                            </label>

                                            <label for="s5" id="slide5">
                                                <div class="card">
                                                    <div class="image">
                                                        <img src="{{ asset($globalVariable . 'assetsClinet') }}/imgs/youtube.png"
                                                            alt="">
                                                        <div class="dots">
                                                            <div class="dot1"></div>
                                                            <div class="dot2"></div>
                                                            <div class="dot3"></div>
                                                        </div>
                                                    </div>
                                                    <h4>You Tube</h4>
                                                </div>
                                            </label>
                                        </div>

                                    </div>
                                    <!-- ========================== -->
                                </div>
                                <div class="tab-pane fade" id="v-pills-Social" role="tabpanel"
                                    aria-labelledby="v-pills-Social-tab" tabindex="0">3000000</div>
                                <div class="tab-pane fade" id="v-pills-googleMarketing" role="tabpanel"
                                    aria-labelledby="v-pills-googleMarketing-tab" tabindex="0">2000000</div>
                                <div class="tab-pane fade" id="v-pills-contentMarketing" role="tabpanel"
                                    aria-labelledby="v-pills-contentMarketing-tab" tabindex="0">1000000</div>
                                <div class="tab-pane fade" id="v-pills-mail" role="tabpanel"
                                    aria-labelledby="v-pills-mail-tab" tabindex="0">1000000</div>
                                <div class="tab-pane fade" id="v-pills-Viral" role="tabpanel"
                                    aria-labelledby="v-pills-Viral-tab" tabindex="0">1000000</div>
                                <div class="tab-pane fade" id="v-pills-Analysis" role="tabpanel"
                                    aria-labelledby="v-pills-Analysis-tab" tabindex="0">1000000</div>
                            </div>
                            <!-- End Digital Marketing -->
                        </div>

                        <div class="tab-pane fade" id="v-pills-digitalPrint" role="tabpanel"
                            aria-labelledby="v-pills-digitalPrint-tab" tabindex="0">2</div>
                        <div class="tab-pane fade" id="v-pills-affiliateMarketing" role="tabpanel"
                            aria-labelledby="v-pills-affiliateMarketing-tab" tabindex="0">3</div>
                        <div class="tab-pane fade" id="v-pills-realEstate" role="tabpanel"
                            aria-labelledby="v-pills-realEstate-tab" tabindex="0">
                            <!--  -->
                            <div class="sectionsRow nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <button class="btnCards nav-link active" id="v-pills-sms-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-sms" type="button" role="tab"
                                    aria-controls="v-pills-sms" aria-selected="true">sms</button>
                                <button class="btnCards nav-link" id="v-pills-Social-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-Social" type="button" role="tab"
                                    aria-controls="v-pills-Social" aria-selected="false">Social</button>
                                <button class="btnCards nav-link" id="v-pills-seo-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-seo" type="button" role="tab"
                                    aria-controls="v-pills-seo" aria-selected="false">seo</button>
                                <button class="btnCards nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    data-bs-target="#v-pills-settings" type="button" role="tab"
                                    aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                            </div>
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-sms" role="tabpanel"
                                    aria-labelledby="v-pills-sms-tab" tabindex="0">4</div>
                                <div class="tab-pane fade" id="v-pills-Social" role="tabpanel"
                                    aria-labelledby="v-pills-Social-tab" tabindex="0">3</div>
                                <div class="tab-pane fade" id="v-pills-seo" role="tabpanel"
                                    aria-labelledby="v-pills-seo-tab" tabindex="0">2</div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab" tabindex="0">1</div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- popup window  -->
    <div id="overlay">
        <div class="wapper">
            <div class="popup">
                <div class="titlePopup">
                    <h4>People</h4>
                    <span id="btnClose">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End popup window  -->
@endsection




@section('script')
    <script src="{{ asset($globalVariable . 'assetsClinet') }}/js/sections.js"></script>
@endsection
