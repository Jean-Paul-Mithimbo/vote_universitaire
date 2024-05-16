<?php
session_start();
include("class/class_etudiant.php");
include("bdd/connexion.php");

if (!isset($_SESSION["ID_Session_electorale"])) {
    echo "<script>window.location.replace('vote.php');</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Matricule'])) {
    $Matricule = trim($_POST['Matricule']);
    if (!empty($Matricule)) {
        try {
            $etud = new Etudiant(null, null, null, $Matricule, null, null, null, null);
            $etud->Verifier_etudiant();
            if (isset($_SESSION['ID_Electeur'])) {
                // Redirection vers la page de vote après authentification
                echo "<script>window.location.replace('espace_vote.php');</script>";
            }
        } catch (Exception $exept) {
            $error = "Erreur: " . $exept->getMessage();
        }
    } else {
        $error = "Le matricule ne peut pas être vide.";
    }
}

include("entete.php");
include("menu.php");
?>


<body>
    <?php


    if (isset($_GET['ID_Candidat'])) {
        $_SESSION['Preso'] =  $_GET['ID_Candidat'];
       
    }
    if (isset($_GET['ID_Candidat_sec'])) {
        $_SESSION['Sec'] =  $_GET['ID_Candidat_sec'];
        // echo $_SESSION['Sec'];
        
    }
   

    if (!isset($_SESSION['ID_Electeur'])) { ?>
        <div class="bg-gray-50 py-6">
            <h1 class="text-center text-3xl font-extrabold">Entrez votre matricule</h1>
            <div class="min-h-72 flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-1">
                    <form class="mt-8 space-y-6" action="" method="POST">
                        <div class="rounded-md shadow-sm -space-y-px">
                            <div>
                                <label for="Matricule" class="sr-only">Matricule</label>
                                <input id="Matricule" name="Matricule" type="text" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Votre matricule">
                            </div>
                        </div>
                        <div>
                            <button type="submit" name="btn_Matri" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } else {
        // Si l'électeur est authentifié
        if (!isset($_SESSION['Preso'])) { ?>
            <div class="">
                <h1 class="font-bold text-3xl text-center py-5">PRESIDENCE</h1>
                <div class="grid-cols-1 sm:grid md:grid-cols-4 mt-10 px-20">
                    <?php
                    $voir = $base->prepare('SELECT e.Nom, e.Prenom, c.Photo, c.Numero_Candidature, c.ID_Candidat
                                            FROM Candidats c
                                            INNER JOIN Electeurs e ON c.ID_Electeur = e.ID_Electeur
                                            WHERE c.ID_Session = ? AND c.ID_Poste = ?');
                    $voir->execute(array($_SESSION["ID_Session_electorale"], 1));
                    while ($res = $voir->fetch()) { ?>
                        <div class="mx-auto mt-6 flex flex-col rounded-lg shadow-md bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0 text-center">
                            <button onclick="openModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')">
                                <div class="mx-3">
                                    <div class="h-56">
                                        <img class="w-full h-full object-cover rounded-t-lg" src="assets/img_candidat/<?php echo $res['Photo']; ?>" alt="Photo candidat" />
                                    </div>
                                    <div class="p-6 h-20">
                                        <h5 class="mb-2 text-xl font-medium leading-tight"><?php echo $res['Nom'] . " " . $res['Prenom']; ?></h5>
                                        <p class="mb-4 text-base"> <?php echo "N°" . $res['Numero_Candidature']; ?></p>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Modal vote -->
                        <div id="<?php echo 'modal' . $res['ID_Candidat']; ?>" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
                            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
                                <div class="flex justify-end p-2">
                                    <button onclick="closeModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-6 pt-0 text-center">
                                    <div class="flex justify-center">
                                        <img src="assets/images/logo.png" class="w-40 cursor-pointer" />
                                    </div>
                                    <h1 class="text-2xl font-bold text-gray-950 text-center">Confirmer votre vote pour
                                        <?php echo $res['Nom'] . " " . $res['Prenom'] . " N°" . $res['Numero_Candidature']; ?>
                                    </h1><br>
                                    <div class="flex justify-around">
                                        <a href="?ID_Candidat=<?= $res['ID_Candidat'] ?>" class="bg-green-600 hover:bg-green-800 text-white w-60 font-semibold rounded-full py-2">Voter</a>
                                        <input type="submit" value="Annuler" name="" onclick="closeModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')" class="bg-red-700 hover:bg-red-800 text-white w-60 font-semibold rounded-full py-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="">
                <h1 class="font-bold text-3xl text-center py-5">SECRETARIAT</h1>
                <div class="grid-cols-1 sm:grid md:grid-cols-4 mt-10 px-20">
                    <?php
                    $voir = $base->prepare('SELECT e.Nom, e.Prenom, c.Photo, c.Numero_Candidature, c.ID_Candidat
                                            FROM Candidats c
                                            INNER JOIN Electeurs e ON c.ID_Electeur = e.ID_Electeur
                                            WHERE c.ID_Session = ? AND c.ID_Poste = ?');
                    $voir->execute(array($_SESSION["ID_Session_electorale"], 4));
                    while ($res = $voir->fetch()) { ?>
                        <div class="mx-auto mt-6 flex flex-col rounded-lg shadow-md bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0 text-center">
                            <button onclick="openModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')">
                                <div class="mx-3">
                                    <div class="h-56">
                                        <img class="w-full h-full object-cover rounded-t-lg" src="assets/img_candidat/<?php echo $res['Photo']; ?>" alt="Photo candidat" />
                                    </div>
                                    <div class="p-6 h-20">
                                        <h5 class="mb-2 text-xl font-medium leading-tight"><?php echo $res['Nom'] . " " . $res['Prenom']; ?></h5>
                                        <p class="mb-4 text-base"> <?php echo "N°" . $res['Numero_Candidature']; ?></p>
                                    </div>
                                </div>
                            </button>
                        </div>
                        <!-- Modal vote -->
                        <div id="<?php echo 'modal' . $res['ID_Candidat']; ?>" class="fixed hidden z-50 inset-0 bg-gray-900 bg-opacity-60 overflow-y-auto h-full w-full px-4">
                            <div class="relative top-40 mx-auto shadow-xl rounded-md bg-white max-w-md">
                                <div class="flex justify-end p-2">
                                    <button onclick="closeModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-6 pt-0 text-center">
                                    <div class="flex justify-center">
                                        <img src="assets/images/logo.png" class="w-40 cursor-pointer" />
                                    </div>
                                    <h1 class="text-2xl font-bold text-gray-950 text-center">Confirmer votre vote pour
                                        <?php echo $res['Nom'] . " " . $res['Prenom'] . " N°" . $res['Numero_Candidature']; ?>
                                    </h1><br>
                                    <div class="flex justify-around">
                                        <a href="?ID_Candidat_sec=<?= $res['ID_Candidat'] ?>" class="bg-green-600 hover:bg-green-800 text-white w-60 font-semibold rounded-full py-2">Voter</a>
                                        <input type="submit" value="Annuler" name="" onclick="closeModal('<?php echo 'modal' . $res['ID_Candidat']; ?>')" class="bg-red-700 hover:bg-red-800 text-white w-60 font-semibold rounded-full py-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
    <?php }
        if (isset($_SESSION['ID_Electeur']) and isset($_SESSION['Preso']) and isset($_SESSION['Sec'])) {
            $etud = new Etudiant($_SESSION['ID_Electeur'], null, null,  null, null, null, null, null);
            $etud->Voter($_SESSION['Preso']);
            $etud->Voter($_SESSION['Sec']);
        }
    }
    ?>

    <script>
        window.openModal = function(modalId) {
            document.getElementById(modalId).style.display = "block";
            document.getElementsByTagName("body")[0].classList.add("overflow-y-hidden");
        };

        window.closeModal = function(modalId) {
            document.getElementById(modalId).style.display = "none";
            document.getElementsByTagName("body")[0].classList.remove("overflow-y-hidden");
        };

        document.onkeydown = function(event) {
            event = event || window.event;
            if (event.keyCode === 27) {
                document.getElementsByTagName("body")[0].classList.remove("overflow-y-hidden");
                let modals = document.getElementsByClassName("modal");
                Array.prototype.slice.call(modals).forEach((i) => {
                    i.style.display = "none";
                });
            }
        };
    </script>

    <?php
    try {
        if (isset($_POST['btn_Matri'])) {
            $Matricule = $_POST['Matricule'];
            if ($Matricule != "") {
                $etud = new Etudiant(null, null, null, $Matricule, null, null, null, null);
                $etud->Verifier_etudiant();
            }
        }
    } catch (Exception $exept) {
        die("Erreur: " . $exept->getMessage());
    }
    ?>
</body>

</html>