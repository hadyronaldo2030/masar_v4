//============================== Search Filter ==============================
$(document).ready(function() {
    
    $(document).ready(function() {
        $("#contract-type").change(function() {
          var selectedType = $(this).val();
          if (selectedType === "all") {
            $(".contracts-table tr").show();
          } else {
            $(".contracts-table tr").hide();
            $(".contracts-table tr[data-type='" + selectedType + "']").show();
          }
        });
      });
    // Search by date
    $("#myInputDate").on("input", function() {
        var filter = $(this).val().toUpperCase();
        $(".myULDate tr").each(function() {
            var txtValue = $(this).find(".date2").eq(0).text().toUpperCase();
            if (txtValue.startsWith(filter)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});


