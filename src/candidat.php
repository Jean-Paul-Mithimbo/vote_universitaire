<?php
include("entete.php");
include('class/class_candidat.php');
include('bdd/connexion.php');

?>

<body>
    <?php
    include("menu.php");

    ?>
    <div class="max-w-2xl mx-auto mt-6 bg-white shadow-md rounded-md overflow-hidden">
        <form id="student-form" action="" method="POST" enctype="multipart/form-data">
            <div class="px-6 py-4">
                <h2 class="text-xl  text-center font-bold text-gray-800 mb-2">Ajouter un candidat</h2>

                <div class="grid grid-cols-1 gap-6 p-4" id="first-section">
                    <!-- Première moitié des champs -->
                    <div>
                        <label for="Numero_Candidature" class="block text-md font-medium text-gray-700">Numero du candidat</label>
                        <input type="number" name="Numero_Candidature" id="nom" class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="ID_Electeur" class="block text-md font-medium text-gray-700">identite du candidat</label>
                        <!-- <select name="ID_Electeur" id="ID_Electeur" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            <option value="" desabled>identite du candidat</option>
                            <?php

                            // $affiche = $base->query('SELECT* FROM Electeurs order by Matricule desc  ');
                            // while ($resultat = $affiche->fetch()) {
                            ?>
                                <option value="<?php //echo $resultat['ID_Electeur']; 
                                                ?>">
                                    <?php //echo $resultat['Matricule'] . " " . $resultat['Prenom'] . " " . $resultat['Nom']; 
                                    ?>
                                </option>
                            <?php //} 
                            ?>
                            </option>

                        </select> -->
                        <!-- recherche -->
                        <input type="text" id="recherche" placeholder="Rechercher..." class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        <select id="options" name="ID_Electeur" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            <!-- Options seront ajoutées ici dynamiquement via JavaScript -->
                        </select>
                        <!-- recherche  end-->
                    </div>

                    <div>
                        <label for="photo_candidat" class="block text-md font-medium text-gray-700">Photo</label>
                        <input type="file" name="Photo" id="photo_candidat" class="mt-1 p-2 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Bouton pour afficher le reste -->
                    <div class=" flex justify-end">
                        <button type="button" id="show-more" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">

                            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                <path d="m13.061 4.939-2.122 2.122L15.879 12l-4.94 4.939 2.122 2.122L20.121 12z"></path>
                                <path d="M6.061 19.061 13.121 12l-7.06-7.061-2.122 2.122L8.879 12l-4.94 4.939z"></path>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
            <!-- Deuxième moitié des champs (initialement cachée) -->
            <div class="grid grid-cols-1 gap-6 hidden p-4" id="second-section">


                <div>
                    <label for="ID_Poste" class="block text-sm font-medium text-gray-700">Poste</label>
                    <select name="ID_Poste" id="ID_Poste" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        <option value="" desabled>Poste</option>
                        <?php

                        $affiche = $base->query('SELECT* FROM Postes');
                        while ($resultat = $affiche->fetch()) {
                        ?>
                            <option value="<?php echo $resultat['ID_Poste']; ?>">
                                <?php echo $resultat['Nom_Poste']; ?>
                            </option>
                        <?php } ?>
                        </option>

                    </select>
                </div>
                <div>
                    <label for="ID_Session" class="block text-sm font-medium text-gray-700">Session electorale</label>

                    <select name="ID_Session" id="ID_Session" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        <option value="" desabled>Session electorale</option>
                        <?php

                        $affiche = $base->query('SELECT* FROM sessions_electorales ');
                        while ($resultat = $affiche->fetch()) {
                        ?>
                            <option value="<?php echo $resultat['ID_Session']; ?>">
                                <?php echo $resultat['Detail']; ?>
                            </option>
                        <?php } ?>
                        </option>

                    </select>
                </div>

                <div class="flex items-center justify-center">
                    <button type="submit" name="btn_candidat" class=" mt-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500">
                        Ajouter Candidat
                    </button><br>
                    <input type="submit" name="tuma" value="tuma">
                </div>
                <div class="">
                    <button type="button" id="show-precedent" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path d="m12.707 7.707-1.414-1.414L5.586 12l5.707 5.707 1.414-1.414L8.414 12z"></path>
                            <path d="M16.293 6.293 10.586 12l5.707 5.707 1.414-1.414L13.414 12l4.293-4.293z"></path>
                        </svg>
                    </button>
                </div>

            </div>

        </form>
    </div>

    <?php
    try {
        if (isset($_POST['btn_candidat'])) {
            $Numero_Candidature =  $_POST['Numero_Candidature'];
            $ID_Electeur = $_POST['ID_Electeur'];
            $ID_Poste = $_POST['ID_Poste'];
            $ID_Session = $_POST['ID_Session'];

            // Vérifions que le fichier a été transmis sans erreurs
            if (isset($_FILES['Photo']) && $_FILES['Photo']['error'] == 0) {
                // Vérifions la taille du fichier
                if ($_FILES['Photo']['size'] < 5000000) { // 15 mégaoctets
                    // Stockons le nom du fichier dans une variable
                    $nom_fichier = pathinfo($_FILES['Photo']['name']);

                    // Récupérons l'extension du fichier
                    $recup_extension = $nom_fichier['extension'];

                    // Définissons les extensions autorisées
                    $extensions = array('jpg', 'jpeg', 'png', 'PNG', 'jfif', 'JPG', 'JPEG');

                    // Vérifions si l'extension du fichier uploadé est autorisée
                    if (in_array($recup_extension, $extensions)) {
                        // Déplaçons le fichier vers notre serveur
                        if (move_uploaded_file($_FILES['Photo']['tmp_name'], 'assets/img_candidat/' . basename($_FILES['Photo']['name']))) {
                            // Instancions la classe Candidat
                            // echo "salut";
                            $candidat = new Candidat(null, $Numero_Candidature, $ID_Electeur, $ID_Poste, $ID_Session, $_FILES['Photo']['name']);
                            // Enregistrons le candidat
                            $candidat->enregistrer_candidat();
                            // Affichons un message de succès
                            echo "<script>alert('//Candidat ajouté avec succès');</script>";
                        }
                    } else {
                        echo "<script>alert('Extension de fichier non autorisée');</script>";
                    }
                } else {
                    echo "<script>alert('La taille du fichier dépasse 15 Mo');</script>";
                }
            }
        }
    } catch (Exception $exept) {
        die("Erreur: " . $exept->getMessage());
    }


    ?>


</body>

</html>