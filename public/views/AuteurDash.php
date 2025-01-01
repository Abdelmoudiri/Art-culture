<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'Auteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animation de l'image de profil */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .profile-image {
            animation: pulse 2s infinite;
        }

        /* Effet de fondu pour le texte */
        .fadeIn {
            animation: fadeIn 1.5s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Effet de survol des cartes */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        /* Animation du bouton */
        .hover-animate:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        /* Fond dégradé avec animation */
        .gradient-bg {
            background: linear-gradient(45deg, #ff6a00, #ee0979);
            background-size: 400% 400%;
            animation: gradient 5s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="gradient-bg">

    <!-- Section Profil de l'Auteur -->
    <div class="max-w-screen-xl mx-auto p-10 text-center text-white">
        <h1 class="text-4xl font-extrabold tracking-tight mb-6 fadeIn">Bienvenue sur le Profil de l'Auteur</h1>

        <!-- Image de l'Auteur avec animation -->
        <div class="relative mx-auto mb-6 w-32 h-32 rounded-full overflow-hidden">
            <img src="https://via.placeholder.com/150" alt="Photo de l'Auteur" class="w-full h-full object-cover profile-image rounded-full border-4 border-white shadow-xl">
        </div>

        <h2 class="text-3xl font-semibold mb-4 fadeIn">Jean Dupont</h2>
        <p class="text-lg mb-6 fadeIn">Jean Dupont est un écrivain passionné par l'art et la culture. Il explore des thèmes variés tels que la littérature, la philosophie et l'art visuel. Ses travaux ont été publiés dans plusieurs revues prestigieuses.</p>

        <!-- Button pour modifier les informations -->
        <a href="#" class="text-lg font-medium py-2 px-6 bg-white text-teal-700 rounded-full hover:bg-teal-700 hover:text-white transition duration-300 mb-10 hover-animate">Modifier le Profil</a>
    </div>


     <!-- Section Gérer les Articles -->
<div class="max-w-screen-xl mx-auto p-10 bg-gradient-to-r from-teal-400 to-blue-500 text-white rounded-lg shadow-xl transform transition-transform hover:scale-105 hover:shadow-2xl">
    <h2 class="text-3xl font-bold text-center mb-6 animate__animated animate__fadeIn">Gérer Vos Articles</h2>
    
    <!-- Cartes avec des boutons pour la gestion des articles -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Modifier un article -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Modifier un Article</h3>
            <p class="text-gray-600 mb-4">Mettre à jour vos articles existants, changer le contenu, les images, et plus.</p>
            <button onclick="showSection('modifierSection')" class="block text-center text-white bg-teal-600 hover:bg-teal-700 py-2 px-4 rounded-lg transition duration-300 ease-in-out">Modifier</button>
        </div>
        
        <!-- Supprimer un article -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Supprimer un Article</h3>
            <p class="text-gray-600 mb-4">Supprimez les articles que vous n'avez plus besoin de garder.</p>
            <button onclick="showSection('supprimerSection')" class="block text-center text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-lg transition duration-300 ease-in-out">Supprimer</button>
        </div>
        
        <!-- Ajouter un nouvel article -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform hover:scale-105">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un Nouvel Article</h3>
            <p class="text-gray-600 mb-4">Publiez un nouvel article pour partager vos pensées et idées avec vos lecteurs.</p>
            <button onclick="showSection('ajouterSection')" class="block text-center text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg transition duration-300 ease-in-out">Ajouter</button>
        </div>
    </div>

    <!-- Sections cachées qui seront affichées au clic -->
    <div id="modifierSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Modifier un Article</h3>
        <p class="text-gray-600 mb-4">Formulaire pour modifier un article existant.</p>
        <!-- Ajoutez ici le formulaire de modification -->
        <input type="text" class="border p-2 w-full mb-4" placeholder="Titre de l'article">
        <textarea class="border p-2 w-full mb-4" placeholder="Contenu de l'article"></textarea>
        <button class="text-white bg-teal-600 hover:bg-teal-700 py-2 px-4 rounded-lg">Sauvegarder les modifications</button>
    </div>

    <div id="supprimerSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Supprimer un Article</h3>
        <p class="text-gray-600 mb-4">Choisissez un article à supprimer.</p>
        <!-- Liste des articles à supprimer -->
        <select class="border p-2 w-full mb-4">
            <option value="">Sélectionner un article à supprimer</option>
            <option value="article1">Article 1</option>
            <option value="article2">Article 2</option>
            <option value="article3">Article 3</option>
        </select>
        <button class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-lg">Supprimer</button>
    </div>

    <div id="ajouterSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter un Nouvel Article</h3>
        <p class="text-gray-600 mb-4">Formulaire pour ajouter un nouvel article.</p>
        <!-- Ajoutez ici le formulaire d'ajout -->
        <input type="text" class="border p-2 w-full mb-4" placeholder="Titre de l'article">
        <textarea class="border p-2 w-full mb-4" placeholder="Contenu de l'article"></textarea>
        <button class="text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg">Ajouter</button>
    </div>
</div>

<script>
    // Fonction pour afficher la section appropriée
    function showSection(sectionId) {
        // Masquer toutes les sections
        const sections = document.querySelectorAll('.section-content');
        sections.forEach(function(section) {
            section.classList.add('hidden');
        });

        // Afficher la section demandée
        const sectionToShow = document.getElementById(sectionId);
        sectionToShow.classList.remove('hidden');
    }
</script>

    <!-- Section Articles -->
    <div class="max-w-screen-xl mx-auto p-10">
        <h2 class="text-3xl font-bold text-white mb-6 text-center fadeIn">Les Derniers Articles de l'Auteur</h2>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="card bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-transform duration-300">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">L'Art de la Littérature Moderne</h3>
                <p class="text-gray-600 mb-4">Un voyage à travers les styles et les genres littéraires qui ont défini la modernité. Découvrez comment la littérature évolue pour refléter les préoccupations contemporaines.</p>
                <a href="#" class="text-teal-500 hover:underline">Lire l'article</a>
            </div>

            <div class="card bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-transform duration-300">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">La Philosophie de l'Art Contemporain</h3>
                <p class="text-gray-600 mb-4">Une réflexion sur la place de l'art contemporain dans le monde moderne, et son lien intime avec les courants philosophiques actuels.</p>
                <a href="#" class="text-teal-500 hover:underline">Lire l'article</a>
            </div>

            <div class="card bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-transform duration-300">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">La Peinture comme Miroir de l'Âme</h3>
                <p class="text-gray-600 mb-4">Explorez la relation profonde entre l'art pictural et l'expression des émotions humaines, et découvrez des artistes dont l'œuvre est un véritable miroir de l'âme.</p>
                <a href="#" class="text-teal-500 hover:underline">Lire l'article</a>
            </div>
        </div>
    </div>

    <!-- Section Gérer les Articles -->




</body>

</html>
