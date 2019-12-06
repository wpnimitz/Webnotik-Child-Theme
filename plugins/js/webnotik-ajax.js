jQuery(document).ready(function( $ ) {	
	$("#get-cp").on("click", function() {
		console.log("get_city_pages");
		var data = {
            action: 'get_city_pages',
            focus_key: 'We Buy Houses'
        };
        
        var json_count = 0;
        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
        	$(".message").html("").attr("class", '').addClass("message");
            if ( json.success ) {
                json_data = json["data"]
                console.log(json_data)
                $.each(json_data, function(i, item) {
                	json_count++;
				    var city1 = $(".main-sub-keyword .k-main input").val()
                    if(city1 == "") {
                        $(".main-sub-keyword .k-main input").attr('value', item.PageName);
                        $(".main-sub-keyword .k-value input").attr('value', item.PageURL);
                    } else {
                    	if( $("#extra-" + json_count).length ) {
                    		//do nathing
                    	} else {
                    		$(".add-sub-keyword").trigger("click");
                    	}
                        $("#extra-" + json_count + " .k-main input").attr('value', item.PageName);
                        $("#extra-" + json_count + " .k-value input").attr('value', item.PageURL);
                    }
                    $(".message").addClass("success").append("Added City #" + (i + 1) + ": " + item.PageName + " <br>");
				});
            } else {
            	console.log(json.data);
            }
            console.log("json is still playing...")
        } );
	})

	$(".rename-cp").on("click", function(e) {
		e.preventDefault();
        $this = $(this);
		gUrl = $(this).closest(".keyword").find(".k-value input").val();
		gTitle = $(this).closest(".keyword").find(".k-main input").val();
		$target = $(this).closest('.keyword').attr('id');

		var data = {
            action: 'rename_city_pages',
            given_url: gUrl,
            given_title: gTitle
        };
        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
        	$(".message").html("").attr("class", '').addClass("message");
            if ( json.success ) {
            	json_data = json["data"];
            	console.log(json_data);
                $(".message").addClass("success").append("Successfully renamed. New URL: " + json.data["post_name"]);

                $this.closest(".keyword").find(".k-value input").val(json.data["post_name"])
            } else {
            	
            	var json_data = json.data;
            	$.each(json_data, function(i, item) {
            		$(".message").addClass("error").append("Error: " + item + "<br>");
            	}); 
            }
        } );

        console.log(gUrl);
	})

    $("#save-styles").on("click", function(e) {
        e.preventDefault();
        var data = {
            action: 'generate_new_rei_style'
        }
        $.getJSON( get_city_pages_data.ajaxurl, data, function( json ) {
            console.log(json.data);
            $(".message").addClass("success show").html("Successfully created a stylesheet base on branding configurations.");
        } );
    })
});