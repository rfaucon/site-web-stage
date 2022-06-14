<?php
include 'db.php';
include 'functions.php';

getHeader("Produit");
?>





        <main class="productpage" id="main">

            <?php if (isset($_POST['productId'])) {
                $productId = $_POST['productId'];
                $product = getArticleFromID($productId);
                singleProductPage($product);
            }
            ?>

        </main>
        <footer class="footer row d-flex justify-content-center text-center bg-dark mt-5 pt-3 pb-3 text-white">
        <h3 class="footer__h3">Hold my bear, la référence des ours en peluche made in France.</h3>
    <?php
    footer();
    ?>
</body>

</html>