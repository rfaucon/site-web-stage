<?php

include 'db.php';
include 'functions.php';

getHeader("Accueil");

?>




        <section class="headersection vh-100 d-flex justify-content-evenly align-items-center flex-column">
            <h1 class="headersection__title">Professionnels de la moto</h1>
            <div>
                <a href="#main" class="btn btn-warning">Je veux voir des motos</a>
                <a href="gamme.php" class="btn btn-success">Je découvre toutes les gammes</a>
            </div>
        </section>

    </header>

    <main class="container-fluid homepage mt-5 vh-70 d-flex align-items-center" id="main">
        <div class="row d-flex justify-content-around align-items-center mt-5">
            <?php
            divproduitaccueil();
            ?>
        </div>
    </main>

    <?php
    footer();
    ?>
    
</body>

</html>