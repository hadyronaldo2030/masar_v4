// pety cach
  // ============================== upload images1 ==============================
  function previewImage(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function () {
      var imgElement = document.getElementById("previewImg");
      imgElement.src = reader.result;
      document.getElementById("deleteButton").style.display = "block";
    }

    reader.readAsDataURL(input.files[0]);
  }

  function deleteImage() {
    var imgElement = document.getElementById("previewImg");
    imgElement.src = "";
    document.getElementById("deleteButton").style.display = "none";
  }

  // ============================== upload images2 ==============================
  function previewImageGallery(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var imageContainer2 = createImageContainer2(reader.result);
      imageContainer2.getElementsByTagName('img')[0].setAttribute('name', 'images[]');
      document.getElementById('image-gallery').appendChild(imageContainer2);
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  function createImageContainer2(imageSrc) {
    var imageContainer2 = document.createElement('div');
    imageContainer2.className = 'image-container';

    var output = document.createElement('img');
    output.src = imageSrc;

    var deleteButton = document.createElement('span');
    deleteButton.className = 'fa-solid fa-x';
    deleteButton.innerText = '';
    deleteButton.addEventListener('click', function() {
      imageContainer2.remove();
    });

    imageContainer2.appendChild(output);
    imageContainer2.appendChild(deleteButton);

    return imageContainer2;
  }

  function addImage() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.addEventListener('change', previewImageGallery);
    input.click();
  }


// ============================== Editing ==============================

  // ============================== upload images1 ==============================
  function previewImageEdit(event) {
    var inputEdit = event.target;
    var readerEdit = new FileReader();

    readerEdit.onload = function () {
      var imgElement = document.getElementById("previewImgEdit");
      imgElement.src = readerEdit.result;
      document.getElementById("deleteButtonEdit").style.display = "block";
    }

    readerEdit.readAsDataURL(inputEdit.files[0]);
  }

  function deleteImageEdit() {
    var imgElement = document.getElementById("previewImgEdit");
    imgElement.src = "";
    document.getElementById("deleteButtonEdit").style.display = "none";
  }

  // ============================== upload images2 ==============================
  function previewImageGalleryEdit(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var imageContainer3 = editImageContainer3(reader.result);
      imageContainer3.getElementsByTagName('img')[0].setAttribute('name', 'images[]');
      document.getElementById('image-galleryEdit').appendChild(imageContainer3);
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  function editImageContainer3(imageSrc) {
    var imageContainer3 = document.createElement('div');
    imageContainer3.className = 'image-container';

    var output = document.createElement('img');
    output.src = imageSrc;

    var deleteButton = document.createElement('span');
    deleteButton.className = 'fa-solid fa-x';
    deleteButton.innerText = '';
    deleteButton.addEventListener('click', function() {
      imageContainer3.remove();
    });

    imageContainer3.appendChild(output);
    imageContainer3.appendChild(deleteButton);

    return imageContainer3;
  }

  function editImage() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.addEventListener('change', previewImageGalleryEdit);
    input.click();
  }

//
// Basic

// ============================== upload images1 ==============================

  // ============================== upload images2 ==============================
  $(document).ready(function() {
    $('.file-upload').change(function() {
        var file = this.files[0];
        var reader = new FileReader();
        var minImg = $(this).closest('.minImg');

        reader.onload = function() {
            var img = minImg.find('img');
            img.attr('src', reader.result);
            img.css('display', 'block');
            minImg.find('.delete-button').css('display', 'flex');
        };

        reader.readAsDataURL(file);
    });

    $('.delete-button').click(function() {
        var minImg = $(this).closest('.minImg');
        var img = minImg.find('img');
        img.attr('src', '');
        img.css('display', 'none');
        var input = minImg.find('.file-upload');
        input.val('');
        $(this).css('display', 'none');
    });
});

// ============================== Editing basic ==============================
  // ============================== Edit images2 ==============================

function previewImageEditBasic(event) {
    var inputEditBasic = event.target;
    var readerEditBasic = new FileReader();

    readerEditBasic.onload = function () {
      var imgElement = document.getElementById("previewImgEditBasic");
      imgElement.src = readerEditBasic.result;
      document.getElementById("deleteButtonEditBasic").style.display = "block";
    }

    readerEditBasic.readAsDataURL(inputEditBasic.files[0]);
  }

  function deleteImageEditBasic() {
    var imgElement = document.getElementById("previewImgEditBasic");
    imgElement.src = "";
    document.getElementById("deleteButtonEditBasic").style.display = "none";
  }

  // ============================== Edit images2 ==============================
  function previewImageGalleryEditBasic(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var imageContainer1 = EditBasicImageContainer1(reader.result);
      imageContainer1.getElementsByTagName('img')[0].setAttribute('name', 'images[]');
      document.getElementById('image-galleryEditBasic').appendChild(imageContainer1);
    }
    reader.readAsDataURL(event.target.files[0]);
  }

  function EditBasicImageContainer1(imageSrc) {
    var imageContainer1 = document.createElement('div');
    imageContainer1.className = 'image-container';

    var output = document.createElement('img');
    output.src = imageSrc;

    var deleteButton = document.createElement('span');
    deleteButton.className = 'fa-solid fa-x';
    deleteButton.innerText = '';
    deleteButton.addEventListener('click', function() {
      imageContainer1.remove();
    });

    imageContainer1.appendChild(output);
    imageContainer1.appendChild(deleteButton);

    return imageContainer1;
  }

  function EditBasicImage() {
    var input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.addEventListener('change', previewImageGalleryEditBasic);
    input.click();
  }


  