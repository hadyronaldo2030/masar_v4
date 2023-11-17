@extends('manger.layout.shardManger')

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
<link href="{{ asset($globalVariable . 'assetsManeger') }}/css/empListManerger.css" rel="stylesheet"">
{{-- <style>
    .activeToggle{
        display: none
    }
</style> --}}
@endsection


@section('content')
    <header>
        <div class="titleSection">
            <h3>Manager</h3>
            <div class="d-flex">
                {{-- @can('isAdmin')     --}}
                <select class="mx-3 btn btnGray" @can('isManager') style="display:none;" @endcan id="contract-type" >
                    <option value="all">All debartment</option>
                    <option value="programming">Programming</option>
                    <option value="marketing">Marketing</option>
                </select>
                {{-- @endcan --}}

                @can('isAdmin')
                <a href="{{ route('manager.marketing.createtasks') }}" class=" btn btnGray" style="margin-right: 5px">Create Task Maketing</a>
                <a href="{{ route('manager.programming.createtasks') }}" class=" btn btnGray">Create Task Programming</a>
                @elseif('isManager' && Auth::user()->department != 'programming')
                <a href="{{ route('manager.marketing.createtasks') }}" class=" btn btnGray" style="margin-right: 5px">Create Task Marketing</a>
                @elseif('isManager' && Auth::user()->department == 'programming')
                <a href="{{ route('manager.programming.createtasks') }}" class=" btn btnGray">Create Task Programming</a>
                @endcan
            </div>
        </div>
        <div class="row">
            <div id="employeToggle" class="col h-100">
                <!-- View Bar -->
                <div class="viewBar mb-3">
                    <div style="margin-left: 0" class="col boxBar department">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="px-2">
                                <h2 class="employeeCount"></h2>
                            </span>
                            <span class="d-flex flex-column w-100">
                                <span>Total Employee</span>
                                <div class="statusBar my-2">
                                    <span class="opacityText">In Debartment</span>
                                    <span class="upArrow text-danger mx-3"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                                </div>
                            </span>

                        </div>
                    </div>
                    <div class="col boxBar department">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="px-2">
                                <h2 class="activeToggle" data-type="all">
                                    @can('isAdmin')
                                     @if ($countProjectNotComploate > 0)
                                    {{ $countProjectNotComploate }}
                                    @else
                                        0
                                     @endif
                                </h2>
                                @elseif ('isManager' && Auth::user()->department == 'programming')
                                <h2 class="activeToggle d-inline-block" data-type="programming">  @if ($countProjectNotComploate2 > 0)
                                    {{ $countProjectNotComploate2  }}
                                    @else
                                        0
                                     @endif
                                </h2>
                                @elseif ('isManager' && Auth::user()->department != 'programming')
                                <h2 class="activeToggle d-inline-block" data-type="marketing" >  @if ($countProjectNotComploate3 > 0)
                                    {{ $countProjectNotComploate3  }}
                                    @else
                                        0
                                     @endif
                                </h2>
                                @endcan

                            </span>
                            <span class="d-flex flex-column w-100">
                                <span>Active projects</span>
                                <div class="statusBar my-2">
                                    <span class="opacityText">For Month</span>
                                    <span class="upArrow text-danger mx-3"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                                </div>
                            </span>

                        </div>
                    </div>
                    <div style="margin-right: 0" class="col boxBar department">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="px-2">
                                <h2 class="taskCount"></h2>
                            </span>
                            <span class="d-flex flex-column w-100">
                                <span>Completed projects</span>
                                <div class="statusBar my-2">
                                    <span class="opacityText">For Month</span>
                                    <span class="upArrow text-danger mx-3"><i class="fa-solid fa-arrow-trend-up fa-rotate-180 fa-2xs"></i></span>
                                </div>
                            </span>

                        </div>
                    </div>

                </div>

                <!-- view heade -->
                <div style="min-height: 80vh;" class="viewBar h-100">
                    <div class="boxHead totalEmp">
                        <div class="d-flex justify-content-between my-2">
                            <span>
                                <h5>List Employee ( <span class="text-info employeeCount"></span> )</h5>
                            </span>
                            <div class="d-flex">
                                <!-- Search Employees -->
                                <div class="d-flex">
                                    <input class="form-control search" type="search" placeholder="Search Name" id="myInput"
                                        onkeyup="myFunction()" title="Type in a name">
                                </div>
                            </div>
                        </div>
                        <table class="table contracts-table">
                            <thead class="thead">
                                <tr class="tr">
                                    <td class="td">ID</td>
                                    <td class="td">Image</td>
                                    <td class="td">Name</td>
                                    <td class="td">Email</td>
                                    <td class="td">Job Title</td>
                                    <td class="td">Mobile</td>
                                    <td class="td">Department</td>
                                </tr>
                            </thead>

                            <tbody class="tbody" id="myUL">
                        @foreach ($employees as $emp )
                                <tr data-type="{{ $emp->department == 'graphics' ? 'marketing' : ($emp->department == 'Marketing' ? 'marketing' : ($emp->department == 'Administrative' ? 'marketing':($emp->department == 'photography' ? 'marketing' : ($emp->department == 'video' ? 'marketing' : ($emp->department == 'sales' ? 'marketing' : 'programming')
                                    )))) }}" class="tr">
                                    <td class="td" scope="row"> {{ $loop->iteration }}</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="{{asset($globalVariable .'images')}}/{{$emp->image}}" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">{{ $emp->name }}</a></th>
                                    <td class="td">{{ $emp->email }}</td>
                                    <td class="td">{{ $emp->jobTitle }}</td>
                                    <td class="td">{{ $emp->mobile }}</td>
                                    <td class="td"><span class="{{ $emp->department == 'graphics' ? 'marketing' : ($emp->department == 'Marketing' ? 'marketing' : ($emp->department == 'Administrative' ? 'marketing':($emp->department == 'photography' ? 'marketing' : ($emp->department == 'video' ? 'marketing' : ($emp->department == 'sales' ? 'marketing' : 'programming')
                                    )))) }}">{{ $emp->department }}</span></td>
                                </tr>
                        @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            {{-- Start Task List --}}
            <div id="projectToggle" class="section1 col">
                <div class="viewBar taskList h-100">
                    <div class="boxHead">
                        <div class="titleSection w-100 justify-content-between">
                        <h5>Project Complete ( <span class="text-info taskCount"></span> )</h5>
                            <div class="d-flex">
                                <input class="form-control search tdToggle d-none" style="margin-right: 10px !important" placeholder="search department"
                                 Department" id="myTask"
                                onkeyup="myTasks()" title="Type in a name">
                                <span class="btnShow text-info">
                                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                                    <i class="fa-solid fa-arrow-right fa-lg d-none"></i>
                                </span>
                            </div>
                        </div>
                        <table class="table text-light contracts-table" id="table2">
                            <thead class="thead">
                                <tr class="tr">
                                    <td class="td">ID</td>
                                    <td class="td">Tm-Image</td>
                                    <td class="td">Project name</td>
                                    <td class="td tdToggle d-none">Created</td>
                                    <td class="td tdToggle d-none">Deadline</td>
                                    <td class="td tdToggle d-none">Debartment</td>
                                    <td class="td">Details</td>
                                </tr>
                            </thead>
                            <tbody class="tbody" id="myULTasks">
                                {{-- Marketing Project Complate --}}
                                @if (!empty($projectComplatet))
                                @foreach ( $projectComplatet as $proCont )
                                <tr data-type="{{ $proCont->department == 'graphics' ? 'marketing' : ($proCont->department == 'Marketing' ? 'marketing' : ($proCont->department == 'Administrative' ? 'marketing':($proCont->department == 'photography' ? 'marketing' : ($proCont->department == 'video' ? 'marketing' : ($proCont->department == 'sales' ? 'marketing' : 'programming')
                                    )))) }}" class="tr">
                                    <td class="td" scope="row">{{ $loop->iteration }}</td>
                                    <td class="td imgEmp fancybox tmImg d-flex">
                                                    @php
                                                        $teamArray = json_decode($proCont->team, true);
                                                        // Assuming that each team member has an 'image' attribute
                                                        $teamMembers = \App\Models\User::whereIn('id', $teamArray)->get();
                                                    @endphp

                                                    @foreach ($teamMembers as $teamMember)
                                                        <a data-fancybox="gallery" href=" {{ asset($globalVariable .'images/' . $teamMember->image) }}" alt="{{ $teamMember->name }}">
                                                            <img src="{{ asset($globalVariable .'images/' . $teamMember->image) }}" alt="{{ $teamMember->name }}" alt="Image #{{ $teamMember->id }}">
                                                        </a>
                                                    @endforeach

                                    </td>
                                    <td class="td">{{ $proCont->project_name }}</td>
                                    <td class="td tdToggle d-none">{{ $proCont->start_date }}</td>
                                    <td class="td tdToggle d-none">{{ $proCont->end_date }}</td>
                                    <th class="td tdToggle d-none"><span class="{{ $proCont->department }}">{{ $proCont->department }}</span></th>
                                    <td class="td">
                                        <button class="btnAccordion employee-btn btnGray" data-employee="{{ $proCont->notesmar }}">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <span>Not Project Marketting</span>
                                @endif


                                {{-- Programming Project Complate --}}
                                @if (!empty($projectComplatet2))
                                @foreach ( $projectComplatet2 as $proCont2 )

                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">{{ $loop->iteration }}</td>
                                    <td class="td imgEmp fancybox tmImg d-flex">
                                        @php
                                            $teamArray = json_decode($proCont2->team, true);
                                            // Assuming that each team member has an 'image' attribute
                                            $teamMembers = \App\Models\User::whereIn('id', $teamArray)->get();
                                        @endphp

                                        @foreach ($teamMembers as $teamMember)
                                            <a data-fancybox="gallery" href=" {{ asset($globalVariable .'images/' . $teamMember->image) }}" alt="{{ $teamMember->name }}">
                                                <img src="{{ asset($globalVariable .'images/' . $teamMember->image) }}" alt="{{ $teamMember->name }}" alt="Image #{{ $teamMember->id }}">
                                            </a>
                                        @endforeach

                                    </td>
                                    <td class="td">{{ $proCont2->project_name }}</td>
                                    <td class="td tdToggle d-none">{{ $proCont2->start_date }}</td>
                                    <td class="td tdToggle d-none">{{ $proCont2->end_date }}</td>
                                    <th class="td tdToggle d-none"><span class="{{ $proCont2->department }}">{{ $proCont2->department }}</span></th>
                                    <td class="td">
                                        <button class="btnAccordion employee-btn btnGray" data-employee="{{ $proCont2->notesmar }}">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <span>Not Project Programming</span>

                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Alert Notes -->
    <div id="notes-container" style="display:none;">
        <div class="navNotes">
            <h5>Project Complete</h5>
            <i id="closeNotes" class="fa-solid fa-angle-down"></i>
        </div>
        <p id="notes"></p>
    </div>
@endsection

@section('scripts')


<script>
    // filter ACTIVE PROJECT
  $(document).ready(function(){
    $('#contract-type').change(function(){
      $('.activeToggle').hide();
      var selectedType = $(this).find(':selected').val();

      if (!selectedType) {
        $('[data-type="project"]').show();
      } else {
        $('[data-type="' + selectedType + '"]').show();
      }
    });

    $('#contract-type').trigger('change');
  });

</script>
<script>




</script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/empListManerger.js"></script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/sharedManeger.js"></script>
@endsection
