<?php

namespace App\Controller\Admin;

use App\Repository\UsersRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;

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
//    /**
//     * @Route("/admin/users/creation",name="creationUsers")
//     * @Route("/admin/users/{id}", name="modifUsers",methods={"GET","POST"})
//     */
//    public function modifUsers(User$user,Request $request,ManagerRegistry $managerRegistry,UserInterface $user)
//    {
//        if (!user)
//        {
//            $user = new User();
//        }
//
//
//    }






}
