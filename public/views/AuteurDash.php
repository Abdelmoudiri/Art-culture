<?php
include_once('../../classes/User.php'); 
include_once('../../classes/Article.php'); 
include_once('../../classes/Categorie.php'); 

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

try {
    
    $articles = Article::getArticleById_user($id_user);
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
try {
    
    $categorirs = Categorie::getAllCategories();
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de l'Auteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
        box-shadow: 0px 20px 30px rgba(0, 128, 128, 0.3); /* Teinte bleu-vert douce */
        transition: all 0.3s ease-in-out;
    }

    /* Animation du bouton */
    .hover-animate:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease-in-out;
    }

    /* Fond dégradé avec animation */
    .gradient-bg {
        background: linear-gradient(45deg, #008080, #0000FF, #800080); /* Vert turquoise → Bleu → Mauve */
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
                            <img src="https://thumbs.dreamstime.com/b/illustration-de-bande-dessin%C3%A9e-de-professeur-ou-d-auteur-43842053.jpg" alt="Photo de l'Auteur" class="w-full h-full object-cover profile-image rounded-full border-4 border-white shadow-xl">
                        </div>

                        <h2 class="text-6xl font-semibold text-red-800 mb-4 fadeIn"><?php echo $user["firstname"]."  ".$user["lastname"]; ?></h2>
                        <a href="#" class="text-lg my-12 font-medium py-2 px-6 bg-white text-teal-700 rounded-full hover:bg-teal-700 hover:text-white transition duration-300  hover-animate">Modifier le Profil</a>
                    </div>


                    <!-- Section Gérer les Articles -->
                    <div class="max-w-screen-xl mx-auto p-10 bg-gradient-to-r from-teal-400 to-blue-500 text-white rounded-lg shadow-xl transform transition-transform ">
                        <h2 class="text-3xl font-bold text-center mb-6 animate__animated animate__fadeIn">Gérer Vos Articles</h2>
                        
                        <!-- Cartes avec des boutons pour la gestion des articles -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            <!-- Ajouter un nouvel article -->
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform hover:scale-105">
                                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un Nouvel Article</h3>
                                <p class="text-gray-600 mb-4">Publiez un nouvel article pour partager vos pensées et idées avec vos lecteurs.</p>
                                <button onclick="showSection('ajouterSection')" class="block text-center text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg transition duration-300 ease-in-out">Ajouter</button>
                            </div>


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
                            
                        
                        </div>
                        <div id="ajouterSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Ajouter un Nouvel Article</h3>
                            <input id="articleTitle" type="text" class="border text-black p-2 w-full mb-4" placeholder="Titre de l'article">
                            <textarea id="articleContent" class="border p-2 text-black w-full mb-4" placeholder="Contenu de l'article"></textarea>
                            <input id="articleImage" type="text" class="border p-2 text-black w-full mb-4" placeholder="Lien de l'image">
                            <select id="articleCategory" class="border text-black p-2 w-full mb-4">
                                <?php foreach ($categorirs as $categorie): ?>
                                    <option value="<?php echo $categorie['id_categorie']; ?>">
                                        <?php echo htmlspecialchars($categorie['nom']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button onclick="addArticle()" class="text-white bg-green-600 hover:bg-green-700 py-2 px-4 rounded-lg">Ajouter</button>
                        </div>
                        <script>
                                const userId = <?php echo $id_user; ?>; 
                                function addArticle() {
                                    const title = document.getElementById('articleTitle').value.trim();
                                    const content = document.getElementById('articleContent').value.trim();
                                    const category = document.getElementById('articleCategory').value;

                                    if (title === '' || content === '' || category === '') {
                                        alert('Veuillez remplir tous les champs obligatoires.');
                                        return;
                                    }

                                    const data = {
                                        titre: title,
                                        content: content,
                                        datePublication: new Date().toISOString().slice(0, 19).replace('T', ' '), // Format SQL
                                        idCategorie: category,
                                        idAuteur: userId, 
                                    };

                                    fetch('add_article.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify(data),
                                    })
                                    .then(response => response.json())
                                    .then(result => {
                                        if (result.success) {
                                            alert('L\'article a été ajouté avec succès !');
                                            document.getElementById('articleTitle').value = '';
                                            document.getElementById('articleContent').value = '';
                                            document.getElementById('articleCategory').value = '';
                                        } else {
                                            alert('Erreur : ' + result.message);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Erreur:', error);
                                        alert('Une erreur s\'est produite.');
                                    });
                                }
                        </script>


                            <!-- Sections cachées qui seront affichées au clic -->
                            <div id="modifierSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
                                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Modifier un Article</h3>
                                <p class="text-gray-600 mb-4">Formulaire pour modifier un article existant.</p>
                                <!-- Ajoutez ici le formulaire de modification -->
                                
                                <form method="POST" action="modify_article.php">
                                    <select name="idArticle" class="border text-black border-gray-300 p-2 w-full mb-4 rounded-md" required>
                                        <option value="" disabled selected>Sélectionner un Categorie à Modifier</option>
                                        <?php foreach ($articles as $article): ?>
                                            <option value="<?php echo $article['id_article']; ?>">
                                                <?php echo htmlspecialchars($article['titre']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <textarea name="content" class="border border-gray-300 p-2 w-full mb-4 rounded-md" placeholder="Contenu de l'article" required></textarea>
                                    
                                    <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 py-2 px-4 rounded-lg w-full">Sauvegarder les modifications</button>
                                </form>
                            </div>

                            <div id="supprimerSection" class="section-content hidden p-6 mt-8 bg-white rounded-lg shadow-md">
                                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Supprimer un Article</h3>
                                <p class="text-gray-600 mb-4">Choisissez un article à supprimer.</p>

                                <form id="deleteForm" method="POST">
                                    <select name="idArticle" id="idArticle" class="border border-gray-300 text-black p-2 w-full mb-4 rounded-md" required>
                                        <option value="" disabled selected>Sélectionner un article à supprimer</option>
                                        <?php 
                                        if (isset($articles) && is_array($articles)) {
                                            foreach ($articles as $article): ?>
                                                <option value="<?php echo htmlspecialchars($article['id_article']); ?>">
                                                    <?php echo htmlspecialchars($article['titre']); ?>
                                                </option>
                                            <?php endforeach; 
                                        } else {
                                            echo "<option disabled>Aucun article disponible</option>";
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" id="deleteButton" class="text-white bg-red-600 hover:bg-red-700 py-2 px-4 rounded-lg w-full">Supprimer</button>
                                </form>
                                <div id="message" class="mt-4"></div> <!-- Message d'erreur ou de confirmation -->
                            </div>

                            <script>
                                document.getElementById('deleteForm').addEventListener('submit', function(e) {
                                    e.preventDefault(); // Empêche l'envoi traditionnel du formulaire

                                    // Récupérer l'ID de l'article sélectionné
                                    const idArticle = document.getElementById('idArticle').value;

                                    // Vérifier si un article a été sélectionné
                                    if (!idArticle) {
                                        document.getElementById('message').innerHTML = '<p class="text-red-600">Veuillez sélectionner un article à supprimer.</p>';
                                        return;
                                    }

                                    // Créer une requête AJAX
                                    const xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'delete_article.php', true);
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');





                                    xhr.onload = function() {
                                        if (xhr.status === 200) {
                                            const messageElement = document.getElementById('message');
                                            if (xhr.responseText === 'success') {
                                                messageElement.innerHTML = '<p class="text-green-600">L\'article a été supprimé avec succès.</p>';
                                                // Retirer l'article supprimé de la liste déroulante
                                                document.querySelector(`option[value="${idArticle}"]`).remove();
                                            } else {
                                                messageElement.innerHTML = '<p class="text-red-600">Une erreur est survenue lors de la suppression de l\'article.</p>';
                                            }
                                        } else {
                                            document.getElementById('message').innerHTML = '<p class="text-red-600">Une erreur est survenue lors de la suppression de l\'article.</p>';
                                        }
                                    };

                                    // Lorsque la requête est terminée, traiter la réponse
                                   

                                    xhr.send('idArticle=' + encodeURIComponent(idArticle));
                                });
                            </script>




                        
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

                        <div class="max-w-screen-xl mx-auto p-10">
                            <?php if ($articles && is_array($articles)): ?>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                                    <?php foreach ($articles as $art): ?>
                                        <div class="card bg-white p-6 rounded-lg shadow-lg hover:shadow-2xl transition-transform duration-300">
                                            <!-- Ajouter l'image -->
                                            <?php if (!empty($art['image'])): ?>
                                                <img src="<?php echo htmlspecialchars($art['image']); ?>" alt="Image de l'article" class="w-full h-48 object-cover rounded-t-lg mb-4">
                                            <?php else: ?>
                                                <img src="default-image.jpg" alt="Image par défaut" class="w-full h-48 object-cover rounded-t-lg mb-4">
                                            <?php endif; ?>

                                            <h3 class="text-xl font-semibold text-gray-800 mb-3"><?php echo htmlspecialchars($art["titre"]); ?></h3>
                                            <div class="text-sm text-gray-500 mb-4">
                                                <p>Par Auteur | <?php echo date("d M Y", strtotime($art['datePublication'])); ?></p>
                                            </div>
                                            <p class="text-gray-700 mb-4 line-clamp-4"><?php echo htmlspecialchars(substr($art['content'], 0, 10)) . '...'; ?></p>
                                            <button 
                                                class="inline-block text-teal-500 font-semibold hover:text-teal-600 hover:underline"
                                                onclick="showPopup(<?php echo htmlspecialchars(json_encode($art)); ?>)">
                                                Lire l'article
                                            </button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-center text-gray-500">Aucun article trouvé pour cet auteur.</p>
                            <?php endif; ?>
                        </div>


                        <div id="articleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full relative">
                                <button class="absolute top-3 right-3 text-gray-600 hover:text-gray-800" onclick="closePopup()">✖</button>
                                <h3 id="modalTitle" class="text-2xl font-bold text-gray-800 mb-4"></h3>
                                <div id="modalMeta" class="text-sm text-gray-500 mb-4"></div>
                                <p id="modalContent" class="text-gray-700 leading-relaxed"></p>
                            </div>
                        </div>

                        <script>
                            function showPopup(article) {
                                document.getElementById('modalTitle').innerText = article.titre;
                                document.getElementById('modalMeta').innerText = `Par Auteur | ${new Date(article.datePublication).toLocaleDateString()}`;
                                document.getElementById('modalContent').innerText = article.content;
                                document.getElementById('articleModal').classList.remove('hidden');
                            }

                            function closePopup() {
                                document.getElementById('articleModal').classList.add('hidden');
                            }
                        </script>





</body>

</html>
