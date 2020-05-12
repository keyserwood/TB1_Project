<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminArticlesController extends AbstractController
{
    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function index(ArticlesRepository $repository)
    {
        $articles = $repository->findAll();
        return $this->render('admin/admin_articles/adminArticles.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/admin/article/creation",name="creationArticle")
     * @Route("/admin/article/{id}", name="modifArticles",methods="GET")
     */
    public function modifArticle(Articles $article = null,Request $request,ManagerRegistry $managerRegistry)
    {
        if (!$article)
        {
            $article = new Articles();
        }
        $form = $this->createForm(ArticlesType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $modif = $article->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($article);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("admin_articles");
        }
        return $this->render('admin/admin_articles/modifAjout.html.twig', [
            'article' => $article,"form" => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/{id}", name="suppressionArticle",methods="SUP")
     */
    public function suppArticle(Articles $article, Request $request, ManagerRegistry $managerRegistry)
    {
        if($this->isCsrfTokenValid("SUP".$article->getId(),$request->get('_token')))
        {
            $em = $managerRegistry->getManager();
            $em->remove($article);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_articles");

        }
    }


}
