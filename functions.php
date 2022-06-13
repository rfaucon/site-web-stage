<?php

/* vérifier si session php existe, sinon on l'initialise */

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}


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





/* récuperation article selon son3I - 3/10 - 15 min  */

/* on génére nos div produit de chaque gamme sur la page d'accueil */


function divproduitaccueil(){
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
                <form class="col-md-7 product__cta" action="product.php" method="POST">
                    <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                    <input class="mt-3 btn btn-warning" type="submit" value="Je la découvre">
                </form>
                <form class="col-md-5 product__cta" action="cart.php" method="POST">
                    <input type="hidden" name="productId" value="<?= $product['id'] ?>">
                    <input class="mt-3 btn btn-warning" type="submit" value="Je l'adopte">
                </form>
                <?php 
                afficherStock($product);
                ?>
            </div>
        </article>

    </section>
<?php } }



/* récuperation article selon son ID - 3/10 - 15 min  */




/* on génère notre div spécifique à un produit sur la page du produit - 2/10 - 15 min */




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

function afficherStock($product){

   if ($product['stock'] < 1) { ?><h3 class="product__stock">Rupture de stock</h3>
      <?php }
     else if ($product['stock'] > 1) { ?><h3 class="product__stock"><?= $product['stock'] ?> motos en stock.</h3>
      <?php } else
      { ?>
         <h3 class="product__stock"><?= $product['stock'] ?> moto en stock.</h3>
      <?php } 
}

/* affiche le montant des frais de port sur la page de détail d'une commande - 4/10 - 30 min*/


/* on sauvegarde l'adresse qui a été modifiée - 4/10 - 20 min*/
