<?php
    function test($valeur) {
        if(isset($valeur) && !empty($valeur) && !is_null(($valeur))) {
            return true;
        }
        return false;
    }

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    if(isset($_POST['delete_livre'])) {
        $sql_delete = "DELETE FROM livres WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_livre"]]);
    }

    if(isset($_POST['delete_auteur'])) {
        $sql_delete = "DELETE FROM auteurs WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_auteur"]]);
    }

    if(isset($_POST['delete_genre'])) {
        $sql_delete = "DELETE FROM genres WHERE id=:id";
        $stmt = $bdd->prepare($sql_delete);
        $stmt->execute(['id' => $_POST["delete_genre"]]);
    }

    if( test($_POST) ) {
        if( test($_POST["titre"]) ) {
            $sql_insert_livre = "INSERT INTO livres VALUES (NULL, :titre, 1, 1)";
            $stmt_livre = $bdd->prepare($sql_insert_livre);
            $stmt_livre->execute(['titre' => $_POST["titre"]]);
        }
    }

    if( test($_POST) ) {
        if( test($_POST["nom"]) ) {
            $sql_insert_auteur = "INSERT INTO auteurs VALUES (NULL, :nom, :prenom)";
            $stmt_auteur = $bdd->prepare($sql_insert_auteur);
            $stmt_auteur->execute(['nom' => $_POST["nom"], 'prenom' => $_POST["prenom"]]);
        }
    }

    if( test($_POST) ) {
        if( test($_POST["genre"]) ) {
            $sql_insert_genre = "INSERT INTO genres VALUES (NULL, :genre)";
            $stmt_genre = $bdd->prepare($sql_insert_genre);
            $stmt_genre->execute(['genre' => $_POST["genre"]]);
        }
    }

    $sql_livres = "SELECT livres.id, livres.titre, auteurs.nom, auteurs.prenom, genres.genre FROM livres INNER JOIN auteurs ON livres.auteur_id = auteurs.id INNER JOIN genres ON livres.genre_id = genres.id;";
    $livres = $bdd->query($sql_livres)->fetchAll();
    $sql_auteurs = "SELECT id, nom, prenom FROM auteurs;";
    $auteurs = $bdd->query($sql_auteurs)->fetchAll();
    $sql_genres = "SELECT id, genre FROM genres;";
    $genres = $bdd->query($sql_genres)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP LEARNING</title>
</head>
<body style="padding: 0 100px;">

    <h2>Livres</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($livres as $livre): ?>
                <tr>
                    <td><?php echo($livre["titre"]); ?></td>
                    <td><?php echo($livre["prenom"]); echo($livre["nom"]); ?></td>
                    <td><?php echo($livre["genre"]); ?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="update">Modifier</button>
                            <button type="submit" name="delete_livre" value=<?php echo($livre["id"]); ?>>Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <form action="" method="POST">
        <input type="text" name="titre" placeholder="Titre">
        <input type="text" name="auteur" placeholder="Auteur">
        <input type="text" name="genre" placeholder="Genre">
        <input type="submit" value="Envoyer !">
    </form>

    <h2>Auteurs</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($auteurs as $auteur): ?>
                <tr>
                    <td><?php echo($auteur["nom"]); ?></td>
                    <td><?php echo($auteur["prenom"]); ?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="update">Modifier</button>
                            <button type="submit" name="delete_auteur" value=<?php echo($auteur["id"]); ?>>Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Nom">
        <input type="text" name="prenom" placeholder="Prenom">
        <input type="submit" value="Envoyer !">
    </form>

    <h2>Genres</h2>

    <table border="1">
        <thead>
            <tr>
                <th>Genre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($genres as $genre): ?>
                <tr>
                    <td><?php echo($genre["genre"]); ?></td>
                    <td>
                        <form action="" method="POST">
                            <button type="submit" name="update">Modifier</button>
                            <button type="submit" name="delete_genre" value=<?php echo($genre["id"]); ?>>Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <form action="" method="POST">
        <input type="text" name="genre" placeholder="Genre">
        <input type="submit" value="Envoyer !">
    </form>
</body>
</html>