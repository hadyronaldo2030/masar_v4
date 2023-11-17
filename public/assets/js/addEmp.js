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
// ======================= Birth day = Age =============================
  $(document).ready(function() {
    $("#birthdate").change(function() {
      var birthdate = new Date($("#birthdate").val());
      var currentDate = new Date();
      var age = currentDate.getFullYear() - birthdate.getFullYear();

      if (currentDate.getMonth() < birthdate.getMonth() || (currentDate.getMonth() === birthdate.getMonth() && currentDate.getDate() < birthdate.getDate())) {
        age--;
      }

      $("#ageSpan").text( age + " " + "Year");
    });
  });
// // ======================= Upload Img =============================

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
    $("#live-department").change(function () {
        var valueDepartment = capitalizeText($(this).val());
        $("#d-department").text(valueDepartment);
    });
    $("#live-position").change(function () {
        var valuePosition = capitalizeText($(this).val());
        $("#d-position").text(valuePosition);
    });
    $("#inputGroupSelect03").change(function () {
        var valueStatus = capitalizeText($(this).val());
        $("#d-status").text(valueStatus);
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

// =================== Show Button after change =========================
$(".showbtnUpdate, .showbtnUpdate2").on("input change", function () {
    $("#updateButton").show();
});
//

//? =====================Start alert=====================

$("#add-employee").on("click", function () {
    $("#alert").slideDown(500);
});

//? =====================End alert=====================
let userName = document.getElementById("live-name");
let userMobile = document.getElementById("userMobile");
let userAddress = document.getElementById("userAddress");
let userSalary = document.getElementById("userSalary");
let create = document.getElementById("createEmployee");

function regexName() {
    let alertUserName = document.getElementById("alertUserName");
    let nameVal = userName.value;
    let regex = /^[a-z\sA-Z]{5,15}$/;
    if (regex.test(nameVal) == true) {
        alertUserName.classList.add("d-none");
        return true;
    } else {
        alertUserName.classList.remove("d-none");
        return false;
    }
}

function regexMobile() {
    let alertMobile = document.getElementById("alertMobile");
    let mobileVal = userMobile.value;
    let regex = /^01[0125][0-9]{8}$/;

    if (regex.test(mobileVal) == true) {
        alertMobile.classList.add("d-none");
        return true;
    } else {
        alertMobile.classList.remove("d-none");
        return false;
    }
}

function regexAddres() {
    let alertAddress = document.getElementById("alertAddress");
    let regex = /^[\w\W_]{5,25}$/;
    let addressVal = userAddress.value;
    if (regex.test(addressVal) == true) {
        alertAddress.classList.add("d-none");
        return true;
    } else {
        alertAddress.classList.remove("d-none");
        return false;
    }
}
function regexSalary() {
    let alertSalary = document.getElementById("alertSalary");
    let regex = /^[1-9][0-9]{2,7}$/;
    let salaryVal = userSalary.value;

    if (regex.test(salaryVal) == true) {
        alertSalary.classList.add("d-none");

        return true;
    } else {
        alertSalary.classList.remove("d-none");
        return false;
    }
}




if (regexName() == true && regexAddres() == true && regexMobile() == true && regexSalary() == true)
{
 alert("hello");
}

