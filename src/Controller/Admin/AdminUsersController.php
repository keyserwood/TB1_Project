<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function index()
    {
        return $this->render('admin/admin_users/index.html.twig', [
            'controller_name' => 'AdminUsersController',
        ]);
    }
}
