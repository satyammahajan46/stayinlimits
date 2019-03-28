$(function(){
  $(window).on("scroll", function(){
    if($(window).scrollTop() > $(".sticky-bar").height()){
      $(".navigation").addClass("borderDec");
    }
    else{
      $(".navigation").removeClass("borderDec");
    }
  });
  $("#expand").on("click", function(){
    $(".subMenu").toggleClass("display");
  });
});
