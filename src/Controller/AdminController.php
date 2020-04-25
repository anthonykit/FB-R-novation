<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/utilisateur", name="utilisateur")
     */
    public function userList(UserRepository $userRepository){
        return $this->render("admin/user.html.twig",[
            'user' => $userRepository -> findAll()
        ]);

    }
    /**
     * @Route("/utilisateurs/modifier/{id}", name="modifier_utilisateur")
     */
    public function editUser(User $user, Request $request)
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Utilisateur modifié avec succès');
            return $this->redirectToRoute('admin_utilisateur');
        }

        return $this->render('admin/edituser.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }
}
