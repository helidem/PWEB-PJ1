<?php
require './views/common/commonHead.php';
if (empty($_SESSION['loggedin'])) {
    require("./views/common/navbarVisiteur.php");
} else {
    require("./views/common/navbarSub.php");
}

?>

<main class="container">
    <?php if (isset($Cars)) { ?>
        <h2>Liste des voitures : </h2>
        <div class="row">
            <?php
            require("./model/factureBD.php");
            foreach ($Cars as $car) : ?>
                <div class="col s12 m6 xl4">
                    <div class="card">
                        <div class="card-image">
                            <?php
                            echo ('<img src="' . $car['photo'] . '">');
                            echo ('<a class="btn-floating halfway-fab waves-effect waves-light" href="?page=accounts&action=getBill&id=' . $car['id'] . '"><i class="material-icons">receipt</i></a>');
                            ?>
                        </div>
                        <div class="card-content">
                            <div class="info-container">
                                <p>
                                    <?php $infosFacture = getFacture($car['id'], $_SESSION['user_info']['id']); ?>
                                    <?php echo ('Vous avez reservé cette voiture du ' . date('d/m/Y', strtotime($infosFacture['dateD'])) . ' au ' . date('d/m/Y', strtotime($infosFacture['dateF']))) . '<br>'; ?>

                                </p>
                            </div>
                            <?php
                            echo ('<span class="card-title">' . $car['type'] . ' ' . $car['prix'] . '€/jour' . '</span>');
                            ?>
                            <div class="info-container">
                                <svg class="icones" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#191919" d="M11,13 L8,13 L8,18 L6,18 L6,6 L8,6 L8,11 L11,11 L11,6 L13,6 L13,11 L16,11 L16,6 L18,6 L18,13 L13,13 L13,18 L11,18 L11,13 Z M8,4 L6,4 L6,2 L8,2 L8,4 Z M12.9997,4.0001 L10.9997,4.0001 L10.9997,2.0001 L12.9997,2.0001 L12.9997,4.0001 Z M18,4 L16,4 L16,2 L18,2 L18,4 Z M12.9997,22.0001 L10.9997,22.0001 L10.9997,20.0001 L12.9997,20.0001 L12.9997,22.0001 Z M8,22 L6,22 L6,20 L8,20 L8,22 Z"></path>
                                </svg>
                                <?php
                                echo json_decode($car['caract'])->automatique ? 'Automatique' : 'Manuelle';
                                ?>
                            </div>

                            <div class="info-container">
                                <svg class="icones" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="#191919" d="M12,8.406 C12,6.95572761 10.9624744,6 9.4594,6 C8.05803939,6 7,7.04664702 7,8.406 C7,9.81852498 8.10931602,11 9.4594,11 C10.9042369,11 12,9.91018444 12,8.406 Z M14,8.406 C14,11.017198 12.006377,13 9.4594,13 C6.97558879,13 5,10.8959027 5,8.406 C5,5.93720183 6.95828756,4 9.4594,4 C12.0320353,4 14,5.81281142 14,8.406 Z M3.93632918,19.3511234 L2.06367082,18.6488766 C2.11647234,18.5080725 2.21091202,18.2730226 2.34165517,17.9741812 C2.55916776,17.4770095 2.80183291,16.9792349 3.06592446,16.5097388 C3.94654645,14.9441886 4.83172322,14 6,14 L13,14 C14.1682768,14 15.0534535,14.9441886 15.9340755,16.5097388 C16.1981671,16.9792349 16.4408322,17.4770095 16.6583448,17.9741812 C16.789088,18.2730226 16.8835277,18.5080725 16.9363292,18.6488766 L15.0636708,19.3511234 C15.0227223,19.2419275 14.9413808,19.0394774 14.8260302,18.7758188 C14.6333865,18.3354905 14.4190204,17.8957651 14.1909245,17.4902612 C13.9105829,16.9918762 13.6309243,16.5851 13.3720253,16.3089411 C13.1617992,16.0847 13.018868,16 13,16 L6,16 C5.98113199,16 5.83820078,16.0847 5.6279747,16.3089411 C5.36907575,16.5851 5.08941713,16.9918762 4.80907554,17.4902612 C4.58097959,17.8957651 4.36661349,18.3354905 4.17396983,18.7758188 C4.05861923,19.0394774 3.97727766,19.2419275 3.93632918,19.3511234 Z M17,16 L17,14 L19,14 C20.1682768,14 21.0534535,14.9441886 21.9340755,16.5097388 C22.1981671,16.9792349 22.4408322,17.4770095 22.6583448,17.9741812 C22.789088,18.2730226 22.8835277,18.5080725 22.9363292,18.6488766 L21.0636708,19.3511234 C21.0227223,19.2419275 20.9413808,19.0394774 20.8260302,18.7758188 C20.6333865,18.3354905 20.4190204,17.8957651 20.1909245,17.4902612 C19.9105829,16.9918762 19.6309243,16.5851 19.3720253,16.3089411 C19.1617992,16.0847 19.018868,16 19,16 L17,16 Z M15,6 L15,4 L16,4 C18.1521499,4 20,6.05316681 20,8.5 C20,10.9468332 18.1521499,13 16,13 L15,13 L15,11 L16,11 C16.9978501,11 18,9.88650014 18,8.5 C18,7.11349986 16.9978501,6 16,6 L15,6 Z"></path>
                                </svg>
                                <?php
                                echo json_decode($car['caract'])->nbPlaces . " Sièges";
                                ?>
                            </div>

                            <div class="info-container">
                                <svg class="icones" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M21,20V2H10v11H7c-0.6,0-1,0.5-1,1v3H4l0-7.6l4.7-4.7L7.3,3.3L2,8.6V13l0,5c0,0.5,0.4,1,1,1h4c0.5,0,1-0.5,1-1v-3h2v5H9v2   h13v-2H21z M19,10h-7V4h7V10z"></path>
                                </svg>
                                <?php
                                echo json_decode($car['caract'])->typeEnergie;
                                ?>
                            </div>
                        </div>
                    </div>



                </div>
            <?php endforeach; ?>
        </div>
    <?php } else { ?>
        Pas de voitures dispo
    <?php } ?>
</main>

<?php include './views/common/commonFoot.php'; ?>