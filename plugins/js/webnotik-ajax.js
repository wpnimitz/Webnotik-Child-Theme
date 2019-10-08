jQuery(document).ready(function( $ ) {	
	$("#get-cp").on("click", function(e) {
		e.preventDefault();
		var data = {
            action: 'get_city_pages',
            focus_key: 'We Buy Houses'
        };
        
        var json_count = 0;
        

        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
        	$(".message").html("").attr("class", '').addClass("message");
            if ( json.success ) {
                json_data = json["data"]
                $.each(json_data, function(i, item) {
                	json_count++;
				    //console.log(item.PageName)
				    //console.log(item.PageURL)
				    var city1 = $(".main-sub-keyword .k-main input").val()
                    if(city1 == "") {
                        $(".main-sub-keyword .k-main input").attr('value', item.PageName);
                        $(".main-sub-keyword .k-value input").attr('value', item.PageURL);
                    } else {
                    	if( $("#extra-" + json_count).length ) {

                    	} else {
                    		$(".add-sub-keyword").trigger("click");
                    	}
                        
                        $("#extra-" + json_count + " .k-main input").attr('value', item.PageName);
                        $("#extra-" + json_count + " .k-value input").attr('value', item.PageURL);
                    }

                    $(".message").addClass("success").append("Added " + item.PageName + " <br>");

				   

				    console.log("Json Count: " + json_count);
				});
            }
        } );
		
	})
});