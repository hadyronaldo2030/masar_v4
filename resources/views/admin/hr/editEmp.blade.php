@extends('admin.layout.shard')

@section('style')
    <!-- Mobiscroll date -->
    <link rel="stylesheet" href="{{ asset($globalVariable . 'assets') }}/css/mobiscroll.javascript.min.css">
    <link href="{{ asset($globalVariable . 'assets') }}/css/edit.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Employee</h3>

            <a href="{{ route('admin.hr.show', $employee->id) }}" class="btnGray py-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>

        <!-- view heade -->
        <div class="viewHead">
            <!-- Card Employee -->
            <div class="boxCard">
                <div class="d-flex w-100">
                    <div class="cover">
                        <div class="cardImg">
                            <img id="myImage3" src="{{ asset($globalVariable . 'images') }}/{{ $employee->image }}"
                                alt="">
                            <span id="editBtn3" class="">
                                <i class="fa-solid fa-camera fa-xl"></i>
                            </span>
                        </div>
                    </div>
                    <div class="userName">
                        <h4 id="d-name">{{ $employee->name }}</h4>
                    </div>
                </div>
                <div class="infoCard">
                    <span id="d-email" class="py-2">{{ $employee->email }}</span>
                    <span id="d-address" class="py-2">{{ $employee->address }}</span>
                    <h6 id="d-job" class=" py-2">{{ $employee->jobTitle }}</h6>
                    <span id="ageSpan" class="py-2">{{ $employee->age }}</span>
                    <h6 id="d-position" class="py-2">{{ $employee->role }}</h6>
                    <h6 id="d-department" class="py-2">{{ $employee->department }}</h6>
                    <h6 id="d-status" class="py-2"></h6>
                </div>
                <div class="rating">
                </div>
                <div>
                    <span
                        class=" {{ $employee->status === 'permanent' ? 'fixed' : ($employee->status === 'training' ? 'trainig' : 'fixed') }}">
                        {{ $employee->status }}</span>
                </div>
            </div>
            <!-- Personal Details -->
            <div class="personalDetails">
                <div class="container">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="person-tab" data-bs-toggle="tab" data-bs-target="#person"
                                type="button" role="tab" aria-controls="person" aria-selected="true">
                                person
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Status-tab" data-bs-toggle="tab"
                                data-bs-target="#Status" type="button" role="tab" aria-controls="Status"
                                aria-selected="false">
                                Status
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Evaluation-tab" data-bs-toggle="tab" data-bs-target="#Evaluation"
                                type="button" role="tab" aria-controls="Evaluation" aria-selected="false">
                                Month Evaluation
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Actions-tab" data-bs-toggle="tab" data-bs-target="#Actions"
                                type="button" role="tab" aria-controls="Actions" aria-selected="false">
                                Actions
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="person" role="tabpanel" aria-labelledby="person-tab">
                        <!-- person -->
                        <form class="viewBar" action="{{ route('admin.hr.update', ['id' => $employee->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="box1">
                                {{-- User Name --}}
                                <div class="boxInput">
                                    <input id="live-name" type="text" class="form-control" placeholder="User Name"
                                        name="name" aria-label="Username" aria-describedby="addon-wrapping"
                                        value="{{ $employee->name }}">

                                    {{-- Print Error Is FOund --}}
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                {{-- email --}}
                                <div class="boxInput">
                                    <input id="live-email" type="email" name="email" class="form-control" placeholder="@email.com" value="{{ $employee->email }}">
                                </div>
                                {{-- Generate Password --}}
                                <div class="boxInput salery">
                                    <span id="generateButton" class="text-primary cursor-pointer"><i class="fa-solid fa-rotate-right"></i></span>
                                    <input id="passwordField" name="password" class="form-control" placeholder="*****************" aria-describedby="addon-wrapping">
                                </div>
                                {{-- Address --}}
                                <div class="boxInput">
                                    <input id="live-address" name="address" type="text" value="{{ $employee->address }}"
                                        class="form-control" placeholder="Address" aria-label="Username"
                                        aria-describedby="addon-wrapping">
                                    {{-- Print Error Is FOund --}}
                                    @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    {{-- Moblie --}}
                                    <div class="boxInput">
                                        <input name="mobile" type="text" value="{{ $employee->mobile }}" maxlength="11"
                                            class="form-control" placeholder="+20 01" aria-label="Username"
                                            aria-describedby="addon-wrapping">
                                        {{-- Print Error Is FOund --}}
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>
                                    {{-- Job Title --}}
                                    <div class="boxInput ml-4">
                                        <input id="live-job" name="jobTitle" type="text"
                                            value="{{ $employee->jobTitle }}" class="form-control" placeholder="job Title"
                                            aria-label="Username" aria-describedby="addon-wrapping">
                                        {{-- Print Error Is FOund --}}
                                        @if ($errors->has('jobTitle'))
                                            <span class="text-danger">{{ $errors->first('jobTitle') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex">
                                    {{-- position --}}
                                    <div class="boxInput">
                                        <select name="role" id="live-position">
                                        @if(Auth::user()->role == 'admin')
                                        <option value="admin" {{ $employee->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                 
                                         @endif
                                            <option value="hr" {{ $employee->role == 'hr' ? 'selected' : '' }}>HR</option>
                                            <option value="finance" {{ $employee->role == 'finance' ? 'selected' : '' }}>Finance</option>
                                            <option value="manager" {{ $employee->role == 'manager' ? 'selected' : '' }}>Manger</option>
                                            <option value="dataentry" {{ $employee->role == 'dataentry' ? 'selected' : '' }}>Data Entry</option>
                                            <option value="employee"{{ $employee->role == 'employee' ? 'selected' : '' }}>Emplooye</option>
                                        </select>
                                    </div>
                                    {{-- Salery --}}
                                    <div class="boxInput salery ml-4">
                                        <span>.EGP</span>
                                        <input class="form-control" placeholder="Salery" aria-label="salery"
                                            value="{{ $employee->salary }}" name="salary"
                                            aria-describedby="addon-wrapping">
                                        @if ($errors->has('salery'))
                                            <span class="text-danger">{{ $errors->first('salery') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-flex">
                                    {{-- age --}}
                                    <div class="boxInput salery">
                                        <span class="mx-4">Age</span>
                                        <input id="birthdate" type="date" name="age" class="form-control" placeholder="Birthday"
                                            aria-label="Username" value="{{ $employee->age }}"
                                            aria-describedby="addon-wrapping">
                                        {{-- Print Error Is FOund --}}
                                        @if ($errors->has('age'))
                                            <span class="text-danger">{{ $errors->first('age') }}</span>
                                        @endif
                                    </div>
                                    {{-- Department --}}
                                    <div class="boxInput ml-4">
                                        <select name="department" id="live-department"
                                            aria-label="Example select with button addon">
                                           
                                            <option {{ $employee->department == 'marketing' ? 'selected' : '' }}
                                                value="marketing">Marketing</option>
                                            <option {{ $employee->department == 'graphics' ? 'selected' : '' }}
                                                value="graphics">Graphics</option>
                                            <option {{ $employee->department == 'programming' ? 'selected' : '' }}
                                                value="programming">programming</option>
                                            <option {{ $employee->department == 'Administrative' ? 'selected' : '' }}
                                                value="Administrative">Administrative</option>
                                            <option {{ $employee->department == 'video' ? 'selected' : '' }} value="video">
                                                video</option>
                                            <option {{ $employee->department == 'sales' ? 'selected' : '' }} value="sales">
                                                sales</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    {{-- Status --}}
                                    <div class="boxInput">
                                        <select id="inputGroupSelect03" name="status"
                                            aria-label="Example select with button addon">
                                            <option {{ $employee->status == 'permanent' ? 'selected' : '' }}
                                                value="permanent">permanent</option>
                                            <option {{ $employee->status == 'temporary' ? 'selected' : '' }}
                                                value="temporary">temporary</option>
                                            <option {{ $employee->status == 'trainee' ? 'selected' : '' }} value="trainee">
                                                trainee</option>
                                        </select>
                                    </div>
                                    {{-- gender --}}
                                    <div class="boxInput ml-4">
                                        <select id="inputGroupSelect03" name="gender"
                                            aria-label="Example select with button addon">
                                            <option value=" male"@if ($employee->gender === 'male') selected @endif>male
                                            </option>
                                            <option value="female" @if ($employee->gender === 'female') selected @endif>female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="boxIdcard">
                                <div class="idaCard">

                                    <!-- {{-- Check if the image3 field is null --}} -->
                                    @if (empty($employee->image3))
                                        <!-- {{-- Set the image to a default path --}} -->
                                        <img class="loupe" id="myImage2"
                                            src="{{ asset($globalVariable . 'assets') }}/img/1Egyption_ID.jpg"
                                            alt="Employee Image">
                                    @else
                                        <!-- {{-- Set the image to the employee's image --}} -->
                                        <img class="loupe" id="myImage2"
                                            src="{{ asset($globalVariable . 'images/' . $employee->image3) }}"
                                            alt="Employee Image">
                                    @endif
                                    <img id="zoomedImage">
                                    <span id="editBtn2" class="">
                                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                    </span>
                                    <input type="file" name='image3' id="newImage2" style="display:none;">
                                    <!-- {{-- Print Error Is FOund --}} -->
                                    @if ($errors->has('image3'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <div class="idaCard">

                                    <!-- {{-- Check if the image3 field is null --}} -->
                                    @if (empty($employee->image2))
                                        <!-- {{-- Set the image to a default path --}} -->
                                        <img class="loupe" id="myImage"
                                            src="{{ asset($globalVariable . 'assets') }}/img/Egyption_ID.jpg"
                                            alt="Employee Image">
                                    @else
                                        <!-- {{-- Set the image to the employee's image --}} -->
                                        <img class="loupe" id="myImage"
                                            src="{{ asset($globalVariable . 'images/' . $employee->image2) }}"
                                            alt="Employee Image">
                                    @endif
                                    <img id="zoomedImage">
                                    <span id="editBtn" class="">
                                        <i class="fa-regular fa-pen-to-square fa-xl"></i>
                                    </span>
                                    <input type="file" name='image2' id="newImage" style="display:none;">
                                    <!-- {{-- Print Error Is FOund --}} -->
                                    @if ($errors->has('image2'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                </div>

                                <input type="file" name='image' id="newImage3" style="display:none;">

                                <button class="saveBtn btn btn-primary">Update</button>

                            </div>
                        </form>
                    </div>
                    <!-- Status -->
                    <div class="tab-pane fade" id="Status" role="tabpanel" aria-labelledby="Status-tab">

                        <!-- <div class=""> -->
                        <div class="boxItem">
                            <table class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Restrict</th>
                                        <th scope="col">Departure</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $prevDate = null; // متغير لتخزين التاريخ السابق
                                @endphp
                                @foreach($filteredData  as $evaluation)
                                    @if ($evaluation->day != $prevDate)
                                    @php
                                        $prevDate = $evaluation->day; // تحديث التاريخ السابق ليصبح كالتاريخ الحالي
                                    @endphp
                                    <tr class="itemDetails {{ $evaluation->on_leave  ? 'holiday'  : ($evaluation->absent  ? 'presence' : 'absence' ) }} ">
                                        <!-- Num -->
                                        <th>{{ $loop->iteration }}</th>
                                        <!-- Type -->
                                        <td>
                                        @if ($evaluation->absent )
                                                <i class="fa-solid fas fa-user-slash fa-lg px-2"></i>
                                        @elseif ( $evaluation->on_leave)
                                                <i class="fa-solid fas fa-mug-hot fa-lg px-2"></i>
                                        @else
                                                <i class="fa-solid  fa-user-check fa-lg px-2"></i>
                                        @endif {{ $evaluation->on_leave  ? 'holiday'  : ($evaluation->absent  ? 'absent' :'presence')  }}
                                        </td>
                                        <!-- Day -->
                                        <td> {{$evaluation->day}}</td>
                                        <!-- Restrict -->
                                        <td>  @if ($evaluation->on_leave)
                                                    <span> - </span>
                                            @elseif($evaluation->absent)
                                                    <span> - </span>
                                            @elseif ($evaluation->check_out)
                                                <span> {{$evaluation->check_in}}  </span>
                                            @endif

                                        </td>
                                        <!-- Departure -->
                                        <td> @if ($evaluation->on_leave)
                                                    <span> - </span>
                                            @elseif($evaluation->absent)
                                                    <span> - </span>
                                            @elseif ($evaluation->check_in)
                                                <span> {{$evaluation->check_out}} </span>
                                            @endif
                                        </td>
                                        <!-- Rating -->
                                        <td> {{$evaluation->rating}}/10 </td>
                                        <!-- Hours -->
                                        <td>
                                        <form class="delete btn-danger" action="{{ route('admin.hr.dataEntry.delete', $evaluation->id) }}"method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="delete" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this {{$evaluation->day}} ?')">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                          
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                    <!-- Month Evaluation -->
                    <div class="tab-pane fade" id="Evaluation" role="tabpanel" aria-labelledby="Evaluation-tab">
                        <table class="detailsMonth">
                            <thead>
                                <tr>
                                    <th scope="col">Num</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Notes</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee->attendances as $attendance)
                                    <tr class="itemDetails   {{ $attendance->absent ? 'presence' : 'notes' }} ">
                                        @if ($attendance->notes)
                                            <!-- Num -->
                                            <th>{{ $loop->iteration }}</th>
                                            <!-- Type -->
                                            <td>
                                                <i
                                                    class="fa-solid fa-user-slash  {{ $attendance->absent ? 'fa-user-slash' : 'fa-user-check' }} fa-lg px-2"></i>
                                                {{ $attendance->absent ? 'absent' : 'presence' }}
                                            </td>
                                            <!-- Day -->
                                            <td>{{ $attendance->day }} </td>
                                            <!-- Restrict -->
                                            <form action="{{ route('admin.notes', ['id' => $attendance->id]) }}"
                                                method="POST">
                                                @csrf
                                                <td class="">
                                                    <span
                                                        class="btnAccordion  {{ $attendance->notes === null ? 'd-none' : '' }}">Show
                                                        Notes
                                                    </span>
                                                    <div class="panel">
                                                        <!-- <input type="hidden" name="_method" value="PUT"> -->
                                                        <div class="form-group">
                                                            <textarea class="form-control" id="attendance_notes" name="notes" rows="3">{{ $attendance->notes }}</textarea>
                                                        </div>
                                                        <div class="d-flex justify-content-between">
                                                            <button type="submit" class="btnPrimary my-2">Update</button>
                                                            <span class="closeNotes"><i class="fa-solid fa-angle-down"></i></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="itemDetails {{ $attendance->absent ? 'presence' : 'notes' }}">
                                                    <button type="submit" class="btnGray update-button"
                                                        data-attendance-id="{{ $attendance->id }}">Update</button>
                                                </td>
                                            </form>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Discounts -->
                    <div class="tab-pane fade" id="Actions" role="tabpanel" aria-labelledby="Actions-tab">
                        <div class="filterdate">
                            <input type="date" id="demo-mobile-picker-input" class="md-mobile-picker-input"
                                placeholder="Year / Month / Day" />
                        </div>
                        <!-- <div class=""> -->
                        <div class="boxItem">
                            <table class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Enter Notes</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">EGP</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employee->attendances as $attendance)
                                        @if ($attendance->entry_date != null)
                                        @foreach ($attendance->deductionsAndBonuses as $deductionOrBonus)

                                            <tr id="row-{{ $attendance->id }}" class="rewards-deductions   {{ $attendance->absent ? 'presence' : ($attendance->on_leave ? 'holiday' : 'absence') }}" >
                                                <!-- Num -->
                                                <th>{{ $loop->iteration }}</th>
                                                <!-- Type -->
                                                <td>
                                                    <i class="fa-solid fas {{ $attendance->absent ? 'fa-user-slash' : ($attendance->on_leave ? 'fa-mug-hot fa-xl' : 'fa-user-check') }} fa-lg px-2"></i>
                                                    {{ $attendance->absent ? 'absent' : ($attendance->on_leave ? 'Holiday' : 'presence') }}
                                                </td>
                                                <!-- Day -->
                                                <td>{{ $attendance->day }} </td>
                                                {{-- @csrf --}}
                                                <input type="hidden" name="employee_id" value="{{ $employee->id }}'">
                                                <input type="hidden" name="attendance_day_id"
                                                    value="{{ $attendance->id }}">

                                               {{-- Update Deductions And Bounses --}}
                                                <form method="post" action="{{ route('admin.updateBonuses', ['id' => $deductionOrBonus->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Notes -->
                                                        <td class="">
                                                            <span class="btnAccordion ">Show
                                                                Notes
                                                            </span>
                                                            <div class="panel">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" id="attendance_notes"  name="notes" rows="3">{{ $deductionOrBonus->notes }}</textarea>
                                                                </div>
                                                                <div class="d-flex justify-content-between">
                                                                    {{-- <button type="cansle" class="btnPrimary">Update</button> --}}
                                                                    <span class="closeNotes"><i class="fa-solid fa-angle-down"></i></span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!-- EGP -->
                                                        <td  id="employees" class="mx-2">
                                                            <div class="discounds">
                                                                <select name='status' class="reward-deduction-select">
                                                                    <option class="mx-2" value="discount" {{ $deductionOrBonus->status == 'discount' ? 'selected' : '' }}>Discount -</option>
                                                                    <option class="mx-2" value="bonus"{{ $deductionOrBonus->status == 'bonus' ? 'selected' : '' }} >Bonus +</option>
                                                                    <option class="mx-2" value="advance"{{ $deductionOrBonus->status == 'advance' ? 'selected' : '' }} >Advance /</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-wrapper discounds discount">
                                                                <input type="number" value="{{ $deductionOrBonus->price ?? '' }}" name="price" class="rewardInput" min="0">
                                                                <span class="salery">.EGP</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button class="send-button"
                                                            data-attendance-id="{{ $attendance->id }}"
                                                            data-employee-id="{{ $employee->id }}"
                                                                disabled>Send</button>
                                                        </td>
                                                        </form>
                                                        <td>
                                                            <form method="post" action="{{ route('admin.hr.DandB.delete',$deductionOrBonus->id) }}" >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="delete" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this {{ $deductionOrBonus->status}} ?')"><i class="fa-regular fa-trash-can"></i></button>
                                                            </form>
                                                        </td>

                                                @endforeach
                                            </tr>

                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- End Header -->
@endsection

    <!-- Alert Notes -->
    <div id="notes-container" style="display:none;">
        <div class="navNotes">
            <i id="closeNotes" class="fa-solid fa-x"></i>
            <img src="{{asset($globalVariable .'images')}}/{{$employee->image}}">
        </div>
        <p id="notes"></p>
    </div>


@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/edit.js"></script>
    <!-- Font Awesome -->
    <script src="{{ asset($globalVariable . 'assets') }}/js/jquery-toggle.js"></script>

<script>
    // Rewards and Deductions Logic
    $(document).ready(function() {
        $(".reward-deduction-select").change(function() {
            var selectedOption = $(this).val();
            var parent = $(this).closest(".rewards-deductions");
            parent.find(".input-wrapper").hide();

            if (selectedOption) {
                parent.find(".rewardInput").prop("disabled", false);
                parent.find(".rewardInput").val('');
                parent.find(".input-wrapper").show().find("input").focus();
                parent.find(".send-button").prop("disabled", true);
            } else {
                parent.find(".rewardInput").prop("disabled", true);
                parent.find("input[type='number']").val('');
                parent.find(".input-wrapper").hide();
                parent.find(".send-button").prop("disabled", true);
            }
        });

        $("input[type='number']").on('input', function() {
            var parent = $(this).closest(".rewards-deductions");
            if ($(this).val().trim() === "") {
                parent.find(".send-button").prop("disabled", true).removeClass("btnPrimary");
            } else {
                parent.find(".send-button").prop("disabled", false).addClass("btnPrimary");
            }
        });
    });

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
