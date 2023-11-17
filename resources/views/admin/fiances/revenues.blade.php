@extends('admin.fiances.layouts.shardfiances')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset($globalVariable . 'assets') }}/css/fancybox.css" rel="stylesheet">
    <link href="{{ asset($globalVariable . 'assets') }}/css/revenues.css" rel="stylesheet">
@endsection

@section('content')


{{-- Message Success --}}
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

	{{-- Message Error --}}
	@if(session('error'))
	<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
	<div class="alertStyle" id="error404">
		<div class="d-flex align-items-center">
			<i class="fa-solid fa-skull-crossbones fs-5"></i>
			<span class="mx-2 fs-5">{!!session('error')!!} (<span class="countdown">5</span>)</span>
		</div>
	</div>
	</div>
	@endif


    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Revenues</h3>
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
                            Basic revenue
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tabTow-tab" data-bs-toggle="tab" data-bs-target="#tabTow"
                            type="button" role="tab" aria-controls="tabTow" aria-selected="false">
                            Short Contracts
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Basic revenue -->
                    <div class="tab-pane fade show active" id="dayInventory" role="tabpanel"
                    aria-labelledby="dayInventory-tab">
                    <!-- {{-- Search --}} -->
                    <div class="d-flex justify-content-between m-3">
                            <div class="d-flex">
                                <form method="GET" action="{{ route('admin.fiances.revenues') }}">
                                    <button type="submit" class="bg-none icon">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                </form>
                                {{-- Search Btn --}}
                                <span style="height: 35px;" class="btn btn-primary search-button" >
                                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                                </span>
                                <!-- {{-- Item Search --}} -->
                                <select class="form-select" id="search-category" aria-label="Default select example">
                                    <option selected value="show">All Type</option>
                                    <option value="monthlyContracts">Monthly Contracts</option>
                                    <option value="threeMonthContracts">3 Month Contracts</option>
                                    <option value="Semiannual">Semi Annual</option>
                                    <option value="annualContracts">Annual Contracts</option>
                                    <option value="consultation">consultation</option>
                                </select>
                                <!-- {{-- Active Complet Search --}} -->
                                <select class="form-select mx-4 filterSelect"
                                    aria-label="Default select example">
                                    <option selected value="active_complete">Active | complete </option>
                                    <option value="active">active</option>
                                    <option value="complete">complete</option>
                                </select>
                                <form method="GET" action="/filter">
                                    <div class="d-flex">
                                        <button type="submit" class="btnGray">Filter</button>
                                        <!-- {{-- start Date  --}} -->
                                        <div class="inputFilter">
                                            <label class="px-1"> Start Date : </label>
                                            <input type="date" class="form-control" placeholder="start" name="start_date" aria-label="Username" aria-describedby="addon-wrapping">
                                        </div>
                                        <!-- {{-- End Date  --}} -->
                                        <div class="inputFilter mx-4">
                                            <label class="px-1"> End Date : </label>
                                            <input id="EndDate" type="date" class="form-control" placeholder="End" name="end_date"aria-label="Username" aria-describedby="addon-wrapping">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- {{-- Add Card --}} -->
                            <button class="addItem" data-bs-toggle="modal" data-bs-target="#exampleModalBasic">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <!-- {{-- Cards basic --}} -->
                        <section class="sectionCard mx-3">
                        @if($revenuesData->isEmpty())
                        <div style="@auth
                            width: 100%;
                            text-align: center;
                            padding-top: 70px;
                            background: var(--input);
                            border-radius: 0.25rem;
                            font-size: 22px;
                            letter-spacing: 3px;
                            @endauth">
                            There are no invoices at this time !
                        </div>
                            @else
                            @foreach ($revenuesData as $revenue )
                            <div class="boxCards  {{ $revenue->contract_type == 'monthlyContracts' ? 'monthlyContracts' :
                                ($revenue->contract_type == 'threeMonthContracts' ? 'threeMonthContracts' :
                                 ($revenue->contract_type == 'Semiannual' ? 'Semiannual' :
                                 ($revenue->contract_type == 'consultation' ? 'consultation' :
                                 ($revenue->contract_type == 'annualContracts' ? 'annualContracts' : '')))) }}-content show-all category-content">
                                <div class="front">
                                    <!-- {{-- Line --}} -->
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        <!-- {{-- Number Cards --}} -->
                                        <span class="numCard rotateCard {{ 
                                            $revenue->contract_type == 'monthlyContracts' ? 'monthlyContracts' :
                                            ($revenue->contract_type == 'threeMonthContracts' ? 'threeMonthContracts' :
                                             ($revenue->contract_type == 'Semiannual' ? 'SemiSecondaryContracts' :
                                             ($revenue->contract_type == 'consultation' ? 'consultation' :
                                             ''))) }}">{{ $revenue->id }}</span>
                                        <!-- {{-- service Type --}} -->
                                        <h6 class="rotateCard" data-contract_type="{{ $revenue->contract_type}}">{{ $revenue->contract_type == 'monthlyContracts' ? 'Monthly Contracts' :
                                            ($revenue->contract_type == 'threeMonthContracts' ? '3 Month Contracts' :
                                            ($revenue->contract_type == 'Semiannual' ? 'Semi Annual' :
                                            ($revenue->contract_type == 'annualContracts' ? 'Annual Contracts' :
                                            ($revenue->contract_type == 'consultation' ? 'consultation' :'')))) }}</h6>
                                        <!-- {{-- client Name --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>Name :</span>
                                            <span>{{ $revenue->name }}</span>
                                        </div>
                                        <!-- {{-- client ID --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>ID :</span>
                                            <span class="fw-bolder">#<span>{{ $revenue->id }}</span></span>
                                        </div>
                                        <!-- {{-- Total Cost --}} -->
                                        <div class="clientCost rotateCard textgallery">
                                            <span>Cost : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">{{ $revenue->amount }}</span>
                                                <span class="text-warning">.EGP</span>
                                            </div>
                                        </div>
                                        <!-- {{-- Start date --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>From :</span>
                                            <span>{{ $revenue->start_date }}</span>
                                        </div>
                                        <!-- {{-- End date --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>To :</span>
                                            <span>{{ $revenue->due_date }}</span>
                                        </div>

                                        <!-- {{-- Gallery --}} -->
                                        <div class="clientCost gallery textgallery">
                                            <span>Gallery : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">
                                                        @php
                                                        $imageCount = 0;
                                                        for ($i = 1; $i <= 10; $i++) {
                                                            if (!empty($revenue->{'image'. $i})) {
                                                                $imageCount++;
                                                            }
                                                        }
                                                        echo $imageCount;
                                                    @endphp
                                                </span>
                                                <!-- {{-- IconImg --}} -->
                                               <span class="iconImg mx-2">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                    @if (!empty($revenue->{'image'. $i}))
                                                    <a href="{{ asset($globalVariable . 'images/revenue/' . $revenue->{'image'. $i}) }}" data-fancybox="gallery-{{ $revenue->id }}" data-caption="Image{{ $i }}">
                                                                <img style="display: none" src="{{ asset($globalVariable .'images/revenue/' . $revenue->{'image'. $i}) }}" />
                                                        @endif
                                                     @endfor
                                                        <i class="fa-regular fa-image fa-lg"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- {{-- status --}} -->
                                        <div class="rotateCard">
                                            <span>Status :</span>

                                            <span class="status  {{ $revenue->checkbox_field == '1' ? 'btnPrimary' :'bgGray'}}  " id="statusSpan">
                                                {{ $revenue->checkbox_field == '1' ? 'complete' :'active'}}
                                                <span class="togglactive  iconActive"></span>
                                            </span>
                                        </div>
                                        <!-- {{-- Action --}} -->
                                        <div class="d-flex align-items-center">
                                            <form class="delete btn-danger" action="{{ route('admin.fiances.destroy', $revenue->id) }}"method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-none text-danger" onclick="return confirm('Are you sure you want to delete this {{ $revenue->contract_type}}?')">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <div class="edit btn-success mx-2">
                                                <form action="{{ route('finance.edit.revenues', $revenue->id) }}">
                                                    <button class="bg-none text-success"onclick="confirm('Are you sure you want to delete this {{ $revenue->name }}?')">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <!-- {{--  Update Status     --}} -->
                                            <form class="d-flex align-items-center"  method="POST" action="{{ route('updateChckbox.revenue',$revenue->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="checkbox" name="checkbox_field" class="myCheckbox" data-revenue-id="{{ $revenue->id }}" {{ $revenue->checkbox_field == '1' ? 'checked' : '' }}>
                                                <button type="submit" id="submitButton" style="display:none;">Send</button>
                                            </form>
                                            {{-- <div class="d-flex align-items-center">
                                                <input type="checkbox" name="checkbox_field" class="myCheckbox" data-revenue-id="{{ $revenue->id }}" {{ $revenue->checkbox_field == '1' ? 'checked' : '' }}>
                                            </div>
                                            <input type="hidden" id="revenue-id" value="{{ $revenue->id }}">
                                             --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="back rotateCard monthlyContracts">
                                    <!-- {{-- Line --}} -->
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        <!-- {{-- Number Cards --}} -->
                                        <span class="numCard monthlyContracts">{{ $revenue->id }}</span>
                                        <!-- {{-- service Type --}} -->
                                        <h4>Details service</h4>
                                        <!-- {{-- Notes --}} -->
                                        <div class="clientName">
                                            <p>{{$revenue->notes}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </section>
                    </div>


                    <!-- Short Contracts -->
                    <div class="tab-pane fade" id="tabTow" role="tabpanel" aria-labelledby="tabTow-tab">
                        {{-- <!-- Search --> --}}
                        <div class="d-flex justify-content-between m-3">
                            <div class="d-flex">
                                <form method="GET" action="{{ route('admin.fiances.revenues') }}">
                                    <button type="submit" class="bg-none icon">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                </form>
                                <span style="height: 35px;" class="btn btnPrimary search-buttonPety" >
                                    <i class="fa-solid fa-magnifying-glass fa-lg"></i></span>
                                {{-- Item Search --}}
                                <select class="form-select" id="search-categoryPety" aria-label="Default select example">
                                    <option selected value="show">All Type</option>
                                    <option value="reservedService">Reserved Service</option>
                                    <option value="weeklyContracts">Weekly Contracts</option>
                                    <option value="SecondaryContracts">Secondary Contracts</option>
                                </select>
                                {{-- Active Complet Search --}}
                                <select class="form-select filterSelect mx-4"
                                    aria-label="Default select example">
                                    <option selected value="active_complete">Active | complete </option>
                                    <option value="active">active</option>
                                    <option value="complete">complete</option>
                                </select>
                                {{-- Date filter --}}
                                <form method="GET" action="/filtershortcontract">
                                    <div class="d-flex">
                                        <button type="submit" class="btnGray ">Filter</button>
                                        <!-- {{-- start Date  --}} -->
                                        <div class="inputFilter">
                                            <label class="px-1"> Start Date : </label>
                                            <input type="date" class="form-control" placeholder="start" name="start_date" aria-label="Username" aria-describedby="addon-wrapping">

                                        </div>
                                        <!-- {{-- End Date  --}} -->
                                        <div class="inputFilter mx-4">
                                            <label class="px-1"> End Date : </label>
                                        <input id="EndDate" type="date" class="form-control" placeholder="End" name="end_date"aria-label="Username" aria-describedby="addon-wrapping">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            {{-- Add Card --}}
                            <button class="addItem" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>


                        {{-- Cards pety cach --}}
                        <section class="sectionCard mx-3">
                        @if($shortContracts->isEmpty())
                            <div style="@auth
                                width: 100%;
                                text-align: center;
                                padding-top: 70px;
                                background: var(--input);
                                border-radius: 0.25rem;
                                font-size: 22px;
                                letter-spacing: 3px;
                                @endauth">
                                There are no invoices at this time !
                            </div>
                            @else
                            @foreach ($shortContracts as $shortCon )
                            <div class="boxCards {{  $shortCon->contractShort_type == 'reservedService' ? 'reservedService' :
                                ($shortCon->contractShort_type == 'weeklyContracts' ? 'weeklyContracts' :
                                ($shortCon->contractShort_type == 'SecondaryContracts' ? 'SecondaryContracts' :  '')) }}-content show-allpety petycategory-content">
                                <div class="front">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard rotateCard {{ $shortCon->contractShort_type == 'reservedService' ? 'reservedService' :
                                            ($shortCon->contractShort_type == 'weeklyContracts' ? 'weeklyContracts' :
                                             ($shortCon->contractShort_type == 'SecondaryContracts' ? 'consultation' :'')) }}">{{ $shortCon->id }}</span>
                                        {{-- service Type --}}
                                        <h6 class="rotateCard" data-contractShort_type="{{ $shortCon->contractShort_type}}" >
                                        {{ $shortCon->contractShort_type == 'reservedService' ? 'Reserved Service' :
                                            ($shortCon->contractShort_type == 'weeklyContracts' ? 'Weekly Contracts' :
                                            ($shortCon->contractShort_type == 'SecondaryContracts' ? 'Secondary Contracts' :'')) }}</h6>
                                        {{-- client Name --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>Name :</span>
                                            <span>{{ $shortCon->name }}</span>
                                        </div>
                                        <!-- {{-- client ID --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>ID :</span>
                                            <span class="fw-bolder">#<span>{{ $shortCon->id }}</span></span>
                                        </div>
                                        {{-- Total Cost --}}
                                        <div class="clientCost rotateCard textgallery">
                                            <span>Cost : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">{{ $shortCon->amount }}</span>
                                                <span class="text-warning">.EGP</span>
                                            </div>
                                        </div>
                                        {{-- Start date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>From :</span>
                                            <span>{{ $shortCon->start_date }}</span>
                                        </div>
                                        {{-- End date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>To :</span>
                                            <span>{{ $shortCon->due_date }}</span>
                                        </div>

                                        {{-- Gallery --}}
                                        <div class="clientCost gallery textgallery">
                                            <span>Gallery : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">
                                                     @php
                                                        $imageCount = 0;
                                                        for ($i = 1; $i <= 10; $i++) {
                                                            if (!empty($shortCon->{'image'. $i})) {
                                                                $imageCount++;
                                                            }
                                                        }
                                                        echo $imageCount;
                                                    @endphp
                                                </span>
                                                {{-- IconImg --}}
                                                <span class="iconImg mx-2">
                                                    @for ($i = 1; $i <= 10; $i++)
                                                    @if (!empty($shortCon->{'image'. $i}))
                                                    <a href="{{ asset($globalVariable . 'images/shortContracts/' . $shortCon->{'image'. $i}) }}" data-fancybox="gallery-{{ $shortCon->id }}" data-caption="Image{{ $i }}">
                                                                <img style="display: none" src="{{ asset($globalVariable .'images/shortContracts/' . $shortCon->{'image'. $i}) }}" />
                                                        @endif
                                                     @endfor
                                                        <i class="fa-regular fa-image fa-lg"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        {{-- status --}}
                                        <div class="rotateCard">
                                            <span>Status :</span>
                                            <span class="status bgGray" id="statusSpan">
                                                active
                                                <span class="togglactive iconActive"></span>
                                            </span>
                                        </div>
                                        {{-- Action --}}
                                        <div class="d-flex align-items-center">
                                            <form class="delete btn-danger" action="{{ route('admin.fiances.shortContracts.destroy', $shortCon->id) }}"method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-none text-danger">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <div class="edit btn-success mx-2">
                                                <form action="{{ route('finance.edit.showShortcontract', $shortCon->id) }}">
                                                    <button class="bg-none text-success">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            {{--               Update Status                  --}}
                                            <form class="d-flex align-items-center">
                                                <input type="checkbox" class="myCheckbox">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="back rotateCard reservedService">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard reservedService">{{ $shortCon->id }}</span>
                                        {{-- service Type --}}
                                        <h4>Details service</h4>
                                        {{-- Notes --}}
                                        <div class="clientName">
                                            <p>{{ $shortCon->notes }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->

    {{-- Popup Window Basic revenue --}}
    <form class="modal fade" id="exampleModalBasic" tabindex="-1" aria-labelledby="exampleModalLabel"
        action="{{ url('/admin/finance/revenues/savebasic') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Basic Revenue</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                    <div class="col-7 mb-3">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Username" aria-describedby="basic-addon1" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="input-group mb-4 justify-content-end">
                            <input type="number" class="form-control" placeholder="Type Value" value="{{ old('amount') }}" name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                            @error('amount')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="Start" name="start_date"
                                aria-describedby="addon-wrapping" value="{{ old('start_date') }}">
                                @error('start_date')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="End" name="due_date"
                                aria-describedby="addon-wrapping" value="{{ old('due_date') }}">
                                @error('due_date')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Select Type --}}
                        <div class="input-group ">
                            <select class="form-select" id="search-categoryPety" name="contract_type"
                                aria-label="Default select example">
                                <option selected disabled>Type </option>
                                <option value="monthlyContracts">Monthly Contracts</option>
                                <option value="threeMonthContracts">3 Month Contracts</option>
                                <option value="Semiannual">Semi Annual Contracts</option>
                                <option value="annualContracts">Annual Contracts</option>
                                <option value="consultation">consultation</option>
                            </select>
                            @error('contract_type')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                    </div>
                    {{-- Upload  --}}
                    <div class="col mb-3">
                        <div class="input-group uploadImg">
                            <span class="minImg">
                                <label for="file-upload0" class="custom-upload-button">Upload Image</label>
                                <input type="file" id="file-upload0" name="image1" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image1')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        </div>
                        {{-- small Images --}}
                        <div class="boxMinImg">
                            <!-- Card 2 -->
                            <span class="minImg">
                                <label for="file-upload1" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload1" name="image2" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image2')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                            <!-- Card 3 -->
                            <span class="minImg">
                                <label for="file-upload2" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload2"  name="image3" class="file-upload" onchange="previewImage(event, 2)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image3')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                             @enderror
                            <!-- Card 4 -->
                            <span class="minImg">
                                <label for="file-upload3" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload3"  name="image4" class="file-upload" onchange="previewImage(event, 3)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image4')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                            <!-- Card 5 -->
                            <span class="minImg">
                                <label for="file-upload4" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload4"  name="image5" class="file-upload" onchange="previewImage(event, 4)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image5')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 6 -->
                            <span class="minImg">
                                <label for="file-upload5" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload5"  name="image6" class="file-upload" onchange="previewImage(event, 5)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image6')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 7 -->
                            <span class="minImg">
                                <label for="file-upload6" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload6"  name="image7" class="file-upload" onchange="previewImage(event, 6)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image7')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                            <!-- Card 8 -->
                            <span class="minImg">
                                <label for="file-upload7" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload7" name="image8" class="file-upload" onchange="previewImage(event, 7)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image8')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 9 -->
                            <span class="minImg">
                                <label for="file-upload8" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload8" name="image9" class="file-upload" onchange="previewImage(event, 8)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image9')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 10 -->
                            <span class="minImg">
                                <label for="file-upload10" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload10" name="image10" class="file-upload" onchange="previewImage(event, 10)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image10')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Type Notes" name="notes" aria-label="With textarea"></textarea>
                        @error('notes')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save changes</button>
                </div>
            </div>
        </div>
    </form>

    {{-- Popup Window short contracts --}}
    <form class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        action="{{ url('/admin/finance/revenues/saveshortContracts') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Short Contracts</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                    <div class="col-7 mb-3">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Username" aria-describedby="basic-addon1" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="input-group mb-4 justify-content-end">
                            <input type="number" class="form-control" placeholder="Type Value" name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)" value="{{ old('amount') }}">
                            <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                            @error('amount')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="Start" name="start_date"
                                aria-describedby="addon-wrapping" value="{{ old('start_date') }}">
                                @error('start_date')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="End" name="due_date"
                                aria-describedby="addon-wrapping" value="{{ old('due_date') }}">
                                @error('due_date')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        {{-- Select Type --}}
                        <div class="input-group ">
                            <select class="form-select" id="search-categoryPety" name="contractShort_type"
                                aria-label="Default select example">
                                <option selected disabled>Type </option>
                                <option value="reservedService">Reserved Service</option>
                                <option value="weeklyContracts">Weekly Contracts</option>
                                <option value="SecondaryContracts">Secondary Contracts</option>
                            </select>
                            @error('contractShort_type')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                    </div>
                    {{-- Upload  --}}
                    <div class="col mb-3">
                        <div class="input-group uploadImg">
                            <span class="minImg">
                                <label for="file-upload22" class="custom-upload-button">Upload Image</label>
                                <input type="file" id="file-upload22"  name="image1"  class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image1')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                        {{-- small Images --}}
                        <div class="boxMinImg">
                            <!-- Card 1 -->
                            <span class="minImg">
                                <label for="file-upload23" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload23"  name="image2"  class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image2')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 3 -->
                            <span class="minImg">
                                <label for="file-upload24" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload24" class="file-upload"  name="image3"  onchange="previewImage(event, 2)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image3')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 4 -->
                            <span class="minImg">
                                <label for="file-upload25" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload25" class="file-upload"  name="image4"  onchange="previewImage(event, 3)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image4')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 5 -->
                            <span class="minImg">
                                <label for="file-upload26" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload26" class="file-upload"  name="image5"  onchange="previewImage(event, 4)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image5')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 6 -->
                            <span class="minImg">
                                <label for="file-upload27" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload27" class="file-upload"  name="image6"  onchange="previewImage(event, 5)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image6')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 7 -->
                            <span class="minImg">
                                <label for="file-upload28" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload28" class="file-upload"  name="image7"  onchange="previewImage(event, 6)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image7')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 8 -->
                            <span class="minImg">
                                <label for="file-upload29" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload29" class="file-upload"  name="image8"  onchange="previewImage(event, 7)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image8')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 9 -->
                            <span class="minImg">
                                <label for="file-upload30" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload30" class="file-upload"  name="image9"  onchange="previewImage(event, 8)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image9')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                            <!-- Card 10 -->
                            <span class="minImg">
                                <label for="file-upload32" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload32" class="file-upload"  name="image10"  onchange="previewImage(event, 10)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                            @error('image10')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Type Notes" name="notes" aria-label="With textarea"></textarea>
                        @error('notes')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/revenues.js"></script>
    <script src="{{ asset($globalVariable . 'assets') }}/js/fancybox.umd.js"></script>

   <script>
        // Rotate Card-3d
        $(document).ready(function() {
            $('.rotateCard').click(function() {
                $(this).parents('.boxCards').toggleClass('showInfo');
            });
        });
        // Toggle Active checkbox
        $(document).ready(function() {
            $('.myCheckbox').change(function() {
                var $container = $(this).closest('.boxCards');
                var $span = $container.find('#statusSpan');
                var spanText = $(this).prop('checked') ? 'complete' : 'active';
                $span.text(spanText);
                $span.toggleClass('btnPrimary');
                $span.toggleClass('bgGray');
            });
        });
        // Filter
        $(document).ready(function() {
            $('.search-button').click(function() {
                var selectedCategory = $('#search-category').val();
                $('.category-content').hide();
                $('.' + selectedCategory + '-content').show();
                $('.' + selectedCategory + '-all').show();
            });
        });
        $(document).ready(function() {
            $('.search-buttonPety').click(function() {
                var selectedCategory = $('#search-categoryPety').val();
                $('.petycategory-content').hide();
                $('.' + selectedCategory + '-content').show();
                $('.' + selectedCategory + '-allpety').show();
            });
        });
        // Search Active & Complete
        $(document).ready(function() {
            // $('.search-button').click(function() {
            //     var selectedOption = $("#filterSelect").val();
            $('.filterSelect').change(function() {
                var selectedOption = $(this).val();
                $('.boxCards').hide();
                if (selectedOption === 'active_complete') {
                    $('.boxCards').show();
                } else if (selectedOption === 'active') {
                    $('.boxCards').filter(function() {
                        return $(this).find('.status').text().trim() === 'active';
                    }).show();
                } else if (selectedOption === 'complete') {
                    $('.boxCards').filter(function() {
                        return $(this).find('.status').text().trim() === 'complete';
                    }).show();
                }
            });
        });

        Fancybox.bind("[data-fancybox]", {

        });
    </script>

    {{-- Update CheckBox  --}}
    <script>
        $(document).ready(function() {
            $('.myCheckbox2').change(function() {
                var id = $(this).data('revenue-id');
                $.ajax({
                    url: '/admin/finance/revenues/' + id + '/updateCheckbox',
                    method: 'PUT',

                    data: {
                        _method: 'PUT',
                        _token: "{{ csrf_token() }}",
                        checkbox_field: $(this).is(':checked') ? 1 : 0
                    },
                    success: function(response) {
                    console.log(response.message);
                      },
                    error: function(error) {
                        console.error(error.responseJSON.message);
                    }
                });
            });
        });
    </script>

   {{-- Update CheckBox Status Revenue Basic --}}
   {{-- <script>
    $(document).ready(function() {
        $('.myCheckbox').change(function() {
            var form = $(this).closest('form');
            form.find('#submitButton').click();
        });
    });
</script> --}}

{{-- <script>
    $(document).ready(function() {
        $('.myCheckbox').change(function() {
            var confirmed = confirm('هل انت متاكد ان تم الانتهاء من العقد ؟');
            if (confirmed) {
                var form = $(this).closest('form');
                form.find('#submitButton').click();
            }
        });
    });
</script> --}}
<script>
    $(document).ready(function() {
        $('.myCheckbox').change(function() {
            if (!$(this).is(':checked')) {
                var confirmed = confirm(' ! الغاء اكتمال حاله العقد');
                // alert('الغاء اكتمال حاله العفد');
                if (confirmed) {
                    var form = $(this).closest('form');
                    form.find('#submitButton').click();
                }

            } else {
                var confirmed = confirm('هل انت متاكد ان تم الانتهاء من العقد ؟');
                if (confirmed) {
                    var form = $(this).closest('form');
                    form.find('#submitButton').click();
                }
            }
        });
    });
</script>



@endsection
