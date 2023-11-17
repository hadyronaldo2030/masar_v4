
// ======================= Alert Notes =============================
$(document).ready(function() {
  var timeoutId;

  $('.employee-btn').on('click', function() {
    var employeeName = $(this).data('employee');
    var notes = getEmployeeNotes(employeeName);
    $('#notes').text(notes);
    $('#notes-container').fadeIn();

    clearTimeout(timeoutId);
    timeoutId = setTimeout(function() {
      $('#notes-container').fadeOut();
    }, 8000);
  });

  $('#closeNotes').on('click', function() {
    clearTimeout(timeoutId);
    $('#notes-container').fadeOut();
  });

  $('#notes-container').on('mouseenter', function() {
    clearTimeout(timeoutId);
  });

  $('#notes-container').on('mouseleave', function() {
    timeoutId = setTimeout(function() {
      $('#notes-container').fadeOut();
    }, 8000);
  });
});

function getEmployeeNotes(employeeName) {
  return '' + employeeName;
};
// ======================= Birth day = Age =============================
$(document).ready(function() {
    function calculateAge() {
      var birthdate = new Date($("#birthdate").val());
      var currentDate = new Date();
      var age = currentDate.getFullYear() - birthdate.getFullYear();

      if (currentDate.getMonth() < birthdate.getMonth() || (currentDate.getMonth() === birthdate.getMonth() && currentDate.getDate() < birthdate.getDate())) {
        age--;
      }

      $("#ageSpan").text(age + " Year");
    }
    calculateAge();

    $("#birthdate").change(function() {
      calculateAge();
    });
  });
//============================== enter Notes Massage  ==============================

$(document).ready(function() {
	var clickedInput = null;

	$('.inputVal').on('click', function() {
	  clickedInput = $(this);
	  var popupWindow = window.open('', 'Popup Window', 'width=400,height=200');
	  var content = `
	  <div class="container py-3">
		  <textarea id="popupTextarea" class="form-control"></textarea>
		  <button id="sendButton" class="btn btn-primary mt-3">إرسال</button>
	  </div>
	  `;
	  popupWindow.document.body.innerHTML = content;

	  var sendButton = $(popupWindow.document).find('#sendButton');
	  sendButton.on('click', function() {
		var textareaValue = $(popupWindow.document).find('#popupTextarea').val();
		clickedInput.val(textareaValue);
		popupWindow.close();
	  });
	});
  });
// ================== Month Evaluation ========================
// Add click event to buttons
$(".btnAccordion").on("click", function() {
  var panel = $(this).next();
  // Toggle display
  panel.slideToggle();
});
$(".closeNotes").on("click", function() {
    var panel = $(this).next();
    // Toggle display
    panel.slideToggle();
  });



// ======================= Upload Img =============================

// ID 1
$(document).ready(function() {
    // عند النقر على زر تعديل الصورة، يتم فتح نافذة اختيار الصورة من المعرض
    $('#editBtn').click(function() {
      $('#newImage').click();
    });

    // عند تحميل الصورة الجديدة، يتم تحديث الصورة في الصفحة وإظهار زر حفظ التعديلات
    $('#newImage').on('input', function() {
      var reader = new FileReader();
      reader.onload = function(event) {
        var newImageSrc = event.target.result;
        $('#myImage').attr('src', newImageSrc);
        $('.saveBtn').show(); // إظهار زر حفظ التعديلات
      };
      reader.readAsDataURL(this.files[0]);
    });

  });

  // ID 2
  $(document).ready(function() {
    // عند النقر على زر تعديل الصورة، يتم فتح نافذة اختيار الصورة من المعرض
    $('#editBtn2').click(function() {
      $('#newImage2').click();
    });

    // عند تحميل الصورة الجديدة، يتم تحديث الصورة في الصفحة وإظهار زر حفظ التعديلات
    $('#newImage2').on('input', function() {
      var reader = new FileReader();
      reader.onload = function(event) {
        var newImageSrc = event.target.result;
        $('#myImage2').attr('src', newImageSrc);
        $('.saveBtn').show(); // إظهار زر حفظ التعديلات
      };
      reader.readAsDataURL(this.files[0]);
    });

  });
   // Personal img
   $(document).ready(function() {
    // عند النقر على زر تعديل الصورة، يتم فتح نافذة اختيار الصورة من المعرض
    $('#editBtn3').click(function() {
      $('#newImage3').click();
    });

    // عند تحميل الصورة الجديدة، يتم تحديث الصورة في الصفحة وإظهار زر حفظ التعديلات
    $('#newImage3').on('input', function() {
      var reader = new FileReader();
      reader.onload = function(event) {
        var newImageSrc = event.target.result;
        $('#myImage3').attr('src', newImageSrc);
        $('.saveBtn').show(); // إظهار زر حفظ التعديلات
      };
      reader.readAsDataURL(this.files[0]);
    });

  });

// ======================= zoomed Image =============================
$(document).ready(function() {
  $('.loupe').hover(function() {
    var imageSrc = $(this).attr('src');
    $('#zoomedImage').attr('src', imageSrc).fadeToggle('100');
  });
});

// ======================= Date Time =============================

mobiscroll.setOptions({
	locale: mobiscroll.localeAr,
	theme: 'ios',
	themeVariant: 'light'
});

mobiscroll.datepicker('#demo-mobile-picker-input', {
	controls: ['date']
});

var instance = mobiscroll.datepicker('#demo-mobile-picker-button', {
	controls: ['date'],
	showOnClick: false,
	showOnFocus: false,
});

instance.setVal(new Date(), true);

mobiscroll.datepicker('#demo-mobile-picker-mobiscroll', {
	controls: ['date']
});

mobiscroll.datepicker('#demo-mobile-picker-inline', {
	controls: ['date'],
	display: 'inline'
});

document
	.getElementById('show-mobile-date-picker')
	.addEventListener('click', function () {
		instance.open();
		return false;
	});

