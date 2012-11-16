$(document).ready(function() {
    jQuery('ul.menu').superfish();




  /*  $(".third-menu li a").each(function(i){

        if (this.attr('href').replace('/','')

               ===

        (location.href.split('/')[3])
        )   alert ('fsd');

    })      */

    (function($) {
        $(function() {

            $('ul.list').delegate('li:not(.current)', 'click', function() {

                $(this).addClass('current').siblings().removeClass('current').parents('.tabs-outer').find('.tab-box').hide().eq($(this).index()).fadeIn(150);

            });

        });

    })(jQuery);

    $(function() {
        $(".1 .slid").jCarouselLite({
            btnNext: ".1  .next-a",
            btnPrev: ".1  .prew-a",
            circular: false
        });
    });

/*
    $(".slid ul li img").click(function() {
        $("#largeImg").attr("src", $(this).attr("src"));
    });

  */


    (function($) {
        $(function() {

            $('ul.linkss').delegate('li:not(.activ)', 'click', function() {

                $(this).addClass('activ').siblings().removeClass('activ').parents('.tabs-outer').find('ul.catalog').hide().eq($(this).index()).fadeIn(150);

            });

        });
        $(function() {
            $('ul.list').delegate('li:not(.act)', 'click', function()
            {$(this).addClass('act').siblings().removeClass('act');
            });
        });

    })(jQuery);


    $(".third-menu li a").each(function(i){
        if(this.toString().split('/')[3]==location.href.split('/')[3])
        {  $(this).parent('li').css({

          //  '-webkit-box-shadow':'#000 0px 0px 12px inset',
            'font-weight':'bold'

        });
            $(this).removeAttr('href').css('text-decoration','none');
         //   $(this).next('span').empty();
           // $(this).prevAll('span').empty();
            //  $(this).closest('li').prev('li').closest('span').empty();
            // alert($(this).text());
        }


    })
});