//============================== NavBar ==============================
$(document).ready(function() {
	// Active Lang
	$("nav .lang").click(function(){
		$(".dropdownLang").toggleClass("d-none");
		});
	// Active User
	$("nav .userNav").click(function(){
		$(".dropdownUser").toggleClass("d-none");
		});
	});
//============================== SaideBar ==============================
$(document).ready(function() {
	$("#btnSlider").click(function(){
		$("aside").toggleClass("toggleSlide");
        $("aside .logoaside img").toggleClass("d-none");
        $("aside section span").toggleClass("d-none");
        $("aside .footerSide span").toggleClass("d-none");
        $("aside .useraside a").toggleClass("d-none");
        $("aside .useraside h5").toggleClass("d-none");
    });
    $(".openSlide").click(function(){
        $("aside").removeClass("toggleSlide");
        $("aside .logoaside img").toggleClass("d-none");
        $("aside section span").toggleClass("d-none");
        $("aside .footerSide span").toggleClass("d-none");
        $("aside .useraside a").toggleClass("d-none");
        $("aside .useraside h5").toggleClass("d-none");
        });
	});


//============================== Full Screen ==============================
$(document).ready(function() {
    const fullscreenButton = $('#fullscreenButton');
    let isFullscreen = false;
    function toggleFullscreen() {
        if (!isFullscreen) {
            const element = document.documentElement;
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }

        isFullscreen = !isFullscreen;
    }

    fullscreenButton.on('click', toggleFullscreen);
});

//========================= Dark Mode & Light Mode =========================
$(document).ready(function() {
  let currentTheme = localStorage.getItem('theme');
  if (currentTheme) {
    $("html").attr("data-theme", currentTheme);

    if (currentTheme === "darkMode") {
      $(".themeicon.btnLight").addClass("d-none");
      $(".themeicon.fa-moon").removeClass("d-none");
    } else if (currentTheme === "lightMode") {
      $(".themeicon.btnLight").removeClass("d-none");
      $(".themeicon.fa-moon").addClass("d-none");
    }
  }

  $(".themeicons").click(function() {
    $(".themeicon").toggleClass("d-none");

    let currentTheme = $("html").attr("data-theme");
    if (currentTheme === "darkMode") {
      $("html").attr("data-theme", "lightMode");
      localStorage.setItem('theme', "lightMode");
    } else if (currentTheme === "lightMode") {
      $("html").attr("data-theme", "darkMode");
      localStorage.setItem('theme', "darkMode");
    }
  });
});
//============================== Popup Window ==============================
$(document).ready(function() {
	// Active popup
	$(".activePop").click(function(){
		$("#overlay").fadeToggle();
		});

    // close Active popup
	$("#btnClose,#saveClose").click(function(){
		$("#overlay").fadeOut();
		});
	});

//============================== Alert Massage ==============================
$(document).ready(function() {
    var countdown = 5;
    var countdownElement = $(".countdown");

    var countdownInterval = setInterval(function() {
        countdown--;
        countdownElement.text(countdown);

        if (countdown === 0) {
            clearInterval(countdownInterval);
            $(".alertStyle").fadeOut();
        }
    }, 1000);

    setTimeout(function() {
        $(".alertStyle").fadeOut();
    }, 5000);
});
