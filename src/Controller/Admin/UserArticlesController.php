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
    /**
     * @Route("/user/{id}/article/creation",name="creationArticleUser")
     * @Route("/user/article/{id}", name="modifArticlesUser",methods={"GET","POST"})
     */
    public function modifArticle(Articles $article = null,Request $request,ManagerRegistry $managerRegistry,UserInterface $user)
    {
        if (!$article)
        {
            $article = new Articles();
        }
        $form = $this->createForm(ArticlesType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid())
        {
            $article->setAuthor($user);
            $modif = $article->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($article);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("admin_user_articles",array('id'=>$user->getId()));
        }
        return $this->render('admin/user_articles/modifAjoutUA.html.twig', [
            'article' => $article,"form" => $form->createView(),"modif"=>$modif
        ]);
    }
    /**
     * @Route("/user/article/{id}", name="suppressionArticleUser",methods="SUP")
     */
    public function suppArticle(Articles $article, Request $request, ManagerRegistry $managerRegistry,UserInterface $user)
    {
        if($this->isCsrfTokenValid("SUP".$article->getId().$user->getId(),$request->get('_token')))
        {
            $em = $managerRegistry->getManager();
            $em->remove($article);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("admin_user_articles",array('id'=>$user->getId()));

        }
    }

}
