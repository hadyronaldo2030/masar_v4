@extends('admin.layout.shard')

@section('style')
<link href="{{asset($globalVariable .'assets')}}/css/EmpList.css" rel="stylesheet"">
{{-- Libarary XLSX  --}}

@endsection

@section('content')
    {{-- Message success --}}
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
			<span class="mx-2 fs-5">	{!!session('error')!!} (<span class="countdown">5</span>)</span>
		</div>
	</div>
	</div>
	@endif


        {{-- <!-- Start Header --> --}}

			<header>
				{{-- <!-- Title Section --> --}}
				<div class="titleSection">
					<h3>Employees List</h3>
					<div>
						<a class="btn btnGray" href="{{route('admin.hr.dataEntry')}}">Data Entry</a>
						<a class="btn btnGray" href="{{route('admin.hr.create')}}">Add Employee</a>
					</div>
				</div>

				{{-- <!-- view heade --> --}}
				<div class="viewBar">
					<div class="boxHead totalEmp">
						<div class="d-flex justify-content-between my-3">
							<span>
								<h5>Employees List</h5>
							</span>
							{{-- <!-- Search Employees --> --}}
							<div class="d-flex">
                                <form class="d-flex mx-3">
                                    <input class="form-control search" type="search" placeholder="Search" id="myInput"
                                        onkeyup="myFunction()" title="Type in a name">
                                </form>
                                <span id="exportButton" class="xlsx"></span>
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
									<th class="th" scope="col">Mobile</th>
									<th class="th text-center" scope="col">Rating Day</th>
									<th class="th text-center" scope="col">Status</th>
									<th class="th text-center" scope="col">Action</th>
								</tr>
							</thead>
							<tbody class="tbody" id="myUL">
                            @foreach ($employees as $emp)
								<tr class="tr">
									<!-- ID -->
									<td class="td" scope="row"># {{ $emp->id }}</td>
									<!-- Img -->
									<td class="td imgEmp">
										<a class="a" href="{{route('admin.hr.show',$emp->id)}}">
											<img src="{{asset($globalVariable .'images')}}/{{$emp->image}}"/>
										</a>
									</td>
									<!-- Name -->
									<th><a class="a" href="{{route('admin.hr.show',$emp->id)}}">{{ $emp->name }}</a></th>
									<!-- Job Title -->
									<td class="td"> {{ $emp->jobTitle }}</td>
									<!-- Department -->
									<td class="td"> {{ $emp->department }}</td>
									<!-- Mobile -->
									<td class="td">+20 {{ $emp->mobile }}</td>
									<!-- Rating -->
									<td class="td text-center"> 10 / <span>0</span></td>
									<!-- Status -->
									<td class="td text-center"><span class=" {{$emp->status === 'permanent'? 'fixed':($emp->status === 'trainee'? 'trainig':'temporary')}}" > {{$emp->status}}</span></td>
									<!--Action  -->
									<td class="td text-center">
										<form style="display: initial;, margin-lift:2px;" action="{{ route('admin.hr.destroy', $emp->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
											<button class="delete" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Employee?')"><i class="fa-regular fa-trash-can"></i></button>
                                        </form>
										<a href="{{ route('admin.hr.edit', $emp->id) }}" class="edit"><i class="fa-regular fa-pen-to-square"></i></a>
									</td>
								</tr>
                            @endforeach
							</tbody>
						</table>
					</div>

				</div>
			</header>
        {{-- <!-- End Header --> --}}

@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script src="{{asset($globalVariable .'assets')}}/js/empList.js"></script>
<script>
    //============================== Export Excel Sheet In TAble ==============================

document.getElementById('exportButton').addEventListener('click', function() {
    const table = document.getElementById('myUL');
    const sheetName = 'Employees Data';
    const ws = XLSX.utils.table_to_sheet(table, { sheet: sheetName });
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, sheetName);
    XLSX.writeFile(wb, 'Employees Data.xls');

});

</script>
@endsection
