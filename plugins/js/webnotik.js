jQuery(document).ready(function( $ ) {
	$('.panel-nav .icon').on('click', function(e){
		e.preventDefault();
		if ( $(this).parent().hasClass('responsive') ) {
	        $('.panel-nav').removeClass('responsive')
	    } else {
	        $('.panel-nav').addClass('responsive')
	    }
	})
	$('.form-field p:not(.hint), span.city').on('click', function(){
		var $this = $(this)
		$(".message").addClass('show').html("Content has been copied to your clipboard!");
		var $temp = $("<input>");;
		$("body").append($temp);
		$temp.val($(this).html()).select();
		document.execCommand("copy");
		$temp.remove();

		setTimeout(function() {
		  $(".message").removeClass('show');
		}, 2500);
	});

	var extraSub = 0;
	$(".add-sub-keyword").on("click", function(e){
		e.preventDefault();
		var mainsub = $(".main-sub-keyword").html();
		var extraSub = $('.keyword').length + 1;
		var tempHtml = mainsub; 

		$(".extra-keywords").append('<div class="form-group keyword" id="extra-' + extraSub + '">' + tempHtml + '</div>');
		$("#extra-" + extraSub + " span").html(extraSub);
		$("#extra-" + extraSub + " label").attr('for', 'webnotik_keywords_subpages' + extraSub);
		$("#extra-" + extraSub + " input").attr('id', 'webnotik_keywords_subpages' + extraSub);
		$("#extra-" + extraSub + " input").attr('value', '');
		$("#extra-" + extraSub + " .k-main input").attr('value', 'City #' + extraSub);


		subKeywordRecount();
	});
	$(".extra-keywords").on("click", ".delete-cp", function(e){
		e.preventDefault();
		$(this).closest(".keyword").remove();
	})

	function subKeywordRecount() {
		var eSub = 2;
		$(".extra-keywords .keyword").each(function(){
			$(this).attr('id', 'extra-' + eSub);
			$("#extra-" + eSub + " span").html(eSub);
			$("#extra-" + eSub + " label").attr('for', 'webnotik_keywords_subpages' + eSub);
			$("#extra-" + eSub + " input").attr('id', 'webnotik_keywords_subpages' + eSub);
			eSub++;
		});
	}

	if( $(".wda_color_picker").length ){
		$( '.wda_color_picker' ).wpColorPicker();
	}
});