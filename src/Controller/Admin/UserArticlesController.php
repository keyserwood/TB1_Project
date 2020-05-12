<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserArticlesController extends AbstractController
{
    /**
     * @Route("/user/{id}/articles", name="admin_user_articles")
     */
    public function index()
    {
        return $this->render('admin/user_articles/index.html.twig', [
            'controller_name' => 'UserArticlesController',
        ]);
    }
}
