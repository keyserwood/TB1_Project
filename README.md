# Projet TB1

> Objectifs de la séance : 
>
> * **Utiliser le moteur de templates Twig** : 
>
> * **Intéragir avec vos utilisateurs via des formulaires**
> * **Gérer vos données avec Doctrine ORM, intéragir avec une base de données.**

## Présentation du Site Web

![image-20200414114030781](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114030781.png)

> Page d'accueil réalisé en html, le style vient de boostwatch : https://bootswatch.com/flatly/

### Structure actuelle

Pour l'instant on peut consulter & modifier des articles 

> Un article est composé d'un Title : titre & Content : Contenu 
>
> On reliera plus tard avec l'utilisateur, l'author de l'articles

![image-20200414114253643](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114253643.png)

> Affichage des articles : J'ai utilisé faker pour générer le titre et le content (lorem ipsum). J'ai donc mis en place la BD avec doctrine, les fixtures (orm fixtures)

![image-20200414114353233](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114353233.png)

> Une page dédiée à l'article est aussi présente.  \articles\\{id}

### Modification & Edition des articles

![image-20200414114525889](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114525889.png)

> A partir de twig, en récupérant les différents articles, on peu afficher sous forme de tableau. Les différents CTA entraîne des actions en BD : Pour le moment, seulement la modification est effective. 

#### Modification d'un article 

> J'ai créé un formulaire, qui permet de modifier le titre & le contenu d'un article 

![image-20200414114833646](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114833646.png)

> Formulaire de modification

![image-20200414114906135](https://github.com/keyserwood/TB1_Project/blob/master/image-20200414114906135.png)

> La modification a bien lieu en BD 

#### Suppression d'un article 

> Pour sécuriser la suppression en BD on utilise le Csrf Token qui garantit la sécurité du processus



![image-20200512111722989](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512111722989.png)

![image-20200512111746083](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512111746083.png)

#### Gestion des utilisateurs 

#### Inscription

> Un formulaire d'inscription permet à l'utilisateur de s'inscrire sur le site web, et de renseigner des informations. Le mot de passe est sécurisé en BD par l'intermédiaire de symfony

![image-20200512111927282](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512111927282.png)

> La modification a alors bien lieu en BD
>
> ![image-20200512112157302](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512112157302.png)

L'attribution des rôles est par défaut le ROLE_USER ce qui entraîne des restrictions

![image-20200512112230394](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512112230394.png)

> Il faut se connecter pour avoir accès à son compte utilisateur et ses articles

![image-20200512112304745](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512112304745.png)

![image-20200512112326394](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512112326394)

![image-20200512112339708](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512112339708)

> Notre utilisateur n'a pas d'articles, il peut en ajouter
>
> Seul le compte admin avec le ROLE_ADMIN à accès à tous les articles, sinon un utilisateur lambda peut seulement modifier et supprimer ses propres articles. 

![image-20200512122439649](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512122439649)

> Il ne peut pas modifier les articles des autres utilisateurs en changeant l'URL !

![image-20200512122532583](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512122532583)

## Features à implementer

* Gestion des catégories des articles 
* Commentaires sur les différents articles
* Deploy sur le site sur internet