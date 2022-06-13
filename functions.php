<?php

/* vérifier si session php existe, sinon on l'initialise */

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

/* Récupérer les articles qui sont dans la bdd - 5/10 - 30 min*/

            // création de la requete pour aller chercher les informations dans la base de données
            $requetearticles = 'SELECT * FROM articles'; 

            // déclaration de la variable $resultatsrequetearticles et assignation de la requete article au format pdo 
            $resultatsrequetearticles = $pdo->query($requetearticles);
            
            // création du tableau vide pour la variable $listearticle
            $listearticle = array();  

            // tant que notre requête à la bdd arrive à récupérer des données, on les assigne à la variable $nosarticles
            while($nosarticles = $resultatsrequetearticles->fetch()) { 
                // on insère le contenu de la variable $nosarticles dans le tableau $listearticle
                $listearticle[] = $nosarticles;
            }

            // affiche les infos de la variable $listearticle
            // var_dump($listearticle); 


/* récuperation article selon son ID - 3/10 - 15 min  */




/* on génère notre div spécifique à un produit sur la page du produit - 2/10 - 15 min */




/* (initialiser) création du panier (qui est un tableau) dans la session, si le panier n'existe pas car $_SESSION['cart'] retourne NULL alors on créé le panier - 5/10 - 45 min */

function creationPanier(){
    if (!isset($_SESSION['panier'])){
       $_SESSION['panier']=array();
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

function viderPanier(){
   $_SESSION['panier']=array();
}
/* restreint l'accès à une page aux personnes connectées - 6/10 - 1h */



/* génère une chaine aléatoire - 3/10 - 15 min*/

function chaineAleatoire($length){
   $random_str = uniqid();  
return substr($random_str, 0, $length);
}


/* enregistre l'adresse du client - 4/10 - 15 min */




/* enregistre les informations de commande du client - 5/10 - 30 min */



/* enregistre les produits présents dans la commande - 5/10 - 30 min*/



/* actualise le stock après une commande - 5/10 - 30 min */




/* affiche le stock d'un produit 3/10 - 20 min*/



/* affiche le montant des frais de port sur la page de détail d'une commande - 4/10 - 30 min*/


/* on sauvegarde l'adresse qui a été modifiée - 4/10 - 20 min*/


?>