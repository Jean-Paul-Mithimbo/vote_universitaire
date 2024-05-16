<?php
session_start();
include("class/class_etudiant.php");
// Vérifie si la clé est définie dans la session avant de l'utiliser
if (!isset($_SESSION["ID_Session_electorale"])) {
    echo "<script>window.location.replace('vote.php');</script>";
    // exit("ID_Session_electorale n'est pas défini dans la session.");
}
include("entete.php");
include("bdd/connexion.php");

?>

<body>
    <?php
    include("menu.php");

    ?>
    <?php
    if (isset($_SESSION['ID_Electeur'])) { ?>
        <div>
            <h1 class="text-center"><?php echo $_SESSION['Nom'] . " " . $_SESSION['Prenom'] ?></h1>
        </div>
    <?php
    }
    ?>

    <div class="poste-container bg-gray-50 py-6" data-index="0">

        <h1 class=" text-center text-3xl font-extrabold  gauche">Entrez votre matricule</h1>
        <!-- Contenu des candidats pour le poste 1 -->
        <div class="min-h-72 flex items-center justify-center  px-4 sm:px-6 lg:px-8">

            <div class="max-w-md w-full space-y-1">

                <form class="mt-8 space-y-6 droite" action="" method="POST">

                    <div class="rounded-md shadow-sm -space-y-px">

                        <div>
                            <label for="Matricule" class="sr-only">matricule</label>
                            <input id="Matricule" name="Matricule" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Votre matricule">
                        </div>

                    </div>


                    <div>
                        <button type="submit" name="btn_Matri" class="group next-button relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <!-- Heroicon name: solid/lock-closed -->
                                <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm10 7V8a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2h2a2 2 0 002-2zm-7-2V8a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H7a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <button class="next-button">Suivant</button>
    </div>
    <?php

    $affiche = $base->prepare('SELECT p.ID_Poste,p.Nom_Poste
            FROM Candidats c
            INNER JOIN Postes p ON c.ID_Poste = p.ID_Poste
            WHERE c.ID_Session = ?;
            ');
    $affiche->execute(array($_SESSION["ID_Session_electorale"]));
    $n = 0;
    while ($resultat = $affiche->fetch()) {
    ?>
        <div class="poste-container" data-index="<?php echo $n += 1; ?>" style="display: none;">
            <h1 class="font-bold text-3xl text-center py-5"><?php echo $resultat['Nom_Poste']; ?></h1>
            <div class="grid-cols-1 sm:grid md:grid-cols-4 mt-10 px-20  ">
                <?php
                $voir = $base->prepare('SELECT e.Nom,e.Prenom,c.Photo
                FROM Candidats c
                INNER JOIN Electeurs e ON c.ID_Electeur = e.ID_Electeur
                WHERE c.ID_Session = ? and c.ID_Poste=? ;
                ');
                $voir->execute(array($_SESSION["ID_Session_electorale"], $resultat['ID_Poste']));
                while ($res = $voir->fetch()) { ?>

                    <div class="mx-auto mt-6 flex flex-col rounded-lg shadow-md bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0 text-center">
                        <div class="mx-3">
                            <div class="h-56">
                                <img class="w-full h-full object-cover rounded-t-lg" src="assets/img_candidat/<?php echo $res['Photo']; ?>" alt="Photo candidat" />
                            </div>
                            <div class="p-6 h-20">
                                <h5 class="mb-2 text-xl font-medium leading-tight"><?php echo $res['Nom'] . " " . $res['Prenom']; ?></h5>
                                <p class="mb-4 text-base"></p>
                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>
                <?php  ?>
            </div>
            <button class="next-button">Suivant</button>
        </div>
    <?php } ?>
    <div class="poste-container bg-gray-50 py-6" data-index="<?php echo $n += 1; ?>" style="display: none;">

        <h1 class=" text-center text-3xl font-extrabold  gauche">Entrez votre</h1>
        <!-- Contenu des candidats pour le poste 1 -->
        <div class="min-h-72 flex items-center justify-center  px-4 sm:px-6 lg:px-8">

            <div class="max-w-md w-full space-y-1">

                <form class="mt-8 space-y-6 droite" action="" method="POST">

                    <div class="rounded-md shadow-sm -space-y-px">

                        <div>
                            <label for="Matricule" class="sr-only">matricule</label>
                            <input id="Matricule" name="Matricule" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Votre matricule">
                        </div>

                    </div>


                    <div>
                        <button type="submit" name="btn_Matri" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <!-- Heroicon name: solid/lock-closed -->
                                <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm10 7V8a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2h2a2 2 0 002-2zm-7-2V8a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H7a1 1 0 01-1-1z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <button class="next-button">Suivant</button>
    </div>
    <script>
        //espace candidat
        document.addEventListener("DOMContentLoaded", function() {
            var postes = document.querySelectorAll(".poste-container");
            var currentIndex = 0;

            // Cacher tous les postes sauf le premier
            for (var i = 1; i < postes.length; i++) {
                postes[i].style.display = "none";
            }

            // Ajouter un gestionnaire d'événements sur chaque bouton "Suivant"
            var nextButtons = document.querySelectorAll(".next-button");
            nextButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Cacher le poste actuel
                    postes[currentIndex].style.display = "none";

                    // Passer au poste suivant
                    currentIndex = (currentIndex + 1) % postes.length;

                    // Afficher le nouveau poste
                    postes[currentIndex].style.display = "block";
                });
            });
        });
    </script>
    <?php
    try {
        if (isset($_POST['btn_Matri'])) {
            $Matricule =  $_POST['Matricule'];

            if ($Matricule != "") {
                $etud = new Etudiant(null, null, null,  $Matricule, null, null, null, null);
                $etud->Verifier_etudiant();
            }
        }
    } catch (Exception $exept) {
        die("Erreur: " . $exept->getMessage());
    }
    ?>

</body>

</html>