<?php
include 'db.php';

include 'functions.php';

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    $product = getArticleFromID($productId);
}
getHeader($product['nom']);
?>





        <main class="productpage" id="main">

            <?php 
                singleProductPage($product);
            
            ?>

        </main>
    <?php
    footer();
    ?>
</body>

</html>