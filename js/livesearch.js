var someFunction = function(event) {

      // Retrieve the input field text and reset the count to zero
      var filter = $("#live-search").val(), count = 0;

      // Loop through the blog posts
      $(".blog-post").each(function(){
        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) > 0 || filter == '' ) {

            var idArray = [];
            $('.category-container .active').each(function () {
                idArray.push(this.id);
            });

            for ( var j = 0; j < idArray.length; j++ ) {

              if ( $(this).hasClass(idArray[j]) ) {
                $(this).show();
                continue;

              } else {
                $(this).hide();
                break;
              }
            }

            if (idArray.length ==  0) {
              $(this).show();
              count++;
            }

        } else {
          $(this).hide();
        }
      });

      // Update the count
      var numberItems = count;
      $("#filter-count").text(count);
}

var $ = jQuery.noConflict();
$(document).ready(function(){

  $(".category-container .category-filter").click(function () {
        $(".category-filter.active").removeClass("active");
        $(this).addClass("active");
        someFunction();
        e.preventDefault(); /*ignores actual link*/
    });

    $(".hamburger").click(function () {
          $(this).toggleClass("active");
          //$("body").toggleClass("disableScroll")
    });

    $("li").click(function () {

          $(".hamburger").toggleClass("active");
          //$("body").toggleClass("disableScroll")
    });

  var count = $('.blog-post').length
  $("#filter-count").text(count);

  $(window).scroll(function(){
      var contactposition = $('#contact').offset();
      var vormposition = $('#vorm').offset();

      if ( $(this).scrollTop() >= (contactposition.top - 300) ) {
        $('#menu-item-1864').removeClass('current_page_item');
        $('#menu-item-1865').addClass('current_page_item');
      } else if ( $(this).scrollTop() >= vormposition.top ) {
        $('#menu-item-1864').addClass('current_page_item');
        $('#menu-item-1865').removeClass('current_page_item');
      } else {
        $('#menu-item-1864').removeClass('current_page_item');
        $('#menu-item-1865').removeClass('current_page_item');
      }
  });
  //trigger the scroll
  $(window).scroll();//ensure if you're in current position when page is refreshed

});
// Add our event listeners
document.getElementById('live-search').addEventListener('input', someFunction, false);
