<?php


namespace App\Controller;

use App\Entity\Article3;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Form\CommentType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\Article3Repository;


use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Knp\Component\Pager\PaginatorInterface;



class BlogController extends Controller\AbstractController
{
    /**
    * @Route("/blog", name="blog")
    */
    public function index(Article3Repository $repo, Request $request, PaginatorInterface $paginator)
    {

        $donnees =$repo->findAll();
        $articles = $paginator->paginate(
            $donnees,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('blog/index.html.twig', [
        'controller_name' => 'BlogController',
            'articles'=> $articles,
            ]);
    }

    /**
     * @return mixed
     * @Route("/", name="home");
     */
    public function home(Request $request,ContactNotification $contactNotification, \Swift_Mailer $mailer)
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $file = $contact->getImage();
            $fileName= md5(uniqid()).'.' .$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_demand'),
                    $fileName
                );
            } catch (FileException $e) {}
            $contact->setImage($fileName);

                $message = (new \Swift_Message('Nouvelle demande'))
                ->setFrom($contact->getEmail())
                ->setTo('contact@fbrenovation.fr')
                ->setBody(

                    $this->renderView(
                        'email/contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
             ;

            $mailer->send($message);
            $this->addFlash('message', 'Le message a bien été envoyé');

        }
        return $this->render('blog/home.html.twig',[
            'form'=> $form->createView()
        ]);


    }


    /**
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit", name="blog_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     * @return \Symfony\Component\Form\FormTypeInterface;
     */
    public function create(Article3 $article = null,Request $request, EntityManagerInterface $entityManager){
        if(!$article) {
            $article = new Article3();
        }
        $form= $this->createFormBuilder($article)
                    ->add('title')
                    ->add('content')
                    ->add('image', FileType::class)
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted()&& $form->isValid()){
                if (!$article->getId()){
                    $article->setCreatedAt(new \DateTime());
                }
                $file = $article->getImage();
                $fileName= md5(uniqid()).'.' .$file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }


                $article->setImage($fileName);
                $article->setCreatedAt(new \DateTime());
                $entityManager->persist($article);
                $entityManager->flush();
                return $this->redirectToRoute('show', ['id'=>$article->getId()]);
            }
        return $this->render('blog/create.html.twig',[
            'formArticle' => $form->createView(),
            'editMode'=>$article->getId()== !null
        ]);
    }
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/blog/{id}", name="show")
     */
    public function show(Article3 $article, Request $request, EntityManagerInterface $entityManager)
    {   $comment= new Comment();
        $form= $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('show', ['id'=>$article->getId()]);
        }

        return $this->render('blog/show.html.twig',[
            'article'=> $article,
            'commentForm'=> $form->createView()
        ]);
    }



}