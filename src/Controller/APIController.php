<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/a/p/i", name="a_p_i")
     */
    public function index()
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'APIController',
        ]);
    }
}
