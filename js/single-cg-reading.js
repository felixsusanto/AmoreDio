
var pwd = $(".wrapper-revealer").data("password");
function facil_display_check(){
  //check the password if it match with the one on the .wrapper-revealer
  var submitted=$('#password').val();
  if(pwd===submitted){
    $(".wrapper-revealer").addClass("revealed");
  } else if($('#password').val()) {
    $('.facil-password').addClass('has-error');//.popover({content: "Password error"});
  }
};

