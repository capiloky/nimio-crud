require('./bootstrap');

require('alpinejs');

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        $('#btn-top').removeClass('hidden');
    } else {
        $('#btn-top').addClass('hidden');
    }
}

  