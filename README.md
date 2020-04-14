# Projet TB1

> Objectifs de la séance : 
>
> * **Utiliser le moteur de templates Twig** : 
>
> * **Intéragir avec vos utilisateurs via des formulaires**
> * **Gérer vos données avec Doctrine ORM, intéragir avec une base de données.**

## Présentation du Site Web

![image-20200414114030781](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114030781.png)

> Page d'accueil réalisé en html, le style vient de boostwatch : https://bootswatch.com/flatly/

### Structure actuelle

Pour l'instant on peut consulter & modifier des articles 

> Un article est composé d'un Title : titre & Content : Contenu 
>
> On reliera plus tard avec l'utilisateur, l'author de l'articles

![image-20200414114253643](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114253643.png)

> Affichage des articles : J'ai utilisé faker pour générer le titre et le content (lorem ipsum). J'ai donc mis en place la BD avec doctrine, les fixtures (orm fixtures)

![image-20200414114353233](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114353233.png)

> Une page dédiée à l'article est aussi présente.  \articles\\{id}

### Modification & Edition des articles

![image-20200414114525889](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114525889.png)

> A partir de twig, en récupérant les différents articles, on peu afficher sous forme de tableau. Les différents CTA entraîne des actions en BD : Pour le moment, seulement la modification est effective. 

#### Modification d'un article 

> J'ai créé un formulaire, qui permet de modifier le titre & le contenu d'un article 

![image-20200414114833646](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114833646.png)

> Formulaire de modification

![image-20200414114906135](C:\Users\Elouan\AppData\Roaming\Typora\typora-user-images\image-20200414114906135.png)

> La modification a bien lieu en BD 

