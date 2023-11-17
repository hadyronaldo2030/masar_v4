//============================== Date & Time ==============================
$(function () {
    $('#datetimepicker9').datetimepicker({
        viewMode: 'years'
    });
});

$(function () {
    $('#date1,#date2,#date3,#date4,#date5,#date6').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        icons: {
            time: 'fa-solid fa-clock fa-2x',
            date: 'fa-solid fa-calendar-alt fa-2x',
            up: 'fa-solid fa-chevron-up fa-2x',
            down: 'fa-solid fa-chevron-down fa-2x',
            previous: 'fa-solid fa-chevron-left fa-2x',
            next: 'fa-solid fa-chevron-right fa-2x',
            today: 'fa-solid fa-calendar-check fa-2x',
            clear: 'fa-solid fa-trash fa-2x',
            close: 'fa-solid fa-times fa-2x'
        }
    });
});

//============================== Search Filter ==============================
function myFunction() {
    var input, filter, tbody, tr, th, i, txtValue, searchValue;
    input = $("#myInput");
    filter = input.val().toUpperCase();
    tbody = $("#myUL");
    tr = tbody.find("tr");
    for (i = 0; i < tr.length; i++) {
        th = $(tr[i]).find("th").eq(0);
        txtValue = th.text().toUpperCase();
        searchValue = filter.toUpperCase();
        if (txtValue.startsWith(searchValue)) {
            $(tr[i]).show();
        } else {
            $(tr[i]).hide();
        }
    }
}
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


