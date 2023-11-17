@extends('admin.fiances.layouts.shardfiances')

@section('style')
    <link href="{{ asset($globalVariable . 'assets') }}/css/editfinace.css" rel="stylesheet">

@endsection

@section('content')
    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Edit Reveneus</h3>
            <a href="{{ route('admin.fiances.revenues') }}" class="btn btnPrimary" id="">Back</a>
        </div>
        {{-- Popup Window Editing Basic revenue --}}
        <form  tabindex="-1" aria-labelledby="exampleModalLabel" action="{{ route('finance.edit.revenuesupdate',$revenuesBasic->id) }}" method="post" enctype="multipart/form-data">
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
                                <input type="hidden" name="id" value="{{ $revenuesBasic->id }}">

                                <input type="text" class="form-control" name="name" id="name" value="{{ $revenuesBasic->name }}" placeholder="Name"
                                    aria-label="Username" aria-describedby="basic-addon1">
                              @error('name') {{ $message }} @enderror

                            </div>

                            <div class="input-group mb-4 justify-content-end">
                                <input type="number" class="form-control" placeholder="Type Value" value="{{ $revenuesBasic->amount }}" id="amount" name="amount" step="any" aria-label="Dollar amount (with dot and two decimal places)">
                                <span class="text-warning position-absolute my-1 mx-2">EGP</span>
                              @error('amount') {{ $message }} @enderror

                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" id="start_date" value="{{ $revenuesBasic->start_date }}" name="start_date" placeholder="Start"
                                    aria-describedby="addon-wrapping">
                              @error('start_date') {{ $message }} @enderror

                            </div>
                            <div class="input-group mb-4">
                                <input type="date" class="form-control" placeholder="End" id="due_date" value="{{ $revenuesBasic->due_date }}" name="due_date"
                                    aria-describedby="addon-wrapping">
                              @error('due_date') {{ $message }} @enderror

                            </div>
                            {{-- Select Type --}}
                            <div class="input-group ">
                                <select class="form-select" id="search-category contract_type" name="contract_type"
                                    aria-label="Default select example">
                                    <option value="monthlyContracts" {{ $revenuesBasic->contract_type == 'monthlyContracts' ?  'selected' : '' }}>Monthly Contracts</option>
                                    <option value="threeMonthContracts" {{ $revenuesBasic->contract_type == 'threeMonthContracts' ?  'selected' : '' }}>3 Month Contracts</option>
                                    <option value="SemiSecondaryContracts" {{ $revenuesBasic->contract_type == 'SemiSecondaryContracts' ?  'selected' : '' }}>Semi Secondary Contracts</option>
                                    <option value="SecondaryContracts" {{ $revenuesBasic->contract_type == 'SecondaryContracts' ?  'selected' : '' }}>Secondary Contracts</option>
                                    <option value="consultation" {{ $revenuesBasic->contract_type == 'consultation' ?  'selected' : '' }}>consultation</option>
                                </select>
                              @error('contract_type') {{ $message }} @enderror

                            </div>
                        </div>

                        {{-- Upload  --}}
                        <div class="col my-3">
                            <div class="input-group uploadImg">
                                <span class="minImg">
                                    <label for="file-upload11" class="custom-upload-button">Upload Image</label>
                                    <img src="{{ asset($globalVariable . 'images/revenue/' . $revenuesBasic->image1) }}" alt="">
                                    <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                                    <input type="file" id="file-upload11" name="image1" class="file-upload"  >
                                </span>
                              @error('image1') {{ $message }} @enderror

                            </div>
                            {{-- small Images --}}
                            <div class="boxMinImg" id="editImagesContainer">
                                 @for($i = 1; $i < 10; $i++)
                                    <span class="minImg">
                                        @if(isset($revenuesBasic['image'.$i]))
                                        <label for="file-upload{{ $i+ 12 }}" class="custom-upload-button">
                                            <i class="fa-solid fa-plus pos"></i>
                                        </label>
                                        <input type="file" name="image{{ $i + 1 }}" id="file-upload{{ $i+ 12 }}" class="file-upload images" onchange="previewImage(event, {{ $i - 1 }})">
                                        <img src="{{  asset($globalVariable . 'images/revenue/' . $revenuesBasic['image'.$i+1]) }} " alt="">
                                        @endif
                                        <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                                    </span>
                                @endfor
                            </div>

                        </div>


                        <div class="input-group">
                            <textarea class="form-control" placeholder="Type Notes" id="notes"  name="notes" aria-label="With textarea">{{ $revenuesBasic->notes }}</textarea>
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
    <script>
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
