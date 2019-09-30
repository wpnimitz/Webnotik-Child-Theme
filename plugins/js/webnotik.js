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

	var extraSub = 1;
	$(".add-sub-keyword").on("click", function(){
	     var mainsub = $(".main-sub-keyword").html();
	     extraSub++;
         var tempHtml = mainsub.replace(/<span>1</span>/g, '<span>' + extraSub + '</span>');         
         
	     $(".extra-keywords").append(tempHtml); 
	     console.log(extraSub);
	});
});