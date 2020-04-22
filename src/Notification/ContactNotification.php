<?php


namespace App\Notification;


use App\Entity\Contact;
use Twig\Environment;

class ContactNotification
{

    /**
     * @var Environment
     */
    private Environment $renderer;
    /**
     * @var \Swift_Mailer
     */
    private \Swift_Mailer $mailer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {


        $this->renderer = $renderer;
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact){
        $message=(new \Swift_Mailer('Travaux: ' . $contact->getMessage()))
            ->setFrom('noreply@fbrenovation.fr')
            ->setTo('contact@fbrenovation.fr')
            ->setReplyTO($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig',[
                'contact'=>$contact
            ]),'text/html');
        $this->mailer->send($message);
    }
}