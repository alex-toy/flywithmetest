<?php
namespace App\Frontend\Modules\Contact;


use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\User;
use \OCFram\FormHandler;


 
class ContactController extends BackController
{
  
  public function executeContact(HTTPRequest $request)
  {
    
    $this->page->addVar('title', 'contact');
    
    
    if ($request->method() == 'POST')
    {
		if($_POST['name']){ $name = $_POST['name'];}
		if($_POST['email']){ $email_from = $_POST['email'];}
		if($_POST['message']){ $message = htmlspecialchars($_POST['message']);}
		

		//$message = html_entity_decode($_POST['message']);
	

		//$message = getcontent( $_POST[tinymce.get('message').getContent()] );
		

		$subject = $_POST['subject'];
		$formcontent="From: $name \n Message: $message";
		$mail_dest = "alexei.80@hotmail.fr";
		

		$header = "From: <" . $email_from . ">";
		$header.= "Reply-to: <" . $email_from . ">";
		$header.= "MIME-Version: 1.0";
		$header.= "Content-Type: text/html; charset=\"ISO-8859-1\"";


		mail($mail_dest,$subject,$message,$header) or die("Error!");
		
		

      	$this->app->user()->setFlash("Merci " . ucfirst($name) .  " pour votre message, je ne manquerai pas d'y répondre!");
      	 
    }
    
    
  }
  

  
  
  public function executeLink()
  {
    $this->page->addVar('title', 'liens');
  }



}















