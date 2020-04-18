<?php


namespace App\Controller;

use App\Entity\Article3;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\Article3Repository;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Date;



class BlogController extends Controller\AbstractController
{
    /**
    * @Route("/blog", name="blog")
    */
    public function index(Article3Repository $repo)
    {

        $articles =$repo->findAll();
        return $this->render('blog/index.html.twig', [

        'controller_name' => 'BlogController',
            'articles'=> $articles,
            ]);
    }

    /**
     * @return mixed
     * @Route("/", name="home");
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/blog/new", name="blog_create")
     * @return \Symfony\Component\HttpFoundation\Response
     * @return \Symfony\Component\Form\FormTypeInterface;
     */
    public function create(Request $request, EntityManagerInterface $entityManager){
        $article= new Article3();
        $form= $this->createFormBuilder($article)
                    ->add('title')
                    ->add('content')
                    ->add('image')
                    ->getForm();
            $form->handleRequest($request);
            if ($form->isSubmitted()&& $form->isValid()){
                $article->setCreatedAt(new \DateTime());
                $entityManager->persist($article);
                $entityManager->flush();
                return $this->redirectToRoute('show', ['id'=>$article->getId()]);
            }
        return $this->render('blog/create.html.twig',[
            'formArticle' => $form->createView()
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