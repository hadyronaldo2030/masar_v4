// filter Debartment | number total project | total employees
$(document).ready(function() {
    function updateCounts() {
        var selectedType = $("#contract-type").val();

        $("#myUL tr, #myULTasks tr").hide();
        if (selectedType === "all") {
            $("#myUL tr, #myULTasks tr").show();
        } else {
            $("#myUL tr[data-type='" + selectedType + "'], #myULTasks tr[data-type='" + selectedType + "']").show();
        }

        $('.employeeCount').text($('#myUL tr:visible').length);
        $('.taskCount').text($('#myULTasks tr:visible').length);
    }

    $("#contract-type").change(updateCounts);
    updateCounts();
    });
    // Toggle show & hide emp in the project list
    $(document).ready(function() {
    $('.btnShow').click(function() {
    $('.btnShow svg').toggleClass('d-none');
    $('#employeToggle').toggleClass('d-none');
    $('.tdToggle').toggleClass('d-none');
    $('#projectToggle').toggleClass('section1');
    $('#projectToggle').toggleClass('section2');
    });
    });


// Search Filter name Employee
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
// Search Filter name Tasks
function myTasks() {
    var input, filter, tbody, tr, th, i, txtValue, searchValue;
    input = $("#myTask");
    filter = input.val().toUpperCase();
    tbody = $("#myULTasks");
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
