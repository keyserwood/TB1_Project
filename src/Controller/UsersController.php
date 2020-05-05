<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\InscriptionType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ManagerRegistry $managerRegistry)
    {
        $user = new Users();
        $form = $this->createForm(InscriptionType::class,$user);
        $em = $managerRegistry->getManager();
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $user->setRoles("ROLE_USER");
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('accueil');
        }
        return $this->render('users/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
