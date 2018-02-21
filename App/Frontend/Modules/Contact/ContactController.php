<?php
namespace App\Frontend\Modules\Contact;


use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \Entity\Articles;
use \Entity\User;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\SearchFormBuilder;
use \OCFram\FormHandler;


 
class ContactController extends BackController
{
  
  public function executeContact(HTTPRequest $request)
  {
    //echo 'ContactController->executeContact <br>';
    
    //titre de la page :
    $this->page->addVar('title', 'contact');
    
    
    if ($request->method() == 'POST')
    {
		//echo 'POST<br>';
		
		$name = $_POST['name'];
		$email_from = $_POST['email'];
		$message = htmlspecialchars($_POST['message']);
		//$message = html_entity_decode($_POST['message']);
	

		//$message = getcontent( $_POST[tinymce.get('message').getContent()] );
		

		$subject = $_POST['subject'];
		$formcontent="From: $name \n Message: $message";
		$mail_dest = "alexei.80@hotmail.fr";
		
		//echo $message . '<br>';


		//Création du header :
		$header = "From: <" . $email_from . ">";
		$header.= "Reply-to: <" . $email_from . ">";
		$header.= "MIME-Version: 1.0";
		$header.= "Content-Type: text/html; charset=\"ISO-8859-1\"";


		//=====Envoi de l'e-mail.
		mail($mail_dest,$subject,$message,$header) or die("Error!");
		//echo 'envoi mail';
		
	
		
		//echo 'setFlash<br>';
      	$this->app->user()->setFlash("Merci " . $name .  " pour votre message, je ne manquerai pas d'y répondre!");
      	 
    }
    
    
  }
  

  
  
  public function executeLink(HTTPRequest $request)
  {
    //echo 'articlesController->executeLink <br>';
    
    //titre de la page :
    $this->page->addVar('title', 'liens');
    
    
  }



}















