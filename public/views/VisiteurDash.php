<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art & Culture - Explorez et Partagez</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

<?php
// Simuler des données dynamiques
$categories = [
    ["name" => "Peinture", "image" => "https://images.unsplash.com/photo-1533757740036-7e0fa1d88f6b"],
    ["name" => "Musique", "image" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4"],
    ["name" => "Littérature", "image" => "https://images.unsplash.com/photo-1512820790803-83ca734da794"],
    ["name" => "Cinéma", "image" => "https://images.unsplash.com/photo-1498050108023-c5249f4df085"],
];

$articles = [
    ["title" => "Les Secrets de la Peinture Renaissance", "date" => "12 Décembre 2023", "category" => "Peinture", "image" => "https://images.unsplash.com/photo-1533757740036-7e0fa1d88f6b", "excerpt" => "Découvrez les techniques fascinantes derrière les chefs-d'œuvre de la Renaissance."],
    ["title" => "L'Évolution de la Musique Classique", "date" => "10 Décembre 2023", "category" => "Musique", "image" => "https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4", "excerpt" => "Un voyage à travers les époques musicales, de Mozart à Beethoven."],
    ["title" => "Les Livres qui Ont Changé le Monde", "date" => "15 Décembre 2023", "category" => "Littérature", "image" => "https://images.unsplash.com/photo-1512820790803-83ca734da794", "excerpt" => "Explorez les œuvres littéraires qui ont influencé des générations entières."],
    ["title" => "L'Art Moderne dans le Cinéma", "date" => "20 Décembre 2023", "category" => "Cinéma", "image" => "https://images.unsplash.com/photo-1498050108023-c5249f4df085", "excerpt" => "Comment le cinéma contemporain s'inspire des formes d'art modernes."],
];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    // Ajoutez une logique pour stocker les messages dans une base de données ou les envoyer par email
    $confirmation = "Merci, $name ! Votre message a été envoyé.";
}
?>

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

<!-- Categories Section -->
<section id="categories" class="container mx-auto py-12 px-6">
    <h3 class="text-3xl font-bold mb-8 text-center">Explorez par Catégories</h3>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($categories as $category): ?>
            <div class="bg-white text-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="<?= $category['image'] ?>" alt="<?= $category['name'] ?>" class="w-full h-48 object-cover">
                <div class="p-6 text-center">
                    <h4 class="text-xl font-bold mb-4"><?= $category['name'] ?></h4>
                    <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded">Voir Articles</a>
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
                <img src="<?= $article['image'] ?>" alt="<?= $article['title'] ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <p class="text-sm text-purple-600 uppercase"><?= $article['date'] ?> - <?= $article['category'] ?></p>
                    <h4 class="text-xl font-bold mb-4"><?= $article['title'] ?></h4>
                    <p class="text-gray-700 mb-4"><?= $article['excerpt'] ?></p>
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
