@extends('admin.fiances.layouts.shardfiances')

@section('style')
    <link href="{{ asset($globalVariable . 'assets') }}/css/editfinace.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Short Contracts</h3>
            <a href="{{ route('admin.fiances.revenues') }}" class="btn btnPrimary" id="">Back</a>
        </div>
        {{-- Popup Window Editing Basic revenue --}}
        <form class="" tabindex="-1" aria-labelledby="exampleModalLabel" action="{{ route('finance.edit.shortcontractsupdate',$shortContracts->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <div class="modal-content popupWindow">
                    {{-- Nav Popup --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Basic Revenue</h5>
                    </div>

                    <div class="modal-body row">
                        <div class="col-9 mb-3">
                            <div class="input-group mb-4">
                                {{--         ID Revenues       --}}
                                <input type="hidden" name="id" id="id" value="{{ $shortContracts->id }}">

                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                    aria-label="Username" aria-describedby="basic-addon1"  value="{{ $shortContracts->name }}">
                              @error('name') {{ $message }} @enderror

                            </div>

                            <div class="input-group mb-4 justify-content-end">
                                <input type="number" class="form-control" placeholder="Type Value" id="amount" name="amount" value="{{ $shortContracts->amount }}" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                              @error('amount') {{ $message }} @enderror

                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $shortContracts->start_date }}" placeholder="Start"
                                    aria-describedby="addon-wrapping">
                              @error('start_date') {{ $message }} @enderror

                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" placeholder="End" id="due_date" value="{{ $shortContracts->due_date }}" name="due_date"
                                    aria-describedby="addon-wrapping">
                              @error('due_date') {{ $message }} @enderror

                            </div>

                            {{-- Select Type --}}
                            <div class="input-group ">
                                <select class="form-select" id="search-category contract_type" name="contractShort_type"
                                    aria-label="Default select example">
                                    <option selected  disabled>Type </option>
                                    <option value="reservedService" {{ $shortContracts->contractShort_type == 'reservedService' ?  'selected' : '' }}>Reserved Service</option>
                                    <option value="weeklyContracts" {{ $shortContracts->contractShort_type == 'weeklyContracts' ?  'selected' : '' }}>Weekly Contracts</option>
                                    <option value="annualContracts" {{ $shortContracts->contractShort_type == 'annualContracts' ?  'selected' : '' }}>annual Contracts</option>
                                </select>
                              @error('contractShort_type') {{ $message }} @enderror

                            </div>
                        </div>

                          {{-- Upload  --}}
                          <div class="col my-3">  
                            <div class="input-group uploadImg">
                                <span class="minImg">
                                    <label for="file-upload22" class="custom-upload-button">Upload Image</label>
                                    <input type="file" id="file-upload22" name="image1" class="file-upload" multiple >
                                    <img   src="{{ asset($globalVariable . 'images/shortContracts/' . $shortContracts->image1) }}" alt="">
                                    <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                                </span>
                              @error('image1') {{ $message }} @enderror

                            </div>
                            {{-- small Images --}}
                            <div class="boxMinImg" id="editImagesContainer">
                                 @for($i = 1; $i < 10; $i++)
                                    <span class="minImg">
                                        {{-- <img  src="{{ asset($globalVariable . 'images/revenue/' .$shortContracts->image.$i + 1) }}" alt=""> --}}
                                        @if(isset($shortContracts['image'.$i]))
                                        <label  for="file-upload{{ $i+ 22 }}" class="custom-upload-button"><i class="fa-solid fa-plus pos"></i></label>
                                        <input type="file" name="image{{ $i + 1 }}" id="file-upload{{ $i+ 22 }}" class="file-upload images" onchange="previewImage(event, {{ $i - 1 }})">
                                        <img src="{{ asset($globalVariable . 'images/shortContracts/' . $shortContracts['image'.$i+1]) }}" alt="">
                                        @endif
                                        <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                                    </span>
                                @endfor 
                            </div>
                                                    
                        </div>


                        <div class="input-group">
                            <textarea class="form-control" placeholder="Type Notes" id="notes" name="notes" aria-label="With textarea">{{ $shortContracts->notes }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">back</button> --}}
                        <button type="submit" class="btn btnPrimary" id="">Save changes</button>
                    </div>
                </div>
            </div>
        </form>
    </header>
    <!-- End Header -->

@endsection


@section('scripts')
    <script src="{{ asset($globalVariable . 'assets') }}/js/revenues.js"></script>
    <script src="{{ asset($globalVariable . 'assets') }}/js/fancybox.umd.js"></script>
@endsection
