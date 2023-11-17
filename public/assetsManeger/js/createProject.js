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