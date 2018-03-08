

<div class="row">
  <div class="col-sm-2"></div>
  <div class="col-sm-10">
  


<div class="encart">
<form method="POST">

<div style="width:400px;">

<div class="form-group">
  <label for="usr">Name :</label>
  <input type="text" class="form-control" id="usr" name="name">
</div>

<div class="form-group">
  <label for="Email">Email :</label>
  <input type="mail" class="form-control" id="pwd" name="email">
</div>

<div class="form-group">
  <label for="Email">Sujet :</label>
  <input type="text" class="form-control" id="sub" name="subject">
</div>

</div>


<label for="Email">Message :</label>

<textarea id="message" name="message" rows="6" cols="25"></textarea><br />


<INPUT class="btn btn-primary" onclick="GetMessage()" type="submit" value="Send">


</form>
</div>
  
  
  
  
  </div>
  
</div>



<script src="http://localhost/~alexei/FlyWithMeOC2/Web/tinymce/tinymce.min.js"></script>

<script>

function GetMessage() {

	var message = document.document.getElementById("message");
	
	message.innerHTML = tinymce.get('message').getContent();
	alert(tinymce.get('message').getContent());
	
}



	

</script>



















