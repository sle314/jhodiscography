$(document).ready(function(){	
	
	$('.pics').hide();
	$('.hidden').hide();
	
	$('.other2 .show a').each(function(){$(this).toggle(function()
			{			
				$(this).html("- hide");	
				
				$('.pics', $(this).parent().parent()).slideToggle(500,function(){							
						$('html, body').animate({scrollTop : $(this).offset().top-100},'slow');
				});				
				
			},
			function()
			{
				$(this).html("+ show");
				$('.pics', $(this).parent().parent()).slideToggle(500);
				
			}
		)});
	$(".other2 h2").toggle(
		function(){
			$('.hidden',$(this).parent().parent()).slideToggle(500, function(){
				$('html, body').stop().animate({scrollTop : $(this).parents(".other2").offset().top-30},'slow');				
			});
			
		},
		function(){
			$('.hidden',$(this).parent().parent()).slideToggle(500);
		});
	
	//IE hiding	
	/*$('.pics').hide();
	$('.hidden').hide();*/
});