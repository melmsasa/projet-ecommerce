<?php
session_start();
$connecte = false;
if (isset($_SESSION['utilisateur'])) {
    $connecte = true;
}

?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Ecommerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page" href="index.php"><i class="fa-solid fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page" href="index.php"><i class="fa-solid fa-user-plus"></i>
                        Ajouter utilisateur</a>
                </li>
                <?php
                if ($connecte) {

                    ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           aria-current="page" href="ajoute_categorie.php"><i
                                    class="fa-brands fa-dropbox"></i> Ajoute des catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           aria-current="page" href="ajoute_produit.php"><i class="fa-solid fa-tag"></i>
                            ajoute des produits</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page" href="list_categorie.php"><i class="fa-solid fa-tag"></i>
                        list des categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                       aria-current="page" href="list_produit.php"><i class="fa-solid fa-tag"></i>
                        list des produits</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="deconnexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Deconnexion</a>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="connexion.php"><i class="fa-solid fa-arrow-right-to-bracket"></i> Connexion</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <a class="btn float-end" href="front/"><i class="fa-solid fa-cart-shopping"></i> Site front</a>
    </div>
</nav>