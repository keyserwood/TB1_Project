<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\InscriptionType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, ManagerRegistry $managerRegistry, UserPasswordEncoderInterface $encoder)
    {
        $user = new Users();
        $form = $this->createForm(InscriptionType::class,$user);
        $em = $managerRegistry->getManager();
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $passwordCrypte = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($passwordCrypte);
            $user->setRoles("ROLE_USER");
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('accueil');
        }
        return $this->render('users/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $utils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $utils)
    {
        return $this->render('users/login.html.twig', [
            "lastUserName"=>$utils->getLastUsername(),
            "error"=>$utils->getLastAuthenticationError()

        ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

    }
}
