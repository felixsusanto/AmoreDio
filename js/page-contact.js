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
  })
});