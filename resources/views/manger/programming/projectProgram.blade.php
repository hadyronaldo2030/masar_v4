@extends('manger.layout.shardManger')

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset($globalVariable . 'assetsManeger') }}/css/projects.css" rel="stylesheet"">
@endsection


@section('content')
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>List Project Programming</h3>
            <div class="d-flex">
                <input class="form-control" type="text" id="searchDate" placeholder="Search Created Date">
                <input class="form-control mx-3" type="text" id="searchActive" placeholder="Search Project Active">
                <input class="form-control" type="text" id="searchCompleted" placeholder="Search Project Completed">
            </div>
        </div>
        <div class="timeline">
            <div class="circle black">
                <span>New</span>
            </div>
            <div class="line black-to-orange"></div>
            <div class="circle orange">
                <span class="pb-1">→</span>
            </div>
            <div class="line orange-to-green"></div>
            <div class="circle green">
                <span class="pb-1">→</span>
            </div>
            <div class="line green-to-blue"></div>
            <div class="circle blue">
                <span>&#10004;</span>
            </div>
        </div>

        <div class="boxColumn">
            <div class="row mt-5 w-100 mx-0">
                <div class="col" id="newProjectColumn" data-percentage="0%">
                    <h4 class="my-2">New Project</h4>
                    <div id="newProjectCards"></div>
                </div>
                <div class="col" id="inProgressColumn" data-percentage="10%" style="margin-left:8px ">
                    <h4 class="my-2">In Progress</h4>
                    <div id="inProgressCards"></div>
                </div>
                <div class="col" id="reviewColumn" data-percentage="80%" style="margin: 0 8px ">
                    <h4 class="my-2">Under Review</h4>
                    <div id="reviewCards"></div>
                </div>
                <div class="col" id="completedColumn" data-percentage="100%">
                    <h4 class="my-2">Completed</h4>
                    <div id="completedCards"></div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('scripts')
    <script>
        function createCard(id, project_name, start_date, end_date, team, department, tmLeaderName, tmLeaderImage, notesmar,
            completion_percentage, file_marketing, parentColumn) {
            const card = document.createElement('div');
            card.className = 'card';
            card.setAttribute('draggable', 'true');
            card.id = `card-${Math.random()}`;
            card.addEventListener('dragstart', (event) => {
                event.dataTransfer.setData('text/plain', card.id);
            });

            const progressBar = document.createElement('div');
            progressBar.className = 'progress';

            const progressBarInner = document.createElement('div');
            progressBarInner.className = 'progress-bar';
            progressBarInner.style.width = completion_percentage;
            progressBar.appendChild(progressBarInner);

            const newProgress = getNewColumnId(completion_percentage);
            const newColumn = document.getElementById(newProgress);
            newColumn.appendChild(card);

            card.innerHTML = `
        @can('isAdmin')
            <button class="dropdown-button" onclick="toggleDropdown(this, event)">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        @endcan

        @can('isManager')
        <button class="dropdown-button" onclick="toggleDropdown(this, event)">
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        @endcan

        <div class="dropdown-content" onclick="stopPropagation(event)">
            <div class="d-flex align-items-center justify-content-between  w-100">
                <span class="progress-button">progress</span>
                <select class="progress-dropdown" onchange="changeProgress(this, ${id})">
                    <option value="0%" ${completion_percentage === '0%' ? 'selected' : ''}>0%</option>
                    <option value="10%" ${completion_percentage === '10%' ? 'selected' : ''}>10%</option>
                    <option value="80%" ${completion_percentage === '80%' ? 'selected' : ''}>80%</option>
                    <option value="100%" ${completion_percentage === '100%' ? 'selected' : ''}>100%</option>
                </select>
            </div>
            <input class="form-control createLink" type="text" placeholder="Type Link ...">
            <div class="deleteEdit">
                <form class="delete-button my-2" action="{{ url('/client/manager/programming/Tasks/') }}/${id}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" href="#" class="text-danger" onclick="return confirm('Are you sure you want to delete this Task?')" style="background: none;" >
                        <i class="fas fa-trash mx-2"></i>
                        Delete
                    </button>
                </form>

                <a href="{{ url('/client/manager/programming/editTasks/') }}/${id}" class="edit-button my-2">
                    <i class="fas fa-pen mx-2"></i>
                    Edit
                </a>
            </div>
        </div>
        <h5 class="mb-4 d-flex searchVal"> ${project_name}</h5>
        <div class="d-flex justify-content-between">
            <h6>Details</h6>
            <span class="department">${department}</span>
        </div>
        <p class="show-read-more">${notesmar}</p>
        <label class="searchDate">${start_date}</span></label>
        <label>Deadline : <span>${end_date}</span></label>
        <label>TM-Leader : <span>${tmLeaderName}</span></label>
        <div class="boxTm">
            <label class="mt-1">Team </label>
            <div class="imgTM">
                ${team.map(member => `
                  <div class="personTm">
                      <img src="{{ asset($globalVariable . 'images') }}/${member.image}">
                      <span>${member.name}</span>
                  </div>
              `).join('')}
            </div>
        </div>
        <label class="document d-flex justify-content-between my-3">
            <a href="{{ asset($globalVariable . 'images') }}/manager/marketing/images/${file_marketing}" download="${file_marketing}" class="btn btnGray" target="_blank">
                <i class="fa-solid fa-images"></i>
                materials
            </a>
            <a href="" class="btn btnGray" target="_blank">
                <i class="fa-solid fa-link"></i>
                Link
            </a>
        </label>
        <label class="document mb-3">
            <a href="#" class="btn btnPrimary myTaskLink"  style="display:none; target="_blank">
                <i class="fa-solid fa-link"></i>
                Finsh Task
            </a>
        </label>
    `;

            card.appendChild(progressBar);
            parentColumn.appendChild(card);
        }


        function toggleDropdown(button, event) {
            const dropdownContent = button.nextElementSibling;
            dropdownContent.classList.toggle('show-dropdown');

            // Prevent the event from reaching the body and closing the dropdown
            event.stopPropagation();
        }

        function stopPropagation(event) {
            event.stopPropagation();
        }

        // Close the dropdown when clicking anywhere else on the page
        document.body.addEventListener('click', () => {
            const dropdownContents = document.querySelectorAll('.dropdown-content');
            dropdownContents.forEach(content => {
                content.classList.remove('show-dropdown');
            });
        });

        //   Button Close Options
        function deleteProject(button) {
            const card = button.closest('.card');
            card.parentNode.removeChild(card);
        }

        // Select Card Body

        function changeProgress(select) {
            const card = select.closest('.card');
            const progressValue = select.value;
            const progressBarInner = card.querySelector('.progress-bar');
            progressBarInner.style.width = progressValue;
            if (progressValue === '100%') {
                document.getElementById('completedColumn').appendChild(card);
                card.querySelector('.card-tick').style.display = 'inline-block;';
            } else {
                card.querySelector('.card-tick').style.display = 'none';
                if (progressValue === '80%') {
                    document.getElementById('reviewColumn').appendChild(card);
                } else if (progressValue === '10%') {
                    document.getElementById('inProgressColumn').appendChild(card);
                } else if (progressValue === '0%') {
                    document.getElementById('newProjectColumn').appendChild(card);
                }
            }
        }

        //  Get Id Development stages And Save In Variable
        const columns = [
            document.getElementById('newProjectColumn'),
            document.getElementById('inProgressColumn'),
            document.getElementById('reviewColumn'),
            document.getElementById('completedColumn')
        ];

        columns.forEach((column) => {
            column.addEventListener('dragover', (event) => {
                event.preventDefault();
                column.classList.add('drag-over');
            });

            column.addEventListener('dragenter', (event) => {
                event.preventDefault();
                column.classList.add('drag-over');
            });

            column.addEventListener('dragleave', (event) => {
                event.preventDefault();
                column.classList.remove('drag-over');
            });



            //  Drop And Drag Card

            column.addEventListener('drop', (event) => {
                event.preventDefault();
                column.classList.remove('drag-over');
                const cardId = event.dataTransfer.getData('text/plain');
                const draggedCard = document.getElementById(cardId);
                const progressDropdown = draggedCard.querySelector('.progress-dropdown');
                const newProgress = column.getAttribute('data-percentage');
                progressDropdown.value = newProgress;
                const progressBarInner = draggedCard.querySelector('.progress-bar');
                progressBarInner.style.width = newProgress;

                const cardTick = draggedCard.querySelector('.card-tick');
                if (newProgress === '100%') {
                    document.getElementById('completedColumn').appendChild(draggedCard);
                    cardTick.style.display = 'block';
                } else {
                    cardTick.style.display = 'none';
                    if (newProgress === '80%') {
                        document.getElementById('reviewColumn').appendChild(draggedCard);
                    } else if (newProgress === '10%') {
                        document.getElementById('inProgressColumn').appendChild(draggedCard);
                    } else if (newProgress === '0%') {
                        document.getElementById('newProjectColumn').appendChild(draggedCard);
                    }
                }
            });
        });


        //  Development stages
        const newProjectColumn = document.getElementById('newProjectColumn'); // 0%
        const inProgressColumn = document.getElementById('inProgressColumn'); // 10%
        const reviewColumn = document.getElementById('reviewColumn'); // 80%
        const completedColumn = document.getElementById('completedColumn'); //100%



        //  Get Json Data
        const teamMembersData = @json($teamMembersDataPro);

        teamMembersData.forEach((data) => {
            const newProgress = getNewColumnId(data.completion_percentage);
            createCard(
                data.id,
                data.project_name,
                data.start_date,
                data.end_date,
                data.team,
                data.department,
                data.tmLeaderName,
                data.tmLeaderImage,
                data.notesmar,
                data.completion_percentage,
                data.file_marketing,
                document.getElementById(newProgress)
            );
        });



        function changeProgress(select, projectId) {
            const card = select.closest('.card');
            const progressValue = select.value;
            const progressBarInner = card.querySelector('.progress-bar');
            progressBarInner.style.width = progressValue;

            const newColumnId = getNewColumnId(progressValue); // احصل على معرف العمود الجديد

            // التحقق مما إذا كان هناك تغيير في الموقع
            if (card.parentElement.id !== newColumnId) {
                document.getElementById(newColumnId).appendChild(card);
            }

        }

        function getNewColumnId(newProgress) {
            switch (newProgress) {
                case '100%':
                    return 'completedColumn';
                case '80%':
                    return 'reviewColumn';
                case '10%':
                    return 'inProgressColumn';
                case '0%':
                default:
                    return 'newProjectColumn';
            }
        }



        function changeProgress(select, projectId) {
            const card = select.closest('.card');
            const progressValue = select.value;
            const progressBarInner = card.querySelector('.progress-bar');
            progressBarInner.style.width = progressValue;

            const newColumnId = getNewColumnId(progressValue);

            // نقل البطاقة إلى العمود الجديد
            const newColumn = document.getElementById(newColumnId);
            newColumn.appendChild(card);

            // تحديث هوية البطاقة إلى العمود الجديد
            card.id = `card-${projectId}`;

            // تحديث الهوية في الطلب AJAX
            updateCompletionPercentage(projectId, progressValue);
        }


        function updateCompletionPercentage(projectId, newCompletionPercentage) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: 'POST',
                url: `/update-programming/${projectId}`,
                data: {
                    completion_percentage: newCompletionPercentage,
                    _token: csrfToken
                },
                success: function(response) {
                    console.log('تم تحديث القيمة بنجاح');
                },
                error: function(error) {
                    console.error('حدث خطأ أثناء تحديث القيمة', error);
                }
            });
        }
    </script>

    <script>
        // Read More & Read less
        $(document).ready(function() {
            var maxWords = 20;
            $(".show-read-more").each(function() {
                var text = $(this).text();
                var words = text.split(' ');
                if (words.length > maxWords) {
                    var shortenedText = words.slice(0, maxWords).join(' ');
                    var remainingText = words.slice(maxWords).join(' ');
                    $(this).empty().html(shortenedText + '<span class="more-text">' + remainingText +
                        '</span> <a href="#" class="read-more-link">read more</a>');
                }
            });


            //  Read More
            $(".read-more-link").click(function(e) {
                e.preventDefault();
                var moreText = $(this).prev('.more-text');
                moreText.toggle();
                if (moreText.is(':visible')) {
                    $(this).text('read less');
                } else {
                    $(this).text('read more');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
        $("#searchCompleted").on("input", function () {
        var searchText = $(this).val().toLowerCase();

        $("#completedColumn .card").hide().filter(function () {
            return $(this).find(".searchVal").text().toLowerCase().includes(searchText);
        }).show();
        });
    });
    $(document).ready(function () {
        $("#searchActive").on("input", function () {
        var searchText = $(this).val().toLowerCase();

        $("#newProjectColumn .card, #inProgressColumn .card, #reviewColumn .card").hide().filter(function () {
            return $(this).find(".searchVal").text().toLowerCase().includes(searchText);
        }).show();
        });
    });
    $(document).ready(function () {
        $("#searchDate").on("input", function () {
        var searchText = $(this).val().toLowerCase();

        $(".card").hide().filter(function () {
            return $(this).find(".searchDate").text().toLowerCase().includes(searchText);
        }).show();
        });
    });

      $(document).ready(function() {
          $(".createLink").on('input', function() {
              var inputValue = $(this).val();

              var linkElement = $(this).closest(".card").find(".myTaskLink");

              if (inputValue.trim() !== "") {
                  linkElement.attr("href", inputValue);
                  linkElement.show();
              } else {
                  linkElement.hide();
              }
          });
      });
    </script>
@endsection
