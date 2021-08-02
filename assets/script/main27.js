
var Cookie =
{
   set: function(name, value, days)

   {
      var domain, domainParts, date, expires, host;

      if (days)
      {
         date = new Date();
         date.setTime(date.getTime()+(days*24*60*60*1000));
         expires = "; expires="+date.toGMTString();
      }
      else
      {
         expires = "";
      }

      host = location.host;
      if (host.split('.').length === 1)
      {
         // no "." in a domain - it's localhost or something similar
         document.cookie = name+"="+value+expires+"; path=/";
      }
      else
      {
         // Remember the cookie on all subdomains.
          //
         // Start with trying to set cookie to the top domain.
         // (example: if user is on foo.com, try to set
         //  cookie to domain ".com")
         //
         // If the cookie will not be set, it means ".com"
         // is a top level domain and we need to
         // set the cookie to ".foo.com"
         domainParts = host.split('.');
         domainParts.shift();
         domain = '.'+domainParts.join('.');

         document.cookie = name+"="+value+expires+"; path=/; domain="+domain;

         // check if cookie was successfuly set to the given domain
         // (otherwise it was a Top-Level Domain)
         if (Cookie.get(name) == null || Cookie.get(name) != value)
         {
            // append "." to current domain
            domain = '.'+host;
            document.cookie = name+"="+value+expires+"; path=/; domain="+domain;
         }
      }
   },

   get: function(name)
   {
      var nameEQ = name + "=";
      var ca = document.cookie.split(';');
      for (var i=0; i < ca.length; i++)
      {
         var c = ca[i];
         while (c.charAt(0)==' ')
         {
            c = c.substring(1,c.length);
         }

         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
   },

   erase: function(name)
   {
      Cookie.set(name, '', -1);
   }
};
/**
* initialises rooms/services carousel on home page
* requires owl carousel script
*/
function init_weather(){
  if(!jQuery('.weather-carousel').length){
    return false;
  }
  var owl = jQuery('.weather-carousel');

  var args = {
    responsive:{
      0:{
        items: 1,
      },
      768:{
        items: 2,

      },
      992:{
        items: 3,
      },
      1200:{
        items: 4,
      }
    },

    items: 1,
    dots: true,
    loop: true,
  }

  owl.owlCarousel(args);
  owl.siblings('.weather-carousel-ctrl').find('.prev').click(function(event) {
    owl.trigger('prev.owl.carousel');
  });
  owl.siblings('.weather-carousel-ctrl').find('.next').click(function(event) {
    owl.trigger('next.owl.carousel');
  });
}

function init_room_slider(){
  if(!jQuery('.carousel__content').length){
    return false;
  }
  var owl = jQuery('.carousel__content');

  var args = {
    responsive:{
      0:{
        dotsEach: 1,
      },
      768:{
        dotsEach: 1,
      }
    },

    items: 1,
    margin: 5,
    dots: true,
    loop: true,
    autoPlay: true,
    dotsContainer: '.carousel__dots .col-9'
  }

  owl.on('initialized.owl.carousel', function(e){
    owl.closest('.container').find('.carousel__counter-total').text(e.item.count);
     owl.closest('.container').find('.carousel__counter-current').text(1);
    jQuery('.carousel__dots').removeClass('visuallyhidden');
    jQuery('.carousel__ctrl').removeClass('visuallyhidden');

    if (jQuery(window).width() < 768) {
      var height = 0;
      owl.find('.carousel__item-about').each(function(index, el) {
        height = Math.max(height, jQuery(el).height());
      });

       owl.find('.carousel__item-about').height(height);
      var height = 0;

      owl.find('.carousel__item-title').each(function(index, el) {
        height = Math.max(height, jQuery(el).height());
      });

       owl.find('.carousel__item-title').height(height);
    }
  })


  setTimeout(function(){
    owl.owlCarousel(args);
  },50);

  owl.on('changed.owl.carousel', function(e){
      owl.closest('.container').find('.carousel__counter-current').text(e.page.index+1);
  })

  owl.siblings('.carousel__ctrl').find('.prev').click(function(){
    owl.trigger('prev.owl.carousel');
  })

  owl.siblings('.carousel__ctrl').find('.next').click(function(){
    owl.trigger('next.owl.carousel');
  })
}

function init_carousel_2(){
  if(!jQuery('.carousel-global .items-2').length){
    return false;
  }

   var owl = jQuery('.owl-carousel.items-2');

  var args = {
    responsive:{
      0:{
        items: 1,
        dots: true,
      },
      992: {
        dots: true,
        items: 2
      },
    },
    dots: true,
    loop:true,

    dots: false,
    revind: true,
    items: 2,
  };

  if(owl.closest('.carousel-global').siblings('.carousel__dots').length){
    args.dotsContainer = '.carousel__dots .col-9';
  }

  owl.each(function(index, el) {
    var _owl = jQuery(el);

  _owl.on('initialized.owl.carousel', function(e){

    _owl.closest('.container').find('.carousel__counter-total').text(e.item.count);
    _owl.closest('.container').find('.carousel__counter-current').text(e.page.index+1)
    jQuery('.carousel__dots').removeClass('visuallyhidden');
    jQuery('.carousel__ctrl').removeClass('visuallyhidden');
  })




    _owl.on('initialized.owl.carousel', function(){
      setTimeout(function(){
       var elements = _owl.find('.tower-item__content');
       euql_height(elements);
      }, 300);
    });

      _owl.on('changed.owl.carousel', function(e){
        _owl.closest('.container').find('.carousel__counter-current').text(e.page.index+1)
      })

    _owl.owlCarousel(args);

    _owl.siblings('.carousel-ctrl').find('.prev').click(function(){
      _owl.trigger('prev.owl.carousel');
    })

    _owl.siblings('.carousel-ctrl').find('.next').click(function(){
      _owl.trigger('next.owl.carousel');
    })
  });

}

function euql_height(elements){
  var height = -1;
  elements.css({'min-height': '0', 'box-sizing': 'content-box'});
  elements.each(function(ind, _el){
    height = Math.max(jQuery(_el).height(), height);
  })

  if(height > 0){
    elements.css({'min-height': height + 'px'});
  }
}


/**
* initialises packages carousel on home page
* requires owl carousel script
*/
function init_mount_carousel(){
  if(!jQuery('.carousel-mount').length){
    return false;
  }

  var owl = jQuery('.carousel-mount__content');

  var args = {
    responsive:{
      0:{
      },
      768:{
        margin: 75,
      }
    },

    margin: 75,
    items: 1,
    dots: true,
    loop: true,
    autoPlay: true,
    // dotsContainer: '.carousel-mount__dots'
  }

  owl.each(function(index, el) {

    var _owl = jQuery(el);

    _owl.owlCarousel(args);

    _owl.siblings('.carousel-mount__ctrl').find('.prev').click(function(){
      _owl.trigger('prev.owl.carousel');
    })

    _owl.siblings('.carousel-mount__ctrl').find('.next').click(function(){
      _owl.trigger('next.owl.carousel');
    })
  });
}


/**
* initialises features carousel on home page
* requires owl carousel script
*/
function init_featured_carousel(){
  if(!jQuery('.featured__item-media-content').length){
    return false;
  }

  jQuery('.featured__item-media-content').each(function(ind,el){
    var owl = jQuery(el);

    var args = {
      items: 1,
      dots: true,
      loop: true,
      autoPlay: true,
      // dotsContainer: owl.data('dots'),
    }

    owl.owlCarousel(args);

    owl.siblings('.owl-ctrl').find('.prev').click(function(){
      owl.trigger('prev.owl.carousel');
    })

    owl.siblings('.owl-ctrl').find('.next').click(function(){
      owl.trigger('next.owl.carousel');
    })
  })
}


var label_variants = {
  rooms: {
    single: 'Room',
    multiple: 'Rooms',
  },
  childs: {
    single: 'Child',
    multiple: 'Childs',
  },
  adults:{
    single: 'Adult',
    multiple: 'Adults',
  }
};


/**
* changes value in input number
*/
function cha_number(obj, type){
  var input = (type === 'input')? jQuery(obj) : jQuery(obj).closest('.input-ctrl').find('input');

  var value_min = parseInt(input.attr('min'));
  var value_max = parseInt(input.attr('max'));
  var value     = input.val();

  switch(type){
    case "encr":
      value++;
      break;
    case "dcr":
      value--
      break;
    case 'input':
      break;
  }

  value = Math.min(value, 99);
  value = Math.max(value, 0);
  input.val(value);



  var data_type = input.attr('name');

  var count_type = (value === 1)? 'single' : 'multiple';

  jQuery('[data-type='+data_type+']').text(value);
  jQuery('[data-type-label='+data_type+']').text(label_variants[data_type][count_type]);
}





/**
* replaces part of a string
*
* @param {needle} - object with pairs {search : replace }
* @param {highstack} - string
*
* @return String
*/
function str_replace(needle, highstack){
  var template = highstack;
    for(key in needle){
    var exp = new RegExp("\\{" + key + "\\}", "gi");
      template = template.replace(exp, function(str){
        value = needle[key];
        return value;
      });
    }
    return template;
}


function show_popup_shop(id){
  jQuery('.shop-popup').addClass('shown');
  jQuery('.content-popup').addClass('hidden');
  jQuery('#'+id).removeClass('hidden');
}

function close_popup_shop (){
   jQuery('.shop-popup').removeClass('shown');
  jQuery('.content-popup').addClass('hidden');
}
jQuery('.icon-shop-popup-close').click(function(){
   jQuery('.shop-popup').removeClass('shown');
  jQuery('.content-popup').addClass('hidden');
})


jQuery('.shop-popup').click(function(event) {
  if(!jQuery(event.target).closest('.content-popup').length){
   jQuery('.shop-popup').removeClass('shown');
  jQuery('.content-popup').addClass('hidden');
  }
});
// switch tabs on rooms list and room single page
jQuery('.tabs__item').click(function(e) {
  jQuery('.tabs__item').removeClass('active');
  jQuery(this).addClass('active');
});


/**
* dropdown open controll
*/
jQuery(document.body).on('click','.js-dropdown-trigger', function(e){

  if(!jQuery(e.target).closest('.js-dropdown').length){
    jQuery(this).addClass('selected');
    jQuery(this).find('.js-dropdown').addClass('active');
  }
})


/**
* dropdown close by click on x symbol
*/
jQuery(document.body).on('click','.icon-close', function(e){
  jQuery(this).closest('.js-dropdown').removeClass('active');
  jQuery(this).closest('.js-dropdow-trigger').removeClass('selected');
})


/**
* dropdown close by click outside of it
*/
jQuery(document.body).on('click', function(e){
  if(!jQuery(e.target).closest('.js-dropdown-trigger').length){
    jQuery(this).removeClass('selected');
    jQuery(this).find('.js-dropdown').removeClass('active');
  }
})



/**
* Resert all inputs
*/
jQuery('.input-ctrl-clear').click(function(e){
  e.preventDefault();

  var items = jQuery(this).closest('.row').siblings('.input-ctrl').find('input');

  items.each(function(index, el) {
    el.value = 0;
    cha_number(el, 'input');
  });
})

/**
* inits daterangepicker
**/
  var now     = new Date();
  var today_str = (now.getMonth() + 1) + '/' + now.getDate() + '/' + now.getFullYear();
  var next_7  = new Date();
  next_7.setDate(next_7.getDate() + 7);
  var next_7_str = (next_7.getMonth() + 1) + '/' + next_7.getDate() + '/' + next_7.getFullYear();

  jQuery('.range-datepicker').each(function(index, el) {
    jQuery(el).daterangepicker({
      "autoApply": false,
      "alwaysShowCalendars": true,
      "startDate": today_str,
      "endDate": next_7_str
    }, function(start, end, label) {

      // var text = start.format('MMM DD YYYY') + ' → ' + end.format('MMM DD YYYY');

      jQuery('label.arival[for="dates"]').text(start.format('MM/DD/YYYY'))
      jQuery('label.departure[for="dates"]').text(end.format('MM/DD/YYYY'))
    });
  });


jQuery('.mobile-menu-toggle').click(function(event) {
  jQuery(this).toggleClass('active');
  jQuery('.mobile-menu-holder').toggleClass('shown');
});

jQuery('.mobile-help').click(function(event) {
  jQuery('.mobile-help-container').addClass('shown');
});

jQuery('.icon-close-help').click(function(event) {
  jQuery('.mobile-help-container').removeClass('shown');
});


// pricing-items expand/collapse

jQuery('.pricing__item-title').click(function(event) {
  var obj = jQuery(this);
  obj
    .closest('div.pricing__item')
    .toggleClass('active')
    .find('.pricing__item-content')
      .slideToggle(300);

  obj
   .closest('div.pricing__item')
     .siblings('div.pricing__item')
       .removeClass('active')
         .find('.pricing__item-content')
         .slideUp(300);

});

jQuery('.vc_tta-tab').click(function(event) {
  /* Act on the event */
  var elements = jQuery(document.body).find('.tower-item');
  euql_height(elements);
});


jQuery(window).on('scroll', function(){
  var top = jQuery(window).scrollTop();


  if(top > jQuery('.home-header').height() + parseInt(jQuery('.home-header').css('padding-top')) + 50){
    jQuery('.home-header-sticky').addClass('shown');
  }else{
    jQuery('.home-header-sticky').removeClass('shown');

  }
})


jQuery(document).ready(function(){
  setTimeout(function(){
  jQuery('.hotel-item-below').each(function(index, el) {
    if(jQuery(el).is(":visible")){
      var parent = jQuery(el).closest('.vc_row');

      if(!parent.hasClass('processed')){
        parent.addClass('processed');

        var title_height = 0;

        parent.find('.hotel-item__title').each(function(title_index, title_el) {
            title_height = Math.max(title_height, jQuery(title_el).height());
        });

        parent.find('.hotel-item__title').css({'min-height': title_height +'px'});

        var text_height = 0;

        parent.find('.hotel-item__text').each(function(title_index, text_el) {
            text_height = Math.max(text_height, jQuery(text_el).height());
        });

        parent.find('.hotel-item__text').css({'min-height': text_height +'px'});

        var category_height = 0;

        parent.find('.hotel-item__categories').each(function(title_index, text_el) {
            category_height = Math.max(category_height, jQuery(text_el).height());
        });

        parent.find('.hotel-item__categories').css({'min-height': category_height +'px'});
      }
    }
  })
  },300);
})

jQuery('.vc_tta-tab').click(function(){
  setTimeout(function(){
  jQuery('.hotel-item-below').each(function(index, el) {
    if(jQuery(el).is(":visible")){
      var parent = jQuery(el).closest('.vc_row');

      if(!parent.hasClass('processed')){
        parent.addClass('processed');

        var title_height = 0;
        parent.find('.hotel-item__title').each(function(title_index, title_el) {
            title_height = Math.max(title_height, jQuery(title_el).height());
        });

        parent.find('.hotel-item__title').css({'min-height': title_height +'px'});

        parent.find('.hotel-item__text').each(function(title_index, text_el) {
            title_height = Math.max(title_height, jQuery(text_el).height());
        });

        parent.find('.hotel-item__text').css({'min-height': title_height +'px'});

        var category_height = 0;

        parent.find('.hotel-item__categories').each(function(title_index, text_el) {
            category_height = Math.max(category_height, jQuery(text_el).height());
        });

        parent.find('.hotel-item__categories').css({'min-height': category_height +'px'});
      }
    }
  })
  },300);
})

jQuery('a[data-anchor]').click(function(event) {
  var anchor = jQuery(this).data('anchor');

  setTimeout(function(){
    var offset = jQuery('#'+anchor).offset().top -160;
    jQuery('html,body').animate({'scrollTop': offset});
  },600)
});

jQuery('.explore-selector2__current').click(function(event) {
  if(jQuery(this).closest('.explore-selector2').data('not') == 'no'){
    jQuery(this).closest('.explore-selector2').toggleClass('active');
  }else{
    var message = jQuery(this).closest('.explore-selector2').data('message');
    var season  = jQuery(this).closest('.explore-selector2').data('season');

    Cookie.set('previous_page_season', season, 7);
    location.reload();
  }
});

jQuery('.explore-selector2 a').click(function(event) {
  if(jQuery(this).closest('.explore-selector2').data('not') == 'no'){
    event.preventDefault();
    url = jQuery(this).attr('href')+'' + location.hash;
    window.location.href = url;
  }else{
    var message = jQuery(this).closest('.explore-selector2').data('message');
    var message = jQuery(this).closest('.explore-selector2').data('message');
    var season  = jQuery(this).closest('.explore-selector2').data('season');
    Cookie.set('previous_page_season', season, 7);
    location.reload();
  }
});

jQuery('.lang-item a').click(function(event) {
    event.preventDefault();
    url = jQuery(this).attr('href')+'' + location.hash;
    window.location.href = url;
});

jQuery('.explore-selector2').hover(function(event) {
}, function(){
  jQuery(this).closest('.explore-selector2').removeClass('active');
});



jQuery('.trigger-sign').click(function(event) {
  event.preventDefault();
  jQuery('.popup-sign-in-wrapper').addClass('shown');
});


jQuery('.icon-close-sign').click(function(event) {
  jQuery('.popup-sign-in-wrapper').removeClass('shown');
});
jQuery('.popup-sign-in-wrapper').click(function(event) {

  if(!jQuery(event.target).closest('.popup-sign-in').length){
    jQuery('.popup-sign-in-wrapper').removeClass('shown');
  }
});

jQuery(document).ready(function(){
  var height = jQuery('.splash-footer-cont').height();
  jQuery('.splash-footer-place').height(height)
  jQuery('.splash-footer-cont').css({'margin-top': '-'+height+'px' });
})


jQuery('#optin_form').on('submit', function(e){
  console.log('do_submit');
  e.preventDefault();

  var $agree = jQuery(this).find('#newsletter_agree');

  var data = {
    firstname: jQuery('.input-first-name'),
    lastname : jQuery('.input-last-name'),
    email    : jQuery('.input-email'),
  }


  var validated = true;

  for(var id in data){
    if(!data[id].val()){
      data[id].addClass('error');
      validated = false;
    }else{
      data[id].removeClass('error');
    }
  }

  if(!$agree.prop('checked')){
    jQuery('.checkbox-imitation').addClass('error');
    validated = false;
  }else{
    jQuery('.checkbox-imitation').removeClass('error');
  }

  if(!validated){
    e.preventDefault();
  }

  var email = data['email'].val();

  var email_exp = /(\S){1,}@(\S){1,}.(\w){1,}/;

  validated = email.match(email_exp)? validated: false;

  if(!validated){
    data['email'].addClass('error');
    e.preventDefault();
  }else{
    data['email'].removeClass('error');
  }

  var data_form = jQuery(this).serializeArray();

  var posted_data = {};

  var string = '';

  for(var inf of data_form){
    posted_data[inf.name] = inf.value;
  }

  jQuery.ajax({
    type: "POST",
    url: jQuery(this).attr('action'),
    contentType: "application/json",
    crossDomain: true,
    dataType: "json",
    data: JSON.stringify({"PostData": posted_data}),
  })

  .done(function(e) {
   if( e.Status == 'Success'){
      if(alert(responce_form_footer)){
      }
        jQuery('.popup-sign-in-wrapper').removeClass('shown')
    }else if(e.Status == 'Error' ){
      if(alert(responce_form_footer_error)){
      }
      jQuery('.popup-sign-in-wrapper').removeClass('shown')
    }
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function(e) {
    console.log(e);
  });
})



jQuery('.switcher').on('change',function(){
  var val = jQuery(this).val();

  jQuery(this).closest('table').find('td.size').each(function(index, el) {
    var data = jQuery(el).data(val);
    jQuery(el).text(data);
  });
})


jQuery('.restaurants-dropdown .select-imitation').click(function(event) {
  jQuery(this).addClass('active');
});

jQuery('.site-container').click(function(event) {
  if(!jQuery(event.target).closest('.select-imitation').length){
    jQuery(this).find('.select-imitation').removeClass('active');
  }
});


jQuery('.icon-shop-popup-close').click(function(){
   jQuery('.shop-popup').removeClass('shown');
   jQuery('.content-popup').addClass('hidden');
})



jQuery(document.body).on('click','.vc_tta-panel-heading',function(){
  if (jQuery(window).width() < 768) {
    if (jQuery(this).closest('.vc_tta-panel').hasClass('vc_active')) {

      var obj = jQuery(this).closest('.vc_tta-panel');
      setTimeout(function(){
        obj.find('.vc_tta-panel-body').slideUp('300', function(){
          obj.find('.vc_tta-panel-body').removeAttr('style');
          obj.removeClass('vc_active');
        })
      },50)
    }
  }
})


jQuery(document.body).on('click', '.next-mob', function(){
  var target = jQuery(this).siblings('.mobile-table');

  var scrollLeft = target.scrollLeft();
  var scrollLeft_old = scrollLeft;

  scrollLeft +=20;

  target.scrollLeft(scrollLeft);
})


jQuery(document.body).on('click', '.prev-mob', function(){
  var target = jQuery(this).siblings('.mobile-table');

  var scrollLeft = target.scrollLeft();
  var scrollLeft_old = scrollLeft;

  scrollLeft -=20;

  target.scrollLeft(scrollLeft);
})

jQuery('.mobile-table').on('scroll',function(e){
  var obj = jQuery(this);

  var scrollLeft = jQuery(this).scrollLeft();
  var width = jQuery(this).width();

  if(scrollLeft == 0){
    obj.siblings('.prev-mob').addClass('visuallyhidden');
  }else{
    obj.siblings('.prev-mob').removeClass('visuallyhidden');
  }

  if(scrollLeft + width === obj[0].scrollWidth){
    obj.siblings('.next-mob').addClass('visuallyhidden');
  }else{

    obj.siblings('.next-mob').removeClass('visuallyhidden');
  }

})


jQuery(document).on('click','img.webcam', function(event) {
  var height_client = jQuery(window).height() * 0.96;
  var width_client  = jQuery(window).width() > 1200? 1200 :jQuery(window).width();
  var height_img    = 0;
  var width_img     = 0;
  jQuery('.popup-wrapper-gallery').addClass('shown');

  jQuery('.popup-gallery-item').find('img').remove();
  jQuery('.popup-gallery-item').find('iframe').remove();
  jQuery('.popup-gallery-item').removeClass('init');
  jQuery('.popup-gallery-item').addClass('visuallyhidden');
  var src = jQuery(this).attr('src');
  jQuery('.popup-wrapper-gallery').append('<img class="spinner" src="/wp-content/themes/velesh_theme/assets/images/spinner.gif">');
  jQuery('.popup-gallery-item').append('<img src="'+src+'"></img>');


  jQuery('.popup-gallery-item').find('img').on('load', function(){

    var img = jQuery('.popup-wrapper-gallery').find('img');
    height_img = img.height();
    width_img  = img.width();

    if(height_img <= height_client && width_img <= width_client){
      jQuery('.popup-gallery-item').width(width_img);
      jQuery('.popup-gallery-item').height(height_img);
    }else{
      var proportion_height   =  height_client/height_img;
      var proportion_width    =  width_client/width_img;
      var proportion          = Math.min(proportion_height, proportion_width).toFixed(2);
      var width_img_new  = width_img*proportion;
      var height_img_new = height_img*proportion;
      jQuery('.popup-gallery-item').width(width_img_new);
      jQuery('.popup-gallery-item').height(height_img_new);
    }

    jQuery('.popup-wrapper-gallery').find('.spinner').remove();
    jQuery('.popup-gallery-item').addClass('init').removeClass('visuallyhidden');
  })
});



jQuery('.career-item').click(function(event) {
  event.preventDefault();

  var id = jQuery(this).data('link');

  jQuery('#'+id).addClass('show');

});



jQuery(document.body).on('click', '.vacancy-popup .icon-close', function(){
  jQuery('.vacancy-popup').removeClass('show');
})


jQuery('.wpcf7-form textarea').on('change, input', function(){
  var text  = jQuery(this).val();
  text = text.replace('http:', '');
  text = text.replace('https:', '');
  text = text.replace('\/', '');
  text = text.replace('www.', '');
  jQuery(this).val(text);
})



jQuery('.expand-form__title').click(function(){
  jQuery(this).toggleClass('expanded');

  jQuery(this).siblings('.expand-form__content').slideToggle()
})

console.log(1);

jQuery('.accept-cookie').click(function(event) {
  jQuery('.cookie-policy').remove();

  Cookie.set('cookie_policy', 'yes');
});

var is_widget = true;


if (is_widget) {

  Vue.component('input-value', {
    template: `<span>{{text}}</span>`,
    data: function () {
      return {
        text      : this._text,
      }
    },

    props:['_text'],

    methods:{
      set: function(t){
        this.text = t;
      }
    }
  })

  Vue.component('childage-input', {
   data: function () {
      return {
        name      : this._name,
        number    : this._number,
        value     : this._value,
      }
    },

    props:['_name', '_value', "_number"],

    template: `
    <div class="row input-ctrl no-gutters">
       <div class="col-5">
       <span class="input-ctrl__label guests-selector__title">Children {{number}} age: </span>
      </div>
      <div class="col-4">
       <select class="select-age" :name="name" v-model="value" id=""><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option></select>
      </div>
    </div>
    `,

    mounted: function(){
      this.$emit('set_childages', {'child_id': this.number - 1, 'age': this.value});
    },

    watch:{
      value: function(val){
        value = Math.min(17, val);
        value = Math.max(0, val);
        this.value = val;
        this.$emit('set_childages', {'child_id': this.number - 1, 'age': this.value});
      }
    },

    methods: {
      cha_form_data: function(id, type){
        var value = (type == 'encr')? this[id]  + 1 : this[id]  - 1 ;

        value = Math.min(17, value);
        value = Math.max(0, value);

        this[id] = value;
      },

      validate: function(){
        var value = Math.min(17, this.value);
        value = Math.max(0, this.value);
        this.value = value;
      }
    }
  })


  Vue.component('daterangepicker', {
   data: function () {
      return {
        name      : this._name,
        text      : this._text,
        date_start : this._date_start,
        date_end   : this._end_str,
      }
    },

    props:['_name', '_text', '_date_start', '_date_end'],

    template: `
      <div class="date-range-picker">
        <span for="dates" class="date-range-picker-trigger" >{{text}}</span>
      </div>
    `,

    mounted: function(){
      var vm   = this;
      var now  = new Date();
      var end  = new Date();
      end.setDate(end.getDate() + 7);

      var date_start = (now.getMonth() + 1) + '/' + now.getDate() + '/' + now.getFullYear();
      var date_end = (end.getMonth() + 1) + '/' + end.getDate() + '/' + end.getFullYear();


      date_start = ('undefined' != typeof(this.date_end))? this.date_end : date_start;
      date_end = ('undefined' != typeof(this.date_end))? this.date_end : date_end;

      setTimeout(function(){
        jQuery(vm.$el).daterangepicker({
          "autoApply": false,
          "alwaysShowCalendars": true,
          "startDate": date_start,
          "endDate": date_end,
           minDate: date_range.start,
           maxDate: date_range.end,
        }, function(start, end, label) {

          var data = {
            date_start : {
              formatted: (theme_locale === 'de_DE')?  start.format('DD/MM/YYYY') :  start.format('MM/DD/YYYY'),
              value:  start.format('YYYY-MM-DD'),
            },
            date_end   : {
              formatted:(theme_locale === 'de_DE')?  end.format('DD/MM/YYYY') :  end.format('MM/DD/YYYY'),
              value:  end.format('YYYY-MM-DD'),
            },
          }

          vm.$emit('daterangepicker_change',data);
       })

      },500)

      jQuery(vm.$el).on('show.daterangepicker', function(ev,picker){
        if (jQuery(vm.$el).closest('.hero-section')) {
          var _el = jQuery(vm.$el).closest('.hero-section');
          var pos = _el.offset().top + _el.height() + parseInt(_el.css('padding-top'))+ parseInt(_el.css('padding-bottom')) + 15;
          jQuery(picker.container[0]).css({'top': pos + 'px'});
        }
      })
    },

    methods: {
      set_text:function(val){
        this.text = val;
      },

      set_dates: function(date_start, date_end){
        jQuery(this.$el).data('daterangepicker').setStartDate(date_start);
        jQuery(this.$el).data('daterangepicker').setEndDate(date_end);
      }
    }
  })

  var widget_mixin = {
    data: {
      form_data:{
        arrive : null,
        depart : null,
        rooms  : 1,
        adult  : 2,
        child  : 0,
        childages : null,
        chain  : 24447,//?
        hotel  : 6911,
        src    : '30',
        locale   : 'en-US',
      },

      childages: [],
      date_start: null,
      date_end: null,
    },

    mounted: function(){

    },

    computed: {
      show_child: function(){
        return this.form_data.child > 0;
      }
    },

    watch: {
      date_start : function(val){
        this.form_data.arrive = val.value;
        this.$refs.arrive.set_text(val.formatted);
      },

      date_end : function(val){
        this.form_data.depart = val.value;
        this.$refs.depart.set_text(val.formatted);
      },

      "form_data.rooms" : function(val){
        this.$refs.rooms.set(val);
      },

      "form_data.adult" : function(val){
        this.$refs.adult.set(val);
      },

      "form_data.child" : function(val){
        this.$refs.child.set(val);

        for(var i = 0; i < val; i++){
          if(typeof(this.childages[i]) === 'undefined'){
            this.childages[i] = 0
          }
        }

        var _sliced = this.childages.slice(0 , val);

        this.form_data.childages = (val > 0)? _sliced.join("|") : null;
      },
    },

    methods:{
      get_daterange: function(e, sourse){
        var vm = this;
        for(id in e){
          this[id] = e[id];
        }

        switch(sourse){
          case 'arrive':
            vm.$refs.depart.set_dates(e.date_start.formatted, e.date_end.formatted);
            break;
          case 'depart':
            vm.$refs.arrive.set_dates(e.date_start.formatted, e.date_end.formatted);
            break;

        }
      },

      cha_form_data: function(id, type){
        var value = (type == 'encr')? this.form_data[id]  + 1 : this.form_data[id]  - 1 ;

        value = Math.min(99, value);
        value = Math.max(0, value);
        this.form_data[id] = value;
      },

      update_childages: function(e){
        this.childages[e.child_id] = parseInt(e.age);
      },

      get_childage: function(n){
        return ( typeof(this.childages[n - 1]) !== 'undefined' )? this.childages[n - 1] : 0;
      },

      submit_form: function(){

        var data = [];

        this.form_data.locale = this.$refs.locale.value;

        for(id in this.form_data){
          if(this.form_data[id]){
            data.push(id +"="+this.form_data[id]);
          }
        }


        if(jQuery(this.$refs.season).val() === 'winter'){
          data.push('theme=winter');
        }


        if(jQuery(this.$refs.season).val() === 'summer'){
          data.push('theme=summer');
        }

        console.log(data);

        var url =jQuery(this.$el).data('url') +'?'+ data.join('&');
        var win = window.open(url, '_blank');
        win.focus();
      }
    }
  }
}

if (jQuery('#check-form-1').length) {

  var widget = new Vue({
    'el' : '#check-form-1',

    mixins: [widget_mixin]

  });
}

if (jQuery('#check-form-2').length) {
    var widget2 = new Vue({
      'el' : '#check-form-2',

      mixins: [widget_mixin]

    });

}

jQuery(document.body).trigger('init_vue');

function init_vue_widget(id, type){

  switch(type){
    case 'book_rooms':
     new Vue({
        'el' : '#'+id,

        mixins: [widget_mixin]

      });

      break;
  }
}

jQuery('document').on('fullscreenchange',function(){
  console.log('fullscreenchange');
})




function apply_tags(images, tag, target_class){
  // if (jQuery('.image-gallery-holder').length) {


    tag = tag.toLowerCase();

    var new_images = [];

    for(id in images){
      var img = images[id];
      var elem = document.createElement('textarea');
      elem.innerHTML = img['tags'];
      var _tag = elem.value;
      if('undefined' !== typeof(_tag) && _tag.toLowerCase().indexOf(tag) >= 0 ){
        new_images.push(img);
      }
    }

    if(tag === 'all'){
      var new_images = images;
    }


    var tmpl_row1 = '<div class="row no-gutters"> <div class="col-12 col-md-custom-52">{img_1}</div> <div class="col-12 col-md-custom-47"> <div class="row no-gutters"> <div class="col-12"> {img_2}</div> <div class="col-12 col-md-6"> {img_3}</div> <div class="col-12  col-md-6">  {img_4} </div> </div> </div> </div';

    var tmpl_row2  = '<div class="row no-gutters"> <div class="col-12  col-md-custom-47"> <div class="row no-gutters"> <div class="col-12">{img_1}</div> <div class="col-12 col-md-6"> {img_2}</div> <div class="col-12 col-md-6">{img_3}</div> </div> </div> <div class="col-12  col-md-custom-52"> {img_4} </div> </div>';

    var tmpl_row3 = '<div class="row no-gutters"> <div class="col-12 col-md-4"> {img_1}</div> <div class="col-12 col-md-4">{img_2}</div> <div class="col-12 col-md-4">{img_3}</div> </div>';

    var img_tpl = '<a href="{full}" onclick="show_gallery_popup(jQuery(this), event)" class="gallery-preview" title="{title}" data-title="{title}" data-url="{url}"> <img src="{img}" alt=""> </a>';


    var map = [
     {
      tmpl : tmpl_row1,
      count : 4,
      thumbs: ['gallery_lg', 'gallery_md', 'gallery_sm', 'gallery_sm'],
     },
     {
      tmpl : tmpl_row2,
      count : 4,
      thumbs: [ 'gallery_md', 'gallery_sm', 'gallery_sm', 'gallery_lg'],
     },
     {
      tmpl : tmpl_row3,
      count : 3,
      thumbs: ['gallery_lg', 'gallery_lg', 'gallery_lg'],
     },
     {
      tmpl : tmpl_row2,
      count : 4,
      thumbs: [ 'gallery_md', 'gallery_sm', 'gallery_sm', 'gallery_lg'],
     }
    ];

    var urls = [];


    var offset = 0;

    var row_number = 0;

    var html = '';

    while (offset < new_images.length){
      var tmpl = map[row_number].tmpl;
      var count = map[row_number].count;
      row_number = (row_number >= map.length )? 0 : row_number;

      var images = new_images.slice(offset, offset+count);

      var images_html = [];

      for( var img_num in images){
        var img = images[img_num];

        var thumb =  map[row_number].thumbs[img_num];



        var search = {
          full: img.full,
          img:   img.thumbs[thumb],
          title: img.title,
          url:   img.link.url,
        };

        images_html.push(str_replace(search, img_tpl));
      }

      row_number++;

      row_number = row_number > 3? 0 :  row_number;

      offset += count;

      var replace = {
        img_1 :(typeof(images_html[0]) !== 'undefined') ? images_html[0] : '',
        img_2 :(typeof(images_html[1]) !== 'undefined') ? images_html[1] : '',
        img_3 :(typeof(images_html[2]) !== 'undefined') ? images_html[2] : '',
        img_4 :(typeof(images_html[3]) !== 'undefined') ? images_html[3] : '',
      };
      html += str_replace(replace, tmpl);
    }

    jQuery('.'+target_class).html(html);
}

// 15n+2  = x  n = x-2/15
// 15n+5
// 15n+12


jQuery('.gallery-tag').click(function(event) {
  jQuery(this).addClass('active').siblings('.gallery-tag').removeClass('active');
});


jQuery('.gallery-preview').click(function(event) {
  var obj = jQuery(this);
  show_gallery_popup(obj, event);
});

function show_gallery_popup(obj, event){
  event.preventDefault();
  var src = obj.attr('href');
  var href = obj.data('url');
  var src_fullsize = src.replace('uploads', 'uploads/backup');

  var height_client = jQuery(window).height() * 0.96;
  var width_client  = jQuery(window).width() > 1200? 1200 :jQuery(window).width();
  var height_img    = 0;
  var width_img     = 0;
  var title = obj.data('title');

  jQuery('.popup-gallery-item')[0].removeAttribute('style');
  jQuery('.popup-wrapper-gallery').find('.load-fullsize').remove();
  jQuery('.popup-wrapper-gallery').addClass('shown');

  jQuery('.popup-wrapper-gallery').append('<img class="spinner" src="/wp-content/themes/velesh_theme/assets/images/spinner.gif">');

  jQuery('.popup-gallery-item').find('img').remove();
  jQuery('.popup-gallery-item').find('iframe').remove();
  jQuery('.popup-gallery-item').removeClass('init');
  jQuery('.popup-gallery-item').addClass('visuallyhidden');

  jQuery('.popup-gallery-item').append('<img src="'+src+'"></img>');

  jQuery('.popup-gallery-item').find('img').on('load', function(){
    var img = jQuery('.popup-wrapper-gallery').find('img');
    height_img = img.height();
    width_img  = img.width();

    if(height_img <= height_client && width_img <= width_client){
      jQuery('.popup-gallery-item').width(width_img);
      jQuery('.popup-gallery-item').height(height_img);
    }else{


      var proportion_height   =  height_client/height_img;
      var proportion_width    =  width_client/width_img;

      var proportion          = Math.min(proportion_height, proportion_width).toFixed(2);

      var width_img_new  = width_img*proportion;
      var height_img_new = height_img*proportion;
      jQuery('.popup-gallery-item').width(width_img_new);
      jQuery('.popup-gallery-item').height(height_img_new);
    }

    jQuery('.popup-wrapper-gallery').find('.spinner').remove();

    jQuery('.popup-gallery-item').addClass('init').removeClass('visuallyhidden');
  })

  jQuery('.popup-gallery-item a').attr({'href': href}).text(title);

  jQuery('.popup-gallery-item').append('<a class="load-fullsize" href="'+src_fullsize+'" download>'+js_translations.gallery.load_fullsize+'</a>');

  if(title){
    jQuery('.popup-gallery-item a').removeClass('hidden')
  }
}


jQuery('.popup-wrapper-gallery .icon-close').click(function(event) {
  jQuery('.popup-wrapper-gallery').removeClass('shown');
  jQuery('.popup-gallery-item img').attr({'src': ''})
  jQuery('.popup-gallery-item a').text('').addClass('hidden');
});

jQuery('.popup-wrapper-gallery').click(function(event) {
  if(!jQuery(event.target).closest('.popup-gallery-item').length){
    jQuery('.popup-wrapper-gallery').removeClass('shown');
    jQuery('.popup-gallery-item img').attr({'src': ''})
    jQuery('.popup-gallery-item a').text('').addClass('hidden');
  }
});
jQuery(document).ready(function(){
  jQuery('.lang-list').each(function(index, el) {
    let obj = jQuery(el);
    let val = obj.find('.lang-list__value');
    let lang_name = obj.find('.current-lang').find('a').text();

    val.text(lang_name);
    obj.addClass('init');
  });
})

jQuery('.lang-list').click(function(){
  jQuery(this).closest('div.lang-list').addClass('expanded');
})

jQuery(document).ready(function(){
  jQuery('.explore-selector').each(function(index, el) {
    let obj = jQuery(el);
    let val = obj.find('.explore-selector__value');
    let lang_name = obj.find('.active').find('a').text();

    val.text(lang_name);
    obj.addClass('init');
  });
})

jQuery('.explore-selector').click(function(){
  jQuery(this).closest('div.explore-selector').addClass('expanded');
})

jQuery(document.body).click(function(e) {
  if(!jQuery(e.target).closest('.lang-list').length){
    jQuery('.lang-list').removeClass('expanded')
  }

  if(!jQuery(e.target).closest('.explore-selector').length){
    jQuery('.explore-selector').removeClass('expanded')
  }
});
var current_date = new Date();

var season = 's';

switch(site_locality){
  case 'en':
    var months = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December',
    ];
    break;
  case 'de':
   var months =[
      'Januar',
      'Februar',
      'März',
      'April',
      'Mai',
      'Juni',
      'Juli',
      'August',
      'September',
      'Oktober',
      'November',
      'Dezember',
    ];
    break;
  case 'ru':
   var months =[
      'Январь',
      'Февраль',
      'Март',
      'Апрель',
      'Май',
      'Июнь',
      'Июль',
      'Август',
      'Сентябрь',
      'Октябрь',
      'Ноябрь',
      'Декабрь',
    ];
    break;
  case 'it':
   var months =[
      'Gennaio',
      'Febbraio',
      'Marzo',
      'Aprile',
      'Maggio',
      'Giugno',
      'Luglio',
      'Agosto',
      'Settembre',
      'Ottobre',
      'Novembre',
      'Dicembre',
    ];
    break;
  case 'fr':
   var months =[
      'Janvier',
      'Février',
      'Mart',
      'Avril',
      'Mai',
      'Juin',
      'Juillet',
      'Août',
      'Septembre',
      'Octobre',
      'Novembre',
      'Décembre',
    ];
    break;
}

function change_date(shift){
  var may_be_date = new Date(current_date);
  var today = new Date();


  var _max_year = 'undefined' !== typeof(max_year)? parseInt(max_year[0]) : today.getFullYear() ;

  var current_year = today.getFullYear();

  may_be_date.setMonth(current_date.getMonth() + shift);
  current_date.setMonth(current_date.getMonth() + shift);

  var new_month = fix_month = current_date.getMonth();

  jQuery('.next').removeClass('visuallyhidden');
  jQuery('.prev').removeClass('visuallyhidden');

  // console.log('current_date');
  // console.log(current_date);
  // console.log(may_be_date);
  // console.log('new_month');
  // console.log(new_month);
  // console.log(shift);
  // console.log('_max_year');
  // console.log(_max_year);

  if(shift == 0){
    if(current_year >= _max_year && current_date.getMonth() == 11){
      jQuery('.next').addClass('visuallyhidden');
    }else{
       jQuery('.next').removeClass('visuallyhidden');
    }

    if(current_date.getMonth() == 0){
      jQuery('.prev').addClass('visuallyhidden');
    }else{
      jQuery('.prev').removeClass('visuallyhidden');
    }

  //   switch(season){
  //     case 's':
  //       if(current_date.getMonth() <= 5){
  //         jQuery('.prev').addClass('visuallyhidden');
  //       }else if(current_date.getMonth() >= 8 && current_year >= _max_year){
  //         jQuery('.next').addClass('visuallyhidden');
  //       }
  //      break;
  //     case 'w':
  //       if(current_date.getMonth() <= 11 && current_date.getMonth() > 3 ){
  //         jQuery('.prev').addClass('visuallyhidden');

  //       }else if(current_date.getMonth() >= 3 && current_year >= _max_year){
  //         jQuery('.next').addClass('visuallyhidden');
  //       }
  //      break;
  //    default:
  //      break;

  //   }

    if(new_month < 5 &&  new_month > 3){
      current_date.setMonth(5);
    }

    if(new_month > 8 && new_month < 11){
      current_date.setMonth(8);
    }

    let date_str = months[current_date.getMonth()] + ' ' + current_date.getFullYear();

    return date_str
  }

  if( shift < 0){
    if( new_month < 5 &&  new_month > 3){
      current_date.setMonth(3);
    }
    if( new_month < 11  && new_month > 8 ){
      current_date.setMonth(8);
    }
  }else if(shift > 0){
    if( new_month > 3 &&  new_month < 5){
      current_date.setMonth(5);
    }
    if( new_month > 8 && new_month < 11){
      current_date.setMonth(11);
    }
  }

  // switch(season){
  //   case 's':
  //     if(new_month <= 5 && shift < 0 ){
  //       may_be_date.setYear(may_be_date.getFullYear() - 1);
  //       if(may_be_date.getFullYear() < current_year){
  //         current_date.setMonth(5);
  //         jQuery('.prev').addClass('visuallyhidden');
  //       }else{
  //         current_date.setMonth(8);
  //         current_date.setYear(current_date.getFullYear() - 1);
  //       }
  //     } else if(new_month > 8 && shift > 0){
  //       may_be_date.setYear(may_be_date.getFullYear() + 1);
  //       if(may_be_date.getFullYear() <=  _max_year ){
  //         current_date.setMonth(5);
  //         current_date.setYear(current_date.getFullYear() + 1);
  //       }else{
  //         current_date.setMonth(8);
  //       }
  //     }

  //     //check arrows

  //     if(shift > 0 && current_date.getMonth() == 8){
  //       may_be_date.setYear(may_be_date.getFullYear() + 1);

  //       if(_max_year < may_be_date.getFullYear()){
  //         jQuery('.next').addClass('visuallyhidden');
  //       }
  //     } else if(shift < 0 && current_date.getMonth() == 5){
  //        may_be_date.setYear(may_be_date.getFullYear() - 1);
  //       if(current_year > may_be_date.getFullYear()){
  //         jQuery('.prev').addClass('visuallyhidden');
  //       }
  //     }
  //     break;

  //   case 'w':
  //     if(([0,1,2,3,11].indexOf(current_date.getMonth()) < 0)  && shift > 0 ){
  //       may_be_date.setYear(may_be_date.getFullYear() + 1);

  //       if(may_be_date.getFullYear() >  _max_year ){
  //         current_date.setMonth(3);
  //         jQuery('.next').addClass('visuallyhidden');
  //       }else if(may_be_date.getFullYear() == _max_year) {
  //         current_date.setMonth(11);
  //       }

  //     }else if(([0,1,2,3,11].indexOf(current_date.getMonth()) < 0 ) && shift < 0){

  //       if(current_year > may_be_date.getFullYear()){
  //         current_date.setMonth(11);
  //         jQuery('.prev').addClass('visuallyhidden');
  //       }else{
  //         current_date.setMonth(3);
  //       }
  //     }

  //     //check arrows

  //     if(shift > 0 && current_date.getMonth() == 3){
  //       may_be_date.setYear(may_be_date.getFullYear() + 1);

  //       if(_max_year <= may_be_date.getFullYear()){
  //         jQuery('.next').addClass('visuallyhidden');
  //       }
  //     } else if(shift < 0 && current_date.getMonth() == 11){
  //       console.log(current_year);
  //       console.log(may_be_date.getFullYear());
  //       if(current_year >= may_be_date.getFullYear()){
  //         jQuery('.prev').addClass('visuallyhidden');
  //       }
  //     }

  //     break;
  // }

    if(current_year >= _max_year && current_date.getMonth() == 11){
      jQuery('.next').addClass('visuallyhidden');
    }else{
       jQuery('.next').removeClass('visuallyhidden');
    }

    if(current_date.getMonth() == 0 && current_year <=  current_date.getFullYear() ){
      jQuery('.prev').addClass('visuallyhidden');
    }else{
      jQuery('.prev').removeClass('visuallyhidden');
    }

  let date_str = months[current_date.getMonth()] + ' ' + current_date.getFullYear();
  return date_str;
}

jQuery(document).ready(function(){
  let date = change_date(0);
  jQuery('.date-selector__value').text(date);
  jQuery(document).trigger('update_events', [current_date] );
})

jQuery('div.date-selector span.prev').click(function(event) {
  let date = change_date(-1);
  jQuery('.date-selector__value').text(date);
  jQuery(document).trigger('update_events', [current_date] );
});

jQuery('div.date-selector span.next').click(function(event) {
  let date = change_date(1);
  jQuery('.date-selector__value').text(date);
  jQuery(document).trigger('update_events', [current_date] );
});

var the_events;

jQuery(document).on('update_events', function(e, date){
  the_events.set_date(date);
})

jQuery('.event_term').click(function(event) {
  var term_id = jQuery(this).data('term');
  the_events.set_category(term_id);
});


if('undefined' !== typeof(theme_events)){
  the_events = new Vue({
    el: '#events',

    data: {
      events:theme_events,
      month: -1,
      year:   -1,
      show: 3,
      counter: 0,
      category : 'all',
      season: '',
      months: [],
    },

    computed: {
      show_prev: function(){
      },

      events_filtered:function(){
        var events_filtered = [];
        var counter = 0
        var all_events = this.events;

        all_events.sort(function(a, b){
          if(typeof(a.meta.date_n_time.date_start) == 'undefined' || typeof(b.meta.date_n_time.date_start) == 'undefined'){
            return 0;
          }
          var start_array_a = a.meta.date_n_time.date_start.split(' ');
          var start_a = start_array_a[0].split('-');
          var date_a = new Date(start_a[0], parseInt(start_a[1]) - 1, start_a[2]);

          var start_array_b = b.meta.date_n_time.date_start.split(' ');
          var start_b = start_array_b[0].split('-');
          var date_b = new Date(start_b[0], parseInt(start_b[1]) - 1, start_b[2]);

          if(date_a == date_b){
            return 0;
          }
          return date_b < date_a? 1: -1;
        });

        for(id in all_events){
          var event = all_events[id];

         if(typeof(event.meta.date_n_time.date_start) == 'undefined' ){

           var validated = false;

          }else{

            var validated = true;
            var start_array = event.meta.date_n_time.date_start.split(' ');
            var start = start_array[0].split('-');
            var date_start = new Date(start[0], parseInt(start[1]) - 1, start[2]);

            var end_array = event.meta.date_n_time.date_end.split(' ');
            var end = end_array[0].split('-');
            var date_end = new Date(end[0], parseInt(end[1]) - 1, end[2]);

            validated = ((date_start.getFullYear() !== this.year && date_end.getFullYear() !== this.year ) || (date_start.getMonth()  !== this.month)) ? false : validated;

            if(this.category !== 'all'){
              var categories = event.meta.categories;
              validated = categories.indexOf(this.category) < 0? false : validated;
            }

            if(validated && (counter < this.show)){
              events_filtered.push(event);
            }
          }

          if(validated){
            counter++;
          }
        }


        this.counter = counter;
        return events_filtered;
      }
    },

    watch: {
      season: function(val){
        // switch(val){
        //   case 's':
        //    this.months = [5,6,7,8];
        //      break;
        //   case 'w':
        //     this.months = [0,1,2,3,11];
        //     break;
        // }

        // season = val;

        // current_date = new Date(this.year, this.month, 1);

      },


      month: function(val){
        var today = new Date();
        var show = (this.year == today.getFullYear() && this.month > today.getMonth()) || this.year > today.getFullYear();

        if(show){
         jQuery('.date-selector .prev').removeClass('visaullyhidden');
        }else{
         jQuery('.date-selector .prev').addClass('visaullyhidden');
        }
      }
    },

    mounted: function(){
      var today = new Date();
      this.season = this.$refs.season.value;
      this.month =  this.get_month();
      this.year  = today.getFullYear();
      jQuery('#events-body').removeClass('hidden');

      this.$forceUpdate();

      var new_month = current_date.getMonth();
    },

    methods:{
      set_date: function(date){
        this.month  = date.getMonth();
        this.year   = date.getFullYear();
        this.show   = 3;
      },

      get_month: function(){
        var date = new Date();
        var month  = date.getMonth();
        this.year  = date.getFullYear();

        if(this.months.indexOf(month) < 0){
          // switch(this.season){
          //   case 's':
          //      if(month > 8){
          //       // this.year++;
          //      }
          //       month = 5;
          //      break;
          //   case 'w':
          //      month = 11;
          //     break;
          // }

          if(month > 8 && month < 11){
            month = 11;
          }else if(month > 3 && month < 5){
            month = 5;
          }
        }

        return month;
      },

      set_category:function(term_id){
        this.category = term_id;
      },
    },
  });
}



jQuery('[href*=events-winter]').click(function(e) {
    e.preventDefault();
    location.href="/events-winter/";
});

jQuery('[href*=events-summer]').click(function(e) {
    e.preventDefault();
  location.href="/events-summer/";
});

jQuery('[href*=de-winter-events]').click(function(e) {
    e.preventDefault();
  location.href="/de/winter-events-veranstaltungen/";
});

jQuery('[href*=events-sommer]').click(function(e) {
    e.preventDefault();
    location.href="/de/events-veranstaltungen-sommer/";
});

jQuery('[href*=events-ru-summer]').click(function(e) {
    e.preventDefault();
  location.href="/ru/events-ru-summer/";
});

jQuery('[href*=events-ru-winter]').click(function(e) {
    e.preventDefault();
  location.href="/ru/events-ru/";
});
jQuery(document).ready(function(){
  jQuery('.form-datepicker').daterangepicker({
    "autoApply": false,
    "alwaysShowCalendars": true,

  }, function(start, end, label) {
    var data = {

      date_start : {
        formatted: start.format('MM/DD/YYYY'),
        value:  start.format('YYYY-MM-DD'),
      },
      date_end   : {
        formatted: end.format('MM/DD/YYYY'),
        value:  end.format('YYYY-MM-DD'),
      },
    }

    jQuery('.form-datepicker [name=start_date]').val(start.format("MMMM D, YYYY"))
    jQuery('.form-datepicker [name=end_date]').val(end.format("MMMM D, YYYY"))

 })
})
jQuery('.vc_tta-tab').click(function(){
  var target = jQuery('.site-container').find('.tab-target-collapse');

  if(jQuery(this).is(':first-child') && target.length && !target.is(':visible')){
      target.slideDown();
  }

  if(!jQuery(this).is(':first-child') && target.length && target.is(':visible')){
      target.slideUp();
  }
})

jQuery('.trigger-iframe').click(function(e){
  e.preventDefault();
  var url = jQuery(this).find('a').attr('href');
   jQuery('.popup-iframe-wrapper').addClass('shown').find('iframe').attr({src: url});
})

// jQuery('.career-item').click(function(e){
//   e.preventDefault();
//   var url = jQuery(this).data('link');
//    jQuery('.popup-iframe-wrapper').addClass('shown').find('iframe').attr({src: url});
// })



jQuery('.close-popup-iframe').click(function(){
  jQuery('.popup-iframe-wrapper').removeClass('shown').find('iframe').attr({src: ''});
})

jQuery('.popup-iframe-wrapper').click(function(e){
  if(!jQuery(e.target).closest('.popup-iframe').length){
    jQuery('.popup-iframe-wrapper').removeClass('shown').find('iframe').attr({src: ''});
  }
})

jQuery('.camera-iframe').click(function(e) {
  jQuery('.popup-wrapper-gallery').find('.spinner').remove();
  jQuery('.popup-wrapper-gallery').append('<img class="spinner" src="/wp-content/themes/velesh_theme/assets/images/spinner.gif">');
  e.preventDefault();
  var url = jQuery(this).closest('a').attr('href');
   jQuery('.popup-iframe-wrapper').addClass('shown').find('iframe').attr({src: url});


});
jQuery(document).ready(function(){
  init_room_slider();
  init_mount_carousel();
  init_featured_carousel();
  init_carousel_2();

  init_weather();
})


jQuery(document).ready(function(){
  if('undefined' !== typeof(previous_page_season)){
    Cookie.set('previous_page_season', previous_page_season, 7);
  }
})



jQuery(document).ready(function(){
  jQuery('.mobile-table').each(function(index, el) {
    jQuery(el).wrap('<div class="relative-pos"></div>');
    jQuery(el).after('<div class="next-mob"><span class="arrow"></span><span class="arrow"></span><span class="arrow"></span></div>');
    jQuery(el).after('<div class="prev-mob visuallyhidden"><span class="arrow"></span><span class="arrow"></span><span class="arrow"></span></div>');
  });
})

jQuery(document).ready(function(){
  if('undefined' !== typeof(theme_locale)){
    Cookie.set('theme_locale', theme_locale, 7);
  }
})