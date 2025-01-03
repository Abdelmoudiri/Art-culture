<?php

include_once('../../classes/Article.php'); 

header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    if (empty($input['titre']) || empty($input['content']) || empty($input['idCategorie']) || empty($input['idAuteur'])) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs obligatoires doivent être remplis.']);
        exit;
    }

    $article = new Article(
        $input['titre'],
        $input['content'],
        $input['datePublication'],
        $input['image'] ?? null,
        "En attente",
        $input['idCategorie'],
        $input['idAuteur']
    );

    $article->save();

    echo json_encode(['success' => true, 'idArticle' => $article->getidArticle()]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
