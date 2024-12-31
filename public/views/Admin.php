<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-800 text-white p-6 fixed">
        <h2 class="text-2xl font-bold text-center mb-8">Admin Dashboard</h2>
        <nav class="space-y-6">
            <a href="#gestion-articles" class="flex items-center space-x-3 text-lg hover:text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2h-5V4H2v16h15z"></path>
                </svg>
                <span>Gestion des Articles</span>
            </a>
            <a href="#gestion-categories" class="flex items-center space-x-3 text-lg hover:text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10M7 10h10M7 16h10"></path>
                </svg>
                <span>Gestion des Catégories</span>
            </a>
            <a href="#gestion-utilisateurs" class="flex items-center space-x-3 text-lg hover:text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6H2v16h16V6h-2m-2 0v16h-8V6H4z"></path>
                </svg>
                <span>Gestion des Utilisateurs</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 p-8">
        <!-- Header Section -->
        <header class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">Bienvenue, Admin</h1>
            <p class="text-lg text-gray-600">Gérez le contenu et les utilisateurs de la plateforme.</p>
        </header>

        <!-- Dashboard Cards Section -->
        <section id="gestion-articles" class="section hidden">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Articles</h2>
                <p class="text-gray-600 mb-4">Créer, modifier et gérer les articles publiés.</p>
                <div class="flex justify-between items-center">
                    <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md">Voir Articles</a>
                    <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-md">Ajouter Article</a>
                </div>
            </div>
        </section>

        <section id="gestion-categories" class="section hidden">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Catégories</h2>
                <p class="text-gray-600 mb-4">Créer, modifier et gérer les catégories des articles.</p>
                <div class="flex justify-between items-center">
                    <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md">Voir Catégories</a>
                    <a href="#" class="bg-green-500 text-white py-2 px-4 rounded-md">Ajouter Catégorie</a>
                </div>
            </div>
        </section>

        <section id="gestion-utilisateurs" class="section hidden">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Utilisateurs</h2>
                <p class="text-gray-600 mb-4">Consulter et gérer les profils des utilisateurs.</p>
                <div class="flex justify-between items-center">
                    <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md">Voir Utilisateurs</a>
                    <a href="#" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="confirmDelete()">Supprimer Utilisateur</a>
                </div>
            </div>
        </section>

    </main>

    <!-- JavaScript -->
    <script>
        // Function to show a section when clicked
        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer tous les liens de navigation
            const navLinks = document.querySelectorAll("aside nav a");

            // Récupérer toutes les sections du tableau de bord
            const sections = document.querySelectorAll(".section");

            // Fonction pour afficher une section spécifique
            function showSection(sectionId) {
                // Cacher toutes les sections
                sections.forEach(function(section) {
                    section.classList.add("hidden");
                });

                // Afficher la section correspondante
                const sectionToShow = document.getElementById(sectionId);
                if (sectionToShow) {
                    sectionToShow.classList.remove("hidden");
                }
            }

            // Ajouter un événement de clic sur chaque lien de la sidebar
            navLinks.forEach(function(link) {
                link.addEventListener("click", function(e) {
                    e.preventDefault();
                    const sectionId = link.getAttribute("href").substring(1); // Récupérer l'id de la section à partir de l'attribut href
                    showSection(sectionId);
                });
            });

            // Afficher la première section par défaut (par exemple, Gestion des Articles)
            showSection("gestion-articles");
        });
    </script>

</body>
</html>
