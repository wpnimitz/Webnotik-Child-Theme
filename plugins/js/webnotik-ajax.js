jQuery(document).ready(function( $ ) {	
	$("#get-cp").on("click", function(e) {
		e.preventDefault();
		var data = {
            action: 'get_city_pages',
            focus_key: 'We Buy Houses'
        };

        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
            if ( json.success ) {
                console.log('yes!')
                console.log("data: " + data);  

                $.each(json, function(i, item) {
				    console.log("item info:" + i);
				    console.log(item);
				});
            }
        } );


		// var data = {
	 //        action: 'get_city_pages',
	 //        focus_key: 'We Buy Houses'
	 //    };

	 //    jQuery.post(ajaxurl, data, function(response) {
	 //        json = $.parseJSON(response);
	 //        console.log('Got this from the server: ' + response);
	 //        $.each(response, function(i, item) {
	 //        	$(".add-sub-keyword").trigger("click");
	 //        	$("#extra-" + extraSub + " input").attr('value', item.PageName);
		// 	});
	 //    });

		
	})
});