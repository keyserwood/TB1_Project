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

> Panneau d'édition 

![image-20200512124233308](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512124233308.png)

> Notre utilisateur n'a pas d'articles, il peut en ajouter : Exemple

![image-20200512124325870](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512124325870.png)



> Seul le compte admin avec le ROLE_ADMIN à accès à tous les articles, sinon un utilisateur lambda peut seulement modifier et supprimer ses propres articles. 
>
> Ici suppression d'un de ses articles par l'utilisateur 

![image-20200512124439466](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512124439466.png)

> Après confirmation de la suppression, la modification a lieu en BD

![image-20200512124404239](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512124404239.png)

> Il ne peut pas modifier les articles des autres utilisateurs en changeant l'URL !

![image-20200512124536239](https://github.com/keyserwood/TB1_Project/blob/master/image-20200512124536239.png)

### Gestion des utilisateurs 

> Il faut maintenant pouvoir modifier les roles des utilisateurs sans passer par la BD, et cela doit être possible pour un utilisateur ROLE_ADMIN

![image-20200519171136809](https://github.com/keyserwood/TB1_Project/blob/master/image-20200519171136809.png)

> Panneau admin de gestion des utilisateurs avec les différentes rôles : Un admin peut modifier les privilèges ou supprimer un utilisateur. Passage au material icons pour les actions. On remarque que un admin ne peut pas ajouter d'utilisateur, c'est un choix délibéré. 

![image-20200519171238903](https://github.com/keyserwood/TB1_Project/blob/master/image-20200519171238903.png)

> Formulaire de modification des privilèges. Ce dernier a posé beaucoup de difficultés à mettre en place avec des problèmes de conversion array->string pour roles, j'ai utilisé un attribut verif roles (pas en BD) pour trick & ensuite setRoles(verifRoles);

### Gestion des commentaires

> * Un admin peut modérer les différents commentaires sur les articles
>
> * Chaque utilisateur en se rendant sur un article peut ajouter un article, et le modifier. Il peut aussi le supprimer en se rendant sur l'article correspondant. Je n'ai pas implémenté de panneau utilisateur de gestion de commentaires, fastidieux (cf gestion articles users & peu pertinent)

![image-20200519171719357](https://github.com/keyserwood/TB1_Project/blob/master/image-20200519171719357.png)

#### Ajout d'un commentaire

![image-20200519171752556](https://github.com/keyserwood/TB1_Project/blob/master/image-20200519171752556.png)

> En cliquant sur ajouter on peut créer un nouveau commentaire depuis un formulaire. 

![image-20200522142220467](https://github.com/keyserwood/TB1_Project/blob/master/image-20200522142220467.png)

#### Modification // Suppression

> On peut ensuite modifier ou supprimer son commentaire directement depuis l'article. 

![image-20200522142742281](https://github.com/keyserwood/TB1_Project/blob/master/image-20200522142742281.png)

> Les utilisateurs peuvent ensuite communiquer et se répondre dans la section commentaires.

### Ajout d'images sur les articles 

![image-20200523105011939](https://github.com/keyserwood/TB1_Project/blob/master/image-20200523105011939.png)

> On peut désormais ajouter des images sur les articles, pour cela j'ai utilisé Vich/UploaderBundle

![image-20200523104641334](https://github.com/keyserwood/TB1_Project/blob/master/image-20200523104641334.png)

> On observe que la gestion des dates pour les articles est présente, avec created_at : la création de l'article, et updated_at : Dernière mise à jour 

### Pagination 

> Pour mettre en place la pagination j'ai utilisé le paginator bundle. 

![image-20200523105743154](https://github.com/keyserwood/TB1_Project/blob/master/image-20200523105743154.png)

> On a accès ici à 4 articles par pages, et on peut naviguer entre les différents articles. 

## Features additionnelles à implementer

* Gestion des catégories des articles (si temps)

* Deploy le site sur internet 

