<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Repository\CommentairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function articles(ArticlesRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $articles = $paginator->paginate(
            $repository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
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
