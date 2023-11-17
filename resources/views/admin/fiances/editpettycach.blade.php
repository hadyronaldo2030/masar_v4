@extends('admin.fiances.layouts.shardfiances')

@section('style')
    <link href="{{ asset($globalVariable . 'assets') }}/css/editfinace.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Petty Cach</h3>
            <a href="{{ route('admin.fiances.expenses') }}" class="btn btnPrimary" id="">Back</a>
        </div>
        {{-- Popup Window Editing Basic revenue --}}
        <form class="" tabindex="-1" aria-labelledby="exampleModalLabel" action="{{ route('finance.edit.savePettycash',$pettycashData->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <div class="modal-content popupWindow">
                    {{-- Nav Popup --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Petty Cash</h5>
                    </div>

                    <div class="modal-body row">
                        <div class="col-9 mb-3">
                            <div class="input-group mb-4">
                                {{--         ID Revenues       --}}
                                <input type="hidden" name="id" id="id" value="{{ $pettycashData->id }}">
                            </div>

                            <div class="input-group mb-4 justify-content-end">
                                <input type="number" class="form-control" placeholder="Type Value" id="amount" name="amount" value="{{ $pettycashData->amount }}" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                              @error('amount') {{ $message }} @enderror
                                
                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $pettycashData->start_date }}" placeholder="Start"
                                    aria-describedby="addon-wrapping">
                              @error('start_date') {{ $message }} @enderror

                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" placeholder="End" id="due_date" value="{{ $pettycashData->due_date }}" name="due_date"
                                    aria-describedby="addon-wrapping">
                              @error('due_date') {{ $message }} @enderror

                            </div>

                            {{-- Select Type --}}
                            <div class="input-group ">
                                <select class="form-select" id="search-category contract_type" name="invoicepetty_type" 
                                    aria-label="Default select example">
                                    <option selected  disabled>Type </option>
                                    <option value="Order"  {{ $pettycashData->invoicepetty_type == 'Order' ?  'selected' : '' }}>Order</option>
                                    <option value="Hospitality" {{ $pettycashData->invoicepetty_type == 'Hospitality' ?  'selected' : '' }}>Hospitality</option>
                                    <option value="Reservation" {{ $pettycashData->invoicepetty_type == 'Reservation' ?  'selected' : '' }}>Reservation</option>
                                    <option value="Other" {{ $pettycashData->invoicepetty_type == 'Other' ?  'selected' : '' }}>Other</option>
                                </select>
                              @error('invoicepetty_type') {{ $message }} @enderror

                            </div>
                        </div>

                        {{-- Upload  --}}
                        <div class="col my-3">
                            <div class="input-group uploadImg">
                                <span class="minImg">
                                    <label for="file-upload11" class="custom-upload-button">Upload Image</label>
                                    <input type="file" id="file-upload11" name="image" class="file-upload"  >
                                    <img   src="{{ asset($globalVariable . 'images/pettycash/' . $pettycashData->image) }}" alt="">
                                    <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                                </span>
                              @error('image') {{ $message }} @enderror

                            </div>
                        </div>

                        <div class="input-group">
                            <textarea class="form-control" placeholder="Type Notes" id="notes" name="notes" aria-label="With textarea">{{ $pettycashData->notes }}</textarea>
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
