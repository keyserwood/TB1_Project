<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Commentaires;
use App\Form\CommentairesType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
class CommentairesController extends AbstractController
{

    /**
     * @Route("/articles/{id}/addComment", name="creationComment")
     * @Route("/articles/{id}/editComment, name="modifComment")
     */
    public function modifCommentaires(Commentaires $commentaires =null,Articles $articles, $request,ManagerRegistry $managerRegistry,UserInterface $user)
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
        return $this->render('admin/user_articles/modifAjoutUA.html.twig', [
            'commentaires' => $commentaires,"form" => $form->createView(),"modif"=>$modif
        ]);
    }
}
