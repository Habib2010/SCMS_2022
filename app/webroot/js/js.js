jQuery(document).ready(function($){
    $('a.openClose').click(function(){
        $('ul.mainNav').slideToggle();	
    })
	
    $('.feedArrow').click(function(){
        $(this).siblings('.feedCont').toggleClass('open')
    })
	
    $(".subArrow3").hover(function(){
        $(this).addClass('active').children('.innrItem').css({
            'transform':'scale(1)',
            'opacity':'1',
            'display':'block'
        });
    },function(){
        $(this).removeClass('active').children('.innrItem').css({
            'transform':'scale(0)',
            'opacity':'0',
            'display':'none'
        });
    });
	
    jQuery('ul.mainNav li').hover(
        function(){
            jQuery(this).addClass('active').children('.subNavCont').stop(true, true).slideDown('slow');
        },
		
        function(){
            jQuery(this).removeClass('active').children('.subNavCont').slideUp('fast');
        }
        );
	
    <!---- accordian ---->
    $('.notice ul li').click(function(){
        //Expand or collapse this panel
        $(this).next().slideToggle( );
        if($(this).hasClass( 'active' )){
            $('.notice ul li').removeClass('active');
        }else{
            $('.notice ul li').removeClass('active');
            $(this).addClass( 'active' );
        }
        //Hide the other panels
        $(".noticeCont").not($(this).next()).slideUp();
    });
	
    //------tab
    $('ul.tabBtn > li').each(function(i,LI){
        $(this).children('a').click(function(e){
            e.preventDefault();
            if( !$(LI).hasClass('selected')){
                $(LI).addClass('selected').siblings().removeClass('selected');
                $('.tabContent').eq(i).slideDown/*show*/().siblings('.tabContent').slideUp/*hide*/();
            }
            return false;
        });
    });
	
	
});

$(window).load(function(){
    $(function() {
        $('.banner ul').carouFredSel({
            responsive	:true,
            infinite	:true,
            width		:'variable',
            height	:'variable',
            items		:{
                visible	:1,
                height	:'variable'
            },
            auto	:{
                duration	: 2000,
                timeoutDuration	: 4000
            },
            scroll   : {
                fx   : 'crossfade'
            }
        });
    });
});

$(window).ready(function(){
    $(function() {
        $('.btmSlider ul').carouFredSel({
            responsive	:true,
            infinite	:true,
            width		:'variable',
            height	:'variable',
            items		:{
                visible	:1,
                height	:'variable'
            },
            auto	:{
                duration	: 2000,
                timeoutDuration	: 4000
            },
            scroll           : {
                fx             : 'uncover',
                pauseOnHover : true
            }
        });
    });
});

$(window).ready(function(){
    $('.side-slider ul').carouFredSel({
        width   : '100%',
        scroll  : 1,
        //pagination : '.pagination',
        prev	:'.prev1',
        next	:'.next1',
        auto	:{
            easing	: "linear",
            duration	: 1000,
            timeoutDuration	: 4000
        }
    });	  
	
});


$(window).ready(function(){
    $('.rchSlider ul').carouFredSel({
        responsive: true,
        width   : '100%',
        scroll : {
            items           : 1,
            easing          : "linear",
            duration		: 1000,
            timeoutDuration	: 5000,
            pauseOnHover    : true
        } ,
        pagination : '.pagination',
        prev	:'.reprev',
        next	:'.renext'
    });	  
	
});

$(window).ready(function(){	<!---- responsive nav ---->
    if($("ul.mainNav").length > 0){
        //setTimeout(function(){alignMenuItems();},50);
        alignMenuItems();
        $(window).resize(function(){
            alignMenuItems();
            var winWdth = $(window).width();
        });
    }
	
});
function alignMenuItems(){
    var totEltWidth = 0;
    var menuWidth = jQuery('ul.mainNav')[0].offsetWidth;
    var availableWidth = 0;
    var space = 0;
    var elts = $('ul.mainNav > li');
    var allWidth = {};
    elts.children('a').each(function(inx, elt) {
        // reset paddding to 0 to get correct offsetwidth
        //jQuery(elt).css({'padding-left':'0','padding-right':'0'});
        //totEltWidth += elt.offsetWidth;
        jQuery(elt).css('width','');
        jQuery(elt).each(function(){
            totEltWidth += allWidth[inx] = elt.offsetWidth;
        //console.log({inx:inx,allWidth:allWidth[inx],totEltWidth:totEltWidth});
        });
    });
    availableWidth = menuWidth - totEltWidth;

    space = parseInt(availableWidth/(elts.length));
    //space = parseFloat(parseFloat(space).toFixed(2));
    
    elts.filter(':not(:last-child)').children('a').each(function(inx, elt) {
        //jQuery(elt).css({'padding-left':((space/2) + 'px'),'padding-right':((space/2) + 'px')});
        jQuery(elt).css({
            width:((allWidth[inx]+space)+'px')
            });
    //console.log({inx:inx,allWidth:allWidth[inx],space:space,availableWidth:availableWidth,menuWidth:menuWidth,totEltWidth:totEltWidth});
    });
    
    var adjust = availableWidth - (space * (elts.length-1));
    adjust = parseInt(adjust)-1; 
    
    elts.filter(':last-child').children('a').css({
        width:((allWidth[elts.length-1]+adjust)+'px')
        });
}
