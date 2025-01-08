<?php
include_once('../../classes/Article.php'); 
include_once('../../classes/Categorie.php'); 

$categories =Categorie::getAllCategories();

$articles = Article::getAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $confirmation = "Merci, $name ! Votre message a été envoyé.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art & Culture - Explorez et Partagez</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">


<!-- Navbar -->
<header class="bg-gray-800 shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <h1 class="text-2xl font-bold text-purple-500">Art & Culture</h1>
        <nav class="flex gap-6">
            <a href="index.php" class="hover:text-purple-400">Accueil</a>
            <a href="visiteur.php" class="hover:text-purple-400">Articles</a>
            <a href="about.php" class="hover:text-purple-400">À Propos</a>
            <a href="contact.php" class="hover:text-purple-400">Contact</a>
        </nav>
    </div>
</header>

<!-- Hero Section -->
<section class="bg-cover bg-center py-20" style="background-image: url('https://images.unsplash.com/photo-1533550937759-2fa8def004c3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&q=80&w=1080');">
    <div class="bg-black bg-opacity-50 py-16 text-center">
        <h2 class="text-4xl font-bold mb-4">Découvrez l'Art et la Culture</h2>
        <p class="text-lg mb-6">Plongez dans un univers où la créativité s'exprime à travers la peinture, la littérature, la musique et plus encore.</p>
        <a href="#articles" class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded">Voir les Articles</a>
    </div>
</section>

<!-- Bare de filtrage -->
<section id="categories" class="container mx-auto py-12 px-6">
    <h3 class="text-3xl font-bold mb-8 text-center">Explorez par Catégories</h3>
    <div class="flex gap-6 justify-center mb-8">
        <?php foreach ($categories as $category): ?>
            <a href="?categorie=<?= $category['id_categorie'] ?>" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-full">
                <?= $category['nom'] ?>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section id="articles" class="container mx-auto py-12 px-6">
    <h3 class="text-3xl font-bold mb-8 text-center">
        <?php if ($categorie_id): ?>
            Articles de la catégorie : <?= htmlspecialchars($categories[array_search($categorie_id, array_column($categories, 'id_categorie'))]['nom']); ?>
        <?php else: ?>
            Derniers Articles
        <?php endif; ?>
    </h3>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($articles as $article): ?>
            <div class="bg-white text-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="<?= htmlspecialchars($article['image']) ?>" 
                     alt="<?= htmlspecialchars($article['titre']) ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <p class="text-sm text-purple-600 uppercase">
                        <?= date('d M Y', strtotime($article['datePublication'])) ?> - <?= htmlspecialchars($article['nom_categorie']) ?>
                    </p>
                    <h4 class="text-xl font-bold mb-4"><?= htmlspecialchars($article['titre']) ?></h4>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars(mb_substr($article['content'], 0, 100)) ?>...</p>
                    <a href="article_detail.php?id=<?= $article['id_article'] ?>" class="text-purple-600 font-medium hover:underline">Lire plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- Articles Section -->
<section id="articles" class="container mx-auto py-12 px-6">
    <h3 class="text-3xl font-bold mb-8 text-center">Derniers Articles</h3>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($articles as $article): ?>
            <div class="bg-white text-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="<?= htmlspecialchars($article['image']) ?>" 
                     alt="<?= htmlspecialchars($article['titre']) ?>" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <p class="text-sm text-purple-600 uppercase">
                        <?= date('d M Y', strtotime($article['datePublication'])) ?> - <?= htmlspecialchars($article['nom_categorie']) ?>
                    </p>
                    <h4 class="text-xl font-bold mb-4"><?= htmlspecialchars($article['titre']) ?></h4>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars(mb_substr($article['content'], 0, 100)) ?>...</p>
                    <a href="#" class="text-purple-600 font-medium hover:underline">Lire plus</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>


<!-- Contact Section -->
<section class="bg-gradient-to-r from-green-400 to-blue-500 py-12 text-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-4 text-shadow-md">Contactez-Nous</h2>
        <p class="text-lg mb-6">Des questions ou des demandes ? Nous serions heureux de vous entendre !</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white text-black p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <h3 class="text-2xl font-semibold text-purple-600 mb-3">Envoyez-nous un Message</h3>
                <?php if (isset($confirmation)): ?>
                    <p class="text-green-500 font-semibold"><?= $confirmation ?></p>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-4">
                        <input type="text" name="name" placeholder="Votre Nom" class="w-full p-3 rounded-md border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 mb-3" required>
                    </div>
                    <div class="mb-4">
                        <input type="email" name="email" placeholder="Votre Email" class="w-full p-3 rounded-md border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 mb-3" required>
                    </div>
                    <div class="mb-4">
                        <textarea name="message" placeholder="Votre Message" class="w-full p-3 rounded-md border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 mb-3" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white py-3 px-6 rounded-full text-lg font-semibold transition duration-300 transform hover:scale-105">Envoyer</button>
                </form>
            </div>

            <div class="bg-white text-black p-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-300">
                <h3 class="text-2xl font-semibold text-purple-600 mb-3">Nos Coordonnées</h3>
                <p class="text-lg mb-3">Contactez-nous via ces informations :</p>
                <div class="mb-3">
                    <h4 class="font-semibold text-lg text-purple-600">Adresse :</h4>
                    <p class="text-lg">123 Rue de l'Art, 75001 Paris, France</p>
                </div>
                <div class="mb-3">
                    <h4 class="font-semibold text-lg text-purple-600">Téléphone :</h4>
                    <p class="text-lg">+33 1 23 45 67 89</p>
                </div>
                <div class="mb-3">
                    <h4 class="font-semibold text-lg text-purple-600">Email :</h4>
                    <p class="text-lg">contact@artandculture.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 py-6">
    <div class="container mx-auto text-center">
        <p>&copy; 2023 Art & Culture. Tous droits réservés.</p>
        <div class="flex justify-center gap-4 mt-4">
            <a href="#" class="hover:text-purple-400">Facebook</a>
            <a href="#" class="hover:text-purple-400">Twitter</a>
            <a href="#" class="hover:text-purple-400">Instagram</a>
        </div>
    </div>
</footer>

</body>
</html>
