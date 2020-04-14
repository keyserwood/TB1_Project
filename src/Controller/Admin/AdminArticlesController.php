<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function index(ArticlesRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('admin/admin_articles/adminArticles.html.twig', [
            'articles' => $articles
        ]);
    }
    /**
     * @Route("/admin/article/{id}", name="modifArticles")
     */
    public function modifArticle(Articles $article,Request $request,ManagerRegistry $managerRegistry)
    {
        $form = $this->createForm(ArticlesType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $em = $managerRegistry->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute("admin_articles");
        }
        return $this->render('admin/admin_articles/modifAjout.html.twig', [
            'article' => $article,"form" => $form->createView()
        ]);
    }
}
