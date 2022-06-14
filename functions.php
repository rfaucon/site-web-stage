<?php

/* vérifier si session php existe, sinon on l'initialise */

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

/* nom de mon site */

$nomdusite = "Esprit Moto";


/* création d'un tableau qui contiendra les produits pour la page d'accueil */

$articlesaccueil = array();


/* requete pour récuperer les articles par gammes */

$queryaccueilcategorie1 = 'SELECT * FROM articles WHERE id_gamme = 1 ORDER BY rand() LIMIT 1';
$queryaccueilcategorie2 = 'SELECT * FROM articles WHERE id_gamme = 2 ORDER BY rand() LIMIT 1';
$queryaccueilcategorie3 = 'SELECT * FROM articles WHERE id_gamme = 3 ORDER BY rand() LIMIT 1';

$resultatarticles1 = $pdo->query($queryaccueilcategorie1);
$resultatarticles2 = $pdo->query($queryaccueilcategorie2);
$resultatarticles3 = $pdo->query($queryaccueilcategorie3);

while ($nosarticles = $resultatarticles1->fetch()) {
   $articlesaccueil[] = $nosarticles;
}

while ($nosarticles = $resultatarticles2->fetch()) {
   $articlesaccueil[] = $nosarticles;
}

while ($nosarticles = $resultatarticles3->fetch()) {
   $articlesaccueil[] = $nosarticles;
}


/* Récupérer les articles qui sont dans la bdd - 5/10 - 30 min*/


// création de la requete pour aller chercher les informations dans la base de données
$requetearticles = 'SELECT * FROM articles';



// création du tableau vide pour la variable $listearticle
$listearticle = array();
// déclaration de la variable $resultatsrequetearticles et assignation de la requete article au format pdo 
$resultatsrequetearticles = $pdo->query($requetearticles);

// tant que notre requête à la bdd arrive à récupérer des données, on les assigne à la variable $nosarticles
while ($nosarticles = $resultatsrequetearticles->fetch()) {
// on insère le contenu de la variable $nosarticles dans le tableau $listearticle
   $listearticle[] = $nosarticles;
}




/* on génére nos div produit de chaque gamme sur la page d'accueil */


function divproduitaccueil()
{
   global $articlesaccueil;
   while (count($articlesaccueil) > 0) {
      $product = array_shift($articlesaccueil); ?>
      <section class="product col-md-3 text-center shadow p-3 mt-5 mb-5 bg-white rounded">

         <article class="product__nameandprice">
            <h2 class="product__title">Moto <?= $product['nom'] ?></h2>
            <p><?= $product['prix'] ?>€</p>
            <img src="images/<?= $product['image'] ?>" alt="Moto <?= $product['nom'] ?>">
            <p><?= $product['description'] ?></p>
            <div class="form__container row d-flex justify-content-center">
               <form class="col-md-7 product__cta" action="produit.php" method="POST">
                  <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                  <input class="mt-3 btn btn-warning" type="submit" value="Je la découvre">
               </form>
               <form class="col-md-5 product__cta" action="panier.php" method="POST">
                  <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                  <input class="mt-3 btn btn-warning" type="submit" value="Je l'adopte">
               </form>
               <?php
               afficherStock($product);
               ?>
            </div>
         </article>

      </section>
   <?php }
}



/* récuperation article selon son ID - 3/10 - 15 min  */


function getArticleFromID($id)
{
    global $listearticle;
    $products = $listearticle;
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            $selectedProduct = $product;
            break;
        }
    }
    return $selectedProduct;
}


/* on génère notre div spécifique à un produit sur la page du produit - 2/10 - 15 min */

function singleProductPage($product)
{ ?>

    <section class=" mb-5 vh-100 headersection d-flex justify-content-evenly align-items-center flex-column" style="background: url(<?="images/moto-par-id/{$product['id']}.webp"?>) no-repeat center;">
        <h1 class="headersection__title"><?= $product['nom'] ?></h1>
        <a href="#theproduct" class="btn btn-warning">Je le personnalise</a>
    </section>

    </header>
    <main class="productpage row mt-3" id="theproduct">
        <section class="product productpage__photo col-md-6">
            <img class="" src="images/<?= $product['image'] ?>" alt="Ours en peluche">
        </section>

        <section class="productpage__details col-md-6">
            <h2 class="productpage__subtitle"><?= $product['nom'] ?><br></h2>
            <p class="productpage__price"><span>Prix</span><br><?= $product['prix'] ?>€</p>

            <p class="productpage__description"><span>Description</span><br><?= $product['description_detaillee'] ?></p>
            <form class="col-md-5 product__cta" action="cart.php" method="POST">
                <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                <input class="mt-3 btn btn-warning col-md-12" type="submit" value="Je l'adopte">
                <?php afficherStock($product) ?>
            </form>
        </section>
    </main>
    <?php }



/* (initialiser) création du panier (qui est un tableau) dans la session, si le panier n'existe pas car $_SESSION['cart'] retourne NULL alors on créé le panier - 5/10 - 45 min */

function creationPanier()
{
   if (!isset($_SESSION['panier'])) {
      $_SESSION['panier'] = array();
      $_SESSION['panier']['nomProduit'] = array();
      $_SESSION['panier']['quantitéProduit'] = array();
      $_SESSION['panier']['prixProduit'] = array();
      $_SESSION['panier']['verrou'] = false;
   }
   return true;
}

/* on ajoute au panier en vérifiant que le panier existe, s'il existe puis si le produit est déjà présent dans le panier on augmente la quantité, sinon on ajoute le produit - 6/10 - 1h*/

function footer(){?>
   <footer class="footer row d-flex justify-content-center text-center bg-dark mt-5 pt-3 pb-3 text-white">
        <h3 class="footer__h3">Esprit moto, la réference de la moto en France.</h3>
    </footer>
    <!-- script pour le menu de bootstrap -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script>
        $(function() {
            var navbarNav = $("#navbarNav");
            navbarNav.on("click", "a", null, function() {
                navbarNav.collapse('hide');
            });
        });
    </script>

    <!-- Script pour chargement de fontawesome-->
    <script src="https://kit.fontawesome.com/a4bf076c8c.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <?php
    }


/* affichage des éléments de la page panier - 3/10 - 20 min */




/* modification de la quantité de l'article présent dans le panier - 4/10 - 20 min */



/* suppression d'un article dans le panier - 4/10 - 20 min*/


/* calcul des frais de port - 5/10 - 30 min*/



/* affichage des frais de port - 2/10 - 15 min */



/* calcul du prix total du panier - 3/10 - 15 min */



/* affiche le prix total du panier - 4/10 - 20 min */



/* Vider le panier qui est un tableau - 3/10 - 15 min */

function viderPanier()
{
   $_SESSION['panier'] = array();
}
/* restreint l'accès à une page aux personnes connectées - 6/10 - 1h */



/* génère une chaine aléatoire - 3/10 - 15 min*/

function chaineAleatoire($length)
{
   $random_str = uniqid();
   return substr($random_str, 0, $length);
}


/* enregistre l'adresse du client - 4/10 - 15 min */




/* enregistre les informations de commande du client - 5/10 - 30 min */



/* enregistre les produits présents dans la commande - 5/10 - 30 min*/



/* actualise le stock après une commande - 5/10 - 30 min */




/* affiche le stock d'un produit 3/10 - 20 min*/

function afficherStock($product)
{

   if ($product['stock'] < 1) { ?><h3 class="product__stock">Rupture de stock</h3>
   <?php } else if ($product['stock'] > 1) { ?><h3 class="product__stock"><?= $product['stock'] ?> motos en stock.</h3>
   <?php } else { ?>
      <h3 class="product__stock"><?= $product['stock'] ?> moto en stock.</h3>
<?php }
}

/* affiche le montant des frais de port sur la page de détail d'une commande - 4/10 - 30 min*/


/* on sauvegarde l'adresse qui a été modifiée - 4/10 - 20 min*/
