@extends('admin.hr.dataEntry')

@section('errors')

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
  <div class="alertStyle" id="error404">
      <div class="d-flex align-items-center">
          <i class="fa-solid fa-skull-crossbones fs-5"></i>
          <span class="mx-2 fs-5">	{!!session('error')!!} (<span class="countdown">5</span>)</span>
      </div>
  </div>
</div> 
@endif


{{-- Message Error Check Day --}}
@if(session('errorDay'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
  <div class="alertStyle" id="error404">
      <div class="d-flex align-items-center">
          <i class="fa-solid fa-skull-crossbones fs-5"></i>
          <span class="mx-2 fs-5">	{!!session('errorDay')!!} (<span class="countdown">5</span>)</span>
      </div>
  </div>
</div> 
@endif

{{-- Message Error Check OnLeave With absent --}}
@if(session('errorOnLeave'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
  <div class="alertStyle" id="error404">
      <div class="d-flex align-items-center">
          <i class="fa-solid fa-skull-crossbones fs-5"></i>
          <span class="mx-2 fs-5">	{!!session('errorOnLeave')!!} (<span class="countdown">5</span>)</span>
      </div>
  </div>
</div> 
@endif

{{-- Message Error Check Check_in With Check_out --}}
@if(session('errorCheckTime'))
<div class="alert-container" style="position: absolute; top: 0; left: 50%;">
  <div class="alertStyle" id="error404">
      <div class="d-flex align-items-center">
          <i class="fa-solid fa-skull-crossbones fs-5"></i>
          <span class="mx-2 fs-5">	{!!session('errorCheckTime')!!} (<span class="countdown">5</span>)</span>
      </div>
  </div>
</div> 
@endif


@endsection
