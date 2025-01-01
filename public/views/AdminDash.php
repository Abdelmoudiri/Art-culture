<?php
require_once __DIR__ . "/../../classes/User.php";

$id_user = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_user) {
    $user = User::getUserById($id_user);

} else {
    echo "ID utilisateur non fourni.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
            .section-active {
                color: #f3f4f6; 
                background-color: #4CAF50; 
                border-left: 4px solid #fff;
                padding-left: 12px;
                border-radius: 4px; 
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
                font-weight: bold; 
                transition: all 0.3s ease; 
                font-size: 1.125rem; 
            }

            .section-active:hover {
                background-color: #388E3C; 
                color: #ffffff; 
                transform: scale(1.05); 
            }

            nav a {
                font-size: 1rem;
                color: #e0e0e0;
                transition: all 0.3s ease; 
            }

            nav a:hover {
                color: #fff; 
                text-decoration: none; 
            }

            nav a.section-active {
                font-size: 1.125rem; 
                font-weight: bold; 
            }

            nav a:not(.section-active) {
                font-size: 1rem; 
                color: #e0e0e0; 
            }


    </style>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
   <!-- Sidebar -->
   <aside class="w-64 h-screen bg-gray-800 text-white p-6 fixed">
        <h2 class="text-2xl font-bold text-center mb-8">Admin Dashboard</h2>
        <nav class="space-y-6">
            <a href="#gestion-articles" class="flex items-center space-x-3 text-lg hover:text-purple-400" id="link-gestion-articles" onclick="setActiveSection('link-gestion-articles')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2h-5V4H2v16h15z"></path>
                </svg>
                <span>Gestion des Articles</span>
            </a>
            <a href="#gestion-categories" class="flex items-center space-x-3 text-lg hover:text-purple-400" id="link-gestion-categories" onclick="setActiveSection('link-gestion-categories')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4h10M7 10h10M7 16h10"></path>
                </svg>
                <span>Gestion des Catégories</span>
            </a>
            <a href="#gestion-utilisateurs" class="flex items-center space-x-3 text-lg hover:text-purple-400" id="link-gestion-utilisateurs" onclick="setActiveSection('link-gestion-utilisateurs')">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6H2v16h16V6h-2m-2 0v16h-8V6H4z"></path>
                </svg>
                <span>Gestion des Utilisateurs</span>
            </a>
        </nav>
        <a href="login.php"  class="flex items-center space-x-3 text-lg hover:text-white bg-red-500 hover:bg-red-700 py-2 px-4 rounded-md mt-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2h-5V4H2v16h15z"></path>
                </svg>
                <span>Logout</span>
            </a>
    </aside>



    <script>
        // Fonction pour gérer la classe active
        function setActiveSection(linkId) {
            // Retirer la classe 'section-active' de tous les liens
            const links = document.querySelectorAll('nav a');
            links.forEach(link => {
                link.classList.remove('section-active');
            });

            // Ajouter la classe 'section-active' au lien cliqué
            const selectedLink = document.getElementById(linkId);
            selectedLink.classList.add('section-active');
        }

        // Initialiser la première section comme active
        window.onload = () => {
            setActiveSection('link-gestion-articles');
        };
    </script>

    <!-- Main Content -->
    <main class="ml-64 p-8">
                <!-- Header Section -->
                <header class="mb-8">
                    <h1 class="text-3xl font-semibold text-gray-900">Bienvenue, <span class="text-3xl font-semibold text-red-900"> <?php  echo   htmlspecialchars($user['firstname']) . " " . htmlspecialchars($user['lastname']);?></span></h1>
                    <p class="text-lg text-gray-600">Gérez le contenu et les utilisateurs de la plateforme.</p>
                </header>

                    <!-- Dashboard Cards Section -->
                <section id="gestion-articles" class="section hidden">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Articles</h2>
                                <p class="text-gray-600 mb-4">Créer, modifier et gérer les articles publiés.</p>
                                <div class="flex justify-between items-center">
                                    <button class="bg-blue-500 text-white py-2 px-4 rounded-md" onclick="openViewArticlesPopup()">Voir Articles</button>
                                    <button class="bg-green-500 text-white py-2 px-4 rounded-md" onclick="openAddArticlePopup()">Ajouter Article</button>
                                </div>
                            </div>
                    </section>
                    <!-- Popup - Voir Articles -->
                    <div id="view-articles-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                        <div class="bg-white p-8 rounded-lg shadow-lg w-1/2">
                            <h3 class="text-2xl font-semibold mb-4">Liste des Articles</h3>
                            
                            <?php
                                    try {
                                        require_once "../../classes/Article.php";
                                        $articles = Article::getAll();
                                        
                                        echo '<div class="overflow-y-auto max-h-[calc(100vh-200px)]">';
                                        echo '<table class="w-full text-left border-collapse mb-4">
                                                <thead>
                                                    <tr>
                                                        <th class="px-4 py-2 border-b">Titre</th>
                                                        <th class="px-4 py-2 border-b">Date de Publication</th>
                                                        <th class="px-4 py-2 border-b">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                        foreach ($articles as $article) {
                                            echo '<tr>
                                                    <td class="px-4 py-2">' . htmlspecialchars($article['titre']) . '</td>
                                                    <td class="px-4 py-2">' . htmlspecialchars($article['datePublication']) . '</td>
                                                    <td class="px-4 py-2">
                                                        <button class="text-red-500" onclick="supprimerArticle(' . $article['id_article'] . ')">Supprimer</button>
                                                    </td>
                                                </tr>';
                                        }

                                        echo '  </tbody>
                                            </table>
                                        </div>';
                                    } catch (Exception $e) {
                                        echo '<p class="text-red-500">Erreur : ' . $e->getMessage() . '</p>';
                                    }
                            ?>

                            <div class="flex justify-end">
                                <button class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeViewArticlesPopup()">Fermer</button>
                            </div>
                        </div>
                    </div>

                    <!-- Popup - Ajouter Article -->
                    <div id="add-article-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                        <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                            <h3 class="text-2xl font-semibold mb-4">Ajouter un Nouvel Article</h3>

                            <!-- Section des articles en attente -->
                            <h4 class="text-xl font-semibold mb-4">Articles en Attente</h4>
                            <div class="overflow-y-auto max-h-[300px]">  <!-- Limite la hauteur à 500px avec défilement -->
                                <table class="w-full text-left border-collapse mb-4">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2 border-b">Titre</th>
                                            <th class="px-4 py-2 border-b">Contenu</th>
                                            <th class="px-4 py-2 border-b">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $articlesEnAttente = Article::getPending();
                                            if (empty($articlesEnAttente)) {
                                                echo '<tr><td colspan="3" class="px-4 py-2">Aucun article en attente</td></tr>';
                                            } else {
                                                foreach ($articlesEnAttente as $article) {
                                                    echo '<tr>
                                                            <td class="px-4 py-2">' . htmlspecialchars($article['titre']) . '</td>
                                                            <td class="px-4 py-2">' . htmlspecialchars(substr($article['content'], 0, 50)) . '...</td>
                                                            <td class="px-4 py-2">
                                                                <button class="bg-green-500 text-white py-1 px-3 rounded-md" onclick="acceptArticle(' . $article['id_article'] . ')">Accepter</button>
                                                                <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="rejectArticle(' . $article['id_article'] . ')">Refuser</button>
                                                            </td>
                                                        </tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>


                            <div class="flex justify-between mt-4">
                                <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeAddArticlePopup()">Annuler</button>
                            </div>
                        </div>
                    </div>
                    <script>
                        function acceptArticle(articleId) {
                            alert("Article " + articleId + " accepté !");
                        }

                        function rejectArticle(articleId) {
                            alert("Article " + articleId + " refusé !");
                        }

                        function closeAddArticlePopup() {
                            document.getElementById("add-article-popup").classList.add("hidden");
                        }
                            function openViewArticlesPopup() {
                                document.getElementById("view-articles-popup").classList.remove("hidden");
                            }

                            function closeViewArticlesPopup() {
                                document.getElementById("view-articles-popup").classList.add("hidden");
                            }

                            function openAddArticlePopup() {
                                document.getElementById("add-article-popup").classList.remove("hidden");
                            }

                            function closeAddArticlePopup() {
                                document.getElementById("add-article-popup").classList.add("hidden");
                            }
                    </script>


                    <!-- cattt -->
                <section id="gestion-categories" class="section hidden">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Catégories</h2>
                        <p class="text-gray-600 mb-4">Créer, modifier et gérer les catégories des articles.</p>

                        <!-- Boutons Voir et Ajouter Catégorie -->
                        <div class="flex justify-between items-center mb-6">
                            <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md">Voir Catégories</a>
                            <button onclick="openAddCategoryPopup()" class="bg-green-500 text-white py-2 px-4 rounded-md">Ajouter Catégorie</button>
                        </div>

                        <!-- Liste des catégories -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse mb-4">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 border-b">Nom de la Catégorie</th>
                                        <th class="px-4 py-2 border-b">Description</th>
                                        <th class="px-4 py-2 border-b">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Exemple de catégories statiques -->
                                    <tr>
                                        <td class="px-4 py-2">Technologie</td>
                                        <td class="px-4 py-2">Articles sur la technologie moderne.</td>
                                        <td class="px-4 py-2">
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditCategoryPopup(1)">Modifier</button>
                                            <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="deleteCategory(1)">Supprimer</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Science</td>
                                        <td class="px-4 py-2">Articles sur la science et les découvertes.</td>
                                        <td class="px-4 py-2">
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditCategoryPopup(2)">Modifier</button>
                                            <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="deleteCategory(2)">Supprimer</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-2">Santé</td>
                                        <td class="px-4 py-2">Articles sur la santé et le bien-être.</td>
                                        <td class="px-4 py-2">
                                            <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditCategoryPopup(3)">Modifier</button>
                                            <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="deleteCategory(3)">Supprimer</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                        <!-- Popup Ajouter Catégorie -->
                        <div id="add-category-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                <h3 class="text-2xl font-semibold mb-4">Ajouter une Nouvelle Catégorie</h3>
                                <form action="add_category.php" method="POST">
                                    <div class="mb-4">
                                        <label for="category-name" class="block text-sm font-medium text-gray-700">Nom de la Catégorie</label>
                                        <input type="text" name="category-name" id="category-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea name="category-description" id="category-description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                    </div>
                                    <div class="flex justify-between">
                                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Ajouter</button>
                                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeAddCategoryPopup()">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Popup Modifier Catégorie -->
                        <div id="edit-category-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                <h3 class="text-2xl font-semibold mb-4">Modifier la Catégorie</h3>
                                <form action="edit_category.php" method="POST">
                                    <div class="mb-4">
                                        <label for="edit-category-name" class="block text-sm font-medium text-gray-700">Nom de la Catégorie</label>
                                        <input type="text" name="edit-category-name" id="edit-category-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="edit-category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea name="edit-category-description" id="edit-category-description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                    </div>
                                    <div class="flex justify-between">
                                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Modifier</button>
                                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeEditCategoryPopup()">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </section>
                <section id="gestion-utilisateurs" class="section hidden">
                            <div class="bg-white p-6 rounded-lg shadow-md">
                                <h2 class="text-2xl font-bold text-gray-800 mb-4">Gestion des Utilisateurs</h2>
                                <p class="text-gray-600 mb-4">Consulter et gérer les profils des utilisateurs.</p>

                                <!-- Liste des utilisateurs -->
                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse mb-4">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 border-b">Nom</th>
                                                <th class="px-4 py-2 border-b">Email</th>
                                                <th class="px-4 py-2 border-b">Rôle</th>
                                                <th class="px-4 py-2 border-b">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Exemple d'utilisateurs statiques -->
                                            <tr>
                                                <td class="px-4 py-2">Jean Dupont</td>
                                                <td class="px-4 py-2">jean.dupont@example.com</td>
                                                <td class="px-4 py-2">Administrateur</td>
                                                <td class="px-4 py-2">
                                                    <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditUserPopup(1)">Modifier</button>
                                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="confirmDeleteUser(1)">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2">Marie Durand</td>
                                                <td class="px-4 py-2">marie.durand@example.com</td>
                                                <td class="px-4 py-2">Utilisateur</td>
                                                <td class="px-4 py-2">
                                                    <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditUserPopup(2)">Modifier</button>
                                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="confirmDeleteUser(2)">Supprimer</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-2">Pierre Martin</td>
                                                <td class="px-4 py-2">pierre.martin@example.com</td>
                                                <td class="px-4 py-2">Utilisateur</td>
                                                <td class="px-4 py-2">
                                                    <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditUserPopup(3)">Modifier</button>
                                                    <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="confirmDeleteUser(3)">Supprimer</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Popup Modifier Utilisateur -->
                            <div id="edit-user-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                    <h3 class="text-2xl font-semibold mb-4">Modifier Utilisateur</h3>
                                    <form action="edit_user.php" method="POST">
                                        <div class="mb-4">
                                            <label for="edit-user-name" class="block text-sm font-medium text-gray-700">Nom</label>
                                            <input type="text" name="edit-user-name" id="edit-user-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="edit-user-email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="edit-user-email" id="edit-user-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="edit-user-role" class="block text-sm font-medium text-gray-700">Rôle</label>
                                            <select name="edit-user-role" id="edit-user-role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                <option value="admin">Administrateur</option>
                                                <option value="user">Utilisateur</option>
                                            </select>
                                        </div>
                                        <div class="flex justify-between">
                                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Modifier</button>
                                            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeEditUserPopup()">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Popup Confirmer Suppression Utilisateur -->
                            <div id="delete-user-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                    <h3 class="text-2xl font-semibold mb-4">Confirmer Suppression</h3>
                                    <p class="mb-4">Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
                                    <div class="flex justify-between">
                                        <button onclick="deleteUser()" class="bg-red-500 text-white py-2 px-4 rounded-md">Supprimer</button>
                                        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md" onclick="closeDeleteUserPopup()">Annuler</button>
                                    </div>
                                </div>
                            </div>
                </section>

    </main>

                <!-- JavaScript -->
                <script>
                    // Fonction pour ouvrir la popup d'ajout de catégorie
                    function openAddCategoryPopup() {
                        document.getElementById("add-category-popup").classList.remove("hidden");
                    }

                    // Fonction pour fermer la popup d'ajout de catégorie
                    function closeAddCategoryPopup() {
                        document.getElementById("add-category-popup").classList.add("hidden");
                    }

                    // Fonction pour ouvrir la popup de modification de catégorie
                    function openEditCategoryPopup(categoryId) {
                        // Remplir le formulaire de modification avec les données de la catégorie sélectionnée
                        document.getElementById("edit-category-name").value = "Nom de la catégorie " + categoryId; // Remplacer par la donnée réelle
                        document.getElementById("edit-category-description").value = "Description de la catégorie " + categoryId; // Remplacer par la donnée réelle

                        document.getElementById("edit-category-popup").classList.remove("hidden");
                    }

                    // Fonction pour fermer la popup de modification de catégorie
                    function closeEditCategoryPopup() {
                        document.getElementById("edit-category-popup").classList.add("hidden");
                    }

                    // Fonction pour supprimer une catégorie
                    function deleteCategory(categoryId) {
                        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?")) {
                            // Logique pour supprimer la catégorie
                            alert("Catégorie " + categoryId + " supprimée.");
                        }
                    }
                    // Fonction pour ouvrir la popup de modification d'utilisateur
                    function openEditUserPopup(userId) {
                        // Remplir le formulaire de modification avec les données de l'utilisateur sélectionné
                        document.getElementById("edit-user-name").value = "Nom de l'utilisateur " + userId; // Remplacer par la donnée réelle
                        document.getElementById("edit-user-email").value = "user" + userId + "@example.com"; // Remplacer par la donnée réelle
                        document.getElementById("edit-user-role").value = "admin"; // Remplacer par la donnée réelle

                        document.getElementById("edit-user-popup").classList.remove("hidden");
                    }

                    // Fonction pour fermer la popup de modification d'utilisateur
                    function closeEditUserPopup() {
                        document.getElementById("edit-user-popup").classList.add("hidden");
                    }

                    // Fonction pour ouvrir la popup de confirmation de suppression d'utilisateur
                    function openDeleteUserPopup() {
                        document.getElementById("delete-user-popup").classList.remove("hidden");
                    }

                    // Fonction pour fermer la popup de confirmation de suppression
                    function closeDeleteUserPopup() {
                        document.getElementById("delete-user-popup").classList.add("hidden");
                    }

                    // Fonction pour confirmer la suppression d'un utilisateur
                    function confirmDeleteUser(userId) {
                        // Ouvrir la popup de confirmation de suppression
                        openDeleteUserPopup();
                        // Tu peux utiliser l'ID utilisateur pour identifier l'utilisateur à supprimer
                        console.log("Suppression de l'utilisateur avec ID: " + userId);
                    }

                    // Fonction pour supprimer un utilisateur
                    function deleteUser() {
                        // Logique pour supprimer l'utilisateur
                        alert("Utilisateur supprimé.");
                        closeDeleteUserPopup();
                    }
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
