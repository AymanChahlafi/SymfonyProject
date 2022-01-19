SymfonyProject
==========

Ce référentiel contient le code pour construire un panier avec Symfony.

Requirements
------------

- PHP 7.2.5+
- [Composer](https://getcomposer.org/download)
- [Symfony CLI](https://symfony.com/download)
- [Docker & Docker compose](https://docs.docker.com/get-docker)

Getting started
---------------

**Cloner la repo**

```
git clone https://github.com/AymanChahlafi/SymfonyProject.git
cd le dossier ciblé
```

**Installer les dépendences**

```
composer install
```

**Starting Docker Compose**

```
docker-compose up -d
```

**Migrating the Database**

```
symfony console doctrine:migrations:migrate 
```

**Loading fake Products**

```
symfony console doctrine:fixtures:load --no-interaction
```

**Launching the Local Web Server**

```
symfony server:start -d
```

Usage
-----

**Adding Products to the Cart**

From the [homepage](http://localhost:8000/), Click on the *Add to Cart* button. The quantity is automaticaly set to 1 and the product is added to the cart.

From the [homepage](http://localhost:8000/), go to a product page by clicking on the *View details* button. Then set a quantity and click on the *Add to Cart* button.

**Removing Products from the Cart**

From the [cart page](http://localhost:8000/cart), click on the *Remove* button for the product you want to remove.

**Updating the quantity of products in the Cart**

From the [cart page](http://localhost:8000/cart), enter the desired quantity for the products and click on the *Save* button.

**Confirm checkout**

From the [checkout page](http://localhost:8000/checkout), enter your card informations and click on the *Confirm Button* button you will redirecte


