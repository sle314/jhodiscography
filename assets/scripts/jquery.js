function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');		
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }		
    }
	return null;
}

$(document).ready(function()
{
	$('.pics').hide();
	$('.hidden').hide();
	$('.text3').show();
	
	var maxTries = 5;
	var xhr = null;
	
	
	var ajax = function(tries, pics){xhr = $.ajax({
						  type: "POST",
						  url: "/release/getImages.php",
						  data: { id: $(".all-data").attr("id").split("rel")[1], id2 : pics.attr("id") },
						  tries : tries
						}).done(function( data ) {							
							if (data.indexOf("none") == -1 && data.indexOf("<img") == -1 && this.tries > 0){								
								this.tries--;
								ajax(this.tries, pics);
								return;
							}
							if (this.tries > 0){
							  pics.parent().siblings(".pics").hide().html(data).fadeIn(1000);							  
							}
							pics.addClass("loaded");
						}).fail(function(xsr){
							if (this.tries > 0){								
								this.tries--;
								ajax(this.tries, pics);
								return;
							}
						
						}).always(function(){
							if (this.tries <= 0){
								pics.parent().siblings(".pics").html("can't get images, please refresh the page and try again");
							}
						});}
	
	$('.other1 a.outer').toggle(
		function(){
			$('.hidden',$(this).parent().parent()).slideToggle(500, function(){
				if (getQueryVariable("show") != "all"){	
					$('html, body').stop().animate({scrollTop : $(this).parents(".other1").offset().top-30},'slow');
				}
				else{
					$('html, body').stop().animate({scrollTop : $(".other1 a.outer:eq(0)").offset().top-30},'slow');
				}
			});
			
		},
		function(){
			$('.hidden',$(this).parent().parent()).slideToggle(500);
		});
	
	$('.other1 .show a').each(function(){$(this).toggle(function()
		{			
			$(this).html("- hide");	
			var pics = $(this);
			if (!pics.hasClass("loaded"))
				$('.loading', pics.parent().siblings(".pics")).show();
			
			$('.pics', pics.parent().parent()).slideToggle(500,function(){
				if (!pics.hasClass("loaded")){
					ajax(maxTries, pics);
				}	
				if (!getQueryVariable("show")){				
					$('html, body').animate({scrollTop : pics.offset().top-100},'slow');
				}
			});				
			
		},
		function()
		{
			$(this).html("+ show");
			$('.pics', $(this).parent().parent()).slideToggle(500);
			
		}
	)});	
	
	var id = null;
	if (/^.*id=([0-9]+).*$/.test(window.location.toString())){
		id = window.location.toString().replace(/^.*id=([0-9]+).*$/,"$1");
		$("#n"+id).css({'color':'#FFF'});
	}
	
	var klasaSingle;
	
	$('.single a').hover(
		function () {
			$(this).css({'color':'#00AACC'});
			klasaSingle = $(this).attr('class').split(" ");
			for (var i=0;i<klasaSingle.length;i++){
				$('.lp a.'+klasaSingle[i]).css({'color':'#00AACC'});
			}
		},
		function () {
			$(this).css({'color':'#666'});
			for (var i=0;i<klasaSingle.length;i++){
				$('.lp a.'+klasaSingle[i]).css({'color':'#666'});
			}
			if (id)
				$('#n'+id).css({'color':'#FFF'});
		}
	);
	
	var klasaOther;
	
	$('.other a').hover(
		function () {
			$(this).css({'color':'#00AACC'});
			klasaOther = $(this).attr('class').split(" ");
			for (var i=0;i<klasaOther.length;i++){
				$('.lp a.'+klasaOther[i]).css({'color':'#00AACC'});
			}
		},
		function () {
			$(this).css({'color':'#666'});
			for (var i=0;i<klasaOther.length;i++){
				$('.lp a.'+klasaOther[i]).css({'color':'#666'});
			}
			if (id)
				$('#n'+id).css({'color':'#FFF'});
		}
	);

	$('.lp a').hover(
		function () {
			$('a.'+$(this).attr('class')).css({'color':'#00AACC'});
		},
		function () {
			$('a.'+$(this).attr('class')).css({'color':'#666'});
			if (id)
				$('#n'+id).css({'color':'#FFF'});
		}
	);
	/*IE hiding
	$('.pics').hide();
	$('.hidden').hide();
	$('.text3').show();*/
	
	var num;
	if ((num = getQueryVariable("show"))  != null){	
		
		if (num == "all"){
			$(".show a").trigger("click");
			$(".other1 a.outer").trigger("click");
		}
		else{
			var sel = $(".other1 a.outer#n"+num);
			sel.trigger("click");
			sel.parents(".other1").find(".show a").trigger("click");
		}
	}
	
});