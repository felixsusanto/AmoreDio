$(document).ready(function(){
  var expiry_time = <?=$expiry_time?>;
  var current_time = <?=$current_time?>;
  // please wait until your Facil and cell group share / discuss this topic :)
  var pwd = '<?=$post_meta['password'][0]?>';

  function facil_display_check() {
    var display_facil = false;

    // check date
    if (current_time > expiry_time) {
      display_facil = true;
    }

    // check password
    if ($('#password').val().toLowerCase() == pwd.toLowerCase()) {
      display_facil = true;
    } else if($('#password').val()) {
      $('.facil-password').addClass('has-error');
    }

    if (display_facil) {
      $('.facil').show('slow');
      $('.facil-box').hide('slow');
    } else {
      $('.facil').hide();
    }
  }

  $(function() {
    facil_display_check();
  });
});
