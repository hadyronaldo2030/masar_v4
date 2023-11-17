function openPage(pageName,elmnt,color) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
	  tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablink");
	for (i = 0; i < tablinks.length; i++) {
	  tablinks[i].style.backgroundColor = "";
	}
	document.getElementById(pageName).style.display = "block";
	elmnt.style.backgroundColor = color;
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen").click();

//   ِAcrive Cards Header
$(document).ready(function() {
	$(".buttonHeader").click(function() {
	  $(".buttonHeader").removeClass("selected").css({"background-color": "", "color": "", "transform": "scale(1)"});
	  $(this).addClass("selected").css({"background-color": "#2e3036", "color": "white", "transform": "scale(1.1)"});
	});
	$(".default").addClass("selected").css({"background-color": "#2e3036", "color": "white", "transform": "scale(1.1)"});
  });