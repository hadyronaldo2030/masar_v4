//============================== Popup Window ==============================
$(document).ready(function() {
	// Active popup
	$("label h4").click(function(){
		$("#overlay").fadeToggle();
		});
	
    // close Active popup
	$("#btnClose").click(function(){
		$("#overlay").fadeOut();
		});
	});