jQuery(document).ready(function($){
		$('a.close1').click(function(){
			$(this).closest('.formTopWrapper').find('div.displayWrapper').slideToggle();
			$(this).toggleClass('close');
		});
	
		
		$('a.close2').click(function(){		
			if(!$(this).hasClass('close')) {
				$('div.rightDisplay').css('display', 'block');
				$('div.rightWraper').animate({width:'22%', padding:'8px .5%'}, 700, function(){
					$('a.close2').addClass('close');
				});
				$('div.left_wrapper').animate({width:'74%'}, 700, function(){});
			} else {
				$('div.rightWraper').animate({width:'4px', padding:'0'}, 700, function(){
					$('a.close2').removeClass('close');
					$('div.rightDisplay').css('display', 'none');
				});
				$('div.left_wrapper').animate({width:'97%'}, 700, function(){});
			}
		});
		
		jQuery(function($){$("input:file, input:radio").uniform();});

	});

