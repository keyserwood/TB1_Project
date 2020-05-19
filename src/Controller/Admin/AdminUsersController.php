<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Form\UsersManagerType;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function index(UsersRepository $repository)
    {
        $users = $repository->findAll();
        return $this->render('admin/admin_users/adminUsers.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/admin/users/{id}", name="modifUsers",methods={"GET","POST"})
     */
    public function modifUsers(Users $user,Request $request,ManagerRegistry $managerRegistry)
    {

        $form  = $this->createForm(UsersManagerType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash("success", "La modification a été effectuée");
            return $this->redirectToRoute("admin_users");
        }
        return $this->render('admin/admin_users/modifUsers.html.twig', [
            'user' => $user,"form" => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/users/{id}", name="suppressionUser",methods="SUP")
     */
    public function suppUser(Users $user, Request $request, ManagerRegistry $managerRegistry)
    {
        if($this->isCsrfTokenValid("SUP".$user->getId(),$request->get('_token')))
        {
            $em = $managerRegistry->getManager();
            $em->remove($user);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_users");
        }
    }


}
