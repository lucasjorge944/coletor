function realizarColeta(){
	$(function() {
		jQuery.ajax({
			url: 'json_twitter.php',
			type: 'GET',
			complete: function() {

			},
			success: function(data, textStatus, xhr) {
				//alert(data);
			},
			error: function(xhr, textStatus, errorThrown) {
			    //called when there is an error
			}
		});
	});
}
setInterval(function(){realizarColeta();}, 5000);
//15 em 15 minutos
//setInterval(function(){realizarColeta();}, 900000);