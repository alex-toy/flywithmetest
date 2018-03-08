//alert("Hello world!");


var comments = document.getElementsByClassName("commentaire");
for (int i = 0; i < comments.length; i++) {
    if (i%2 == 0) {
		comments[i].style.backgroundColor = "red";
	}
	else
	{
		comments[i].style.backgroundColor = "white";
	}
}



