jQuery(document).ready(function( $ ) {
	$('.panel-nav .icon').on('click', function(e){
		e.preventDefault();
		if ( $(this).parent().hasClass('responsive') ) {
	        $('.panel-nav').removeClass('responsive')
	    } else {
	        $('.panel-nav').addClass('responsive')
	    }
	})
	$('.form-field p:not(.hint)').on('click', function(){
		var $this = $(this)
		$this.addClass('copied');
		var $temp = $("<input>");;
		$("body").append($temp);
		$temp.val($(this).html()).select();
		document.execCommand("copy");
		$temp.remove();

		setTimeout(function() {
		  $this.removeClass('copied');
		}, 2500);
	});

	
	$(".add-sub-keyword").on("click", function(){
		var mainsub = $(".main-sub-keyword").html();
		var extraSub = $('.keyword').length + 1;
		var tempHtml = mainsub; 

		$(".extra-keywords").append('<div class="form-group keyword" id="extra-' + extraSub + '">' + tempHtml + '</div>');
		$("#extra-" + extraSub + " span").html(extraSub);
		$("#extra-" + extraSub + " label").attr('for', 'webnotik_keywords_subpages' + extraSub);
		$("#extra-" + extraSub + " input").attr('id', 'webnotik_keywords_subpages' + extraSub);
		$("#extra-" + extraSub + " input").attr('value', '');

		subKeywordRecount();
	});
	$(".extra-keywords").on("click", ".form-label label", function(){
		$(this).closest(".keyword").remove();
	})

	function subKeywordRecount() {
		var eSub = 2;
		$(".extra-keywords .keyword").each(function(){
			$(this).attr('id', 'extra-' + eSub);
			$("#extra-" + eSub + " label").attr('for', 'webnotik_keywords_subpages' + eSub);
			$("#extra-" + eSub + " input").attr('id', 'webnotik_keywords_subpages' + eSub);
			eSub++;
			console.log($(this).find("label").html()); 
		});
		console.log("-- -- -- -- --")
	}

});