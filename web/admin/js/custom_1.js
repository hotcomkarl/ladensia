var COOKIE_NAME = 'cookie';
var COOKIE_NAME_NAV = 'nav';
var CookieExpiry = 365;
var sortableCookie = "sortable-order";
var sortableList = ".sortable-list";
var menuYloc = null;
var options = {
    expires: CookieExpiry, 
    path: "/"
};

$(document).ready(function() {

    //Sortable
    $(function() {
        $(sortableList).sortable( {
            cursor: 'crosshair',
            update: function(event, ui) {
                if ($.cookie) {
                    $.cookie(sortableCookie, $(this).sortable("toArray"), options
                        );
                }
            }
        });
        $(sortableList).disableSelection();
    });

    //Datepicker
    $(function() {
        if(COOKIE_NAME) {
            $( "#datepicker" ).datepicker( $.datepicker.regional[ $.cookie(COOKIE_NAME) ] );
        }
        else {
            $.datepicker.setDefaults( $.datepicker.regional[ "de" ] );
            $( "#datepicker" ).datepicker( $.datepicker.regional[ "de" ]  );
        }
        $( "#locale" ).change(function() {
            $( "#datepicker" ).datepicker( "option",
                $.datepicker.regional[ $( this ).val() ] );
        });
     
    });

    //Navigation Links
    $(document).ready(function(){
        $('.site').hide();

        $('.navigation li:first').addClass('active').show();

        $('#navi li:first').addClass('active').show();
        $('.site:first').show();

        $('.navigation li').click(function(){
            $('.navigation li').removeClass('active');
            $(this).addClass('active');

            $('.site').hide();
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn('slow');
            return false;
        });

        $('.navigation2 li').click(function(){
            $('.navigation2 li').removeClass('active');
            $(this).addClass('active');

            $('.site').hide();
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn('slow');
            return false;
        });

        $('#navi li').click(function(){
            $('#navi li').removeClass('active');
            $(this).addClass('active');

            $('.site').hide();
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).fadeIn('slow');
            return false;
        });

    });

    //Main Navigation
    $(function() {
        $( "#main_nav li" ).click(function() {
            $( "#main_nav li" ).removeClass('active');
            $(this).addClass('active');
        });

    });

    if ($.cookie) {
        restoreSortableList(sortableList, sortableCookie);
    }


    function restoreSortableList(sortable, cookieName) {
        var list = $(sortable);
        if (!list) return;

        // fetch the saved cookie
        var cookie = $.cookie(cookieName);
        if (!cookie) return;

        // create array from cookie
        var IDs = cookie.split(",");

        // fetch current order
        var items = list.sortable("toArray");

        // create associative array from current order
        var current = [];
        for ( var v=0; v < items.length; v++ ){
            current[items[v]] = items[v];
        }

        for (var i = 0, n = IDs.length; i < n; i++) {
            // item id from saved order
            var itemID = IDs[i];

            if (itemID in current) {
                // select the item according to the saved order and reappend it to the list
                $(sortable).append($(sortable).children("#" + itemID));
            }
        }
    }
    //    test = $("#locale").val();
    //    alert(test);
    //datepicker locale cookie
    $('#locale').click(function(){
        var locale = $('#locale').val();
        $.cookie(COOKIE_NAME, locale, options);
    });
    if(COOKIE_NAME) {
        $('#locale').val($.cookie(COOKIE_NAME));
    }
    
    //navigation cookie
//    $('.navigation').click(function(){
//       var nav =  $('.navigation li').addClass('active').show();
//       alert(nav);
//       $.cookie(COOKIE_NAME_NAV, nav, options);
//    });
//    if(COOKIE_NAME_NAV) {
//        $('.navigation li').addClass($.cookie(COOKIE_NAME_NAV));
//    }
    

    $('.chevron').click(function(){
        if ($(this).hasClass('toggle-up')) {
            if (!$.browser.msie) {
                $('.shortcuts').slideUp();
            } else {
                $('.shortcuts').hide();
            }
        } else {
            if (!$.browser.msie) {
                $('.shortcuts').slideDown();
            } else {
                $('.shortcuts').show();
            }
        }
        $(this).toggleClass('toggle-up');
    });

    /**
     * Skin file input elements
     */
    $(':file').each(function(){
        var file = this;
        $(this).attr('size', 25).wrap('<span class="ui-file" />')
        .before('<span class="ui-file-value">Keine Datei ausgewählt</span><button class="ui-file-button button button-gray">Browse...</button>')
        .change(function(){
            $(file).parent().find('.ui-file-value').html($(this).val()? $(this).val() : 'No file chosen');
        })
        .hover(
            function(){
                $(file).prev().addClass('hover');
            },
            function(){
                $(file).prev().removeClass('hover');
            }
            ).mousedown(function(){
            $(file).prev().addClass('active');
        })
        .bind('mouseup mouseleave', function(){
            $(file).prev().removeClass('active');
        })
        .parent().disableSelection();
    });
    
    /**
     * Skin select elements
     */
    $('select:not([multiple])').each(function(){
        var select = this;
        $(this).wrap('<span class="ui-select" />')
            .before('<span class="ui-select-value" />')
            .bind('change click', function(){
                $(this).prev().html($(this).find('option:selected').text());
            })
            .after('<a class="ui-select-button button button-gray"><span></span></a>')
            .prev().html($(this).find('option:selected').text());
        $(this).mousedown(function(){
            $(this).next().addClass("active");
        }).mouseup(function(){
            $(this).next().removeClass("active");
        }).hover(function(){
            $(this).next().addClass("hover");
        }, function(){
            $(this).next().removeClass("hover");
        }).parent().disableSelection();
    });

    /**
     * Setup tooltips
     */
    $('[title]').tooltip({
        effect: 'slide',
        offset: [-20, 0],
        position: 'top center',
        layout: '<div><em/></div>',
        onBeforeShow: function() {
            this.getTip().each(function(){
                if ($.browser.msie) {
                    PIE.attach(this);
                }
            });
        },
        onHide: function() {
            this.getTip().each(function(){
                if ($.browser.msie) {
                    PIE.detach(this);
                }
            });
        }
    }).dynamic({
        bottom: {
            direction: 'down',
            bounce: true
        }
    });

    /**
     * Setup the Accordions
     */
    $(".accordion").tabs(".accordion section", {
        tabs: 'header',
        effect: 'slide',
        initialIndex: null
    });

    /**
     * Setup the Tabs
     */
    $("ul.tabs").tabs("div.panes > section");

    /**
     * Setup the Sidebar tabs
     */
    $("ul.sidebar-tabs").tabs("div.panes > section");

    /**
     * attach calendar to date inputs
     */
    $(":date")
    .wrap('<span class="ui-date" />')
    .dateinput({
        trigger: true,
        format: 'mm/dd/yyyy',
        selectors: true
    })
    .focus(function(){
        $(this).parent().addClass('ui-focused');
        return false;
    })
    .blur(function(){
        $(this).parent().removeClass('ui-focused');
        return false;
    });

    /**
     * add close buttons to closeable message boxes
     */
    $(".message.closeable").prepend('<span class="message-close"></span>')
    .find('.message-close')
    .click(function(){
        $(this).parent().fadeOut(function(){
            $(this).remove();
        });
    });

    /**
     * setup popup balloons (add contact / add task)
     */
    $('.has-popupballoon').click(function(){
        // close all open popup balloons
        $('.popupballoon').fadeOut();
        $(this).next().fadeIn();
        return false;
    });

    $('.popupballoon .close').click(function(){
        $(this).parents('.popupballoon').fadeOut();
    });
    
    /**
     * html element for the help popup
     */
    $('body').append('<div class="apple_overlay black" id="overlay"><iframe class="contentWrap" style="width: 100%; height: 500px"></iframe></div>');


    /**
     * this is the help popup
     */
    $("a.help[rel]").overlay({

        effect: 'apple',

        onBeforeLoad: function() {

            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".contentWrap");

            // load the page specified in the trigger
            wrap.attr('src', this.getTrigger().attr("href"));
        }

    });

    /**
     * Form Validators
     */
    // Regular Expression to test whether the value is valid
    $.tools.validator.fn("[type=time]", "Please supply a valid time", function(input, value) {
        return (/^\d\d:\d\d$/).test(value);
    });

    $.tools.validator.fn("[data-equals]", "Value not equal with the $1 field", function(input) {
        var name = input.attr("data-equals"),
        field = this.getInputs().filter("[name=" + name + "]");
        return input.val() === field.val() ? true : [name];
    });

    $.tools.validator.fn("[minlength]", function(input, value) {
        var min = input.attr("minlength");

        return value.length >= min ? true : {
            en: "Please provide at least " +min+ " character" + (min > 1 ? "s" : "")
        };
    });

    $.tools.validator.localizeFn("[type=time]", {
        en: 'Please supply a valid time'
    });

    /**
     * setup the validators
     */
    $(".form").validator({
        position: 'bottom left',
        offset: [5, 0],
        messageClass:'form-error',
        message: '<div><em/></div>' // em element is the arrow
    }).attr('novalidate', 'novalidate');

    /**
     * Table Sorting, Row Selection and Pagination
     */
    if ($.paginate) {
        $("table.paginate").paginate({
            rows: 10,
            buttonClass: 'button-blue'
        });
    }
    if ($.tablesort) {
        $("table.tablesort").tablesort();
    }
    if ($.selectable) {
        $("table.selectable").selectable({
            onSelect: function(row) {
            // do something
            },
            onDeselect: function(row) {
            // do something
            }
        });
    }

    /**
     * Setup details viewing for table
     */
    $('table tr a.view-details').each(function(){
        var a = $(this);
        $(this).next().overlay({
            effect: $.browser.msie? 'default' : 'drop',
            top: 'center',
            mask: {
                color: '#000',
                loadSpeed: 200,
                opacity: 0.5
            },
            onClose: function() {
                this.getOverlay().appendTo(a.parent());
            }
        });
    }).click(function(){
        $(this).next().appendTo('body').overlay().load();
        return false;
    });
    
    // loading animation
    $.tools.overlay.addEffect("drop", function(css, done) { 
   
        // use Overlay API to gain access to crucial elements
        var conf = this.getConf(),
        overlay = this.getOverlay();           
   
        // determine initial position for the overlay
        if (conf.fixed)  {
            css.position = 'fixed';
        } else {
            css.top += $(window).scrollTop();
            css.left += $(window).scrollLeft();
            css.position = 'absolute';
        } 
   
        // position the overlay and show it
        overlay.css(css).show();
   
        // begin animating with our custom easing
        overlay.animate({
            top: '+=55',  
            opacity: 1,  
            width: '+=20'
        }, 400, 'drop', done);
   
    /* closing animation */
    }, function(done) {
        this.getOverlay().animate({
            top:'-=55', 
            opacity:0, 
            width:'-=20'
        }, 300, 'drop', function() {
            $(this).hide();
            done.call();      
        });
    });
    
    //$(".dashboard-table tr").last().addClass("removeStyle");
    $(".dashboard-table tr:even").addClass("code");

});

//categories del
function deleteCategory(catId)
{
	if (confirm('Wenn Sie diese Kategorie löschen, werden auch alle Artikel in dieser gelöscht.\nWollen Sie trotzdem fortfahren?')) {
		window.location.href = 'processCategory.php?action=delete&catId=' + catId;
	}
}