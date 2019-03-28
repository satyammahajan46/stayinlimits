$(function(){
  $(".list .item .item-link ").on("keydown", function(event){
    //select the li item
    let item = $(this).parent();
    if(event.key == 'ArrowLeft'){
      event.preventDefault();
      if (item.prev().length==0) {
        item.parent().children().last().children().focus();
      }
      else{
        item.prev().children().focus();
      }
    }
    if(event.key == 'ArrowRight'){
      event.preventDefault();
      if (item.next().length==0) {
        item.parent().children().eq(0).children().focus();
      }
      else{
        item.next().children().focus();
      }
    }
  });
  $(".list #expand .item-link").on("keydown", function(event){
    //select the li item
    let item = $(this).parent();
    if(event.key == "ArrowDown" || event.key == " " || event.key == "Enter"){
      event.preventDefault();
      item.find(".subMenu").toggleClass("display");
      $(".subMenu").children().children().eq(0).focus();
    }
  });
  $(".subMenu .subMenu-item .subMenu-item-link").on("keydown", function(){
    //select the li item
    let item = $(this).parent();
    if(event.key == "ArrowDown"){
      event.preventDefault();
      if (item.next().length==0) {
        item.parent().children().eq(0).children().focus();
      }
      else{
        item.next().children().focus();
      }
    }
    if(event.key == "ArrowUp"){
      event.preventDefault();
      if (item.prev().length==0) {
        item.parent().children().last().children().focus();
      }
      else{
        item.prev().children().focus();
      }
    }
    if(event.key == "ArrowRight"){
      event.preventDefault();
      if (item.parent().hasClass("display")) {
        item.parent().toggleClass("display");
        item.parent().parent().next().children().focus();
      }
    }
    if(event.key == "ArrowLeft"){
      event.preventDefault();
      if (item.parent().hasClass("display")) {
        item.parent().toggleClass("display");
        item.parent().parent().prev().children().focus();
      }
    }
  });
});
