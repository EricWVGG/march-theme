var initial_load = true;
var old_url = '';
var last_link_hash = false;

setTimeout(function () {
  window.scrollTo(0, 1);
}, 1000);

// DOM Ready
$(function() {
	
  // mobile nav
  $(function() {
    $('section.header').on('click', 'nav', function(){
      $('nav').toggleClass('nav_btn_active');
      $('nav ul').toggleClass('nav_draw_active');
    });
  });


  // load ajax pages
  $('body').on('click', '.ajax_trigger, .header_main a, .header_sub_about a', function(e) {
    e.preventDefault();
    var url = jQuery(this).attr('href');
    ajax_load(url);
  });
  
  $('body').on('click', '.ajax_trigger_detail', function(e) {
    e.preventDefault();
    if($(window).width() < 768) return;
    var url = jQuery(this).attr('href');
    ajax_load_detail(url);
  });
  
  // on history change, new ajax load
  old_url = jQuery.url().attr('path');
  window.addEventListener("popstate", function(e) {
    if(initial_load) {
      initial_load = false;
      return;
    }
    var new_url = jQuery.url().attr('path');
    if( new_url == old_url || last_link_hash) { // do nothing on hash changes
      last_link_hash = false;
      return;
    }
    old_url = new_url;
    ajax_load(document.location);
  });
  
  // initialize
  load_masonry();
  
  
  
  $('body').on('click', 'a[href^="#"]', function(e) {
    e.preventDefault();
    last_link_hash = true;
    var target = this.hash,
    $target = $(target);
    $('html, body').stop().animate({
      'scrollTop': $target.offset().top
    }, 500, function () {
      window.location.hash = target;
    });
  });

  // detail view action
  $('body').on('click', 'a.article_snip_btn', function() {
    $('section.article_info').toggleClass('article_info_active');
  }).on('click', 'a.article_info_btn', function() {
    $('section.article_info').removeClass('article_info_active');
  }).on('click', '.article_close', function() {
    if(history.pushState) {
      var url = $.url(document.location);
      var path = url.attr('protocol') + '://' + url.attr('host') + '/' + url.segment(1);
      history.pushState({}, '', path);
    }
    $('.overlay_active, #featured_project_mask').removeClass('overlay_active');
  });
  
  
  // track "active section" on portfolio pages
  track_active_section();
  var scrolling_timer = {};
  $(window).on('scroll', function() {
    clearTimeout('scrolling_timer');
    scrolling_timer = setTimeout(function() {
      track_active_section();
    }, 50);
  });

});



function track_active_section() {
  if(!$('#content').hasClass('projects_page')) return;

  // NOTE: this currently only supports Featured and Clients
  //       will need additional work to support Case Studies
  var clients_point = $('#clients_scroll_target').offset().top;
  if($('body').scrollTop() >= clients_point) {
    $('#menu-item-34').removeClass('active_section'); 
    $('#menu-item-36').addClass('active_section'); 
  } else {
    $('#menu-item-34').addClass('active_section'); 
    $('#menu-item-36').removeClass('active_section'); 
  }
}



function ajax_load(url) {
  $('body').addClass('waiting');
  $('html, body').animate({scrollTop:0}, 500);
  $('nav').removeClass('nav_btn_active');
  $('nav ul').removeClass('nav_draw_active');

  if( !Modernizr.csstransitions ) {
  
      $().wvgg_ajax_load({
        url: url,
        dataType: 'html',
        success:function(r) {
          check_background_class();
          load_masonry();
          // note: google analytics ping here
          setTimeout(function() {
            $('body').removeClass('waiting');
            old_url = jQuery.url().attr('path');
            track_active_section();
          }, 5);
        }
      });

  } else {
    
    $('#content_wrapper').on('transitionEnd transitionend webkitTransitionEnd', function() {
      $(this).off('transitionEnd transitionend webkitTransitionEnd');
      $().wvgg_ajax_load({
        url: url,
        dataType: 'html',
        success:function(r) {
          check_background_class();
          load_masonry();
          // note: google analytics ping here
          setTimeout(function() {
            $('body').removeClass('waiting');
            old_url = jQuery.url().attr('path');
            track_active_section();
            $('#content_wrapper').removeClass('reloading');
          }, 5);
        }
      });
    }).addClass('reloading');
  }
}


function ajax_load_detail(url) {
    $('body').addClass('waiting');
    $().wvgg_ajax_load({
      url: url,
      dataType: 'html',
      success:function(r) {
        // note: google analytics ping here
      }
    });
}


function load_masonry() {
  $('#featured ul').masonry({
    columnWidth: 316,
    itemSelector: 'li',
    gutter: 6,
  });
}


function load_background_image(url) {
    var img = new Image;
    img.onload = function() {
        $('#background').css('background-image', 'url(' + url + ')');
        check_background_class();
    }
    img.src = url;
}


function check_background_class() {
    // on every page load, check to see background visibility state
    var url = $.url();
    if(url.attr('path') == '/') { // load home
        $('#background').removeClass('about').addClass('visible');
        setTimeout(function() {
            $('.header_main, .footer').removeClass('initial_load');
            $('.display_text').removeClass('display_text');
        }, 5000);
    } else if(
        !$('body').hasClass('home')
    ) {
        $('#background').removeClass('visible').addClass('about');
        $('.header_main, .footer').removeClass('initial_load');
    } else {
        // this never happens anymore
        $('#background').removeClass('about').removeClass('visible');
        $('.header_main, .footer').removeClass('initial_load');
    }
}







