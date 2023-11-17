@extends('admin.layout.shard')

@section('style')
<link href="{{asset($globalVariable .'assets')}}/css/profile.css" rel="stylesheet">

@endsection

@section('content')



    {{-- Message success --}}
	@if(session('success'))
	<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
			<div class="alertStyle" id="alertSuccess">
				<div class="d-flex align-items-center">
					<i class="fa-regular fa-circle-check fs-5"></i>
					<span class="mx-2"> {!!session('success')!!}  (<span class="countdown">5</span>)</span>
				</div>
			</div>
	</div>
	@endif

@yield('error')



    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Profile</h3>
            <!-- Edit Employee -->
            <div class="d-flex">
                <form class="mx-3" action="{{ route('admin.hr.show',$employee->id) }}" method="GET">
                    <div class="filterdate">
                        <select id="month" name="month">
                            <option value="" selected>Select Month</option>
                            @for ($month = 1; $month <= 12; $month++)
                            <option value="{{ $month }}" {{ $month == ($_GET['month'] ?? $employee->selectedMonth) ? 'selected' : '' }} >
                                {{ date("F", mktime(0, 0, 0, $month, 1)) }}
                            </option>
                            @endfor
                        </select>
                        <button type="submit" class="btnGray">Filter</button>
                    </div>
                </form>
                <a href="{{ route('admin.hr.edit', $employee->id) }}" class="btnGray py-2">Edit</a>
            </div>
        </div>

        <!-- View Bar -->
        <div class="viewBar">
            <div id="toggle-Attendance" class="boxBar department">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total presence</h6>
                        <div>
                        {{-- @php
                        $month = now()->format('m');
                        $dateToCalculate = '2023-08-12';
                        @endphp --}}
                        <h3 id="h3" class="d-inline-block"> {{$employee->calculateAttendanceDaysInCurrentMonth()}} </h3>
                            <span class="text-warning"> Day </span>
                        </div>
                    </div>

                    <div class="boxIcon boxBlue">
                        <i class="fa-solid fa-user-check fa-xl"></i>
                    </div>
                </div>
                <div class="statusBar">
                    <div class="opacityText"> <span>For Month</span> </div>
                </div>
            </div>
            <div id="toggle-Holidays" class="boxBar totalEmp">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Holidays</h6>
                        <div>
                            <h3 id="h3" class="d-inline-block">{{$employee->calculateOnLeaveDaysInCurrentMonth() }}  </h3>
                            <span class="text-warning"> Day </span>
                        </div>
                    </div>
                    <div class="boxIcon boxGreen">
                        <i class="fa-solid fa-mug-hot fa-xl"></i>
                    </div>
                </div>
                <div class="statusBar">
                    <div class="opacityText"> <span>For Month</span> </div>
                </div>
            </div>
            <div id="toggle-Absence" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Absence</h6>
                        <div>
                            <h3 id="h3" class="d-inline-block">{{$employee->calculateAbsenceDaysInCurrentMonth()}}</h3>
                            <span class="text-warning"> Day </span>
                        </div>
                    </div>
                    <div class="boxIcon boxRed">
                        <i class="fa-solid fa-user-slash fa-xl"></i>
                    </div>
                </div>
                <div class="statusBar">
                    <div class="opacityText"> <span class="span">For Month</span> </div>
                </div>
            </div>
            <div id="toggle-triple" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>Total Work</h6>
                        <div>
                            @php
                            $currentDate = now();
                            $month = $currentDate->month;
                            $year = $currentDate->year;
                            @endphp
                            <h3 id="h3" class="d-inline-block">{{ $employee->calculateWorkingHoursInMonth($month, $year) }}</h3>
                            <span class="text-warning"> Hours </span>
                        </div>
                    </div>
                    <div class="boxIcon boxGray">
                        <i class="fa-solid fa-briefcase  fa-xl"></i>
                    </div>
                </div>
                <div class="statusBar">
                    <span id="span" class="opacityText">For Month </span>
                </div>
            </div>
        </div>
        <!-- view heade -->
        <div class="viewHead">
            <!-- Card Employee -->
            <div class="boxCard">
                <div class="d-flex w-100">
                    <div class="cover">
                        <div class="cardImg" id="willPopImgParent">
                            <img src="{{ asset($globalVariable . 'images') }}/{{ $employee->image }}" alt="img"
                                id="willPopImg">
                        </div>

                        <div class="position-absolute "
                            style="z-index: 3 ; top:10% ; left:40% ; transition:.3s;scale:0;opacity:0 ; " id="popImgParent">
                            <img src="" alt="img" id="popImg"
                                style=" width:400px ; height:400px ; transition:.5s; border-radius:50% ;position: relative;z-index: 3; background-size: 100% 100% ">
                        </div>
                    </div>
                    <div class="userName">
                        <h4>{{$employee->name}}</h4>
                        <h6 class="py-2 h6">ID : #{{$employee->id}}</h6>
                    </div>
                </div>
                <div class="infoCard">
                    <span class="py-2">{{ $employee->email }}</span>
                    <h6 class="py-2">{{$employee->jobTitle}}</h6>
                    <span id="ageSpan" class="py-2">{{ $employee->age }}</span>
                    <h6 class="py-2">{{ $employee->role }}</h6>
                    <span class="m-0 {{$employee->status === 'permanent'? 'fixed':($employee->status === 'training'? 'trainig':'fixed')}}" > {{$employee->status}}</span>
                </div>

                <div class="rating"></div>
            </div>
            <!-- Personal Details -->
            <div class="personalDetails">
                <div class="container">
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="person-tab" data-bs-toggle="tab"
                                data-bs-target="#person" type="button" role="tab" aria-controls="person"
                                aria-selected="true">
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
                            <button class="nav-link" id="Evaluation-tab" data-bs-toggle="tab"
                                data-bs-target="#Evaluation" type="button" role="tab" aria-controls="Evaluation"
                                aria-selected="false">
                                Month Evaluation
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Actions-tab" data-bs-toggle="tab"
                                data-bs-target="#Actions" type="button" role="tab" aria-controls="Actions"
                                aria-selected="false">
                                Actions
                            </button>
                        </li>
                        <li class="boxFilterDate">

                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <!-- person -->
                    <div class="tab-pane fade show active" id="person" role="tabpanel"
                        aria-labelledby="person-tab">
                        <div class="d-flex">
                            <table class="table table-borderless mt-3">
                                <tbody>
                                    <tr>
                                        <th scope="row">Name :</th>
                                        <td>{{$employee->name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Job Title</th>
                                        <td>{{$employee->jobTitle}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Salery</th>
                                        <td>
                                            {{$employee->salary}}
                                            <span class="salery">.EGP</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile</th>
                                        <td>{{$employee->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gender</th>
                                        <td>{{$employee->gender}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{$employee->address}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Department</th>
                                        <td>{{$employee->department}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date of Join</th>
                                        <td>{{ $employee->created_at ? $employee->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Update :</th>
                                        <td>{{$employee->updated_at->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr class="d-none">
                                        <th scope="row">age</th>
                                        <td>
                                            <input id="birthdate" type="date" name="age"  value="{{ $employee->age }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="boxIdcard">
                                <div class="idaCard">
                                    <!-- {{-- Check if the image3 field is null --}} -->
                                    @if (empty($employee->image3))
                                        <!-- {{-- Set the image to a default path --}} -->
                                        <img class="loupe" src="{{asset($globalVariable .'assets')}}/img/1Egyption_ID.jpg" alt="Employee Image">
                                    @else
                                        <!-- {{-- Set the image to the employee's image --}} -->
                                        <img class="loupe" src="{{ asset($globalVariable .'images/' . $employee->image3) }}" alt="Employee Image">
                                    @endif
                                    <img id="zoomedImage">
                                </div>
                                <div class="idaCard">
                                    <!-- {{-- Check if the image3 field is null --}} -->
                                    @if (empty($employee->image2))
                                        <!-- {{-- Set the image to a default path --}} -->
                                        <img class="loupe" src="{{asset($globalVariable .'assets')}}/img/Egyption_ID.jpg" alt="Employee Image">
                                    @else
                                        <!-- {{-- Set the image to the employee's image --}} -->
                                        <img class="loupe" src="{{ asset($globalVariable .'images/' . $employee->image2) }}" alt="Employee Image">
                                    @endif
                                </div>

                            </div>
                        </div>
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
                                        <th scope="col">Hours</th>
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
                                        <td> {{ intval($evaluation->check_in) - intval($evaluation->check_out) }}</td>
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
                        <div class="boxItem">
                            <table class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($filteredData as $attendance)
                                @if($attendance->notes  )
                                <tr class="itemDetails  {{ $attendance->absent ? 'presence' :( $attendance->on_leave ? 'holiday':'notes')  }}" styl >
                                    <!-- <input type="hidden" name="employee_id" value="{{ $evaluation->id }}"> -->
                                        <!-- Num -->
                                        <th>{{ $loop->iteration }}</th>
                                        <!-- Type -->
                                        <td>
                                            <i class="fa-solid fas {{$attendance->absent ? 'fa-user-slash': ($attendance->on_leave ? 'fa-mug-hot fa-xl':'fa-user-check')}} fa-lg px-2"></i>
                                            {{ $attendance->absent ? 'absent' :($attendance->on_leave ? 'Holiday' :  'presence') }}
                                        </td>
                                        <!-- Day -->
                                        <td>{{$attendance->day}} </td>
                                        <!-- Notes -->
                                        <td id="employees" class="">
                                            <button class="btnAccordion employee-btn{{ $attendance->notes === null ? 'd-none' : '' }}"
                                                data-employee="{{$attendance->notes ? $attendance->notes : ''}}">Show Notes</button>
                                        </td>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- Discounts -->
                    <div class="tab-pane fade" id="Actions" role="tabpanel" aria-labelledby="Actions-tab">
                        <div class="boxItem"  >
                            <table class="detailsMonth" >
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
                                    @foreach ($filteredData  as $attendance)
                                    @if ($attendance->entry_date === null)
                                    <tr id="row-{{ $attendance->id }}" class="rewards-deductions itemDetails  {{ $attendance->absent ? 'presence' :( $attendance->on_leave ? 'holiday':'notes')  }}" styl >
                                            <!-- Num -->
                                            <th>{{ $loop->iteration }}</th>
                                            <!-- Type -->
                                            <td>
                                                <i class="fa-solid fas {{$attendance->absent ? 'fa-user-slash': ($attendance->on_leave ? 'fa-mug-hot fa-xl':'fa-user-check')}} fa-lg px-2"></i>
                                                {{ $attendance->absent ? 'absent' :($attendance->on_leave ? 'Holiday' :  'presence') }}
                                            </td>
                                            <!-- Day -->
                                            <td>{{$attendance->day}} </td>
                                                {{-- @csrf --}}
                                                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                                <input type="hidden" name="attendance_day_id" value="{{ $attendance->id }}">
                                                <!-- Notes -->
                                                <td id="employees" class="" >
                                                    <div class="input-icon">
                                                        <i class="fa fa-pen xl" ></i>
                                                        <input class="inputVal input-field" type="text" name="notes" autocomplete="off" {{ (Auth::user()->role != 'hr' && Auth::user()->role != 'admin' && Auth::user()->role != 'dataentry') ? 'disabled' : '' }} />
                                                    </div>
                                                </td>
                                                <!-- EGP -->
                                                <td  id="employees" class="mx-2">
                                                    <div class="discounds">
                                                        <select name='status' class="reward-deduction-select"{{ (Auth::user()->role != 'hr' && Auth::user()->role != 'admin' && Auth::user()->role != 'dataentry') ? 'disabled' : '' }}>
                                                            <option class="mx-2" value="">Type</option>
                                                            <option class="mx-2" value="discount">Discount -</option>
                                                            <option class="mx-2" value="bonus">Bonus +</option>
                                                            <option class="mx-2" value="advance">Advance /</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-wrapper discounds discount">
                                                        <input type="number" name="price" class="rewardInput" min="0" disabled>
                                                        <span class="salery">.EGP</span>
                                                    </div>
                                                </td>
                                                <td>
                                        @can('isAdmin')
                                        <button class="send-button" data-attendance-id="{{ $attendance->id }}" disabled>Send</button>
                                        @elsecan('isHr')
                                        <button class="send-button" data-attendance-id="{{ $attendance->id }}" disabled>Send</button>
                                        @elsecan('isDataEntry')
                                            <button class="send-button" data-attendance-id="{{ $attendance->id }}" disabled>Send</button>
                                        @else
                                        <button class="send-button"
                                            @if(Auth::user()->role == 'hr' || Auth::user()->role == 'admin' || Auth::user()->role == 'dataentry')
                                                data-attendance-id="{{ $attendance->id }}"
                                            @endif
                                        >
                                            Send
                                        </button>
                                         @endcan
                                        </td>
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
            <i id="closeNotes" class="fa-solid fa-angle-down"></i>
            <img src="{{asset($globalVariable .'images')}}/{{$employee->image}}">
        </div>
        <p id="notes"></p>
    </div>

@section('scripts')
<script src="{{asset($globalVariable .'assets')}}/js/profile.js"></script>

<script>
// ======================= Toggle button =============================
 // Toggle Holidays
    $(document).ready(function() {
      const box = $("#toggle-Holidays");
      const h3 = $("#toggle-Holidays h3");
      const span = $("#toggle-Holidays .opacityText");

      let state = 1;

      box.on("click", function() {
        if (state === 1) {
          h3.text({{$employee-> calculateOnLeaveDaysInCurrentYear()}});
          span.text("For Year");
          state = 2;
        } else if (state === 2) {
          h3.text({{$employee->calculateOnLeaveDaysInCurrentMonth()}} );
          span.text("For Month");
          state = 1;
        }
      });
    });

        // Total Absence
        $(document).ready(function() {
            const box = $("#toggle-Absence");
            const h3 = $("#toggle-Absence h3");
            const span = $("#toggle-Absence .opacityText");

            let state = 1;

            box.on("click", function() {
                if (state === 1) {
                h3.text({{$employee->calculateAbsenceDaysInCurrentYear()}});
                span.text("For Year");
                state = 2;
                } else if (state === 2) {
                h3.text({{$employee->calculateAbsenceDaysInCurrentMonth()}});
                span.text("For Month");
                state = 1;
                }
            });
            });

        // Toggle presence
        $(document).ready(function() {
          const box = $("#toggle-Attendance");
          const h3 = $("#toggle-Attendance h3");
          const span = $("#toggle-Attendance .opacityText");

          let state = 1;

          box.on("click", function() {
            if (state === 1) {
              h3.text({{$employee->calculateAttendanceDaysInCurrentYear()}});
              span.text("For Year");
              state = 2;
            } else if (state === 2) {
              h3.text({{$employee->calculateAttendanceDaysInCurrentMonth()}});
                span.text("For Month");
              state = 1;
            }
          });
        });
//   // Total Work
    $(document).ready(function() {
        const box = $("#toggle-triple");
        const h3 = $("#toggle-triple #h3");
        const span = $("#toggle-triple #span");

        let state = 1;

        box.on("click", function() {
        if (state === 1) {
            h3.text({{$employee->calculateWorkHoursForToday()}});
            span.text("For day");
            state = 2;
        } else if (state === 2) {
            h3.text({{$employee->calculateWorkHoursInCurrentYear()}});
            span.text("For year");
            state = 3;
        } else if (state === 3) {
            h3.text({{$employee->calculateWorkHoursInCurrentMonth()}});
            span.text("For Month");
            state = 1;
        }
        });
    });

</script>

{{-- Hidden Row Day Then Save Data  --}}
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

    // {{-- Hidden Row Day Then Save Data  --}}
    $(document).ready(function () {
        $(".send-button").click(function () {
            const attendanceId = $(this).data("attendance-id");
            const rowToHide = $("#row-" + attendanceId);
            const notes = rowToHide.find("input[name='notes']").val();
            const status = rowToHide.find("select[name='status']").val();
            const price = rowToHide.find("input[name='price']").val();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.hr.DandB.store') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    employee_id: "{{ $employee->id }}",
                    attendance_day_id: attendanceId,
                    notes: notes,
                    status: status,
                    price: price,
                },
                success: function (response) {
                    rowToHide.hide();
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>
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
<script>
    // zoom img profile
    $(document).ready(function() {
        const $willPop = $("#willPopImg");
        const $popImg = $("#popImg");
        const $popImgParent = $("#popImgParent");
        const $willPopImgParent = $("#willPopImgParent");

        $willPop.on("mouseover", function() {
            $popImg.attr("src", $willPop.attr("src"));
            $popImgParent.css({ scale: '1', opacity: '1' });
            $popImg.css({ transition: 'all .3s linear' });
        });

        $willPopImgParent.on("mouseleave", function() {
            $popImgParent.css({ scale: '0', opacity: '0' });
            $popImg.css({ transition: 'all .3s linear' });
        });
    });
</script>
@endsection
