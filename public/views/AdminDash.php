<?php
require_once __DIR__ . "/../../classes/User.php";
require_once __DIR__ . "/../../classes/Admin.php";
require_once __DIR__ . "/../../classes/Categorie.php";
require_once __DIR__ . "/../../classes/Article.php";

session_start();
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
} elseif (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    $_SESSION['user_id'] = $id_user;
} else {
    echo "ID utilisateur non fourni.";
    exit();
}
$user = User::getUserById($id_user);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['category-name'];
    $description = $_POST['category-description'];
    if (empty($nom) || empty($description)) {
        echo "Les champs 'nom' et 'description' ne peuvent pas être vides.";
        exit();
    }

    $categorie = new Categorie(); 

    if ($categorie->addCategory($nom, $description)) {
        echo "Catégorie ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de la catégorie.";
    }
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
                            <script>
                                    function supprimerArticle(idArticle) {
                                        if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "supprimer_article.php", true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.onload = function() {
                                                if (xhr.status == 200) {
                                                    alert(xhr.responseText);
                                                    location.reload(); 
                                                } else {
                                                    alert("Une erreur s'est produite lors de la suppression.");
                                                }
                                            };
                                            xhr.send("idArticle=" + idArticle);
                                        }
                                    }
                                    function acceptArticle(idArticle) {
                                        if (confirm("Êtes-vous sûr de vouloir accepter cet article ?")) {
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "accepter_article.php", true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.onload = function() {
                                                if (xhr.status == 200) {
                                                    alert(xhr.responseText); 
                                                    location.reload(); 
                                                } else {
                                                    alert("Une erreur s'est produite lors de l'acceptation de l'article.");
                                                }
                                            };
                                            xhr.send("idArticle=" + idArticle); 
                                        }
                                    }

                                    function rejectArticle(idArticle) {
                                        if (confirm("Êtes-vous sûr de vouloir refuser cet article ?")) {
                                            
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "refuser_article.php", true);
                                            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                            xhr.onload = function() {
                                                if (xhr.status == 200) {
                                                    alert(xhr.responseText);
                                                    location.reload(); 
                                                } else {
                                                    alert("Une erreur s'est produite lors du refus de l'article.");
                                                }
                                            };
                                            xhr.send("idArticle=" + idArticle); 
                                        }
                                    }
                            </script>


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

                                <div class="flex justify-between items-center mb-6">
                                    <a href="#" class="bg-blue-500 text-white py-2 px-4 rounded-md">Voir Catégories</a>
                                    <button onclick="openAddCategoryPopup()" class="bg-green-500 text-white py-2 px-4 rounded-md">Ajouter Catégorie</button>
                                </div>
                                <!-- lescategories -->
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
                                            <?php 
                                                $categories = Categorie::getAllCategories();
                                                foreach ($categories as $category): ?>
                                                
                                                <tr data-category-id="<?= $category['id_categorie']; ?>" data-name="<?= htmlspecialchars($category['nom']); ?>" data-description="<?= htmlspecialchars($category['description']); ?>">

                                                    <td class="px-4 py-2"><?= htmlspecialchars($category['nom']); ?></td>
                                                    <td class="px-4 py-2"><?= htmlspecialchars($category['description']); ?></td>
                                                    <td class="px-4 py-2">
                                                        <button class="bg-yellow-500 text-white py-1 px-3 rounded-md" onclick="openEditCategoryPopup(<?= $category['id_categorie']; ?>)">Modifier</button>
                                                        <button class="bg-red-500 text-white py-1 px-3 rounded-md" onclick="deleteCategory(<?= $category['id_categorie']; ?>)">Supprimer</button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>


                            <!-- Popup Ajouter Catégorie -->
                            <div id="add-category-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                                <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                    <h3 class="text-2xl font-semibold mb-4">Ajouter une Nouvelle Catégorie</h3>
                                    <form action="#" method="POST">
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
                                    <form id="edit-category-form" action="edit_category.php" method="POST">
                                        <!-- Champ caché pour l'ID de la catégorie -->
                                        <input type="hidden" name="edit-category-id" id="edit-category-id">

                                        <div class="mb-4">
                                            <label for="edit-category-name" class="block text-sm font-medium text-gray-700">Nom de la Catégorie</label>
                                            <input type="text" name="edit-category-name" id="edit-category-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="edit-category-description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea name="edit-category-description" id="edit-category-description" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                        </div>
                                        <div id="edit-message" class="text-red-500 text-sm mb-2 hidden"></div>
                                        <div class="flex justify-between">
                                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md">Modifier</button>
                                            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-md" onclick="closeEditCategoryPopup()">Annuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                    </section>
                    <!-- cat script -->
                    <script>
                                    function openEditCategoryPopup(categoryId) {
                                const category = document.querySelector(`[data-category-id="${categoryId}"]`);
                                if (!category) {
                                    alert("Catégorie introuvable !");
                                    return;
                                }

                                document.getElementById("edit-category-id").value = categoryId;
                                document.getElementById("edit-category-name").value = category.dataset.name;
                                document.getElementById("edit-category-description").value = category.dataset.description;

                                document.getElementById("edit-category-popup").classList.remove("hidden");
                               }

                            function closeEditCategoryPopup() {
                                document.getElementById("edit-category-popup").classList.add("hidden");
                                document.getElementById("edit-category-form").reset();
                                document.getElementById("edit-message").classList.add("hidden");
                            }

                            function openAddCategoryPopup() {
                                document.getElementById("add-category-popup").classList.remove("hidden");
                            }
                            function closeAddCategoryPopup() {
                                document.getElementById("add-category-popup").classList.add("hidden");
                            }

                            



                            
                            function closeEditCategoryPopup() {
                                document.getElementById("edit-category-popup").classList.add("hidden");
                            }

                            
                            function deleteCategory(categoryId) {
                                        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie ?")) {
                                            fetch("delete_category.php", {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/x-www-form-urlencoded",
                                                },
                                                body: `action=delete&id=${categoryId}`, // Indique l'action et l'ID de la catégorie
                                            })
                                                .then(response => {
                                                    if (!response.ok) {
                                                        return response.text().then(text => { throw new Error(text); });
                                                    }
                                                    return response.json();
                                                })
                                                .then(data => {
                                                    if (data.success) {
                                                        alert("Catégorie supprimée avec succès.");
                                                        document.querySelector(`[data-category-id="${categoryId}"]`).remove();
                                                    } else {
                                                        alert(data.message || "Erreur lors de la suppression de la catégorie.");
                                                    }
                                                })
                                                .catch(error => {
                                                    console.error("Erreur détectée:", error);
                                                    alert(`Erreur: ${error.message}`);
                                                });
                                        }
                                    }
                    </script>

                    
                

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
                                        <tbody id="user-list">
                                        <?php
                                                $admin=new Admin("admin","admin","admin","admin","admin");
                                                $utilisateurs =$admin->getAllUtilisateur();
                                                if (!empty($utilisateurs)) {
                                                    foreach ($utilisateurs as $utilisateur) {
                                                        echo "<tr id='user-" . $utilisateur['id_user'] . "'>";
                                                        echo "<td class='px-4 py-2'>" . htmlspecialchars($utilisateur['firstname']) . " " . htmlspecialchars($utilisateur['lastname']) . "</td>";
                                                        echo "<td class='px-4 py-2'>" . htmlspecialchars($utilisateur['email']) . "</td>";
                                                        echo "<td class='px-4 py-2'>" . htmlspecialchars($utilisateur['role']) . "</td>";
                                                        echo "<td class='px-4 py-2'>
                                                                <button class='bg-yellow-500 text-white py-1 px-3 rounded-md' onclick='openEditUserPopup(" . $utilisateur['id_user'] . ")'>Modifier</button>
                                                                <button class='bg-red-500 text-white py-1 px-3 rounded-md' onclick='confirmDeleteUser(" . $utilisateur['id_user'] . ")'>Supprimer</button>
                                                            </td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4' class='px-4 py-2 text-center'>Aucun utilisateur trouvé</td></tr>";
                                                }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                                <script>
                                    function confirmDeleteUser(userId) {
                                        const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.");
                                        
                                        if (confirmation) {
                                            deleteUser(userId);
                                        }
                                    }

                                    function deleteUser(userId) {
                                        const xhr = new XMLHttpRequest();
                                        xhr.open("POST", "delete_user.php", true);
                                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                        xhr.onload = function () {
                                            if (xhr.status === 200) {
                                                const userRow = document.getElementById("user-" + userId);
                                                userRow.remove();
                                                alert("L'utilisateur a été supprimé avec succès.");
                                            } else {
                                                alert("Erreur lors de la suppression de l'utilisateur.");
                                            }
                                        };
                                        xhr.send("user_id=" + userId); 
                                    }
                                </script>


                        <!-- Popup Modifier Utilisateur -->
                        <div id="edit-user-popup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-8 rounded-lg shadow-lg w-1/3">
                                <h3 class="text-2xl font-semibold mb-4">Modifier Utilisateur</h3>
                                <form id="edit-user-form" method="POST">
                                    <input type="hidden" name="user-id" id="edit-user-id">
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
                                    <button id="delete-user-btn" onclick="deleteUser()" class="bg-red-500 text-white py-2 px-4 rounded-md">Supprimer</button>
                                    <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded-md" onclick="closeDeleteUserPopup()">Annuler</button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- utilisateur script -->
                    <script>      
                        function openEditUserPopup(userId) {
                            // Remplir le formulaire avec les informations de l'utilisateur
                            document.getElementById("edit-user-id").value = userId;
                            document.getElementById("edit-user-name").value = "Nom de l'utilisateur " + userId;
                            document.getElementById("edit-user-email").value = "user" + userId + "@example.com"; 
                            document.getElementById("edit-user-role").value = "admin"; 

                            document.getElementById("edit-user-popup").classList.remove("hidden");
                        }

                        function closeEditUserPopup() {
                            document.getElementById("edit-user-popup").classList.add("hidden");
                        }

                        function openDeleteUserPopup(userId) {
                            document.getElementById("delete-user-btn").setAttribute("data-user-id", userId);
                            document.getElementById("delete-user-popup").classList.remove("hidden");
                        }

                        function closeDeleteUserPopup() {
                            document.getElementById("delete-user-popup").classList.add("hidden");
                        }

                        function confirmDeleteUser(userId) {
                            openDeleteUserPopup(userId);
                            console.log("Suppression de l'utilisateur avec ID: " + userId);
                        }

                        function deleteUser() {
                            var userId = document.getElementById("delete-user-btn").getAttribute("data-user-id");
                            
                            // Appeler PHP pour supprimer l'utilisateur
                            fetch("delete_user.php", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({ id: userId }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert("Utilisateur supprimé.");
                                    document.getElementById("user-" + userId).remove();
                                    closeDeleteUserPopup();
                                } else {
                                    alert("Erreur lors de la suppression de l'utilisateur.");
                                }
                            })
                            .catch(error => {
                                alert("Une erreur s'est produite.");
                                console.error(error);
                            });
                        }

                        document.getElementById("edit-user-form").addEventListener("submit", function(event) {
                            event.preventDefault();

                            var formData = new FormData(this);
                            var userId = formData.get("user-id");

                            fetch("edit_user.php", {
                                method: "POST",
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert("Utilisateur modifié avec succès.");
                                    closeEditUserPopup();
                                    // Mettre à jour l'affichage des utilisateurs
                                } else {
                                    alert("Erreur lors de la modification de l'utilisateur.");
                                }
                            })
                            .catch(error => {
                                console.error("Erreur:", error);
                                alert("Une erreur s'est produite.");
                            });
                        });

                        document.addEventListener("DOMContentLoaded", function() {
                            const navLinks = document.querySelectorAll("aside nav a");
                            const sections = document.querySelectorAll(".section");

                            function showSection(sectionId) {
                                sections.forEach(function(section) {
                                    section.classList.add("hidden");
                                });

                                const sectionToShow = document.getElementById(sectionId);
                                if (sectionToShow) {
                                    sectionToShow.classList.remove("hidden");
                                }
                            }

                            navLinks.forEach(function(link) {
                                link.addEventListener("click", function(e) {
                                    e.preventDefault();
                                    const sectionId = link.getAttribute("href").substring(1);
                                    showSection(sectionId);
                                });
                            });

                            showSection("gestion-articles");
                        });
                    </script>



    </main>

                <!-- JavaScript -->
                 
                
</body>
</html>
