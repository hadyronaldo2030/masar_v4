@extends('manger.layout.shardManger')

@section('style')
<link href="{{asset($globalVariable .'assetsManeger')}}/css/projects.css" rel="stylesheet"">
@endsection


@section('content')
    <header>
        <!-- Title Section -->
        <div class="titleSection">
            <h3>List Project Marketing</h3>
            <a href="#" class="btn btnGray" id="">Back <i class="fa-solid fa-arrow-right"></i></a>
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
    const projects = [
     { projectName: 'Project 1', startDate: '2023-10-01', endDate: '2023-11-30', progress: '0%', documentLink: 'path_to_pdf_1' },
     { projectName: 'Project 2', startDate: '2023-11-01', endDate: '2023-12-31', progress: '0%', documentLink: 'path_to_pdf_2' },
     { projectName: 'Project 3', startDate: '2023-12-01', endDate: '2024-01-31', progress: '0%', documentLink: 'path_to_pdf_3' }
   ];

   function createCard(projectName, employeeName, startDate, endDate, progress, documentLink, parentColumn) {
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
     progressBarInner.style.width = progress;
     progressBar.appendChild(progressBarInner);

     card.innerHTML = `
       <button class="dropdown-button" onclick="toggleDropdown(this, event)">
           <i class="fa-solid fa-ellipsis-vertical"></i>
       </button>
       <div class="dropdown-content" onclick="stopPropagation(event)">
           <span class="progress-button">progress</span>
           <select class="progress-dropdown" onchange="changeProgress(this)">
               <option value="0%" ${progress === '0%' ? 'selected' : ''}>0%</option>
               <option value="10%" ${progress === '10%' ? 'selected' : ''}>10%</option>
               <option value="80%" ${progress === '80%' ? 'selected' : ''}>80%</option>
               <option value="100%" ${progress === '100%' ? 'selected' : ''}>100%</option>
           </select>
           <div class="deleteEdit">
               <a href="#" class="delete-button" onclick="deleteProject(this)">
                   <i class="fas fa-trash mx-2"></i>
                   Delete
               </a>
               <a href="#" class="edit-button my-2">
                   <i class="fas fa-pen mx-2"></i>
                   Edit
               </a>
           </div>
       </div>

       <h5 class="mb-4 d-flex"><span class="card-tick">✅</span>Project Name: ${projectName}</h5>
       <div class="d-flex justify-content-between">
           <h6>Details</h6>
           <span class="department">Marketing</span>
       </div>
       <p class="show-read-more">Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.Ut auctor velit sed consectetur rhoncus. Nunc dictum facilisis felis nec facilisis.  scelerisque.</p>
       <label>Created : <span>${startDate}</span></label>
       <label>Deadline : <span>${endDate}</span></label>
       <label>TM-Leader : <span>Hady</span></label>
       <div class="boxTm">
           <label class="mt-1">Team </label>
           <div class="imgTM">
               <div class="personTm">
                   <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cGVyc29ufGVufDB8fDB8fHww">
                   <span>Hady</span>
               </div>
               <div class="personTm">
                   <img src="https://img.freepik.com/free-photo/handsome-confident-smiling-man-with-hands-crossed-chest_176420-18743.jpg">
                   <span>Hady</span>
               </div>
               <div class="personTm">
                   <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                   <span>Hady</span>
               </div>
               <div class="personTm">
                   <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1">
                   <span>Hady</span>
               </div>
           </div>
       </div>
       <label class="document my-3">
           <a href="${documentLink}" class="btn btnGray" target="_blank">
                <i class="fa-solid fa-images"></i>
                Download File
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

   function deleteProject(button) {
     const card = button.closest('.card');
     card.parentNode.removeChild(card);
   }

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

   const newProjectColumn = document.getElementById('newProjectColumn');
   const inProgressColumn = document.getElementById('inProgressColumn');
   const reviewColumn = document.getElementById('reviewColumn');
   const completedColumn = document.getElementById('completedColumn');

   createCard('Project 4', 'Employee 4', '2024-02-01', '2024-03-31', '0%', 'path_to_pdf_4', newProjectColumn);
   createCard('Project 5', 'Employee 5', '2024-04-01', '2024-05-31', '0%', 'path_to_pdf_5', newProjectColumn);
   createCard('Project 6', 'Employee 6', '2024-06-01', '2024-07-31', '0%', 'path_to_pdf_6', newProjectColumn);

   // Read More & Read less
   $(document).ready(function(){
   var maxWords = 20;
   $(".show-read-more").each(function(){
       var text = $(this).text();
       var words = text.split(' ');
       if (words.length > maxWords) {
           var shortenedText = words.slice(0, maxWords).join(' ');
           var remainingText = words.slice(maxWords).join(' ');
           $(this).empty().html(shortenedText + '<span class="more-text">' + remainingText + '</span> <a href="#" class="read-more-link">read more</a>');
       }
   });


  //  Read More
   $(".read-more-link").click(function(e){
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
@endsection
