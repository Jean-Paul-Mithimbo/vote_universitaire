<?php
session_start();
include("entete.php");

include("bdd/connexion.php");

?>

<body>
    <?php
    include("menu.php");

    ?>
    <div class=" w-full p-5 h-52 flex items-center justify-center bg-gray-800">
        <div class=" text-center text-3xl font-extrabold text-gray-50 gauche">Creer un espace de vote</div>
    </div>
    <div class="min-h-72 flex items-center justify-center bg-gray-50 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-1">

            <form class="mt-8 space-y-6 droite" action="" method="POST">

                <div class="rounded-md shadow-sm -space-y-px">

                    <div>
                        <label for="ID_Session" class="sr-only">Session electorale</label>

                        <select name="ID_Session" id="ID_Session" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" required>
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
                </div>


                <div>
                    <button type="submit" name="btn_vote" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <!-- Heroicon name: solid/lock-closed -->
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm10 7V8a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2h2a2 2 0 002-2zm-7-2V8a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1H7a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        Suivant
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
    try {
        if (isset($_POST['btn_vote'])) {
            $ID_Session_electorale = $_POST['ID_Session'];

           
            if ($ID_Session_electorale != "") {
                $_SESSION['ID_Session_electorale'] = $ID_Session_electorale; // Utilisation correcte de $_SESSION
                echo "<script>window.location.replace('espace_vote.php');</script>";
            }

        }
    } catch (Exception $exept) {
        die("Erreur: " . $exept->getMessage());
    }
    ?>
</body>

</html>