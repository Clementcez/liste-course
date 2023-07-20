liste-course

- PHP 8.2.6
- symfony 6.3.1
- node 18.14.2

Test technique

Énoncé : 
Mettre en place une mini application de listes de courses permettant la création et la suppression de produits.
Pour se faire l’application devra comprendre un formulaire d’ajout de catégorie de produit, une page de liste de ces catégories, et la possibilité de les supprimer.
On devra avoir les mêmes fonctionnalités pour les produits qui seront créés à partir de ces catégories.
Enfin le même principe devra être appliqué pour la gestion des listes de courses qui comprendront une liste de produits associée à une notion de quantité.
Contraintes : 
    • L’application doit être versionnée et accessible sur github
    • Utiliser le framework symfony 6 (PHP 8)
    • BDD MYSQL
Catégorie de produit :
Doit comprendre au minimum un libelle (unique)
    • Faire des fixtures de bases avec quelques catégories
Produit :
Doit obligatoirement être lié à au moins une catégorie de produit et avoir un libelle (unique)
    • Faire des fixtures de bases avec quelques produits
Liste de course :
Doit comprendre au minimum un libelle, une date de création / édition et une liste de produits avec quantité
    • Un produit ne peut être ajouté qu’une seule fois dans la liste

L’utilisation de librairies / bundles tiers, etc est libre, de même que l’ajout de fonctionnalités / contrôles en plus, du moment que la base de l’énoncé et les contraintes sont respectées. A minima au niveau de l’interface on doit pouvoir accéder aux différentes pages de liste / créations des différents objets de manière logique. La nomenclature / structure du code doit être pensé comme si l’application devait être amené à être reprise par la suite par d’autres personnes et donc facilement maintenable et pérenne dans le temps.

installation du projet:

- creer un fichier .env.local ajouter la ligne DATABASE_URL="mysql://##:##@127.0.0.1:3306/liste-course"

- composer install

- npm install

- npm run build

- php bin/console doctrine:database:create

- php bin/console doctrine:migrations:migrate 

- php bin/console doctrine:fixtures:load