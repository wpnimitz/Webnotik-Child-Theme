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

	var extraSub = $('.keyword').length;
	$(".add-sub-keyword").on("click", function(){
	     var mainsub = $(".main-sub-keyword").html();
	     extraSub++;
         var tempHtml = mainsub; 
         
	     $(".extra-keywords").append('<div class="form-group keyword" id="extra-' + extraSub + '">' + tempHtml + '</div>');
	     $("#extra-" + extraSub + " span").html(extraSub);
	     $("#extra-" + extraSub + " input").attr('value', '');
	     console.log(extraSub);
	});
});