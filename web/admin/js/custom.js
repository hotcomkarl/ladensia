// HTML5 placeholder plugin version 0.3
// Enables cross-browser* html5 placeholder for inputs, by first testing
// for a native implementation before building one.
//
// USAGE: 
//$('input[placeholder]').placeholder();

(function($){
  
    $.fn.placeholder = function(options) {
        return this.each(function() {
            if ( !("placeholder"  in document.createElement(this.tagName.toLowerCase()))) {
                var $this = $(this);
                var placeholder = $this.attr('placeholder');
                $this.val(placeholder).data('color', $this.css('color')).css('color', '#aaa');
                $this
                .focus(function(){
                    if ($.trim($this.val())===placeholder){
                        $this.val('').css('color', $this.data('color'));
                    }
                })
                .blur(function(){
                    if (!$.trim($this.val())){
                        $this.val(placeholder).data('color', $this.css('color')).css('color', '#aaa');
                    }
                });
            }
        });
    };
}(jQuery));

var COOKIE_NAME = 'cookie';
var COOKIE_NAME_NAV = 'nav';
var CookieExpiry = 365;
var sortableCookie = "sortable-order";
var sortableList = ".sortable-list";
var menuYloc = null;
var sortableName = ".sortable";
var options = {
    expires: CookieExpiry, 
    path: "/"
};

// perform JavaScript after the document is scriptable.
$(document).ready(function() {
    
    //Sortable
    $(function() {
        $(sortableList).sortable( {
            cursor: 'crosshair',
            update: function(event, ui) {
                if ($.cookie) {
                    $.cookie(sortableCookie, $(this).sortable("toArray"), options);
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
            $( "#datepicker" ).datepicker( 
                $.datepicker.regional[ "de" ]
                );    
        }
        

        
        $( "#datepicker" ).datepicker({
            onSelect: function(date) {
                alert(date)
                console.log(date);
            },
            selectWeek: true,
            inline: true,
            startDate: '01/01/2000',
            firstDay: 1
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

    /**
     * Main Menu Shortcuts Toggle
     */
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
     * Skin file input elements
     */
    $(':file').each(function(){
        var file = this;
        $(this).attr('size', 25).wrap('<span class="ui-file" />')
        .before('<span class="ui-file-value">Keine Datei ausgewählt</span><button class="ui-file-button button button-gray">Suchen...</button>')
        .change(function(){
            $(file).parent().find('.ui-file-value').html($(this).val()? $(this).val() : 'Keine Datei ausgewählt');
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
     * Setup tooltips
     */
    /*$('[title]').tooltip({
        effect: 'slide', 
        offset: [-14, 0], 
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
    });*/

    /**
     * Setup the Tabs
     */
    $("ul.tabs").tabs("div.panes > section");

    /**
     * Setup the Sidebar tabs
     */
    $("ul.sidebar-tabs").tabs("div.panes > section");
    
    /**
     * Textbox Placeholder
     */
    $('input[placeholder]').placeholder();

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
     * floating menu
     */
    if ($('#wrapper > header').length>0) {
        menuYloc = parseInt($('#wrapper > header').css("top").substring(0,$('#wrapper > header').css("top").indexOf("px")), 10);
    }
    $(window).scroll(function () {
        var offset = 0;
        if ($('#wrapper > header').length>0) {
            offset = menuYloc+$(document).scrollTop();
            if (!$.browser.msie) {
                $('#wrapper > header').animate({
                    opacity: ($(document).scrollTop()<=10? 1 : 0.8)
                });
            }
        }
    });

    if (!$.browser.msie) {
        $('#wrapper > header').hover(
            function(){
                $(this).animate({
                    opacity: 1
                });
            },
            function(){
                $(this).animate({
                    opacity: ($(document).scrollTop()<=10? 1 : 0.8)
                });
            }
            );
    }

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

    if ($(sortableName).sortable) {
        $(sortableName).sortable({
            cursor: 'move',
            revert: 500,
            opacity: 0.7,
            appendTo: 'body',
            handle: 'header',
            items: '.widget-container[draggable=true]',
            placeholder: 'widget-placeholder grid_2',
            forcePlaceholderSize: true,
            start: function(event, ui) {
                ui.item.addClass('start-drag');
            },
            stop: function(event, ui) {
                ui.item.removeClass('start-drag');
            },
            update: function(event, ui) {
                if ($.cookie) {
                    $.cookie(sortableCookie, $(this).sortable("toArray"), {
                        expires: sortableCookieExpiry, 
                        path: "/"
                    });
                }
            }
        }).disableSelection();
    }

    /**
     * restore the order of sortable widgets
     */
    if ($.cookie) {
        restoreOrder(sortableName, sortableCookie);
    }

    /**
     * Widget Drag and Drop
     */
    $('.widget-container .widget')
    .hover(
        function(){
            if (!$(this).parent().hasClass('start-drag')) {
                $(this).find('header').animate({
                    height : 30
                }).parents('.widget-container').siblings(':not(.start-drag)').find('header').animate({
                    height: 4
                });
            }
            return false;
        },
        function() {
            if (!$(this).parent().hasClass('start-drag')) {
                $(this).find('header').animate({
                    height : 4
                })
            }
            return false;
        }
        )
    .find('.widget-close').click(function(){
        $(this).parents('.widget-container').fadeOut(function(){
            $(this).remove();
        });
        // perhaps call an ajax function to remember the widget is closed
        // $.ajax({url: "somescript.php", data: {widgetId: $(this).parents('.widget-container').attr('id')});
        return false;
    })
    .parents('.widget-container').each(function(){
        $(this).css({
            height: $(this).find('.widget').height()+30
        }, "slow");
    });

    /**
     * Widget overlays
     */
    $(".widget.has-details > section").each(function(){
        var section = this;
        $(section).append('<a class="rollover" />')
        .find('.rollover')
        .attr('rel', $(section).prev().find('h2 > a').attr('rel'))
        .hover(
            function(){
                $(this).animate({
                    opacity: 0.6
                });
            },
            function(){
                $(this).animate({
                    opacity: 0
                });
            }
            ).parents('.widget').find('.rollover[rel]').overlay({
            effect: $.browser.msie? 'default' : 'drop',
            top: 'center',
            mask: {
                color: '#000',
                loadSpeed: 200,
                opacity: 0.5
            }
        });
    });


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
        //console.log($(this).next());
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
    
    /**
     * Overlay form for editing details
     */
    $('table tr a.form-edit').each(function(){
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
            //console.log(a.parent());
            }
        });
    }).click(function(){
        
        $(this).next().appendTo('body').overlay().load();
        return false;
    });
    
    /**
     * Overlay form for add new
     */
    $('a.form-new').each(function(){
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
            //console.log(a.parent());
            }
        });
    }).click(function(){
        
        $(this).next().appendTo('body').overlay().load();
        return false;
    });

});

/**
 * Restores the sortable order from a cookie
 */
function restoreOrder(sortable, cookieName) {
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


/**
 * Custom jQuery Tools Overlay Effect, thanks to the great guys at flowplayer.org :)
 */
// create custom animation algorithm for jQuery called "drop" 
$.easing.drop = function (x, t, b, c, d) {
    return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
};

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

/*
*
*
* Dialog Boxen
*
*/

var cat_id, ticket_id, news_id, product_id, site_id, posting_id;
var xmlhttp;

function setCatId(id) {
    cat_id = id;
};

function setProductId(id) {
    product_id = id;
};

function setTicketId(id) {
    ticket_id = id;
}

function setNewsId(id) {
    news_id = id;
}

function setSiteId(id) {
    site_id = id;
}

function setPostingId(id) {
    posting_id = id;
}

$(function() {
    
    
    $.fx.speeds._default = 1000;
    //$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
    $( "#dialog-confirm" ).dialog({
        autoOpen: false,
        height: 200,
        modal: true,
        buttons: {
            "Löschen": function() {
                if(cat_id >= 0) {
                    $.ajax({
                        url: "/admin/cat_del/" + cat_id + "/"
                    })
                } else if(ticket_id >= 0) {
                    $.ajax({
                        url: "/admin/delete_ticket/" + ticket_id + "/"
                    })
                } else if(news_id >= 0) {
                    $.ajax({
                        url: "/admin/delete_info/" + news_id + "/"
                    })
                } else if(product_id >= 0) {
                    $.ajax({
                        url: "/admin/product_delete/" + product_id + "/"
                    })
                } else if(site_id >= 0) {
                    $.ajax({
                        url: "/admin/delete_site/" + site_id + "/"
                    })
                } else if(posting_id >= 0) {
                    $.ajax({
                        url: "/admin/delete_news/" + posting_id + "/"
                    })
                }
                
                $( this ).dialog( "close" );
                $( "#dialog-success" ).dialog( "open" );
                
                if(cat_id >= 0) {
                    $( "#" + cat_id ).hide();
                } else if(ticket_id >= 0) {
                    $( "#" + ticket_id ).hide();
                } else if(news_id >= 0) {
                    $( "#" + news_id ).hide();
                } else if(product_id >= 0) {
                    $( "#" + product_id ).hide();
                } else if(site_id >= 0) {
                    $( "#" + site_id ).hide();
                } else if(posting_id >= 0) {
                    $( "#" + posting_id ).hide();
                }
                
                setTimeout(function(){
                    $( "#dialog-success" ).dialog( "close" );
                }, 1500)
            },
            "Abbrechen": function() {
                $( this ).dialog( "close" );
            }
        }
        
    });
    
    $( ".confirm-message" ).click(function() {
//        console.log("click funktion");
        $( "#dialog-confirm" ).dialog( "open" );
        return false;
    });
    
    $( "#dialog-success" ).dialog({
        autoOpen: false,
        height:140,
        modal: true
        
    });
});

/*
 *
 * textarea editor
 * 
 */

//var editor;
//
//if(editor == 'set') {
//    bkLib.onDomLoaded(function() {
//        new nicEditor({
//            buttonList : ['fontSize','bold','italic','underline','strikeThrough','ol','ul','hr','html','image']
//        }).panelInstance('editor');
//    });
//}

/*
 * 
 * Charts
 * 
 */

var chart1, chart2, chart3;

//Gesamtumsatz Kunden
$(document).ready(function(){
    if(chart1 == 'set') {
        var line1=[['15-May-11', 578.55], ['15-Jun-11', 566.5], ['15-Jul-11', 480.88], ['15-Aug-11', 509.84],
        ['15-Sep-11', 454.13], ['15-Oct-11', 379.75], ['15-Nov-11', 900], ['15-Dec-11', 308.56],
        ['15-Jan-12', 299.14], ['15-Feb-12', 346.51], ['15-Mar-12', 325.99], ['15-Apr-12', 386.15]];
        var plot1 = $.jqplot('chart1', [line1], {
            title:'Gesamtumsatz Ihrer Kunden',
            axes:{
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{
                        formatString:'%b&nbsp;%#d'
                    }
                },
                yaxis:{
                    tickOptions:{
                        formatString:'$%.2f'
                    }
                }
            },
            highlighter: {
                show: true,
                sizeAdjust: 7.5
            },
            cursor: {
                show: false
            }
        });
    }
});

//Bestellungen
$(document).ready(function(){
    if(chart2 == 'set') {
        var line2=[['15-May-11', 30], ['15-Jun-11', 30], ['15-Jul-11', 40], ['15-Aug-11', 52],
        ['15-Sep-11', 60], ['15-Oct-11', 60], ['15-Nov-11', 90], ['15-Dec-11', 111],
        ['15-Jan-12', 200], ['15-Feb-12', 500], ['15-Mar-12', 700], ['15-Apr-12', 900]];
        var plot2 = $.jqplot('chart2', [line2], {
            title:'Anzahl der Bestellungen',
            axes:{
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{
                        formatString:'%b&nbsp;%#d'
                    }
                },
                yaxis:{
                    tickOptions:{
                        formatString:'%d'
                    }
                }
            },
            highlighter: {
                show: true,
                sizeAdjust: 7.5
            },
            cursor: {
                show: false
            }
        });
    }
});

//Kunden
$(document).ready(function(){
    if(chart3 == 'set') {
        //woher kommen die kunden
        var data = [
        ['Endkunden - keine Aktion', 12],['Wiederverkäufer - keine Aktion', 9], ['Aktion Kunde wirbt Kunde', 14]
        ];
        var plot3 = jQuery.jqplot ('chart3', [data],
        {
            title:'Anmeldungen',
            seriesDefaults: {
                // Make this a pie chart.
                renderer: jQuery.jqplot.PieRenderer,
                rendererOptions: {
                    // Put data labels on the pie slices.
                    // By default, labels show the percentage of the slice.
                    showDataLabels: true
                }
            },
            legend: {
                show:true, 
                location: 'e'
            }
        }
        );
          
        //Kundenaufkommmen
        var line4=[['15-May-11', 30], ['15-Jun-11', 30], ['15-Jul-11', 40], ['15-Aug-11', 52],
        ['15-Sep-11', 60], ['15-Oct-11', 60], ['15-Nov-11', 90], ['15-Dec-11', 111],
        ['15-Jan-12', 200], ['15-Feb-12', 500], ['15-Mar-12', 700], ['15-Apr-12', 900]]
        var plot4 = $.jqplot('chart4', [line4], {
            title:'Anzahl der Kunden',
            axes:{
                xaxis:{
                    renderer:$.jqplot.DateAxisRenderer,
                    tickOptions:{
                        formatString:'%b&nbsp;%#d'
                    }
                },
                yaxis:{
                    tickOptions:{
                        formatString:'%d'
                    }
                }
            },
            highlighter: {
                show: true,
                sizeAdjust: 7.5
            },
            cursor: {
                show: false
            }
        });
    }
});

$(document).ready(function() {
    /*
     *
     * table filter
     *   
     */
    
    
    var options = {
        additionalFilterTriggers: [$('#quickfind')]
    };

    $('#tablefilter').tableFilter(options);
    
    $('.button-display').click( function() {
        $('.filters').toggle(); 
    });
    
    $('.button-display-none').click( function() {
        $('.filters').css('display', 'none');
        var filter_display = $('.filters').css('display');
        $.cookie("table_filter", filter_display);
    });
    
    $('.button-display-display').click( function() {
        $('.filters').css('display', 'table-row');
        var filter_display = $('.filters').css('display');
        $.cookie("table_filter", filter_display);
    });
    
    if($.cookie("table_filter") == 'none') {
        $('.filters').css('display', 'none');
    }
    
    /*
     * 
     * config dialog
     * 
     */
    
    $('.conf').click(function() {
        $( "#dialog-configure" ).dialog( "open" );
        return false;
    });
    
    $( "#dialog-configure" ).dialog({
        autoOpen: false,
        height: 200,
        modal: true
        
    });
    
});

ddaccordion.init({ //top level headers initialization
	headerclass: "saleexpandable", //Shared CSS class name of headers group that are expandable
	contentclass: "salecategoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: true, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["openheader" , "closedheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

ddaccordion.init({ //2nd level headers initialization
	headerclass: "marketingexpandable", //Shared CSS class name of sub headers group that are expandable
	contentclass: "marketingcategoryitems", //Shared CSS class name of sub contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["openmarketingheader", "closedmarketingheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

ddaccordion.init({ //2nd level headers initialization
	headerclass: "cmsexpandable", //Shared CSS class name of sub headers group that are expandable
	contentclass: "cmscategoryitems", //Shared CSS class name of sub contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["opencmsheader", "closedcmsheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

/*$('.product_filter').change( function() {
    
    var catId = $(this).find('option:selected').val();

    $.ajax({
        type: "GET",
        url: "/admin/product_sortby_cat/" + catId + "/",
        success: function(data){
        alert(data);    
        
        $("#ajaxcontent").html(data);
        }
        });
});*/

$('.show_products').click( function() {
    var catId = $('.product_filter').find('option:selected').val();
    
    window.location.href = "/admin/products/" + catId + "/";
});

$('.cleditor').cleditor();





