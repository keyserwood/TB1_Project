<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Users;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class APIController extends AbstractController
{
    /**
     * @Route("/api/articles", name="api",methods={"GET})
     */
    public function liste(ArticlesRepository $articlesRepository)
    {
        // Récupérer la liste
        $articles = $articlesRepository->apiFindAll();
        // Encodage en JSON
        $encoders = [new JsonEncoder()];
        // Instanciation du normaliseur
        $normalizers = [new ObjectNormalizer()];
        // Instanciation du convertisseur
        $serializer = new Serializer($normalizers,$encoders);
        // Convertir en JSON
        $jsonContent = $serializer->serialize($articles,'json',['circular_reference_handler'=>function($object){return $object->getId();}]);
        // Instanciation de la réponse
        $response = new Responses($jsonContent);
        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type','application/json');
        // On envoie la réponse
        return $response;
    }
    /**
     * @Route("/api/articles/{id}",name ="api_article",methods={"GET"})
     */
    public function getArticle(Articles $articles)
    {
        $encoders =[new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers,$encoders);
        $jsonContent = $serializer->serialize($articles,'json',['circular_reference_handler'=>function($object){return $object->getId();}]);
        $response =new Response($jsonContent);
        $response->headers->set('Content-Type','application/json');
        return $response;

    }
    /**
     * @Route("article/ajout",name="api_add",methods={"POST"}
     */
    public function addArticle(Request $request)
    {
        // On vérifie si la requête est une requête Ajax
        if($request->isXmlHttpRequest()) {
            //On instancie un nouvel article
                $article = new Articles();
                // On décode les données envoyées
                $donnees = json_decode($request->getContent());
                // On hydrate l'objet
                $article->setTitle($donnees->title);
                $article->setContent($donnees->content);
                $article->setFeaturedImage($donnees->image);
                $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(["id"
                => 1]);
                $article->setAuthor($user);
                 // On sauvegarde en base
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();
                 // On retourne la confirmation
                return new Response('ok', 201);
        } return new Response('Failed', 404);
    }

}
