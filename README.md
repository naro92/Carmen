# Carmen

Dossier MVC

Contient le code mvc du site internet.

Chaque dossier correspond à une partie du site.

- le dossier public : correspond à la partie que l'utilisateur aura accès
- le dossier app : correspond à tous les fichiers du site.

La partie public est en accès libre afin que les différents fichiers de style ou images soient accessibles.
La partie app n'est pas accessible par l'utilisateur afin qu'il évite d'avoir accès à des fichiers sources, qui pourrait compromettre le site.
Ceci est réalisé grâce à des fichiers de configurations .htaccess

## Explications des dossiers :

Les dernieres modifications générales font en sorte de ne plus avoir besoin du dossier parent `mvcExample` !

- dossier public :
  - index.php : page appelée par l'utilisateur
  - assets : images accessibles au public
- dossier app :
  - dossier controllers : controlleurs
  - dossier models : modeles
  - dossiers views : vues du site
  - dossier core : routing mvc et base des controlleurs 
index.php : redirige automatiquement l'utilisateur vers le dossier public

## Informations de connexions de demo :

- medecin : michel.cymes@medecin.com ==> MichelCymes
- patient : mathis.champagne@patient.fr ==> MathisChampagne
- famille : fabrice.autier@famille.fr ==> FabriceAutier
- admin : admin@admin.com ==> AdminTest


## Info importante :
__Attention__, il faut mettre le fichier `index.php`, le dossier `App`, et le dossier `Public` à la racine de votre httpdocs, sinon le projet ne fonctionnera pas !
