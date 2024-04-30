<?php
include("entete.php");
include('class/class_etudiant.php');
include('bdd/connexion.php');

?>

<body>
    <?php
    include("menu.php");

    ?>
    <div class="max-w-2xl mx-auto mt-6 bg-white shadow-md rounded-md overflow-hidden">
        <div class="px-6 py-4">
            <h2 class="text-xl  text-center font-bold text-gray-800 mb-2">Ajouter un étudiant</h2>
            <form id="student-form" action="#" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 gap-6 p-4" id="first-section">
                    <!-- Première moitié des champs -->
                    <div>
                        <label for="nom" class="block text-md font-medium text-gray-700">Nom</label>
                        <input type="text" name="Nom" id="nom" class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label for="prenom" class="block text-md font-medium text-gray-700">Prénom</label>
                        <input type="text" name="Prenom" id="prenom" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block text-md font-medium text-gray-700">Email</label>
                        <input type="email" name="Email" id="email" class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="photo" class="block text-md font-medium text-gray-700">Photo</label>
                        <input type="file" name="Photo" id="photo" class="mt-1 p-2 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                <label for="promotion" class="block text-sm font-medium text-gray-700">Promotion</label>

                <select name="ID_Promotion" id="promotion" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="" desabled>Promotion</option>
                    <?php

                    $affiche = $base->query('SELECT* FROM Promotions order by Nom_Promotion desc  ');
                    while ($resultat = $affiche->fetch()) {
                    ?>
                        <option value="<?php echo $resultat['ID_Promotion']; ?>">
                            <?php echo $resultat['Nom_Promotion']; ?>
                        </option>
                    <?php } ?>
                    </option>

                </select>
            </div>
            <div>
                <label for="faculte" class="block text-sm font-medium text-gray-700">Faculté</label>
                <select name="ID_Faculte" id="faculte" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    <option value="" desabled>faculté</option>
                    <?php

                    $affiche = $base->query('SELECT* FROM Facultes order by Nom_Faculte desc');
                    while ($resultat = $affiche->fetch()) {
                    ?>
                        <option value="<?php echo $resultat['ID_Faculte']; ?>">
                            <?php echo $resultat['Nom_Faculte']; ?>
                        </option>
                    <?php } ?>
                    </option>

                </select>
            </div>
            <div>
                <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                <input type="text" name="Matricule" id="matricule" class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="flex items-center justify-center">
                <button type="submit" name="btn_electeur" class=" mt-2 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-indigo-500">
                    Ajouter
                </button>
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
        if (isset($_POST['btn_electeur'])) {
            $Nom =  $_POST['Nom'];
            $Prenom = $_POST['Prenom'];
            $Matricule = $_POST['Matricule'];
            $Email = $_POST['Email'];
            $ID_Promotion = $_POST['ID_Promotion'];
            $ID_Faculte=$_POST['ID_Faculte'];

            // verifions que le fichier a été transmis sans erreurs
            if (isset($_FILES['Photo']) and $_FILES['Photo']['error'] == 0) {
                // echo "bjr";
                // verifions la taille du fichier
                if ($_FILES['Photo']['size'] < 5000000) {

                    // stockons le nom du fichier dans une variable
                    $nom_fichier = pathinfo($_FILES['Photo']['name']);

                    // récuperons l'extension du fichier
                    $recup_extension = $nom_fichier['extension'];
                    // définissons les extensions autorisées
                    $extensions = array('jpg', 'jpeg', 'png', 'PNG', 'jfif', 'JPG', 'JPEG');
                    // verifions si l'extension du fichier uploader est autorisé
                    if (in_array($recup_extension, $extensions)) {
                        // deplaçons le fichier vers notre serveur
                        if (move_uploaded_file($_FILES['Photo']['tmp_name'], 'assets/img_electeurs/' . basename($_FILES['Photo']['name']))) {
                            // include("class_livre.php");
                            $etudiant = new Etudiant(null,$Nom,$Prenom, $Matricule, $Email, $_FILES['Photo']['name'],$ID_Promotion,$ID_Faculte);
                            $etudiant->Faire_inscription();
                            // echo "<script>
                            //      var notification = alertify.notify('Electeur enregistré', 'success', 5, function(){  console.log('dismissed'); });
                            // </script>";
                        }
                    } else {
                        $afficher = "extension non autoriser";
                    }
                } else {
                    $afficher = "fichier très volumineux";
                }
            }
        }
    } catch (Exception $exept) {
        die("Erreur: " . $exept->getMessage());
    }
    ?>


</body>

</html>