@extends('admin.fiances.layouts.shardfiances')

@section('style')
<link href="{{ asset($globalVariable . 'assets') }}/css/fancybox.css" rel="stylesheet">
<link href="{{ asset($globalVariable . 'assets') }}/css/storage.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Storage</h3>
        </div>

        <!-- view heade -->
        <div class="viewHead">
            <!-- dayInventoryal -->
            <div class="navcontent">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dayInventory-tab" data-bs-toggle="tab"
                            data-bs-target="#dayInventory" type="button" role="tab" aria-controls="dayInventory"
                            aria-selected="true">
                            Day Inventory
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="monthInventory-tab" data-bs-toggle="tab"
                            data-bs-target="#monthInventory" type="button" role="tab" aria-controls="monthInventory"
                            aria-selected="false">
                            Month Inventory
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="yearInventory-tab" data-bs-toggle="tab" data-bs-target="#yearInventory"
                            type="button" role="tab" aria-controls="yearInventory" aria-selected="false">
                            Year Inventory
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- dayInventory -->
                    <div class="tab-pane fade show active" id="dayInventory" role="tabpanel"
                        aria-labelledby="dayInventory-tab">
                        {{-- <!-- Search --> --}}
                        <div class="d-flex justify-content-between m-3">
                            <div class="d-flex">
                                {{-- Date filter --}}
                                <form action="{{ route('filterDay_data') }}" method="GET">
                                    <div style="display: flex ;">
                                        {{-- Filter --}}
                                        <button style="margin-left: 10px;" type="submit"class="btn btnGray">Filter</button>
                                        <select class="form-select" id="month" name="monthDay"
                                            aria-label="Default select example">
                                            <option value="" selected disabled>Select Month</option>
                                            @for ($month = 1; $month <= 12; $month++)
                                                <option value="{{ $month }}"
                                                    {{ isset($_GET['month']) && $month == $_GET['month'] ? 'selected' : '' }}>
                                                    {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </form>
                                {{-- type Search --}}
                                <select class="form-control search mx-4" id="contract-type">
                                    <option value="all">All Type</option>
                                    <option value="consultation">consultation</option>
                                    <option value="Secondary Contracts">Secondary Contracts</option>
                                    <option value="Semi Secondary Contracts">Semi Secondary Contracts</option>
                                    <option value="3 Month Contracts">3 Month Contracts</option>
                                    <option value="Monthly Contracts">Monthly Contracts</option>
                                    <option value="Annual Contracts">Annual Contracts</option>
                                    <option value="Weekly Contracts">Weekly Contracts</option>
                                    <option value="Reserved Service">Reserved Service</option>
                                    <option value="Others">Others Expenses Basic</option>
                                    <option value="Other">Others Expenses Pety Cash</option>
                                    <option value="Subscriptions">Subscriptions</option>
                                    <option value="Water">Water</option>
                                    <option value="Electricity">Electricity</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Reservation">Reservation</option>
                                    <option value="Hospitality">Hospitality</option>
                                    <option value="Order">Order</option>
                                  </select>
                                {{-- Date Search --}}
                                <input class="form-control search" type="search" placeholder="Search Date" id="myInputDate" onkeyup="searchDate()">
                            </div>
                        </div>
                        <div class="d-flex">
                            @if($revenuesData->isEmpty() && $shortContracts->isEmpty() && $expensesData->isEmpty() && $pettycashData->isEmpty() )
                                <div style="
                                    width: 100%;
                                    height: 100vh;
                                    text-align: center;
                                    padding-top: 70px;
                                    margin: 20px;
                                    background: var(--input);
                                    border-radius: 0.25rem;
                                    font-size: 22px;
                                    letter-spacing: 3px;
                                    ">
                                    There are no invoices at this time !
                                </div>
                            @else
                            <table id="contractsTable" class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Contracts</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Value</th>
                                        <th scope="col">image</th>
                                        <th scope="col">Date Start</th>
                                        <th scope="col">Date End</th>
                                        <th scope="col">Details</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                        {{-- Basic Revenue --}}

                                        @foreach ($revenuesData as $basicRevenues)
                                        <tbody class="myULDate contracts-table">
                                            <tr class="itemDetails contract-row"
                                            data-type="{{ $basicRevenues->contract_type == 'monthlyContracts'
                                                        ? 'Monthly Contracts'
                                                        : ($basicRevenues->contract_type == 'threeMonthContracts'
                                                            ? '3 Month Contracts'
                                                            : ($basicRevenues->contract_type == 'SemiSecondaryContracts'
                                                                ? 'Semi Secondary Contracts'
                                                                : ($basicRevenues->contract_type == 'SecondaryContracts'
                                                                    ? 'Secondary Contracts'
                                                                    : ($basicRevenues->contract_type == 'consultation'
                                                                        ? 'consultation'
                                                                        : '')))) }}">
                                                <!-- Num -->
                                                <td># {{ $basicRevenues->id }}</td>
                                                <!-- Type -->
                                                <td>Reveneus Basic</td>
                                                <!-- name Contracts -->
                                                <td>
                                                    {{ $basicRevenues->contract_type == 'monthlyContracts'
                                                        ? 'Monthly Contracts'
                                                        : ($basicRevenues->contract_type == 'threeMonthContracts'
                                                            ? '3 Month Contracts'
                                                            : ($basicRevenues->contract_type == 'SemiSecondaryContracts'
                                                                ? 'Semi Secondary Contracts'
                                                                : ($basicRevenues->contract_type == 'SecondaryContracts'
                                                                    ? 'Secondary Contracts'
                                                                    : ($basicRevenues->contract_type == 'consultation'
                                                                        ? 'consultation'
                                                                        : '')))) }}
                                                </td>
                                                <!-- clint Name -->
                                                <td>{{ $basicRevenues->name }}</td>

                                                <!-- Day -->
                                                <td>{{ $basicRevenues->amount }}<span class="text-warning">.EGP</span></td>
                                                <!-- Restrict -->
                                                <td class="gallery">
                                                    {{-- Gallery --}}
                                                    <span class="iconImg mx-2">
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            @if (!empty($basicRevenues->{'image' . $i}))
                                                                <a href="{{ asset($globalVariable . 'images/revenue/' . $basicRevenues->{'image' . $i}) }}"
                                                                    data-fancybox="gallery-{{ $basicRevenues->id }}"
                                                                    data-caption="Imag-{{ $i }}">
                                                                    <img style="display: none"
                                                                        src="{{ asset($globalVariable . 'images/revenue/' . $basicRevenues->{'image' . $i}) }}" />
                                                            @endif
                                                        @endfor
                                                        <i class="fa-regular fa-image fa-xl"></i>
                                                        </a>
                                                    </span>
                                                </td>

                                                <td class="date2">{{ $basicRevenues->start_date }}</td>

                                                <td id="employees" class="">
                                                    {{ $basicRevenues->due_date }}
                                                </td>
                                                <td class="">
                                                    <button class="btnAccordion employee-btn {{$basicRevenues->notes  ?  'btnGray' : '' }}" 
                                                        data-employee="{{$basicRevenues->notes ? $basicRevenues->notes : ''}}" {{$basicRevenues->notes  ?  '' : 'disabled' }}>Details</button>
                                                </td>
                                                <!--Action  -->
                                                <td class="td">
                                                    <form class=""
                                                        action="{{ route('admin.fiances.destroy', $basicRevenues->id) }}"method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="bg-none btn text-danger">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach


                                        {{-- Short Contracts --}}
                                        @foreach ($shortContracts as $shortContract)
                                            <tbody class="myULDate contracts-table">
                                                <tr class="itemDetails contract-row" 
                                                data-type="{{ $shortContract->contractShort_type == 'reservedService'
                                                    ? 'Reserved Service'
                                                    : ($shortContract->contractShort_type == 'weeklyContracts'
                                                        ? 'Weekly Contracts'
                                                        : ($shortContract->contractShort_type == 'annualContracts'
                                                            ? 'Annual Contracts'
                                                            : '')) }}">
                                                    <!-- Num -->
                                                    <td># {{ $shortContract->id }}</td>
                                                    <!-- Type -->
                                                    <td>Reveneus Short Contracts </td>
                                                    <!-- name Contracts -->
                                                    <td>
                                                        {{ $shortContract->contractShort_type == 'reservedService'
                                                            ? 'Reserved Service'
                                                            : ($shortContract->contractShort_type == 'weeklyContracts'
                                                                ? 'Weekly Contracts'
                                                                : ($shortContract->contractShort_type == 'annualContracts'
                                                                    ? 'Annual Contracts'
                                                                    : '')) }}
                                                    </td>
                                                    <!-- Name -->
                                                    <td>{{ $shortContract->name }}</td>

                                                    <!-- Day -->
                                                    <td>{{ $shortContract->amount }}<span class="text-warning">.EGP</span></td>
                                                    <!-- Restrict -->
                                                    <td class="gallery">
                                                        {{-- Gallery --}}
                                                        <span class="iconImg mx-2">
                                                            @for ($i = 1; $i <= 10; $i++)
                                                                @if (!empty($shortContract->{'image' . $i}))
                                                                    <a href="{{ asset($globalVariable . 'images/shortContracts/' . $shortContract->{'image' . $i}) }}"
                                                                        data-fancybox="gallery-{{ $shortContract->id }}"
                                                                        data-caption="Imag-{{ $i }}">
                                                                        <img style="display: none"
                                                                            src="{{ asset($globalVariable . 'images/shortContracts/' . $shortContract->{'image' . $i}) }}" />
                                                                @endif
                                                            @endfor
                                                            <i class="fa-regular fa-image fa-xl"></i>
                                                            </a>
                                                        </span>
                                                    </td>


                                                    <td class="date2">{{ $shortContract->start_date }}</td>

                                                    <td id="employees" class="">
                                                        {{ $shortContract->due_date }}
                                                    </td>
                                                    <td class="">
                                                        <button class="btnAccordion employee-btn {{$shortContract->notes  ?  'btnGray' : '' }}" 
                                                            data-employee="{{$shortContract->notes ? $shortContract->notes : '' }}" {{$shortContract->notes  ?  '' : 'disabled' }}>Detials</button>
                                                    </td>
                                                    <!--Action  -->
                                                    <td class="td">
                                                        <form class=""
                                                            action="{{ route('admin.fiances.shortContracts.destroy', $shortContract->id) }}"method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="bg-none btn text-danger">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach

                                        {{-- Expenses --}}
                                        @foreach ($expensesData as $expensess)
                                            <tbody class="myULDate contracts-table">
                                                <tr data-type="{{ $expensess->invoice_type }}" class="itemDetails contract-row">
                                                    <!-- Num -->
                                                    <td># {{ $expensess->id }}</td>
                                                    <!-- Type -->
                                                    <td>Expenses Basic</td>
                                                    <!-- name Contracts -->
                                                    <td>{{ $expensess->invoice_type }}</td>
                                                    <!-- Name -->
                                                    <td>{{ $expensess->name == null ? 'Expenses' : '' }}</td>

                                                    <!-- Day -->
                                                    <td>{{ $expensess->amount }}<span class="text-warning">.EGP</span></td>
                                                    <!-- Restrict -->
                                                    <td class="gallery">
                                                        {{-- Gallery --}}
                                                        <span class="iconImg mx-2">
                                                            @if (!empty($expensess->{'image'}))
                                                                <a href="{{ asset($globalVariable . 'images/expenses/' . $expensess->{'image'}) }}"
                                                                    data-fancybox="gallery-{{ $expensess->id }}"
                                                                    data-caption="Imag">
                                                                    <img style="display: none"
                                                                        src="{{ asset($globalVariable . 'images/expenses/' . $expensess->{'image' }) }}" />
                                                            @endif

                                                            <i class="fa-regular fa-image fa-xl"></i>
                                                            </a>
                                                        </span>
                                                    </td>


                                                    <td class="date2">{{ $expensess->start_date }}</td>

                                                    <td id="employees" class="">
                                                        {{ $expensess->due_date }}
                                                    </td>
                                                    <td class="">
                                                        <button class="btnAccordion employee-btn {{$expensess->notes  ?  'btnGray' : '' }}"
                                                            data-employee="{{$expensess->notes ? $expensess->notes : ''}}" {{$expensess->notes  ?  '' : 'disabled' }}>Details</button>
                                                    </td>
                                                    <!--Action  -->
                                                    <td class="td">
                                                        <form action="{{ route('admin.fiances.expenses_delete', $expensess->id) }}"method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="bg-none btn text-danger">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach


                                        {{-- Petty Cash --}}
                                        @foreach ($pettycashData as $pettycash)
                                            <tbody class="myULDate contracts-table">
                                                <tr class="itemDetails contract-row" data-type="{{ $pettycash->invoicepetty_type }}">
                                                    <!-- Num -->
                                                    <td># {{ $pettycash->id }}</td>
                                                   <!-- Type -->
                                                   <td>Expenses Petty Cash</td>
                                                   <!-- name Contracts -->
                                                    <td>{{ $pettycash->invoicepetty_type }}</td>
                                                    <!-- Name -->
                                                    <td>{{ $pettycash->name == null ? 'Petty Cash' : '' }}</td>

                                                    <!-- Day -->
                                                    <td>{{ $pettycash->amount }}<span class="text-warning">.EGP</span></td>
                                                    <!-- Restrict -->
                                                    <td class="gallery">
                                                        {{-- Gallery --}}
                                                        <span class="iconImg mx-2">
                                                            @if (!empty($pettycash->{'image'}))
                                                                <a href="{{ asset($globalVariable . 'images/pettycash/' . $pettycash->{'image'}) }}"
                                                                    data-fancybox="gallery-{{ $pettycash->id }}"
                                                                    data-caption="Imag">
                                                                    <img style="display: none"
                                                                        src="{{ asset($globalVariable . 'images/pettycash/' . $pettycash->{'image'}) }}" />
                                                            @endif

                                                            <i class="fa-regular fa-image fa-xl"></i>
                                                            </a>
                                                        </span>
                                                    </td>


                                                    <td class="date2">{{ $pettycash->start_date }}</td>

                                                    <td id="employees" class="">
                                                        {{ $pettycash->due_date }}
                                                    </td>
                                                    <td class="">
                                                        <button class="btnAccordion employee-btn {{$pettycash->notes  ?  'btnGray' : '' }}"
                                                            data-employee="{{$pettycash->notes ? $pettycash->notes : ''}}" {{$pettycash->notes  ?  '' : 'disabled' }}>Details</button>
                                                    </td>
                                                    <!--Action  -->
                                                    <td class="td">
                                                        <form class=""
                                                            action="{{ route('admin.fiances.petty_delete', $pettycash->id) }}"method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="bg-none btn text-danger">
                                                                <i class="fa-regular fa-trash-can"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                  @endif
                            </table>
                        </div>

                    </div>
                    <!-- monthInventory -->
                    <div class="tab-pane fade" id="monthInventory" role="tabpanel" aria-labelledby="monthInventory-tab">
                        {{-- Date filter --}}
                        <form class=" m-3" action="{{ route('filterMonth_data') }}" method="GET">
                            <div style="display: flex ;">
                                {{-- Filter --}}
                                <button style="margin-left: 10px;" type="submit" class="btn btnGray">Filter</button>
                                <select class="form-select" id="month" name="monthStorage"
                                    aria-label="Default select example">
                                    <option value="" selected disabled>Select Month</option>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}"
                                            {{ isset($_GET['monthStorage']) && $month == $_GET['monthStorage'] ? 'selected' : '' }}>
                                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                        <div class="tab-pane fade show active" id="dayInventory" role="tabpanel"
                            aria-labelledby="dayInventory-tab">
                            <div class="d-flex">
                                @if($revenuesData->isEmpty() && $shortContracts->isEmpty() && $expensesData->isEmpty() && $pettycashData->isEmpty() )
                                    <div style="
                                        width: 100%;
                                        height: 100vh;
                                        text-align: center;
                                        padding-top: 70px;
                                        margin: 20px;
                                        background: var(--input);
                                        border-radius: 0.25rem;
                                        font-size: 22px;
                                        letter-spacing: 3px;
                                        ">
                                        There are no invoices at this time !
                                    </div>
                                @else
                                <table class="detailsMonth">
                                    <thead>
                                        <tr>
                                            <th scope="col">Num</th>
                                            <th scope="col">Month</th>
                                            <th scope="col">Total Revenues</th>
                                            <th scope="col">Total Expenses</th>
                                            <th scope="col">Total ShortContracts</th>
                                            <th scope="col">Total pettyCash</th>
                                            <th scope="col">Status Month</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($combinedData as $month => $data)
                                            <tr>
                                                <!-- Num -->
                                                <td># {{ $loop->iteration }}</td>
                                                <!-- Type -->
                                                <th>{{ $month }}</th>
                                                <!-- Day -->
                                                <!-- Total Revenues -->
                                                <td>{{ isset($data['revenue']) ? $data['revenue'] : 0 }}<span
                                                        class="text-warning">.EGP</span></td>
                                                <!-- Total Expenses -->
                                                <td>{{ isset($data['expense']) ? $data['expense'] : 0 }}<span
                                                        class="text-warning">.EGP</span></td>
                                                <!-- Total ShortContracts -->
                                                <td>{{ isset($data['shortContract']) ? $data['shortContract'] : 0 }}<span
                                                        class="text-warning">.EGP</span></td>
                                                <!-- Total pettyCash -->
                                                <td>{{ isset($data['pettycash']) ? $data['pettycash'] : 0 }}<span
                                                        class="text-warning">.EGP</span></td>
                                                {{-- Status Month --}}
                                                <td id="employees" class="">
                                                    @php
                                                        // $totalExpensePettycash = $data['expense'] + $data['pettycash'];
                                                        // $totalRevenueShortContract = $data['revenue'] + $data['shortContract'];
                                                        $totalExpensePettycash = (isset($data['expense']) ? $data['expense'] : 0) + (isset($data['pettycash']) ? $data['pettycash'] : 0);
                                                        $totalRevenueShortContract = (isset($data['revenue']) ? $data['revenue'] : 0) + (isset($data['shortContract']) ? $data['shortContract'] : 0);
                                                    @endphp

                                                    @if ($totalExpensePettycash > $totalRevenueShortContract)
                                                        <span class="upArrow text-danger">
                                                            <i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i>
                                                            {{ $totalRevenueShortContract - $totalExpensePettycash }}
                                                        </span>
                                                    @else
                                                        <span class="upArrow text-success">
                                                            <i class="fa-solid fa-arrow-trend-up fa-2xs"></i>
                                                            {{ $totalRevenueShortContract - $totalExpensePettycash }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Test --}}

                    <!-- Year yearInventory -->
                    <div class="tab-pane fade" id="yearInventory" role="tabpanel" aria-labelledby="yearInventory-tab">
                        @php
                        $revenueYear = optional(App\Models\Revenue::orderBy('created_at', 'asc')->first())->created_at ? optional(App\Models\Revenue::orderBy('created_at', 'asc')->first())->created_at->year : null;
                        $expensesYear = optional(App\Models\Expenses::orderBy('created_at', 'asc')->first())->created_at ? optional(App\Models\Expenses::orderBy('created_at', 'asc')->first())->created_at->year : null;
                        $pettycashYear = optional(App\Models\Pettycash::orderBy('created_at', 'asc')->first())->created_at ? optional(App\Models\Pettycash::orderBy('created_at', 'asc')->first())->created_at->year : null;
                        $shortContractsYear = optional(App\Models\ShortContracts::orderBy('created_at', 'asc')->first())->created_at ? optional(App\Models\ShortContracts::orderBy('created_at', 'asc')->first())->created_at->year : null;
                    
                        $yearsArray = array_filter([$revenueYear, $expensesYear, $pettycashYear, $shortContractsYear]);
                        if (empty($yearsArray)) {
                            $years = null;
                        } else {
                            $firstYear = min($yearsArray);
                            $currentYear = date('Y');
                            $years = range($firstYear, $currentYear);
                        }
                    
                        $selectedYear = request()->input('filterYear');
                    @endphp

                        <form class="d-flex m-3" action="{{ route('filterYear_data') }}" method="GET">
                            <button style="margin-left: 10px;" class="btnGray" type="submit">Search Year</button>
                            <select class="form-select" name="filterYear" id="selected_year" {{$years ? '' : 'disabled'}}>
                                @if ($years)
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}"  @if($year == $selectedYear) selected @endif >{{ $year }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </form>
                        <div class="d-flex">
                            @if($revenuesData->isEmpty() && $shortContracts->isEmpty() && $expensesData->isEmpty() && $pettycashData->isEmpty() )
                                <div style="
                                    width: 100%;
                                    height: 100vh;
                                    text-align: center;
                                    padding-top: 70px;
                                    margin: 20px;
                                    background: var(--input);
                                    border-radius: 0.25rem;
                                    font-size: 22px;
                                    letter-spacing: 3px;
                                    ">
                                    There are no invoices at this time !
                                </div>
                            @else
                            <table class="detailsMonth">
                                <thead>
                                    <tr>
                                        <th scope="col">Num</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Total Revenues</th>
                                        <th scope="col">Total Expenses</th>
                                        <th scope="col">Total ShortContracts</th>
                                        <th scope="col">Total pettyCash</th>
                                        <th scope="col">Status Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($combinedDataYear as $year => $data)
                                        <tr>
                                            <!-- Num -->
                                            <td># {{ $loop->iteration }}</td>
                                            <!-- Year -->
                                            <td>{{ $year }}</td>
                                            {{-- Total Revenues --}}
                                            <td>{{ isset($data['revenueYear']) ? $data['revenueYear'] : 0 }}<span
                                                    class="text-warning">.EGP</span></td>
                                            {{-- Total Expenses --}}
                                            <td>{{ isset($data['expenseYear']) ? $data['expenseYear'] : 0 }}<span
                                                    class="text-warning">.EGP</span></td>
                                            {{-- Total ShortContracts --}}
                                            <td>{{ isset($data['shortContractYear']) ? $data['shortContractYear'] : 0 }}<span
                                                    class="text-warning">.EGP</span></td>
                                            {{-- Total pettyCash --}}
                                            <td>{{ isset($data['pettycashYear']) ? $data['pettycashYear'] : 0 }}<span
                                                    class="text-warning">.EGP</span></td>
                                            {{-- Status Year --}}
                                            <td>
                                                @php
                                                    $totalExpensePettycashYear = (isset($data['expenseYear']) ? $data['expenseYear'] : 0) + (isset($data['pettycashYear']) ? $data['pettycashYear'] : 0);
                                                    $totalRevenueShortContractYear = (isset($data['revenueYear']) ? $data['revenueYear'] : 0) + (isset($data['shortContractYear']) ? $data['shortContractYear'] : 0);
                                                @endphp

                                                @if ($totalExpensePettycashYear > $totalRevenueShortContractYear)
                                                    <span class="upArrow text-danger">
                                                        <i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i>
                                                        {{ $totalRevenueShortContractYear - $totalExpensePettycashYear }}
                                                    </span>
                                                @else
                                                    <span class="upArrow text-success">
                                                        <i class="fa-solid fa-arrow-trend-up fa-2xs"></i>
                                                        {{ $totalRevenueShortContractYear - $totalExpensePettycashYear }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->


    <!-- Alert Notes -->
    <div id="notes-container" style="display:none;">
        <div class="navNotes">
            <i id="closeNotes" class="fa-solid fa-x"></i>
            {{-- <img src="{{asset('images')}}/{{$employee->image}}"> --}}
        </div>
        <p id="notes"></p>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/fancybox.umd.js"></script>
    <script src="{{ asset($globalVariable . 'assets') }}/js/storage.js"></script>
    {{-- popup income --}}
    <script>
        $(document).ready(function() {
            $('.gallery img').click(function() {
                var imageUrl = $(this).attr('src');
                var imageAlt = $(this).attr('alt');
                $('#overlay-image').attr('src', imageUrl);
                $('#overlay-image').attr('alt', imageAlt);
                $('#download-button').attr('href', imageUrl);
                $('#overlay').fadeIn();
            });

            $('#overlay').click(function() {
                $(this).fadeOut();
            });
        });

        Fancybox.bind("[data-fancybox]", {

        });
    </script>
@endsection
