$(function() {
	
	/*
	$("#test").click(function() {
		alert("Hello, world!");
	});
    */
	$( "#api_menu" ).change(function(e) {
		//$mung = $( "#api_menu option:selected" ).text();
		//alert(e.type);
		event.preventDefault();
		//console.log(e);
		//console.log($mung);
		
		$api_id = $( "#api_menu" ).val();		


		$.ajax(
			'get_api_description.php?api_id=' + $api_id,
				{
					success: function(data) {

						var jsonData = JSON.parse(data);

						$('.result').text(jsonData.description);
						console.log(jsonData.description);
						//alert('AJAX call was successful!');
						//alert('Data from the server' + data);
					},
					error: function() {
						alert('There was some error performing the AJAX call!');
					}
				}
		);


	});

	$( "button" ).click(function() {
	  $( "#mung" ).slideToggle( "slow" );
	});

    

});