@extends('admin.fiances.layouts.shardfiances')

@section('style')
    <link href="{{ asset($globalVariable . 'assets') }}/css/fancybox.css" rel="stylesheet">
    <link href="{{ asset($globalVariable . 'assets') }}/css/revenues.css" rel="stylesheet">
@endsection

@section('content')
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
                            Petty cash
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
                                {{-- Search Btn --}}
                                <span style="height: 35px;" class="btn btnPrimary search-button" id="">
                                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                                </span>
                                <!-- {{-- Item Search --}} -->
                                <select class="form-select" id="search-category" aria-label="Default select example">
                                    <option selected value="show">Type</option>
                                    <option value="monthlyContracts">Monthly Contracts</option>
                                    <option value="threeMonthContracts">3 Month Contracts</option>
                                    <option value="SemiSecondaryContracts">Semi Secondary Contracts</option>
                                    <option value="SecondaryContracts">Secondary Contracts</option>
                                    <option value="consultation">consultation</option>
                                </select>
                                
                                <!-- {{-- Active Complet Search --}} -->
                                <select class="form-select mx-4 filterSelect" id=""
                                    aria-label="Default select example">
                                    <option selected value="active_complete">Active | complete </option>
                                    <option value="active">active</option>
                                    <option value="complete">complete</option>
                                </select>

                                <!-- {{-- start Date  --}} -->
                                <input type="date" class="form-control" placeholder="start" aria-label="Username" aria-describedby="addon-wrapping">
                                <!-- {{-- End Date  --}} -->
                                <input id="EndDate" type="date" class="form-control mx-4" placeholder="End" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>

                            <!-- {{-- Add Card --}} -->
                            <button class="addItem" data-bs-toggle="modal" data-bs-target="#exampleModalBasic">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        
                        <!-- {{-- Cards basic --}} -->
                        <section class="sectionCard mx-3">
                            @foreach ($revenuesData as $revenue )
                                <div class="boxCards {{ $revenue->contract_type == 'monthlyContracts' ? 'monthlyContracts' : 
                                    ($revenue->contract_type == 'threeMonthContracts' ? 'threeMonthContracts' :
                                     ($revenue->contract_type == 'SemiSecondaryContracts' ? 'SemiSecondaryContracts' : 
                                     ($revenue->contract_type == 'consultation' ? 'consultation' :''))) }}-content show-all category-content">
                                    <div class="front">
                                        <!-- {{-- Line --}} -->
                                        <span class="line"></span>
                                        <span class="line"></span>
                                        <div class="contentCard">
                                            <!-- {{-- Number Cards --}} -->
                                            <span class="numCard rotateCard {{ $revenue->contract_type == 'monthlyContracts' ? 'monthlyContracts' : 
                                            ($revenue->contract_type == 'threeMonthContracts' ? 'threeMonthContracts' :
                                             ($revenue->contract_type == 'SemiSecondaryContracts' ? 'SemiSecondaryContracts' : 
                                             ($revenue->contract_type == 'consultation' ? 'consultation' :''))) }}">{{ $revenue->id }}</span>

                                            <!-- {{-- service Type --}} -->
                                            <h6 class="rotateCard" data-contract_type="{{ $revenue->contract_type}}" > {{ $revenue->contract_type == 'monthlyContracts' ? 'Monthly Contracts' : 
                                                ($revenue->contract_type == 'threeMonthContracts' ? '3 Month Contracts' : 
                                                ($revenue->contract_type == 'SemiSecondaryContracts' ? 'Semi Secondary Contracts' :
                                                ($revenue->contract_type == 'SecondaryContracts' ? 'Secondary Contracts' :
                                                ($revenue->contract_type == 'consultation' ? 'consultation' :'')))) }}
                                            </h6>
                                            <!-- {{-- client Name --}} -->
                                            <div class="clientName rotateCard textgallery">
                                                <span>Name : </span>
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
                                                    <span class="cost">{{ $revenue->images->count() }}</span>
                                                    <!-- {{-- IconImg --}} -->
                                                    <span class="iconImg mx-2">
                                                        @foreach ($revenue->images as $image)
                                                        <a href="{{ asset($globalVariable . '/images/revenue/' . $image->images) }}"
                                                        data-fancybox="gallery-{{ $revenue->id }}" data-caption="Imag-1">
                                                                <img style="display: none"
                                                                    src="{{ asset($globalVariable . '/images/revenue/' . $image->images) }}" />
                                                        @endforeach
                                                                <i class="fa-regular fa-image fa-lg"></i>
                                                            </a>
                                                      </span>
                                                        
                                                </div>
                                            </div>
                                            <!-- {{-- status --}} -->
                                            <div class="rotateCard">
                                                <span>Status :</span>
                                                <span class="status bgGray" id="statusSpan">
                                                   active 
                                                    <span class="togglactive iconActive"></span>
                                                </span>
                                            </div>
                                            <!-- {{-- Action --}} -->
                                            <div class="d-flex align-items-center">
                                                <form class="delete btn-danger" action="{{ route('admin.fiances.destroy', $revenue->id) }}"method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="bg-none text-danger">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                                <div class="edit btn-success mx-2">
                                                        <a class="bg-none text-success" href="{{ route('finance.edit.revenues', $revenue->id) }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                                <!-- {{--Update Status--}} -->
                                                <div class="d-flex align-items-center">
                                                    <input class="myCheckbox" type="checkbox" data-revenue-id="{{ $revenue->id }}" id="revenueCheckbox_{{ $revenue->id }}">
                                                    {{-- <input class="myCheckbox" type="checkbox" data-revenue-id="{{ $revenue->id }}"> --}}
                                                </div>
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
                            
                            
                        </section>
                    </div>

                    {{-- ===================== {{ Start Petty Cach }} ===================== --}}
                    <!-- Pety Cach -->
                    <div class="tab-pane fade" id="tabTow" role="tabpanel" aria-labelledby="tabTow-tab">
                        {{-- <!-- Search --> --}}
                        <div class="d-flex justify-content-between m-3">
                            <div class="d-flex">
                                <span style="height: 35px;" class="btn btnPrimary search-button" id=""><i
                                        class="fa-solid fa-magnifying-glass fa-lg"></i></span>
                                {{-- Item Search --}}
                                <select class="form-select" id="search-category" aria-label="Default select example">
                                    <option selected value="show">Type</option>
                                    <option value="reservedService">Reserved Service</option>
                                    <option value="weeklyContracts">Weekly Contracts</option>
                                    <option value="consultation">Consultation</option>
                                </select>
                                {{-- Active Complet Search --}}
                                <select class="form-select filterSelect mx-4" id=""
                                    aria-label="Default select example">
                                    <option selected value="active_complete">Active | complete </option>
                                    <option value="active">active</option>
                                    <option value="complete">complete</option>
                                </select>
                                {{-- Date filter --}}
                                <input type="date" class="form-control" placeholder="Birthday" aria-label="Username"
                                    aria-describedby="addon-wrapping">
                            </div>
                            {{-- Add Card --}}
                            <button class="addItem" data-bs-toggle="modal" data-bs-target="#exampleModalPety"><i
                                    class="fa-solid fa-plus"></i></button>
                        </div>
                        {{-- Cards pety cach --}}
                        <section class="sectionCard mx-3">
                            <div class="boxCards reservedService-content show-all category-content">
                                <div class="front">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard rotateCard reservedService">1</span>
                                        {{-- service Type --}}
                                        <h6 class="rotateCard">Reserved service</h6>
                                        {{-- client Name --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>Name :</span>
                                            <span>Hady Rabie</span>
                                        </div>
                                        <!-- {{-- client ID --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>ID :</span>
                                            <span class="fw-bolder">#<span>1</span></span>
                                        </div>
                                        {{-- Total Cost --}}
                                        <div class="clientCost rotateCard textgallery">
                                            <span>Cost : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">100</span>
                                                <span class="text-warning">.EGP</span>
                                            </div>
                                        </div>
                                        {{-- Start date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>From :</span>
                                            <span>11/8/2022</span>
                                        </div>
                                        {{-- End date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>To :</span>
                                            <span>2/9/2022</span>
                                        </div>

                                        {{-- Gallery --}}
                                        <div class="clientCost gallery textgallery">
                                            <span>Gallery : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">10</span>
                                                {{-- IconImg --}}
                                                <span class="iconImg mx-2">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="Imag-1">
                                                        <img style="display: none"
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                        <i class="fa-regular fa-image fa-lg"></i>
                                                    </a>
                                                </span>
                                                <div style="display: none">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-2">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-3">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                </div>
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
                                            <form class="delete btn-danger" action="">
                                                <button class="bg-none text-danger">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                            <div class="edit btn-success mx-2">
                                                <a class="bg-none text-success" href="{{ route('finance.edit.pettycachRevenues', $revenue->id) }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
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
                                        <span class="numCard reservedService">1</span>
                                        {{-- service Type --}}
                                        <h4>Details service</h4>
                                        {{-- Notes --}}
                                        <div class="clientName">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, cumque.
                                                Accusantium praesentium facilis, autem amet tenetur esse qui, ducimus nisi
                                                consequuntur ratione, in illo odio dicta saepe pariatur reiciendis
                                                laboriosam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="boxCards weeklyContracts-content show-all category-content">
                                <div class="front">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard rotateCard weeklyContracts">1</span>
                                        {{-- service Type --}}
                                        <h6 class="rotateCard">Weekly Contracts</h6>
                                        {{-- client Name --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>Name :</span>
                                            <span>Hady Rabie</span>
                                        </div>
                                        <!-- {{-- client ID --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>ID :</span>
                                            <span class="fw-bolder">#<span>1</span></span>
                                        </div>
                                        {{-- Total Cost --}}
                                        <div class="clientCost rotateCard textgallery">
                                            <span>Cost : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">100</span>
                                                <span class="text-warning">.EGP</span>
                                            </div>
                                        </div>
                                        {{-- Start date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>From :</span>
                                            <span>11/8/2022</span>
                                        </div>
                                        {{-- End date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>To :</span>
                                            <span>2/9/2022</span>
                                        </div>

                                        {{-- Gallery --}}
                                        <div class="clientCost gallery textgallery">
                                            <span>Gallery : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">10</span>
                                                {{-- IconImg --}}
                                                <span class="iconImg mx-2">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="Imag-1">
                                                        <img style="display: none"
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                        <i class="fa-regular fa-image fa-lg"></i>
                                                    </a>
                                                </span>
                                                <div style="display: none">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-2">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-3">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- status --}}
                                        <div class=" rotateCard">
                                            <span>Status :</span>
                                            <span class="status bgGray" id="statusSpan">
                                                active
                                                <span class="togglactive iconActive"></span>
                                            </span>
                                        </div>
                                        {{-- Action --}}
                                        <div class="d-flex align-items-center">
                                            <div class="delete btn-danger">
                                                <button class="bg-none text-danger">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                            <div class="edit btn-success mx-2">
                                                <button class="bg-none text-success " href="{{ route('finance.edit.pettycachRevenues', $revenue->id) }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                            </div>
                                            {{--               Update Status                  --}}
                                            <form class="d-flex align-items-center">
                                                <input type="checkbox" class="myCheckbox">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="back rotateCard weeklyContracts">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard weeklyContracts">1</span>
                                        {{-- service Type --}}
                                        <h4>Details service</h4>
                                        <div class="clientName">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, cumque.
                                                Accusantium praesentium facilis, autem amet tenetur esse qui, ducimus nisi
                                                consequuntur ratione, in illo odio dicta saepe pariatur reiciendis
                                                laboriosam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="boxCards consultation-content show-all category-content">
                                <div class="front ">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard rotateCard consultation">2</span>
                                        {{-- service Type --}}
                                        <h6 class="rotateCard">Consultation</h6>
                                        {{-- client Name --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>Name :</span>
                                            <span>Hady Rabie</span>
                                        </div>
                                        <!-- {{-- client ID --}} -->
                                        <div class="clientName rotateCard textgallery">
                                            <span>ID :</span>
                                            <span class="fw-bolder">#<span>1</span></span>
                                        </div>
                                        {{-- Total Cost --}}
                                        <div class="clientCost rotateCard textgallery">
                                            <span>Cost : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">100</span>
                                                <span class="text-warning">.EGP</span>
                                            </div>
                                        </div>
                                        {{-- Start date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>From :</span>
                                            <span>11/8/2022</span>
                                        </div>
                                        {{-- End date --}}
                                        <div class="clientName rotateCard textgallery">
                                            <span>To :</span>
                                            <span>2/9/2022</span>
                                        </div>

                                        {{-- Gallery --}}
                                        <div class="clientCost gallery textgallery">
                                            <span>Gallery : </span>
                                            <div class="d-inline-block">
                                                <span class="cost">10</span>
                                                {{-- IconImg --}}
                                                <span class="iconImg mx-2">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="Imag-1">
                                                        <img style="display: none"
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                        <i class="fa-regular fa-image fa-lg"></i>
                                                    </a>
                                                </span>
                                                <div style="display: none">
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-2">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                    <a href="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}"
                                                        data-fancybox="gallery" data-caption="imag-3">
                                                        <img
                                                            src="{{ asset($globalVariable . 'assets/img/Egyption_ID.jpg') }}" />
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        {{-- status --}}
                                        <div class="rotateCard ">
                                            <span>Status :</span>
                                            <span class="status bgGray" id="statusSpan">
                                                active
                                                <span class="togglactive iconActive"></span>
                                            </span>
                                        </div>
                                        {{-- Action --}}
                                        <div class="d-flex align-items-center">
                                            <div class="delete btn-danger">
                                                <button class="bg-none text-danger">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </div>
                                            <div class="edit btn-success mx-2">
                                                <a class="bg-none text-success" href="{{ route('finance.edit.pettycachRevenues') }}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                            <form class="d-flex align-items-center">
                                                <input type="checkbox" class="myCheckbox">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="back rotateCard consultation">
                                    {{-- Line --}}
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <div class="contentCard">
                                        {{-- Number Cards --}}
                                        <span class="numCard consultation">2</span>
                                        {{-- service Type --}}
                                        <h4>Details service</h4>
                                        <div class="clientName">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, cumque.
                                                Accusantium praesentium facilis, autem amet tenetur esse qui, ducimus nisi
                                                consequuntur ratione, in illo odio dicta saepe pariatur reiciendis
                                                laboriosam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                    {{-- ===================== {{ End Petty Cach }} ===================== --}}

                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->


{{-- ===============================================Start Modal Create========================================================= --}}
    {{-- Popup Window Basic revenue --}}
    <form class="modal fade" id="exampleModalBasic" tabindex="-1" aria-labelledby="exampleModalLabel"
        action="{{ url('/admin/finance/revenues') }}" method="POST" enctype="multipart/form-data">
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
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-4 justify-content-end">
                            <input type="number" class="form-control" placeholder="Type Value" name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="Start" name="start_date"
                                aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="End" name="due_date"
                                aria-describedby="addon-wrapping">
                        </div>

                        {{-- Select Type --}}
                        <div class="input-group ">
                            <select class="form-select" id="search-category" name="contract_type"
                                aria-label="Default select example">
                                <option selected disabled>Type </option>
                                <option value="monthlyContracts">Monthly Contracts</option>
                                <option value="threeMonthContracts">3 Month Contracts</option>
                                <option value="SemiSecondaryContracts">Semi Secondary Contracts</option>
                                <option value="SecondaryContracts">Secondary Contracts</option>
                                <option value="consultation">consultation</option>
                            </select>
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
                        </div>
                        {{-- small Images --}}
                        <div class="boxMinImg">
                            <!-- Card 1 -->
                            <span class="minImg">
                                <label for="file-upload1" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image2" id="file-upload1" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 2 -->
                            <span class="minImg">
                                <label for="file-upload2" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image3" id="file-upload2" class="file-upload" onchange="previewImage(event, 2)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 3 -->
                            <span class="minImg">
                                <label for="file-upload3" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image4" id="file-upload3" class="file-upload" onchange="previewImage(event, 3)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 4 -->
                            <span class="minImg">
                                <label for="file-upload4" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image5" id="file-upload4" class="file-upload" onchange="previewImage(event, 4)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 5 -->
                            <span class="minImg">
                                <label for="file-upload5" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image6" id="file-upload5" class="file-upload" onchange="previewImage(event, 5)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 6 -->
                            <span class="minImg">
                                <label for="file-upload6" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image7" id="file-upload6" class="file-upload" onchange="previewImage(event, 6)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 7 -->
                            <span class="minImg">
                                <label for="file-upload7" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image8" id="file-upload7" class="file-upload" onchange="previewImage(event, 7)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 8 -->
                            <span class="minImg">
                                <label for="file-upload8" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image9" id="file-upload8" class="file-upload" onchange="previewImage(event, 8)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 9 -->
                            <span class="minImg">
                                <label for="file-upload9" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image10" id="file-upload9" class="file-upload" onchange="previewImage(event, 9)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 10 -->
                            {{-- <span class="minImg">
                                <label for="file-upload10" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" name="image" id="file-upload10" class="file-upload" onchange="previewImage(event, 10)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span> --}}
                        </div>
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Type Notes" name="notes" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btnPrimary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
{{-- ===============================================End Modal Create========================================================= --}}

{{-- ====================================================== Start Pety Cash================================================================ --}}
    {{-- Popup Window pety cach --}}
    <form class="modal fade" id="exampleModalPety" tabindex="-1" aria-labelledby="exampleModalLabel"
        action="{{ url('/admin/finance/revenues') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content popupWindow">
                {{-- Nav Popup --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Pety Cach</h5>
                    <button type="button" class="btn-close closepopup" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body row">
                    <div class="col-7 mb-3">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" placeholder="Name" name="name"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-4 justify-content-end">
                            <input type="number" class="form-control" placeholder="Type Value" name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                            <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="Start" name="start_date"
                                aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" placeholder="End" name="due_date"
                                aria-describedby="addon-wrapping">
                        </div>

                        {{-- Select Type --}}
                        <div class="input-group ">
                            <select class="form-select" id="search-category " name="contract_type"
                                aria-label="Default select example">
                                <option selected disabled>Type </option>
                                <option value="reservedService">Reserved Service</option>
                                <option value="weeklyContracts">Weekly Contracts</option>
                                <option value="consultation">Three</option>
                            </select>
                        </div>
                    </div>
                    {{-- Upload  --}}
                    <div class="col mb-3">
                        <div class="input-group uploadImg">
                            <span class="minImg">
                                <label for="file-upload22" class="custom-upload-button">Upload Image</label>
                                <input type="file" id="file-upload22" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                        </div>
                        {{-- small Images --}}
                        <div class="boxMinImg">
                            <!-- Card 1 -->
                            <span class="minImg">
                                <label for="file-upload23" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload23" class="file-upload">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 2 -->
                            <span class="minImg">
                                <label for="file-upload24" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload24" class="file-upload" onchange="previewImage(event, 2)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 3 -->
                            <span class="minImg">
                                <label for="file-upload25" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload25" class="file-upload" onchange="previewImage(event, 3)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 4 -->
                            <span class="minImg">
                                <label for="file-upload26" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload26" class="file-upload" onchange="previewImage(event, 4)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 5 -->
                            <span class="minImg">
                                <label for="file-upload27" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload27" class="file-upload" onchange="previewImage(event, 5)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 6 -->
                            <span class="minImg">
                                <label for="file-upload28" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload28" class="file-upload" onchange="previewImage(event, 6)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 7 -->
                            <span class="minImg">
                                <label for="file-upload29" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload29" class="file-upload" onchange="previewImage(event, 7)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 8 -->
                            <span class="minImg">
                                <label for="file-upload30" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload30" class="file-upload" onchange="previewImage(event, 8)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 9 -->
                            <span class="minImg">
                                <label for="file-upload31" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload31" class="file-upload" onchange="previewImage(event, 9)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>

                            <!-- Card 10 -->
                            <span class="minImg">
                                <label for="file-upload32" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                <input type="file" id="file-upload32" class="file-upload" onchange="previewImage(event, 10)">
                                <img src="" alt="">
                                <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                            </span>
                        </div>
                    </div>
                    <div class="input-group">
                        <textarea class="form-control" placeholder="Type Notes" name="notes" aria-label="With textarea"></textarea>
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
    {{--   Pass Data In Model Edit   --}}
    <script>
        $('#exampleModalBasicEdit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var amount = button.data('amount')
            var contract_type = button.data('contract_type')
            var start_date = button.data('start_date')
            var due_date = button.data('due_date')
            var notes = button.data('notes')
            var images = button.data('images')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #amount').val(amount);
            modal.find('.modal-body #contract_type').val(contract_type);
            modal.find('.modal-body #start_date').val(start_date);
            modal.find('.modal-body #due_date').val(due_date);
            modal.find('.modal-body #notes').val(notes);
            // modal.find('.modal-body #images').val(images);

            modal.find('.modal-body #images').val(images);

                
            if (images && images.length > 0) {
                var imagesInput = modal.find('.modal-body #images');
                imagesInput.closest('.form-group').append('<div id="existingImages"></div>');
                var existingImagesDiv = modal.find('.modal-body #existingImages');

                $.each(images, function(index, image) {
                    existingImagesDiv.append('<input type="hidden" name="images[]" value="' + image + '">');
                });

            //     var imagesInput = modal.find('.modal-body #images');
            //     imagesInput.closest('.form-group').append('<div id="existingImages"></div>');
            //     var existingImagesDiv = modal.find('.modal-body #existingImages');

            //     $.each(images, function(index, image) {
            //         existingImagesDiv.append('<input type="hidden" name="images[]" value="' + image + '">');
            //     });

            //     // تحميل الصورة الرئيسية
            //     var imgsrc = images[0]; // يتوقف هذا على كيفية تنظيم بيانات الصور
            //     $('#my_image').attr('src', imgsrc);

            // }
        })
    </script>

// {{-- Check Complete --}}
<script>
    $(document).ready(function() {
        $('#statusUpdate').change(function() {
            var isChecked = $(this).prop('checked');
            var revenueId = $(this).data('revenue-id'); 

            $.ajax({
                url: '/update_status',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    revenue_id: revenueId,
                    status: isChecked ? 1 : 0
                },
                success: function(response) {
                    console.log('تم التحديث بنجاح');
                },
                error: function(error) {
                    console.log('حدث خطأ أثناء التحديث');
                }
            });
        });
    });
</script>

<script>
    $(document).querySelectorAll('.myCheckbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var revenueId = this.getAttribute('data-revenue-id');
        var isChecked = this.checked ? 1 : 0;

        // إرسال البيانات باستخدام AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/update_revenue_status', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // تم التحديث بنجاح
            } else {
                // حدث خطأ
            }
        };
        xhr.onerror = function() {
            // حدث خطأ
        };
        xhr.send('revenue_id=' + revenueId + '&status=' + isChecked);
    });
});
$(document).ready(function() {
    $('.file-upload').change(function() {
        var file = this.files[0];
        var reader = new FileReader();
        var minImg = $(this).closest('.minImg');

        reader.onload = function() {
            var img = minImg.find('img');
            img.attr('src', reader.result);
            img.css('display', 'block');
            minImg.find('.delete-button').css('display', 'flex');
        };

        reader.readAsDataURL(file);
    });

    $('.delete-button').click(function() {
        var minImg = $(this).closest('.minImg');
        var img = minImg.find('img');
        img.attr('src', '');
        img.css('display', 'none');
        var input = minImg.find('.file-upload');
        input.val('');
        $(this).css('display', 'none');
    });
    });
</script>

@endsection
