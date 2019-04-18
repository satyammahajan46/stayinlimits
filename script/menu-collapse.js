$(function(){
  //Small transition on nav border
  $(window).on("scroll", function(){
    if($(window).scrollTop() > $(".sticky-bar").height()){
      $(".navigation").addClass("borderDec");
    }
    else{
      $(".navigation").removeClass("borderDec");
    }
  });
  //Open and close submenu's
  $(".list .expand .item-link").on("click", function(){
    let item = $(this).parent();
    item.find(".subMenu").toggleClass("display");
  });
});
