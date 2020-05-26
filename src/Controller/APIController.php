<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Users;
use App\Repository\ArticlesRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/api/articles/display", name="api_display")
     */
    public function apiArticles(ArticlesRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $articles = $paginator->paginate(
            $repository->findAllWithPagination(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            4 /*limit per page*/
        );
        return $this->render('api/index.html.twig', [
            'articles' => $articles,
        ]);
    }
    /**
     * @Route("/api/articles",name ="api",methods={"GET"})
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
        $response = new Response($jsonContent);
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
     * @Route("article/ajout",name="api_add",methods={"POST"})
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
        }
        return new Response('Failed', 404);
    }
    /**
     * @Route("/api/article/editer/{id}", name="api_edit", methods={"PUT"})
     */
    public function editArticle(?Articles $article, Request $request)
    {
        // On vérifie si la requête est une requête Ajax
        if($request->isXmlHttpRequest()) {
         // On décode les données envoyées
            $donnees = json_decode($request->getContent());
            // On initialise le code de réponse
            $code = 200;
            // Si l'article n'est pas trouvé
            if(!$article){
            // On instancie un nouvel article
                $article = new Articles();
            // On change le code de réponse
                $code = 201;
            }
          // On hydrate l'objet
            $article->setTitle($donnees->titre);
            $article->setContent($donnees->contenu);
            $article->setFeaturedImage($donnees->image);
            $user = $this->getDoctrine()->getRepository(Users::class)->find(1);
            $article->setAuthor($user);
            // On sauvegarde en base
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();
             // On retourne la confirmation
            return new Response('ok', $code);
        } return new Response('Failed', 404);
    }
    /**
     * @Route("/api/article/delete/{id}", name="api_delete", methods={"DELETE"})
     */
    public function removeArticle(Articles $article)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        return new Response('ok');
    }

}
