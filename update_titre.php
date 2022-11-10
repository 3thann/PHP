<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    $id_livre = $_POST['update_livre'];

    $sql_livre = "SELECT livres.id, livres.titre, livres.auteur_id, livres.genre_id, auteurs.nom, auteurs.prenom, genres.genre 
    FROM livres INNER JOIN auteurs ON livres.auteur_id = auteurs.id INNER JOIN genres ON livres.genre_id = genres.id WHERE livres.id=" . $id_livre . ";";
    // $sql_livre = "SELECT id, titre FROM livres WHERE id=" . $id_livre . ";";
    $livre = $bdd->query($sql_livre)->fetch();
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
    <title>Update Livre</title>
</head>
<body>

    <form action="index.php" method="POST">
        <input type="text" name="txt_livre" value="<?php echo($livre["titre"]); ?>">
        <input type="hidden" name="id_livre" value=<?php echo($livre["id"]); ?>>
        <input type="hidden" name="auteur_livre" value=<?php echo($livre["auteur_id"]); ?>>
        <input type="hidden" name="genre_livre" value=<?php echo($livre["genre_id"]); ?>>
        <select name="auteur_select">
            <option selected value=<?php echo($livre["auteur_id"]); ?>><?php echo($livre["prenom"] . " " . $livre["nom"]); ?></option>
            <?php foreach($auteurs as $auteur): ?>
                <option value=<?php echo($auteur["id"]); ?>><?php echo($auteur["prenom"] . " " . $auteur["nom"]); ?></option>
            <?php endforeach; ?>
        </select>
        <select name="genre_select">
            <option selected value=<?php echo($livre["genre_id"]); ?>><?php echo($livre["genre"]); ?></option>
            <?php foreach($genres as $genre): ?>
                <option value=<?php echo($genre["id"]); ?>><?php echo($genre["genre"]); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="btn_livre" value="Modifier !"/>
    </form>

</body>
</html>