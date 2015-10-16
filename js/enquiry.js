$(document).ready( function() {
	// checkCookies();
	$("#emptyEnquiry").click(function() {
		deleteCookies();
	});

	console.log(Cookies.get());

});

$('.add_to_enqiry_button').click(function(){
	Cookies.set( "enquiry-" + $(this).attr("id"), $(this).attr("id") );
});

function deleteValue(id)
{
	$("#"+id+"-input").remove();
	$("#"+id+"-div").remove();
	Cookies.remove('enquiry-' + id);
}

$('.error-wrapper .close').click(function(){
	$(this).parent().remove();
});

function deleteCookies()
{
	var cookies = get_cookies_array();
	for(var name in cookies) {
		Cookies.remove( name , null );
	}
	$(".enquiry-cart").html('');
}

function checkCookies()
{
	var cookies = get_cookies_array();
	for(var name in cookies) {
		addEnquiry( name , cookies[name] );
	}
}

function get_cookies_array() {
	var cookies = { };
	if (document.cookie && document.cookie !== '') {
		var split = document.cookie.split(';');
		for (var i = 0; i < split.length; i++) {
			var name_value = split[i].split("=");
			name_value[0] = name_value[0].replace(/^ /, '');
			if (name_value[0].indexOf('enquiry-') != -1)
			{
				cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
			}
		}
	}

	return cookies;
}

$('.single.woocommerce .add_to_enqiry_button').click(function(){
	$(this).closest('.product').prepend(translated_string.added_to_cart_single);
});

$('.archive.woocommerce .add_to_enqiry_button').click(function(){
	$(this).closest('.product').append(translated_string.added_to_cart_archive);
});
