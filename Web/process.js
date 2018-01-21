
function createXMLHttpRequest(id_reponse_serveur){
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById(id_reponse_serveur).innerHTML = this.responseText;
		}
	};
}



// client =================================================================>

function Search_Departures() {
	//alert('test');
	createXMLHttpRequest("reponse_serveur_depart");
	//alert('après le createXMLHttpRequest');
	xmlhttp.open("GET","http://localhost/~alexei/FlyWithMeOC2/Web/getDeparture.php",true);
	//alert('après le xmlhttp.open(GET)');
    xmlhttp.send();
}


































































