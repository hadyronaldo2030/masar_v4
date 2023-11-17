// ======================= generate password =============================

$(document).ready(function() {
    $("#generateButton").click(function() {
      var passwordField = $("#passwordField");
      var password = "masar_" + generateRandomPassword();
      passwordField.val(password);
    });

    function generateRandomPassword() {
      var length = 12 - "masar_".length;
      var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
      var password = "";

      for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length);
        password += charset.charAt(randomIndex);
      }

      return password;
    }
  });

//============================== Notes Massage ==============================

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
// ======================= Live typing text =============================
$(document).ready(function () {
    $("#live-job").keyup(function () {
        var valueJob = capitalizeText($(this).val());
        $("#d-job").text(valueJob);
    });
    $("#live-name").keyup(function () {
        var valueName = capitalizeText($(this).val());
        $("#d-name").text(valueName);
    });
    $("#live-address").keyup(function () {
        var valueAddress = capitalizeText($(this).val());
        $("#d-address").text(valueAddress);
    });
    $("#live-email").on("input", function() {
        var emailValue = $(this).val();
        $("#d-email").text(emailValue);
      });
    $("#live-position").change(function () {
        var valuePosition = capitalizeText($(this).val());
        $("#d-position").text(valuePosition);
    });

    // department
    function displaydepartment() {
        var selecteddepartment = $("#live-department").val();
        $("#d-department").text(selecteddepartment);
        }
        displaydepartment();
        $("#live-department").change(function() {
        displaydepartment();
    });
    // status
      function displaystatus() {
        var selectedStatus = $("#inputGroupSelect03").val();
        $("#d-status").text(selectedStatus);
        }
        displaystatus();

        $("#inputGroupSelect03").change(function() {
        displaystatus();
    });
    // status
    function displayposition() {
        var selectedposition = $("#live-position").val();
        $("#d-position").text(selectedposition);
        }
        displayposition();

        $("#live-position").change(function() {
        displayposition();
    });
});


function capitalizeText(text) {
    let words = text.split(" ");
    for (let i = 0; i < words.length; i++) {
        words[i] =
            words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    return words.join(" ");
}

// ================== Month Evaluation ========================
// Add click event to buttons
$(".btnAccordion").on("click", function() {
  var panel = $(this).next();
  // Toggle display
  panel.slideToggle();
});
$(".closeNotes").on("click", function() {
    $('.panel').fadeOut();
  });
// ======================= Toggle button =============================
  // triple
  $(document).ready(function() {
    const box = $("#toggle-triple");
    const h3 = $("#toggle-triple #h3");
    const span = $("#toggle-triple #span");

    let state = 1;

    box.on("click", function() {
      if (state === 1) {
        h3.text("20");
        span.text("month");
        state = 2;
      } else if (state === 2) {
        h3.text("30");
        span.text("year");
        state = 3;
      } else if (state === 3) {
        h3.text("10");
        span.text("day");
        state = 1;
      }
    });
  });
  // Toggle Attendance
    $(document).ready(function() {
      const box = $("#toggle-Attendance");
      const h3 = $("#toggle-Attendance h3");
      const span = $("#toggle-Attendance .span");

      let state = 1;

      box.on("click", function() {
        if (state === 1) {
          h3.text("4");
          span.text("For Week");
          state = 2;
        } else if (state === 2) {
          h3.text("22");
          span.text("Month");
          state = 1;
        }
      });
    });
  // Toggle Holidays
    $(document).ready(function() {
      const box = $("#toggle-Holidays");
      const h3 = $("#toggle-Holidays h3");
      const span = $("#toggle-Holidays .span");

      let state = 1;

      box.on("click", function() {
        if (state === 1) {
          h3.text("2");
          span.text("for week");
          state = 2;
        } else if (state === 2) {
          h3.text("4");
          span.text("Month");
          state = 1;
        }
      });
    });
  // Toggle Absence
    $(document).ready(function() {
      const box = $("#toggle-Absence");
      const h3 = $("#toggle-Absence h3");
      const span = $("#toggle-Absence .span");

      let state = 1;

      box.on("click", function() {
        if (state === 1) {
          h3.text("1");
          span.text("For Week");
          state = 2;
        } else if (state === 2) {
          h3.text("3");
          span.text("Month");
          state = 1;
        }
      });
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

