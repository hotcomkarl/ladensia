jQuery(document).ready(function($) {
    
    $('.products ul li:nth-child(4n)').css('margin-right', '0px');
    
    $("#accordion").accordion({
        fillSpace: true
    });
        
    $( "#accordion_resizer" ).resizable({
        minHeight: 140,
        resize: function() {
            $( "#accordion" ).accordion( "resize" );
        }
    });
    
    if(gallerific == 'set') {

        // We only want these styles applied when javascript is enabled
        $('div.navigation').css({
            'width' : '350px',
            'float' : 'left'
        });
        $('div.content').css('display', 'block');

        // Initially set opacity on thumbs and add
        // additional styling for hover effect on thumbs
        var onMouseOutOpacity = 0.67;
        $('#thumbs ul.thumbs li').opacityrollover({
            mouseOutOpacity:   onMouseOutOpacity,
            mouseOverOpacity:  1.0,
            fadeSpeed:         'fast',
            exemptionSelector: '.selected'
        });

        // Initialize Advanced Galleriffic Gallery
        var gallery = $('#thumbs').galleriffic({
            delay:                     2500,
            numThumbs:                 15,
            preloadAhead:              10,
            enableTopPager:            true,
            enableBottomPager:         true,
            maxPagesToShow:            7,
            imageContainerSel:         '#slideshow',
            controlsContainerSel:      '#controls',
            captionContainerSel:       '#caption',
            loadingContainerSel:       '#loading',
            renderSSControls:          true,
            renderNavControls:         true,
            playLinkText:              'Play Slideshow',
            pauseLinkText:             'Pause Slideshow',
            prevLinkText:              '&lsaquo; Previous Photo',
            nextLinkText:              'Next Photo &rsaquo;',
            nextPageLinkText:          'Next &rsaquo;',
            prevPageLinkText:          '&lsaquo; Prev',
            enableHistory:             false,
            autoStart:                 false,
            syncTransitions:           true,
            defaultTransitionDuration: 900,
            onSlideChange:             function(prevIndex, nextIndex) {
                // 'this' refers to the gallery, which is an extension of $('#thumbs')
                this.find('ul.thumbs').children()
                .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                .eq(nextIndex).fadeTo('fast', 1.0);
            },
            onPageTransitionOut:       function(callback) {
                this.fadeTo('fast', 0.0, callback);
            },
            onPageTransitionIn:        function() {
                this.fadeTo('fast', 1.0);
            }
        });
    }
   
});


var last_added;

$("p .button_buy").click(function() {
    productId = $(this).val();
    var value;
    ajax = $.ajax({
        url: "cart/"  + productId + "/"
    });

    price = $(this).parent().next('p').children(".price").text();
    value = price.replace('€', '');

    if(last_added != undefined) {
        price = parseFloat(value) + parseFloat(last_added);
    } else {
        price = value;
    }
    $(".cart_value").fadeOut("slow");

    $(".cart_value").text(price + "€");
    $(".cart_value").fadeIn("slow");
    last_added = value;
});

$('#cat_nav li').append('<img src="/bundles/ladensiastorewebshop/images/trenner.png" alt="" />');
$('#cat_nav li:last img').css({'display' : 'none'});

$('#footer li a').append('<img src="/bundles/ladensiastorewebshop/images/arrow_grey_small.png" alt="arrow" class="footer_arrow" />');

$('.footer_container:last').css('margin-right', '0px');

$(function() {


    $.fx.speeds._default = 1000;
    //$( "#dialog:ui-dialog" ).dialog( "destroy" );

    $( "#dialog-login" ).dialog({
        autoOpen: false,
        height: 200,
        width: 300,
        modal: true,
        position: ['right','top'],
        overlay: "display: none",
        show: "blind",
        buttons: {
            "Login": function() {

            },
            "Abbrechen": function() {
                $( this ).dialog( "close" );
            }
        }

    });

    $( ".login-message" ).click(function() {
        console.log("click funktion");
        $( "#dialog-login" ).dialog( "open" );
        return false;
    });

});

$('#login-overlay').hide();


/* cart */

$('.productQuantity').click(function() {
    $(this).select();
});

$('#btnUpdate').click(function() {
    var elem = $('.productQuantity');
    
    $.each(elem, sumPrice(elem));
})
    
$('.productQuantity').blur(function(e) {
    sumPrice(this);
});

function sumPrice(element) {
    var count = $(element).val();
    var price = $(element).next().val();
    
    var price_sum = price * count;
    
    price_sum = price_sum.toFixed(2); 
    
    $(element).parent().next().children('span').text(price_sum);
}

/**
* Tabs
*/
$(function() {
    $( "#tabs" ).tabs();
});

$("ul.tabs").tabs("div.panes > section");

$(function(){
        $('.wide').columnize({
                width : 200,
                height : 400
        });
});

$(function() {
        $( ".slider_price" ).slider();
});

$('.cat_icon').hover(function() {
    $('.cat_box').css({'display' : 'block'});
},
function() {
    $('.cat_box').css({'display' : 'none'});
}
);

$('.cat_box').hover(function() {
    $('.cat_box').css({'display' : 'block'});
},
function() {
    $('.cat_box').css({'display' : 'none'});
}
);

/* product details selectbox */

$('.optiongroup').coreUISelect();
