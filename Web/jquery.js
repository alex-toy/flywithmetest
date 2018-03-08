$(document).ready(function(){

	
	$titre_vol = $(".titre_vol");
	
	$titre_vol.on("mouseenter", function(){
		$(this).css("border-color" , "yellow");
		$(this).css("background-color" , "red");
		$(this).css("box-shadow" , "5px 5px 2px grey");
	});

	$titre_vol.on("mouseleave", function(){

		$(this).css("border-color" , "blue");
		$(this).css("background-color" , "#80FFFF");
		$(this).css("box-shadow" , "10px 10px 5px grey");
		
	});
	
});






























