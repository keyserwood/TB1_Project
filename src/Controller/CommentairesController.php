<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use App\Repository\CommentairesRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
class CommentairesController extends AbstractController
{
    /**
     * @Route("/articles/{id}/commentaires/creation",name="creationComment")
     * @Route("/articles/article/{id}/commentaires", name="modifComment",methods={"GET","POST"})
     */
    public function modifCommentaires(Commentaires $commentaires =null,Articles $articles,Request $request,ManagerRegistry $managerRegistry,UserInterface $user)
    {
        if($commentaires==null)
        {
            $commentaires=new Commentaires();
        }
        $form=$this->createForm(CommentairesType::class,$commentaires);
        $form->handleRequest($request);
        $modif=$commentaires->getId()!=null;
        if($form->isSubmitted() && $form->isValid())
        {
            $commentaires->setAuthor($user);
            $commentaires->setArticles($articles);
            $em = $managerRegistry->getManager();
            $em->persist($commentaires);
            $em->flush();
            $this->addFlash("success", ($modif)? "La modification a été effectuée" : "L'ajout a été effectué");
            return $this->redirectToRoute("afficherArticle",array('id'=>$articles->getId()));

        }
        return $this->render('commentaires/modifAjout.html.twig', [
            'commentaires' => $commentaires,"form" => $form->createView(),"modif"=>$modif
        ]);
    }
    /**
     * @Route("/articles/article/{id}/commentaires", name="suppressionComment",methods="SUP")
     */
    public function suppComment(Commentaires $commentaires, Request $request, ManagerRegistry $managerRegistry, Articles $articles)
    {
        if($this->isCsrfTokenValid("SUP".$commentaires->getId(),$request->get('_token')))
        {
            $em = $managerRegistry->getManager();
            $em->remove($commentaires);
            $em->flush();
            $this->addFlash("success","La suppression a été effectuée");
            return $this->redirectToRoute("afficherArticle",array('id'=>$articles->getId()));

        }
    }
    /**
     * @Route("/admin/commentaires", name="admin_comment")
     */
    public function index(CommentairesRepository $repository)
    {
        $commentaires =$repository->findAll();
        return $this->render('admin/admin_commentaires/adminComment.html.twig', [
            'commentaires' => $commentaires,
            ]);
    }


}
