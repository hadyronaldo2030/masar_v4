@extends('admin.fiances.layouts.shardfiances')

@section('style')

<link href="{{asset($globalVariable .'assets')}}/css/salaries.css" rel="stylesheet">

@endsection

@section('content')

    <!-- Start Header -->
    <header>

        <!-- Title Section -->
        <div class="titleSection">
            <h3>Salaries</h3>
        </div>
        <!-- View Bar -->
        <div class="viewBar">
            <div style="margin:0 1% 0 0" class="boxBar totalEmp">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Salaries</h6>
                        <h3>{{ $employeesTotal['totalSalaries'] }}</h3>
                    </span>
                    <span class="boxIcon boxGreen">
                        <i class="fa-solid fa-hand-holding-dollar fa-xl"></i>
                    </span>
                </div>
            </div>
            <div class="boxBar department">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Employees</h6>
                        <h3>{{ $employeesTotal['totalEmployee'] }}</h3>
                    </span>
                    <span class="boxIcon boxGray">
                        <i class="fa-solid fa-users fa-xl"></i>
                    </span>
                </div>
            </div>
            <div style="margin:0 1%" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Bonus</h6>
                        <h3>{{ $deductionsAndBonusesTotal['totalBonus'] }}</h3>
                    </span>
                    <span class="boxIcon boxBlue">
                        <i class="fa-solid fa-user-plus fa-xl"></i>
                    </span>
                </div>
            </div>
            <div class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Advances </h6>
                        <h3>{{ $deductionsAndBonusesTotal['totalAdvance'] }}</h3>
                    </span>
                    <span class="boxIcon boxOrange">
                        <i class="fa-solid fa-user-minus fa-xl"></i>
                    </span>
                </div>
            </div>
            <div style="margin:0 0 0 1%" class="boxBar expenses">
                <div class="d-flex justify-content-between">
                    <span>
                        <h6>Total Discounts</h6>
                        <h3>{{ $deductionsAndBonusesTotal['totalDiscount'] }}</h3>
                    </span>
                    <span class="boxIcon boxRed">
                        <i class="fa-solid fa-users-slash fa-xl"></i>
                    </span>
                </div>
            </div>
        </div>
        <!-- view heade -->
        <div class="viewHead">
            <!-- dayInventory -->
            <div class="tab-pane fade show active">
                {{-- <!-- Search --> --}}
                <div class="d-flex justify-content-between m-3">
                    <div class="d-flex">
                        {{-- reset --}}
                        <span class="reset" onclick="resetFilter()"><i class="fa-solid fa-rotate-right"></i></span>

                        {{-- Date Search --}}
                        <select class="form-select mx-3" id="departmentSelect" onchange="filterCards()">
                            <option value="">All Departments</option>
                            <option value="programming">programming</option>
                            <option value="graphics">Graphics</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Administrative">Administrative</option>
                            <option value="photography">photography</option>
                            <option value="video">video</option>
                            <option value="sales">sales</option>
                        </select>
                        {{-- Date filter --}}
                            <select class="form-select" id="monthSelect" onchange="filterCards()">
                                <option selected value="">All Months</option>
                                <option value="1">January (1)</option>
                                <option value="2">February (2)</option>
                                <option value="3">March (3)</option>
                                <option value="4">April (4)</option>
                                <option value="5">May (5)</option>
                                <option value="6">June (6)</option>
                                <option value="7">July (7)</option>
                                <option value="8">August (8)</option>
                                <option value="9">September (9)</option>
                                <option value="10">October (10)</option>
                                <option value="11">November (11)</option>
                                <option value="12">December (12)</option>
                            </select>
                    </div>
                </div>
                <div id="accordion">
                    {{-- First row  --}}
                    <div class="cardTitle mb-2 text-center">
                        <div class="card-header row fw-bold" id="heading4">
                            <div class="col"> Department Name </div>
                            <div class="col"> Month </div>
                            <div class="col"> Total department salaries </div>
                            <div class="col"> Total Employees </div>
                            <div class="col-1"> action </div>
                        </div>
                    </div>

                    {{-- row Emp Department --}}
                @foreach ($employess as $departmentMonth => $employees)
                {{-- Defuilt Varaible --}}
                @php $totalIncome = 0; @endphp
                @foreach($employees as $employee)
                {{-- Total Income --}}
                    @php $totalIncome += $employee['salary'] + ($employee['deductions']['bonus'] - ($employee['deductions']['advance'] + $employee['deductions']['discount'])); @endphp
                @endforeach
                  {{-- Count Employee --}}
                        @php
                        $department = explode('-', $departmentMonth)[0];
                        $month = explode('-', $departmentMonth)[1];
                        $employeeCount = $departmentCounts[$departmentMonth];
                    @endphp
                    <div class="card mb-2 text-center" data-department="{{ explode('-', $departmentMonth)[0] }}" data-month="{{ explode('-', $departmentMonth)[1] }}">
                        <div class="card-header row" id="heading2">
                            <div class="col"> {{ explode('-', $departmentMonth)[0] }}</div>
                            <div class="col">{{$months[explode('-', $departmentMonth)[1] - 1]}} </div>
                            <div class="col">  {{ $totalIncome }}</div>
                            <div class="col">{{ $employeeCount }}</div>
                            <div class="col-1" data-bs-toggle="collapse" data-bs-target="#{{$departmentMonth}}" aria-expanded="false" aria-controls="collapse1"> <i class="fa-solid fa-chevron-down fa-lg"></i> </div>
                        </div>
                        <div style="background: var(--input);" id="{{$departmentMonth}}" class="collapse" aria-labelledby="heading1" data-bs-parent="#accordion">
                            <div class="card-body row">
                                <div class="col">Name</div>
                                <div class="col">Job Title</div>
                                <div class="col">Month</div>
                                <div class="col">Salary</div>
                                <div class="col">Total Bonus</div>
                                <div class="col">Total Advances</div>
                                <div class="col">Total Discounts</div>
                                <div class="col">Total Income</div>
                                <div class="col-1">Action</div>
                            </div>
                            {{-- Loop Employees --}}
                            @foreach($employees as $employee)
                                    <div class="card-body row pb-1">
                                        <div class="col">{{ $employee['name'] }}</div>
                                        <div class="col">{{ $employee['jobTitle'] }}</div>
                                        <div class="col">{{$months[explode('-', $departmentMonth)[1] -1]}}</div>
                                        <div class="col">{{ $employee['salary'] }}<span class="textGreen">.EGP</span></div>
                                        <div class="col"> {{ $employee['deductions']['bonus'] }}<span class="textBlue">.EGP+</span></div>
                                        <div class="col"> {{ $employee['deductions']['advance'] }}<span class="textOrange">.EGP-</span></div>
                                        <div class="col"> {{ $employee['deductions']['discount'] }}<span class="textRed">.EGP-</span></div>
                                        <div class="col"> {{ $employee['salary']  +  ($employee['deductions']['bonus'] - ($employee['deductions']['advance'] + $employee['deductions']['discount'])) }}<span class="textGreen">.EGP</span></div>

                                        @if($employee['deductions']['bonus'] == 0 && $employee['deductions']['advance'] == 0 && $employee['deductions']['discount'] == 0)
                                        <div class="col-1" data-bs-toggle="collapse" data-bs-target="#{{"DI".$months[explode('-', $departmentMonth)[1] -1]."".$employee['id']}}">
                                            <button disabled style="letter-spacing: 3px;" class="btn px-2">Null </button>
                                        </div>
                                    @else
                                        <div class="col-1" data-bs-toggle="collapse" data-bs-target="#{{"DI".$months[explode('-', $departmentMonth)[1] -1]."".$employee['id']}}">
                                            <span class="btn btnPrimary">More</span>
                                        </div>
                                    @endif
                                    </div>
                                @if($employee['deductions']['bonus'] == 0 && $employee['deductions']['advance'] == 0 && $employee['deductions']['discount'] == 0)

                                @else
                                        <div id="{{"DI".$months[explode('-', $departmentMonth)[1] -1]."".$employee['id']}}" class="collapse  " >
                                            <table class="table" >
                                                <thead>
                                                    <tr >
                                                        <th>Day</th>
                                                        <th>Status</th>
                                                        <th>Value</th>
                                                        <th>Notes</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($employee['deductions_and_bonuses']  as $bonuses )
                                                         <tr>
                                                            <td class="@if($bonuses['status']  == 'discount') textRed @elseif($bonuses['status']  == 'advance') textOrange @elseif($bonuses['status']  == 'bonus') textBlue @else textOrange @endif">{{ $bonuses['attendances']['day'] ?? '' }}</td>
                                                            <td class="@if($bonuses['status']  == 'discount') textRed @elseif($bonuses['status']  == 'advance') textOrange @elseif($bonuses['status']  == 'bonus') textBlue @else textOrange @endif">{{ $bonuses['status']  }}</td>
                                                            <td>
                                                                @if (isset($bonuses['price'])) {{ $bonuses['price'] }} @else 0 @endif
                                                                <span class="@if($bonuses['status']  == 'discount') textRed @elseif($bonuses['status']  == 'advance') textOrange @elseif($bonuses['status']  == 'bonus') textBlue @else textOrange @endif ">
                                                                    @if( $bonuses['status']  == 'discount').EGP-
                                                                    @elseif($bonuses['status']  == 'advance') .EGP-
                                                                    @elseif($bonuses['status']  == 'bonus') .EGP+
                                                                    @else .EGP-
                                                                </span>
                                                                @endif
                                                            </td>
                                                            <td id="employees" class="">
                                                                <button class="btn employee-btn {{$bonuses['notes'] ? 'btnGray' : ''}}" data-employee="{{$bonuses['notes'] ? $bonuses['notes'] : ''}}" {{$bonuses['notes'] ? "" : 'disabled'}}>Details</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
        {{-- <img src="{{asset($globalVariable .'images')}}/{{$employess['image']}}"> --}}
    </div>
    <p id="notes"></p>
</div>

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset($globalVariable .'assets')}}/js/salaries.js"></script>


<script>
    $(".employee-link").on("click", function() {
        $(".salary").toggleClass('d-none');
    });

    function filterCards() {
            const selectedDepartment = document.getElementById('departmentSelect').value;
            const selectedMonth = document.getElementById('monthSelect').value;
            const cards = document.querySelectorAll('header .card');

            cards.forEach(card => {
                const cardDepartment = card.getAttribute('data-department');
                const cardMonth = card.getAttribute('data-month');

                if ((selectedDepartment === '' || cardDepartment === selectedDepartment) &&
                    (selectedMonth === '' || cardMonth === selectedMonth)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function resetFilter() {
            const departmentSelect = document.getElementById('departmentSelect');
            const monthSelect = document.getElementById('monthSelect');
            const cards = document.querySelectorAll('header .card');

            // Reset select options
            departmentSelect.value = '';
            monthSelect.value = '';

            // Show all cards
            cards.forEach(card => {
                card.style.display = 'block';
            });
        }

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alertContainer = document.querySelector('.alert-container');
        let alertMessage = document.querySelector('#alertMessage');

        let showAlert = true;

        if (showAlert) {
            alertMessage.textContent = 'لا يوجد خصومات او مكافات ';
            alertContainer.style.display = 'block';

            // إخفاء الرسالة بعد مرور 3 ثواني
            setTimeout(function() {
                alertContainer.style.display = 'none';
            }, 5000);
        }
    });
</script>
@endsection
