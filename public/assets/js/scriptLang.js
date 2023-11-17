var tnum = 'en';

$(document).ready(function(){

  $(document).click( function(e) {
       $('.translate_wrapper, .more_lang').removeClass('active');
  });

  $('.translate_wrapper .current_lang').click(function(e){
    e.stopPropagation();
    $(this).parent().toggleClass('active');

    setTimeout(function(){
      $('.more_lang').toggleClass('active');
    }, 5);
  });


  /*TRANSLATE*/
  translate(tnum);

  $('.more_lang .lang').click(function(){
    $(this).addClass('selected').siblings().removeClass('selected');
    $('.more_lang').removeClass('active');

    var img = $(this).find('img').attr('src');
    var lang = $(this).attr('data-value');
    var tnum = lang;
    translate(tnum);

    $('.current_lang .lang-txt').text(lang);
    $('.current_lang img').attr('src', img);

    if(lang == 'ar'){
      $('body').attr('dir', 'rtl');
    }else{
      $('body').attr('dir', 'ltr');
    }

  });
});

function translate(tnum){
  $('.textprofile').text(trans[0][tnum]);
  $('.textlogout').text(trans[1][tnum]);
  $('.textlogouto').text(trans[2][tnum]);
}

var trans = [
  {
    en : 'Profile',
    ar : 'صفحة شخصيه'
  },{
    en : 'Logout',
    ar : 'تسجيل خروج'
  },{
    en : '',
    ar : ''
  },

];
