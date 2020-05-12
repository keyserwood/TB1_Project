<?php

namespace App\Controller\Admin;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserArticlesController extends AbstractController
{
    /**
     * @Route("/user/{id}/articles", name="admin_user_articles")
     */
    public function index(ArticlesRepository $repository,UserInterface $user)
    {
        $userId = $user->getId();
        $articles = $repository->findAll();
        return $this->render('admin/user_articles/adminUsersArticles.html.twig', [
            'articles' => $articles,'userId'=>$userId
        ]);
    }
}
