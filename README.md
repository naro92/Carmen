# Carmen

Dossier MVC

Contient le code mvc du site internet

## Il manque 2 fichiers :

- dans le dossier app, il faut créer un fichier **.htaccess** qui contiendra :

```
Options -Indexes
```

- dans le dossier public, il faut créer un autre fichier **.htaccess** qui contiendra :

```
Options -MultiViews
RewriteEngine On

RewriteBase /public

RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f

RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
```

**Attention :** Il faut bien coller **exactement** ces codes dans ces fichiers dans les bons dossiers, sinon le projet ne fonctionne pas !
Ces fichiers permettent de gérer la réecriture d'url pour le site !

Il n'est pas possible de mettre ces fichiers dans le github
