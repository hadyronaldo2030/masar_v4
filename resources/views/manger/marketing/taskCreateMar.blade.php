@extends('manger.layout.shardManger')

@section('style')
<link href="{{asset($globalVariable .'assetsManeger')}}/css/createProject.css" rel="stylesheet"">
@endsection

@section('content')

    {{-- Start Error And Success Alert --}}
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
    {{-- Message Error --}}
    @if(session('error'))
     <div class="alert-container" style="position: absolute; top: 0; left: 50%;">
            <div class="alertStyle" id="alertWrong">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                    <span class="mx-2">{!!session('error')!!} (<span class="countdown">5</span>)</span>
                </div>
            </div>
        </div>
    @endif

    {{-- End Error And Success Alert --}}

    <!-- Start Header -->
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>Create Task Marketing</h3>
            <a href="{{ url('/client/manager/marketing/list-project') }}" class="btn btnGray" id="">Back <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        {{-- Popup Window Editing Basic revenue --}}
        <form class="popupWindow" method="POST" action="{{ route('projects.marketing.store') }}" enctype="multipart/form-data">
             {{-- <form class="popupWindow" id="ajaxForm" action="{{ route('projects.marketing.store') }}" enctype="multipart/form-data"> --}}
			@csrf
            <div class="modal-body row">
                <div class="boxform col-9 mb-3">
                    {{--Project Name  --}}
                    <div class="input-group mb-5">
                        <input class="form-control" type="text" id="username" name="project_name" value="{{ old('project_name') }}" required>
                        <label class="label" for="username">Project Name</label>
                        @error('project_name')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    </div>

                    <div class="d-flex mb-5">
                        <div class="input-group">
                            <input class="form-control text-center" type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                            <label  class="label" for="start_date" >Start Date</label>
                        </div>
                        @error('start_date')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <div class="input-group  ml-4">
                            <input class="form-control text-center" type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                            <label  class="label" for="end_date">End Date</label>
                        </div>
                        @error('end_date')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                         @enderror
                    </div>
                    {{-- Select Type --}}
                    <div class="input-group  mb-5">
                        <select class="form-select"  name="department">
                            <option value="" {{ old('department') == '' ? 'selected' : '' }}>Type Department</option>
                            <option value="marketing" {{ old('department') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="video" {{ old('department') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="graphic" {{ old('department') == 'graphic' ? 'selected' : '' }}>Graphic</option>
                            <option value="administrative" {{ old('department') == 'administrative' ? 'selected' : '' }}>Administrative</option>
                            <option value="photography" {{ old('department') == 'photography' ? 'selected' : '' }}>Photography</option>
                            <option value="sales" {{ old('department') == 'sales' ? 'selected' : '' }}>Sales</option>
                        </select>
                    </div>
                    @error('department')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                     @enderror
                    {{--tm Leader  --}}
                    <div class="input-group mb-5">
                        {{-- <input class="form-control" type="text" id="tmLeader" placeholder="Tm Leader"  required> --}}
						<select id="tmLeader"  class="form-select js-example-tags" name="tmLeader"  style="width: 100%;" required>
                            <option value=" ">Select Team Leader</option>
                            <option value="{{ old('tmLeader') }}">{{ old('tmLeader') }}</option>
						</select>
                    </div>
                    @error('tmLeader')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                     @enderror
                    {{-- Team --}}
                    <div class="input-group">
                        {{-- <input class="form-control" type="text" id="team" placeholder="Team" name="teamleader" required> --}}
						<select id="team"  class="form-select js-example-tags" multiple="multiple" name="team[]"  style="width: 100%;" required>
                            <option value=" ">Select Team Leader</option>
						</select>
                    </div>
                    @error('team[]')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                   @enderror
                </div>

                {{-- Upload  Marketing--}}
                <div class="col mb-5">
                    <div class="input-group uploadImg mb-3">
                        <span class="minImg">
                            <label for="file-upload22" class="custom-upload-button">Upload Img or PDF</label>
                            <input type="file" id="file-upload22"   name="file_marketing"  class="file-upload">
                            <img id="preview-image"  src="" alt="">
                            <div class="delete-button"><i class="fa-solid fa-x fa-sm"></i></div>
                        </span>
                    </div>
                    <div class="input-group">
                        <input class="form-control" type="text" value="" placeholder="Or Add Link">
                    </div>
                </div>
                @error('file_marketing')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
               @enderror

                <div class="input-group">
                    <textarea class="form-control" placeholder="Type Notes" name="notesmar" aria-label="With textarea">{{ old('notesmar') }}</textarea>
                </div>
                @error('notesmar')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
                <div class="input-group my-4">
                    <button type="submit" class="btn btnGray" id="">Save</button>
                </div>
            </div>
        </form>

    </header>
    <!-- End Header -->
@endsection


@section('scripts')
<script src="{{asset($globalVariable .'assetsManeger')}}/js/bootstrap-typeahead.js"></script>
<script src="{{asset($globalVariable .'assetsManeger')}}/js/mention.js"></script>
{{-- Lib Preview --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

{{-- Lib Tag Name --}}
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{asset($globalVariable .'assetsManeger')}}/js/sharedManeger.js"></script>
<script src="{{asset($globalVariable .'assetsManeger')}}/js/createProject.js"></script>


{{-- ================= Start Selet Team And Team Leader  ================= --}}
<script>
    function configureSelect2(elementId, placeholderText) {
        $("#" + elementId).select2({
            tags: true,
            tokenSeparators: [',', ' '],
            ajax: {
                url: '/employees',
                dataType: 'json',
                processResults: function(data) {
                    return {
                        results: $.map(data, function(employee) {
                            return {
                                id: employee.id,
                                text: employee.name,
                                image: employee.image,
                                jobTitle: employee.jobTitle,
                                department: employee.department
                            };
                        })
                    };
                }
            },
            placeholder: placeholderText,
			templateResult: formatResult,
        escapeMarkup: function (markup) { return markup; }
        });
    }
	function formatResult(result) {
    if (!result.id) { return result.text; }

    var $container = $(
        '<div class="select2-result clearfix">' +
        // '<div class="select2-result__image"><img src="' + '{{asset($globalVariable .'images')}}'+ '/' + result.image + '" alt="User Image"></div>' +
		'<div class="select2-result__image"><img class="imgTM" src="{{asset($globalVariable .'images')}}/' + result.image + '" alt="User Image"></div>' +
        '<div class="select2-result__meta">' +
        '<div class="select2-result__title form-control ">' + result.text + '</div>' +
        '<div class="select2-result__title form-control">' + result.jobTitle + '</div>' +
        '<div class="select2-result__title form-control">' + result.department + '</div>' +
        '</div>' +
        '</div>'
    );

    return $container;
}
configureSelect2("yourSelectId", "Select User");
configureSelect2("tmLeader", "Select Team Leader");
configureSelect2("team", "Select Team Work");
</script>
{{-- ================= End Selet Team And Team Leader  ================= --}}


{{-- ================= Start Preview Image Pdf  ================= --}}
<script>
    $(document).ready(function() {
        // عند تغيير الملف
        $('#file-upload22').change(function() {
            var input = this;

            // اذا كان الملف غير فارغ
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // عند اكتمال قراءة الملف
                reader.onload = function(e) {
                    // احصل على امتداد الملف
                    var fileExtension = input.files[0].name.split('.').pop().toLowerCase();

                    // افتراضيًا نعتبر أن الملف هو صورة
                    var isImage = true;

                    // إذا كان الملف PDF، قم بتحديد أنه ليس صورة
                    if (fileExtension === 'pdf') {
                        isImage = false;
                    }

                    // إذا كان الملف صورة، قم بعرض الصورة المحددة
                    if (isImage) {
                        $('#preview-image').attr('src', e.target.result);
                    } else {
                        // إذا كان الملف PDF، قم بعرض الصورة الافتراضية للملفات PDF
                        $('#preview-image').attr('src', '{{ asset('assets/img/pdf.png') }}');
                    }
                };

                // ابدأ في قراءة الملف
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
{{-- ================= End Preview Image Pdf  ================= --}}

{{--Ajax --}}
{{-- <script>
    $(document).ready(function () {
        $('#ajaxForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '{{ route('projects.marketing.store') }}',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    $('.alert-container').show();

                    $('#ajaxForm').trigger("reset");
                },
                error: function (error) {
                    console.log(error);
                    // يمكنك التعامل مع الأخطاء هنا
                }
            });
        });
    });
</script> --}}



{{-- {Validitions Time} --}}
<script>
    // Add event listener to the end date input
    document.getElementById('end_date').addEventListener('input', function () {
        // Get the values of start date and end date
        var startDate = document.getElementById('start_date').value;
        var endDate = this.value;

        // Compare the dates
        if (startDate > endDate) {
            // Display an error message
            this.setCustomValidity('End Date must be equal to or after Start Date.');
        } else {
            // Reset the error message
            this.setCustomValidity('');
        }
    });
</script>



{{-- { Validitions Team Work } --}}
<script>
    // Add event listener to the team leader dropdown
    document.getElementById('tmLeader').addEventListener('input', validateTeamLeader);

    // Add event listener to the team dropdown
    document.getElementById('team').addEventListener('input', validateTeam);

    function validateTeamLeader() {
        // Get the selected value
        var selectedValue = this.value;

        // Check if a valid option is selected
        if (selectedValue === '') {
            // Display an error message
            this.setCustomValidity('Please select a team leader.');
        } else {
            // Reset the error message
            this.setCustomValidity('');
        }
    }

    function validateTeam() {
        // Get the selected values
        var selectedValues = Array.from(this.selectedOptions).map(option => option.value);

        // Check if at least one option is selected
        if (selectedValues.length === 0 || (selectedValues.length === 1 && selectedValues[0] === '')) {
            // Display an error message
            this.setCustomValidity('Please select at least one team member.');
        } else {
            // Reset the error message
            this.setCustomValidity('');
        }
    }
</script>

@endsection
