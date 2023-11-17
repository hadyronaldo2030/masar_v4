@extends('admin.layout.shard')


@section('style')
<link href="{{asset($globalVariable .'assets')}}/css/EmpList.css" rel="stylesheet"">
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


{{-- Message Error Check Day --}}
@if(session('errorDay'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
    <div class="alertStyle" id="alertWrong">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-triangle-exclamation fs-5"></i>
            <span class="mx-2"> {!!session('errorDay')!!} (<span class="countdown">5</span>)</span>
        </div>
    </div>
</div>

@endif

{{-- Message Error Check OnLeave With absent --}}
@if(session('errorOnLeave'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
    <div class="alertStyle" id="alertWrong">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-triangle-exclamation fs-5"></i>
            <span class="mx-2">   {!!session('errorOnLeave')!!} (<span class="countdown">5</span>)</span>
        </div>
    </div>
</div>
@endif

{{-- Message Error Check Check_in With Check_out --}}
@if(session('errorCheckTime'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
    <div class="alertStyle" id="alertWrong">
        <div class="d-flex align-items-center">
            <i class="fa-solid fa-triangle-exclamation fs-5"></i>
            <span class="mx-2">      {!!session('errorCheckTime')!!} (<span class="countdown">5</span>)</span>
        </div>
    </div>
</div>
@endif




		<!-- Start Header -->

			<header>
				<!-- Title Section -->
				<div class="titleSection">
					<h3>Employees</h3>
					<div>
						<a class="btn btnGray" displed href="{{route('admin.hr.empList')}}">Data Show</a>
						<a class="btn btnGray" href="{{route('admin.hr.create')}}">Add Employee</a>
					</div>
				</div>

				<!-- view heade -->
				<div class="viewBar">
					<!-- End popup window  -->
					<div class="boxHead totalEmp">
						<div class="d-flex justify-content-between my-3">
							<span>
								<h5>Employees List Input</h5>
							</span>
							<div class="d-flex">
								<!-- Search Employees -->
								<form class="d-flex">
									<input class="form-control search" type="search" placeholder="Search" id="myInput"
										onkeyup="myFunction()" title="Type in a name">
								</form>
							</div>
						</div>
						<table class="table text-light">
							<thead class="thead">
								<tr class="tr">
									<th class="th" scope="col">ID</th>
									<th class="th" scope="col">Image</th>
									<th class="th" scope="col">Name</th>
									<th class="th" scope="col">Job Title</th>
									<th class="th" scope="col">Department</th>
									<th class="th" scope="col">Day</th>
									<th class="th" scope="col">Check In</th>
									<th class="th" scope="col">Check Out</th>
									<th class="th" scope="col">Holday</th>
									<th class="th" scope="col">Absence</th>
									<th class="th" scope="col">Nots</th>
									<th class="th" scope="col">Rating Day</th>
									<th class="th" scope="col">Send</th>
								</tr>
							</thead>
							<tbody class="tbody" id="myUL">
								@foreach ($employees as $employee)
								<form action="{{ route('admin.hr.dataEntry.store',$employee->id) }}" method="post">
									@csrf
									<tr class="tr" >
                                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
										<td class="td" scope="row" name='employee_id' value=" {{ $employee->id }}"># {{ $employee->id }}</td>
										<td class="td imgEmp"><a class="a" href="{{route('admin.hr.show',$employee->id)}}"><img src="{{asset($globalVariable .'images')}}/{{$employee->image}}" alt=""></a></td>
										<th class="td"><a class="a" href="{{route('admin.hr.show',$employee->id)}}">{{ $employee->name }}</a></th>
										<td class="td">{{ $employee->jobTitle }}</td>
										<td class="td">{{ $employee->department }}</td>
										<td class="td">
											<input type="date" name="day" id="entry_time" class="form-control">
										</td>
										<td class="td">
											<div class="form-group ">
												<input type="time" name="check_in" id="check_in" class="form-control dateInput">
											</div>
										</td>
										<td class="td">
											<div class="form-group ">
												<input type="time" name="check_out" id="check_out" class="form-control dateInput">
											</div>
										</td>
										<td class="td text-center"><input class="checkBox" type="checkbox" name="on_leave"></td>
										<td class="td text-center"><input class="checkBox" type="checkbox" name="absent"></td>
										<td class="td">
										    <div class="input-icon">
												<i class="fa fa-pen xl"></i>
												<input class="inputVal input-field" type="text" name="notes" autocomplete="off"/>
											</div>
										</td>
										<td class="td">
											<select name="rating" class="form-select" aria-label="Default select example">
												<option  value="0" selected>10 / 0</option>
												<option value="1">10 / 1</option>
												<option value="2">10 / 2</option>
												<option value="3">10 / 3</option>
												<option value="4">10 / 4</option>
												<option value="5">10 / 5</option>
												<option value="6">10 / 6</option>
												<option value="7">10 / 7</option>
												<option value="8">10 / 8</option>
												<option value="9">10 / 9</option>
												<option value="10">10 / 10</option>
											</select>
										</td>
										<td class="td">
                                            <div class="form-group">
                                                <button type='submit' id="btnMassage" class="btn btnGray btn-save" disabled>Save</button>
											</div>
										</td>
									</tr>


								</form>
								@endforeach
							</tbody>

						</table>
					</div>

				</div>
			</header>

            <!-- End Header -->

            @endsection

            @yield('errors')


            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="{{asset($globalVariable .'assets')}}/js/empList.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');

    checkInInput.addEventListener('change', function() {
        if (this.value !== "") {
            checkOutInput.removeAttribute('disabled');
        } else {
            checkOutInput.setAttribute('disabled', 'disabled');
        }
    });

    checkOutInput.addEventListener('change', function() {
        if (this.value !== "") {
            checkInInput.removeAttribute('disabled');
        } else {
            checkInInput.setAttribute('disabled', 'disabled');
        }
    });
});
</script>

@section('scripts')

{{-- validation date & button --}}
<script>
    $(document).ready(function() {
            $('.dateInput').change(function() {
                var dateInputValue = $(this).val();
                $(this).closest('tr').find('.btn-save').prop('disabled', !dateInputValue);
            });
            $('.checkBox').change(function() {
                var isChecked = $(this).prop('checked');
                $(this).closest('tr').find('.btn-save').prop('disabled', !isChecked);
            });
        });
</script>
@endsection
