<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class APIController extends AbstractController
{
    /**
     * @Route("/api", name="api",methods={"GET})
     */
    public function liste(ArticlesRepository $articlesRepository)
    {
        // Récupérer la liste
        $articles = $articlesRepository->findAll();
        // Encodage en JSON
        $encoders = [new JsonEncoder()];
        // Instanciation du normaliseur
        $normalizers = [new ObjectNormalizer()];
        // Instanciation du convertisseur
        $serializer = new Serializer($normalizers,$encoders);
        // Convertir en JSON
        $jsonContent = $serializer->serialize($articles,'json',['circular_reference_handler'=>function($object){return $object->getId();}]);
        return $this->render('api/index.html.twig', [
            'controller_name' => 'APIController',
        ]);
        // Instanciation de la réponse
        $response = new Responses($jsonContent);
        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type','application/json');
        // On envoie la réponse
        return $response;
    }
}
