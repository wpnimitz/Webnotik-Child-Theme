jQuery(document).ready(function( $ ) {	
	$("#get-cp").on("click", function(e) {
		e.preventDefault();
		var data = {
            action: 'get_city_pages',
            focus_key: 'We Buy Houses'
        };
        
        var json_count = 1;
        

        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
            if ( json.success ) {
                json_data = json["data"]
                $.each(json_data, function(i, item) {
				    //console.log(item.PageName)
				    //console.log(item.PageURL)
				    var city1 = $(".main-sub-keyword .k-main input").val()
                    if(city1 == "") {
                        $(".main-sub-keyword .k-main input").attr('value', item.PageName);
                        $(".main-sub-keyword .k-value input").attr('value', item.PageURL);
                    } else {
                        $(".add-sub-keyword").trigger("click");
                        $("#extra-" + json_count + " .k-main input").attr('value', item.PageName);
                        $("#extra-" + json_count + " .k-value input").attr('value', item.PageURL);
                    }

				    json_count++;

				    console.log("Json Count: " + json_count);
				});
            }
        } );
		
	})
});