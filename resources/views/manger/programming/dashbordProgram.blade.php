@extends('manger.layout.shardManger')

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
<link href="{{ asset($globalVariable . 'assetsManeger') }}/css/empListManerger.css" rel="stylesheet"">
@endsection


@section('content')
    <header>
        <div class="titleSection">
            <h3>Manager</h3>
            <div class="d-flex">
                <select class="mx-3 btn btnGray" id="contract-type">
                    <option value="all">All debartment</option>
                    <option value="programming">Programming</option>
                    <option value="marketing">Marketing</option>
                </select>
                <a href="{{ url('/client/taskcreatemarketing') }}" class=" btn btnGray">Create Task</a>
            </div>
        </div>
        <div class="row">
            <div id="employeToggle" class="col h-100">
                <!-- View Bar -->
                <div class="viewBar mb-3">
                    <div style="margin-left: 0" class="col boxBar department">
                        <div class="d-flex justify-content-center align-items-center">
                            <span class="px-2">
                                <h1 class="employeeCount"></h1>
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
                                <h1>0</h1>
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
                                <h1 class="taskCount"></h1>
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
                                    <input class="form-control search" type="search" placeholder="Search" id="myInput"
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
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">mohamed</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hassan</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">osman</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">samy</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="programming">Programming</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp"><a class="a" href="#"><img src="" alt=""></a></td>
                                    <th class="td"><a class="a text-decoration-none" href="#">hady</a></th>
                                    <td class="td">hadyrabie@gmail.com</td>
                                    <td class="td">Programer</td>
                                    <td class="td">01030804922</td>
                                    <td class="td"><span class="marketing">Marketing</span></td>
                                </tr>
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
                            <span class="btnShow text-info">
                                <i class="fa-solid fa-arrow-left fa-lg"></i>
                                <i class="fa-solid fa-arrow-right fa-lg d-none"></i>
                            </span>
                            <h5>Project Complete ( <span class="text-info taskCount"></span> )</h5>
                            <span class=""></span>
                        </div>
                        <table class="table text-light contracts-table" id="table2">
                            <thead class="thead">
                                <tr class="tr">
                                    <td class="td">ID</td>
                                    <td class="td">Tm-Image</td>
                                    <td class="td">Type</td>
                                    <td class="td">Project name</td>
                                    <td class="td tdToggle d-none">Created</td>
                                    <td class="td tdToggle d-none">Deadline</td>
                                    <td class="td tdToggle d-none">Debartment</td>
                                    <td class="td">Details</td>
                                </tr>
                            </thead>
                            <tbody class="tbody" id="myULTasks">
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp fancybox tmImg d-flex">
                                        <a data-fancybox="gallery" href="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"><img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Image 1"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Image 2"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Video"></a>
                                    </td>
                                    <td class="td">video</td>
                                    <td class="td">project 1</td>
                                    <td class="td tdToggle d-none">2023/10/15</td>
                                    <td class="td tdToggle d-none">2023/10/25</td>
                                    <td class="td tdToggle d-none"><span class="programming">Programming</span></td>
                                    <td class="td">
                                        <button class="btnAccordion employee-btn btnGray" data-employee="hassan">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                <tr data-type="marketing" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp fancybox tmImg d-flex">
                                        <a data-fancybox="gallery" href="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"><img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Image 1"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Image 2"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Video"></a>
                                    </td>
                                    <td class="td">website</td>
                                    <td class="td">project 2</td>
                                    <td class="td tdToggle d-none">2023/10/15</td>
                                    <td class="td tdToggle d-none">2023/10/25</td>
                                    <td class="td tdToggle d-none"><span class="marketing">marketing</span></td>
                                    <td class="td">
                                        <button class="btnAccordion employee-btn btnGray" data-employee="mohamed">
                                            Show
                                        </button>
                                    </td>
                                </tr>
                                <tr data-type="programming" class="tr">
                                    <td class="td" scope="row">1</td>
                                    <td class="td imgEmp fancybox tmImg d-flex">
                                        <a data-fancybox="gallery" href="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg"><img src="https://t3.ftcdn.net/jpg/02/43/12/34/360_F_243123463_zTooub557xEWABDLk0jJklDyLSGl2jrr.jpg" alt="Image 1"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Image 2"></a>
                                        <a data-fancybox="gallery" href="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d"><img src="https://c.pxhere.com/photos/be/0e/photo-16530.jpg!d" alt="Video"></a>
                                    </td>
                                    <td class="td">Graphic</td>
                                    <td class="td">project 3</td>
                                    <td class="td tdToggle d-none">2023/10/15</td>
                                    <td class="td tdToggle d-none">2023/10/25</td>
                                    <td class="td tdToggle d-none"><span class="programming">Programming</span></td>
                                    <td class="td">
                                        <button class="btnAccordion employee-btn btnGray" data-employee="hady">
                                            Show
                                        </button>
                                    </td>
                                </tr>

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




    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/empListManerger.js"></script>
    <script src="{{ asset($globalVariable . 'assetsManeger') }}/js/sharedManeger.js"></script>
@endsection
