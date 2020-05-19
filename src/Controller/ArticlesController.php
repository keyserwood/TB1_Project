<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\CommentairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {
        return $this->render("articles/accueil.html.twig");
    }
    /**
     * @Route("/articles", name="articles")
     */
    public function articles(ArticlesRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('articles/articles.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/articles/{id}", name="afficherArticle")
     */
    public function afficherArticle(Articles $article,CommentairesRepository $repository)
    {
        $commentaires = $repository->findAll();
        return $this->render('articles/afficherArticle.html.twig', [
            'article' => $article,'commentaires'=>$commentaires
        ]);
    }


}
