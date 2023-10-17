
/* Dore Single Theme Initializer Script 

Table of Contents

01. Single Theme Initializer
02. Toastr
*/

/* 01. Single Theme Initializer */

(function($) {
  if ($().dropzone) {
    Dropzone.autoDiscover = false;
}
var $dore = $("body").dore();
})(jQuery);

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
