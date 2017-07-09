$(document).ready(function(){
  var contact_y = 300;
  $(function() {
    var url = document.location.toString();
    if (url.match('#')) {
      $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
      
      // go up to show Contact nicely
      setTimeout(function(){
        $(window).scrollTop(contact_y);
      }, 10);
    }
  });

  // Change hash for page-reload
  $('.nav-tabs a').on('shown.bs.tab', function (e) {
    e.preventDefault();
    if(history.pushState) {
      history.pushState(null, null, e.target.hash);
    }
    else {
      window.location.hash = '#myhash';
    }
  });

  //PRAYER REQUEST FORM

  var $formPrayerRequest = $("#prayer-request .wpcf7");
  $formPrayerRequest.find("input.required, textarea.required").prop("required", 1);

  $formPrayerRequest.validator();

  $("#anonymity-request").on('click', anonHandler);

  function notifyHandler() {
    var isChecked = $("#notify-me").prop("checked");
    var template = "\n<b>[IMPORTANT]</b> I'd like to be notified when the request is prayed for";
    var thePrayer = $("#prayer").val();
    if(isChecked) {
      thePrayer += template;
      $("#prayer").val(thePrayer);
    }
  }

  function anonHandler() {
    var isChecked = this.checked;
    if(isChecked) {
      $('.anon-subject').prop('disabled', 1);
      $('.anon-subject').val('').prop('checked', 0).attr('data-validate', false);
      $('.anon-subject.anon-hide').closest('.checkbox').addClass('invisible');
    } else {
      $('.anon-subject').prop('disabled', 0).attr('data-validate', true);
      $('.anon-subject.anon-hide').closest('.checkbox').removeClass('invisible');
    }
    $(this).closest("form").validator('update');
    //$(this).closest("form").validator('validate');
  }

  $formPrayerRequest.on("invalid.bs.validator", function() {
    $(this).find('[type=submit]').prop('disabled',1);
  });

  $formPrayerRequest.on("validated.bs.validator", function() {
    var hasError = $(this).find('.has-error').length;
    if(!hasError) {
      $(this).find('[type=submit]').prop('disabled',0);  
    } else {
      $(this).find('[type=submit]').prop('disabled',1); 
    }
  });

  $formPrayerRequest.on('wpcf7submit', notifyHandler});

});