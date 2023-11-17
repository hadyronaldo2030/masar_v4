@extends('admin.fiances.layouts.shardfiances')

@section('style')
<link href="{{asset($globalVariable .'assets')}}/css/fancybox.css" rel="stylesheet">
<link href="{{asset($globalVariable .'assets')}}/css/expenses.css" rel="stylesheet">
@endsection

@section('content')

{{-- Message Success --}}
@if(session('success'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
    <div class="alertStyle" id="alertSuccess">
        <div class="d-flex align-items-center">
            <i class="fa-regular fa-circle-check fs-5"></i>
            <span class="mx-2"> {!!session('success')!!} (<span class="countdown">5</span>)</span>
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
            <span class="mx-2 fs-5"> {!!session('error')!!} (<span class="countdown">5</span>)</span>
        </div>
    </div>
</div>
@endif

<!-- Start Header -->
<header>
    <!-- Title Section -->
    <div class="titleSection">
        <h3>Expenses</h3>
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
                        Basic Expenses
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tabTow-tab" data-bs-toggle="tab" data-bs-target="#tabTow" type="button"
                        role="tab" aria-controls="tabTow" aria-selected="false">
                        Petty cash
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                {{-- Expenses --}}
                <div class="tab-pane fade show active" id="dayInventory" role="tabpanel"
                    aria-labelledby="dayInventory-tab">
                    {{-- <!-- Search --> --}}
                    <div class="d-flex justify-content-between m-3">
                        {{-- filter Month --}}
                        <div class="d-flex">
                            {{-- Date filter --}}
                            <div class="d-flex">
                                <form method="GET" action="{{ route('admin.fiances.expenses') }}">
                                    <button type="submit" class="bg-none icon">
                                        <i class="fa-solid fa-rotate-right"></i>
                                    </button>
                                </form>
                            </div>
                            {{-- Item Search --}}
                            <div class="d-flex">
                                <span style="height: 35px;" class="btn btnPrimary search-button" id="">
                                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                                </span>
                                <select class="form-select" id="search-category" aria-label="Default select example">
                                    <option selected value="show">All Type</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Electricity">Electricity</option>
                                    <option value="Water">Water</option>
                                    <option value="Subscriptions">Subscriptions</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <form class="mx-4" method="GET" action="/filterexpencess">
                                <div class="d-flex">
                                    <button type="submit" class="btnGray">Filter</button>
                                    <!-- {{-- start Date  --}} -->
                                    <div class="inputFilter">
                                        <label class="px-1"> Start Date : </label>
                                        <input type="date" class="form-control" placeholder="start" name="start_date"
                                            aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                    <!-- {{-- End Date  --}} -->
                                    <div class="inputFilter mx-4">
                                        <label class="px-1"> End Date: </label>
                                        <input id="EndDate" type="date" class="form-control" placeholder="End"
                                            name="end_date" aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- Add Card --}}
                        <button class="addItem" data-bs-toggle="modal" data-bs-target="#exampleModalBasic"><i
                                class="fa-solid fa-plus"></i></button>
                    </div>
                    <section class="sectionCard mx-3">
                        @if($expensesData->isEmpty())
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
                        @foreach ( $expensesData as $expenses )

                        <div class="boxCards {{ $expenses->invoice_type }}-content show-all category-content">
                            <div class="front">
                                {{-- Line --}}
                                <span class="line"></span>
                                <span class="line"></span>
                                <div class="contentCard">
                                    {{-- Number Cards --}}
                                    <span
                                        class="numCard rotateCard {{ $expenses->invoice_type }}">{{ $expenses-> id }}</span>
                                    {{-- service Type --}}
                                    <h6 class="rotateCard">{{ $expenses->invoice_type }}</h6>
                                    {{-- Total Cost --}}
                                    <div class="clientCost rotateCard">
                                        <span>Cost : </span>
                                        <div class="d-inline-block">
                                            <span class="cost">{{ $expenses->amount }}</span>
                                            <span class="text-warning">.EGP</span>
                                        </div>
                                    </div>
                                    {{-- Month --}}
                                    <div class="clientName rotateCard">
                                        <span>From :</span>
                                        <span>{{ $expenses->start_date }}</span>
                                    </div>
                                    <div class="clientName rotateCard">
                                        <span>To :</span>
                                        <span>{{ $expenses->due_date }}</span>
                                    </div>
                                    {{-- Gallery --}}
                                    <div class="clientCost gallery">
                                        <span>Gallery : </span>
                                        <div class="d-inline-block">
                                            <span class="cost">
                                                1
                                            </span>
                                            {{-- IconImg --}}
                                            <span class="iconImg mx-2">
                                                @if (!empty($expenses->image))
                                                <a href="{{asset($globalVariable .'images/expenses')}}/{{$expenses->image}}"
                                                    data-fancybox="gallery-{{$expenses->id}}-2"
                                                    data-caption="Imag-{{$expenses->image}}">
                                                    <img style="display: none"
                                                        src="{{asset($globalVariable .'images/expenses')}}/{{$expenses->image}}" />
                                                    <i class="fa-regular fa-image fa-lg"></i>
                                                </a>
                                                @endif
                                            </span>

                                        </div>
                                    </div>
                                    {{-- Action --}}
                                    <div class="d-flex align-items-center">
                                        <form class="delete btn-danger"
                                            action="{{ route('admin.fiances.expenses_delete', $expenses->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-none text-danger" onclick="return confirm('Are you sure you want to delete this {{ $expenses->invoice_type }}?')">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                        <div class="edit btn-success mx-2">
                                            <form action="{{ route('finance.edit.expenses', $expenses->id) }}">
                                                <button class="bg-none text-success">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="back rotateCard {{$expenses->invoice_type}}">
                                {{-- Line --}}
                                <span class="line"></span>
                                <span class="line"></span>
                                <div class="contentCard">
                                    {{-- Number Cards --}}
                                    <span class="numCard {{$expenses->invoice_type}}">{{$expenses->id}}</span>
                                    {{-- service Type --}}
                                    <h6>Details service</h6>
                                    {{-- Notes --}}
                                    <div class="clientName">
                                        <p> {{$expenses->notes}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </section>
                </div>

                <!-- petty Cash -->
                <div class="tab-pane fade" id="tabTow" role="tabpanel" aria-labelledby="tabTow-tab">
                    {{-- <!-- Search --> --}}
                    <div class="d-flex justify-content-between m-3">
                        {{-- Date filter --}}
                        <div class="d-flex">
                            <form method="GET" action="{{ route('admin.fiances.expenses') }}">
                                <button type="submit" class="bg-none icon">
                                    <i class="fa-solid fa-rotate-right"></i>
                                </button>
                            </form>
                            {{-- Item Search --}}
                            <div class="d-flex">
                                <span style="height: 35px;" class="btn btnPrimary search-Type" id="">
                                    <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                                </span>
                                <select class="form-select" id="search-Type" aria-label="Default select example">
                                    <option selected value="show">All Type</option>
                                    <option value="Order">Order</option>
                                    <option value="Hospitality">Hospitality</option>
                                    <option value="Reservation">Reservation</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            {{-- filter Month --}}
                            <form class="mx-4" method="GET" action="/filterpettycash">
                                <div class="d-flex">
                                    <button type="submit" class="btnGray">Filter</button>
                                    <!-- {{-- start Date  --}} -->
                                    <div class="inputFilter">
                                        <label class="px-1"> Start Date : </label>
                                        <input type="date" class="form-control" placeholder="start" name="start_date"
                                            aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                    <!-- {{-- End Date  --}} -->
                                    <div class="inputFilter mx-4">
                                        <label class="px-1"> End Date : </label>
                                        <input id="EndDate" type="date" class="form-control" placeholder="End"
                                            name="end_date" aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- Add Card --}}
                        <button class="addItem" data-bs-toggle="modal" data-bs-target="#examplePetyCash"><i
                                class="fa-solid fa-plus"></i></button>
                    </div>


                    <section class="sectionCard mx-3">
                        @if($pettycashData->isEmpty())
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
                        @foreach ( $pettycashData as $pettycash)
                        <div class="boxCards  {{ $pettycash->invoicepetty_type }}-content show-all type-content">
                            <div class="front">
                                {{-- Line --}}
                                <span class="line"></span>
                                <span class="line"></span>
                                <div class="contentCard">
                                    {{-- Number Cards --}}
                                    <span
                                        class="numCard rotateCard {{ $pettycash->invoicepetty_type }}">{{ $pettycash->id }}</span>
                                    {{-- service Type --}}
                                    <h6 class="rotateCard">{{ $pettycash->invoicepetty_type }}</h6>
                                    {{-- Total Cost --}}
                                    <div class="clientCost rotateCard">
                                        <span>Cost : </span>
                                        <div class="d-inline-block">
                                            <span class="cost">{{ $pettycash->amount }}</span>
                                            <span class="text-warning">.EGP</span>
                                        </div>
                                    </div>
                                    {{-- Month --}}
                                    <div class="clientName rotateCard">
                                        <span>Form :</span>
                                        <span>{{ $pettycash->start_date }}</span>
                                    </div>
                                    <div class="clientName rotateCard">
                                        <span>To :</span>
                                        <span>{{ $pettycash->due_date }}</span>
                                    </div>
                                    {{-- Gallery --}}
                                    <div class="clientCost gallery">
                                        <span>Gallery : </span>
                                        <div class="d-inline-block">
                                            <span class="cost">1</span>
                                            {{-- IconImg --}}
                                            <span class="iconImg mx-2">
                                                @if (!empty($pettycash->image))
                                                <a href="{{asset($globalVariable .'images/pettycash')}}/{{$pettycash->image}}"
                                                    data-fancybox="gallery-{{$pettycash->id}}"
                                                    data-caption="Imag-{{$pettycash->image}}">
                                                    <img style="display: none"
                                                        src="{{asset($globalVariable .'images/pettycash')}}/{{$pettycash->image}}" />
                                                    <i class="fa-regular fa-image fa-lg"></i>
                                                </a>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    {{-- Action --}}
                                    <div class="d-flex align-items-center">
                                        <form class="delete btn-danger"
                                            action="{{ route('admin.fiances.petty_delete', $pettycash->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-none text-danger" onclick="confirm('Are you sure you want to delete this {{ $pettycash->invoicepetty_type }}?')">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                        <div class="edit btn-success mx-2">
                                            <form action="{{ route('finance.edit.pettycash', $pettycash->id) }}">
                                                <button class="bg-none text-success">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="back rotateCard  {{$pettycash->invoicepetty_type}}">
                                {{-- Line --}}
                                <span class="line"></span>
                                <span class="line"></span>
                                <div class="contentCard">
                                    {{-- Number Cards --}}
                                    <span class="numCard {{$pettycash->invoicepetty_type}}">{{$pettycash->id}}</span>
                                    {{-- service Type --}}
                                    <h6>Details service</h6>
                                    {{-- Notes --}}
                                    <div class="clientName">
                                        <p>{{$pettycash->notes}}</p>
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

{{-- Popup Expenses --}}
<form class="modal fade" id="exampleModalBasic" tabindex="-1" aria-labelledby="exampleModalLabel"
    action="{{ route('admin.fiances.expensesSave') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content popupWindow">
            {{-- Nav Popup --}}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Basic Expenses</h5>
                <button type="button" class="btn-close closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body row">
                <div class="col-7 mb-3">
                    <div class="input-group mb-4 justify-content-end">
                        <input type="number" class="form-control" placeholder="Type Value" value="{{ old('amount') }}"
                            name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
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
                        <select class="form-select" id="search-category" name="invoice_type"
                            aria-label="Default select example">
                            <option selected disabled>Type </option>
                            <option value="Gas">Gas</option>
                            <option value="electricity">Electricity</option>
                            <option value="Water">Water</option>
                            <option value="Subscriptions">Subscriptions</option>
                            <option value="Others">Others</option>
                        </select>
                        @error('invoice_type')
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
                            <input type="file" id="file-upload22" name="image" class="file-upload">
                            <img src="" alt="">
                            <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                        </span>
                        @error('image')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="Type Notes" name="notes"
                        aria-label="With textarea"></textarea>
                </div>
                @error('notes')
                <div class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btnPrimary">Save changes</button>
            </div>
        </div>
    </div>
</form>


{{-- Popup Pety Cash --}}
<form class="modal fade" id="examplePetyCash" tabindex="-1" aria-labelledby="exampleModalLabel"
    action="{{ route('admin.fiances.expenses_pettysave') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content popupWindow">
            {{-- Nav Popup --}}
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Pety Cash</h5>
                <button type="button" class="btn-close closepopup" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body row">
                <div class="col-7 mb-3">
                    <div class="input-group mb-4 justify-content-end">
                        <input type="number" class="form-control" placeholder="Type Value" value="{{ old('amount') }}"
                            name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
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
                            aria-describedby="addon-wrapping" value="{{ old('start_date') }}">
                        @error('due_date')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    {{-- Select Type --}}
                    <div class="input-group ">
                        <select class="form-select" id="search-category" name="invoicepetty_type"
                            aria-label="Default select example">
                            <option selected disabled>Type </option>
                            <option value="Order">Order</option>
                            <option value="Hospitality">Hospitality</option>
                            <option value="Reservation">Reservation</option>
                            <option value="Other">Other</option>
                        </select>
                        @error('invoicepetty_type')
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
                            <label for="file-upload11" class="custom-upload-button">Upload Image</label>
                            <input type="file" id="file-upload11" name="image" class="file-upload">
                            <img src="" alt="">
                            <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                        </span>
                        @error('image')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="input-group">
                <textarea class="form-control" placeholder="Type Notes" name="notes"
                    aria-label="With textarea"></textarea>
            </div>
            @error('notes')
            <div class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btnPrimary">Save changes</button>
            </div>
        </div>
    </div>
</form>

@endsection


@section('scripts')
<script src="{{asset($globalVariable .'assets')}}/js/storage.js"></script>
<script src="{{asset($globalVariable .'assets')}}/js/revenues.js"></script>
<script src="{{asset($globalVariable .'assets')}}/js/fancybox.umd.js"></script>
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
// Filter
$(document).ready(function() {
    $('.search-Type').click(function() {
        var selectedCategory = $('#search-Type').val();
        $('.type-content').hide();
        $('.' + selectedCategory + '-content').show();
        $('.' + selectedCategory + '-all').show();
    });
});

Fancybox.bind("[data-fancybox]", {

});
</script>
@endsection
