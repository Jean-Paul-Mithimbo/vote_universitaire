<?php
include("entete.php");

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
                        <input type="text" name="nom" id="nom"
                            class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="post-nom" class="block text-md font-medium text-gray-700">Post-Nom</label>
                        <input type="text" name="post-nom" id="post-nom"
                            class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="prenom" class="block text-md font-medium text-gray-700">Prénom</label>
                        <input type="text" name="prenom" id="prenom"
                            class="mt-1 p-1 border  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="email" class="block text-md font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 p-1 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Bouton pour afficher le reste -->
                    <div class="mt-6 flex justify-center">
                        <button type="button" id="show-more"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Suivant
                        </button>
                    </div>

                </div>
        </div>
        <!-- Deuxième moitié des champs (initialement cachée) -->
        <div class="grid grid-cols-1 gap-6 hidden p-4" id="second-section">

            <div>
                <label for="photo" class="block text-md font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" id="photo"
                    class="mt-1 p-2 border focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>

            <div>
                <label for="promotion" class="block text-sm font-medium text-gray-700">Promotion</label>
                <input type="text" name="promotion" id="promotion"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="faculte" class="block text-sm font-medium text-gray-700">Faculté</label>
                <input type="text" name="faculte" id="faculte"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div>
                <label for="matricule" class="block text-sm font-medium text-gray-700">Matricule</label>
                <input type="text" name="matricule" id="matricule"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="flex items-center justify-center">
                <button type="button"
                    class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Afficher plus
                </button>
            </div>
            <div class="mt-6">
                <button type="button" id="show-precedent"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                        <path d="m12.707 7.707-1.414-1.414L5.586 12l5.707 5.707 1.414-1.414L8.414 12z"></path>
                        <path d="M16.293 6.293 10.586 12l5.707 5.707 1.414-1.414L13.414 12l4.293-4.293z"></path>
                    </svg>Precedent
                </button>
            </div>

        </div>

        </form>
    </div>




</body>

</html>