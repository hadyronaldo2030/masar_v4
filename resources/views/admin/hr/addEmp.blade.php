@extends('admin.layout.shard')

@section('style')
    <link href="{{ asset($globalVariable . 'assets') }}/css/create.css" rel="stylesheet">
@endsection

@section('content')
    @error('mobile')
    <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="error404">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-skull-crossbones fs-5"></i>
                <span class="mx-2 fs-5"> (<span class="countdown">5</span>) {{ $message }}</span>
            </div>
        </div>
    </div>
        {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
    @enderror
    @error('image')
    <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="error404">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-skull-crossbones fs-5"></i>
                <span class="mx-2 fs-5"> (<span class="countdown">5</span>) {{ $message }}</span>
            </div>
        </div>
    </div>
        {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
    @enderror

    @error('error')
    <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="error404">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-skull-crossbones fs-5"></i>
                <span class="mx-2 fs-5"> (<span class="countdown">5</span>) {{ $message }}</span>
            </div>
        </div>
    </div>
        {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
    @enderror
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Add Employee</h3>
            <!-- Edit Employee -->
            {{-- <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Save</a> --}}
        </div>
        <!-- view heade -->
        <form class="viewHead needs-validation" novalidate action="{{ route('admin.hr.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!-- Card Employee -->
            <div class="boxCard">
                <div class="d-flex w-100">
                    <div class="cover">
                        <div class="cardImg">
                            <img id="myImage3" src="{{ asset($globalVariable . 'assets') }}/img/defult.jpeg" alt="">
                            <span id="editBtn3" class="">
                                <i class="fa-solid fa-camera fa-xl"></i>
                            </span>
                            <input type="file" name='image' value="{{ old('image') }}" id="newImage3"
                                style="display:none;">
                        </div>
                    </div>
                    <div class="userName">
                        <h4 id="d-name">User Name</h4>
                    </div>
                </div>
                <div class="infoCard">
                    <span id="d-email" class="py-2">masar@Email.come</span>
                    <span id="d-address" class="py-2">Address</span>
                    <h6 id="d-job" class=" py-2">Job Title</h6>
                    <span id="ageSpan" class="py-2">Age</span>
                    <h6 id="d-position" class="py-2">Position</h6>
                    <h6 id="d-department" class="py-2">Department</h6>
                    <h6 id="d-status" class="py-2">Status</h6>
                </div>
                <!-- Rating -->
                <div class="rating py-2"></div>
            </div>
            <!-- Personal Details -->
            <div class="personalDetails">
                <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <span class="nav-link active" id="person-tab" data-bs-toggle="tab" data-bs-target="#person"
                                type="button" role="tab" aria-controls="person" aria-selected="true">
                                person
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="tab-" id="myTabContent">
                    <!-- person -->
                    <div class="viewBar">
                        <div class="box1">
                            {{-- User Name --}}
                            <div class="boxInput">
                                <input id="live-name" type="text" class="form-control" placeholder="User Name"
                                    name="name" aria-label="Username" aria-describedby="addon-wrapping"
                                    value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                            </div>
                            {{-- email --}}
                            <div class="boxInput">
                                <input id="live-email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@email.com">
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            {{-- Generate Password --}}
                            <div class="boxInput salery">
                                <span id="generateButton" class="text-primary cursor-pointer"><i class="fa-solid fa-rotate-right"></i></span>
                                <input id="passwordField" class="form-control" placeholder="Generate Password" aria-label="password" name="password" aria-describedby="addon-wrapping">
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            {{-- Addres --}}
                            <div class="boxInput">
                                <input id="live-address" name="address" type="text" value="{{ old('address') }}" class="form-control"
                                placeholder="Address" aria-label="Username" aria-describedby="addon-wrapping">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="d-flex">
                                {{-- Mobile --}}
                                <div class="boxInput">
                                    <input name="mobile" type="text" value="{{ old('mobile') }}" class="form-control" maxlength="11"
                                        placeholder="+20 " aria-label="Username" aria-describedby="addon-wrapping">
                                    @error('mobile')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                {{-- Job Title --}}
                                <div class="boxInput ml-4">
                                    <input id="live-job" name="jobTitle" type="text" value="{{ old('jobTitle') }}"
                                        class="form-control" placeholder="job Title" aria-label="Username"
                                        aria-describedby="addon-wrapping">
                                    @error('jobTitle')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex">
                                {{-- position --}}
                                <div>
                                    <select name="role" id="live-position" class="w-100" >
                                        <option value="finance">Finance</option>
                                        <option value="manager">Manager</option>
                                        <option value="hr">HR</option>
                                        <option value="dataentry">Data Entry</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                @error('role')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                </div>
                                {{-- Salery --}}
                                <div class="boxInput salery ml-4">
                                    <span>.EGP</span>
                                    <input class="form-control" placeholder="Salery" aria-label="salery" name="salary"
                                        aria-describedby="addon-wrapping"  value="{{ old('salary') }}" >
                                    @error('salary')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="d-flex">
                                {{-- Age --}}
                                <div class="boxInput salery">
                                    <span class="mx-4">Age</span>
                                    <input id="birthdate" type="date" name="age" class="form-control" placeholder="Birthday"
                                        aria-label="Username" value="{{ old('age') }}"
                                        aria-describedby="addon-wrapping">
                                    @error('age')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                {{-- department --}}
                                <div class="boxInput ml-4">
                                    <select name="department" id="live-department" value="{{ old('department') }}"
                                        aria-label="Example select with button addon">
                                        <option value="programming">programming</option>
                                        <option value="graphics">graphics</option>
                                        <option value="Marketing">Marketing</option>
                                        <option value="Administrative">Administrative</option>
                                        <option value="photography">photography</option>
                                        <option value="video">video</option>
                                        <option value="sales">sales</option>
                                    </select>
                                @error('department')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div class="d-flex">
                                {{-- Status --}}
                                <div class="boxInput">
                                    <select id="inputGroupSelect03" name="status"
                                        aria-label="Example select with button addon" value="{{ old('status') }}">
                                        <option value="permanent">permanent</option>
                                        <option value="temporary">temporary</option>
                                        <option value="trainee">trainee</option>
                                    </select>
                                @error('status')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                </div>

                                <div class="d-flex">
                                    {{-- gender --}}
                                    <div class="boxInput ml-4">
                                        <select id="inputGroupSelect03" name="gender"
                                            aria-label="Example select with button addon" value="{{ old('gender') }}">
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                        </select>
                                    @error('gender')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="boxIdcard">
                            <div class="idaCard">
                                <img class="loupe" id="myImage2"
                                    src="{{ asset($globalVariable . 'assets') }}/img/1Egyption_ID.jpg" alt="">
                                <img id="zoomedImage">
                                <span id="editBtn2" class="">
                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                </span>
                                <input type="file" name='image3' value="{{ old('image3') }}" id="newImage2"
                                    style="display:none;">
                                @error('image3')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="idaCard">
                                <img class="loupe" id="myImage"
                                    src="{{ asset($globalVariable . 'assets') }}/img/Egyption_ID.jpg" alt="">
                                <img id="zoomedImage">
                                <span id="editBtn" class="">
                                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                </span>
                                <input type="file" name='image2' value="{{ old('image2') }}" id="newImage"
                                    style="display:none;">
                                @error('image2')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <input type="file" name='image' value="{{ old('image') }}" id="newImage3"
                                style="display:none;" disabled>
                                @error('image1')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <button class="saveBtn btn btn-primary">Create</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </header>

    <!-- End Header -->

    <!-- Satrt alert -->
    {{-- @error('mobile') --}}

    {{-- <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
        <div class="alertStyle" id="alertSuccess">
            <div class="d-flex align-items-center">
                <i class="fa-regular fa-circle-check fs-5"></i>
                <span class="mx-2">Employee Added Successfully.  (<span class="countdown">5</span>)</span>
            </div>
        </div>
        <div class="alertStyle" id="alertWrong">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                <span class="mx-2">Please see attached file for the business rule. (<span class="countdown">5</span>)</span>
            </div>
        </div>

        <div class="alertStyle" id="alertInfo" >
            <div class="d-flex align-items-center">
            <i class="fa-solid fa-circle-exclamation fs-5"></i>
            <span class="mx-2">An info occurs while adding a new employee. (<span class="countdown">5</span>)</span>
            </div>
        </div>

        <div class="alertStyle" id="error404">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-skull-crossbones fs-5"></i>
                <span class="mx-2 fs-5">Error 404 (<span class="countdown">5</span>)</span>
            </div>
        </div>
    </div>
    @enderror
    --}}
    <!-- End alert -->

@endsection

@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/addEmp.js"></script>
    <!-- Font Awesome -->
    <script src="{{ asset($globalVariable . 'assets') }}/js/jquery-toggle.js"></script>

    <script>
    // ======================== Rating personal =========================
    $('.rating').starRating(
    {
        starSize: 1.5,
        showInfo: true
    });

  $(document).on('change', '.rating',
    function (e, stars, index) {
      alert(`Thx for ${stars} stars!`);
    });


    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function () {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    try {
        fetch(new Request("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", { method: 'HEAD', mode: 'no-cors' })).then(function (response) {
          return true;
        }).catch(function (e) {
          var carbonScript = document.createElement("script");
          carbonScript.src = "//cdn.carbonads.com/carbon.js?serve=CK7DKKQU&placement=wwwjqueryscriptnet";
          carbonScript.id = "_carbonads_js";
          document.getElementById("carbon-block").appendChild(carbonScript);
        });
      } catch (error) {
        console.log(error);
      }

    </script>
@endsection
