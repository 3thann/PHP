<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    $id_auteur = $_POST['update_auteur'];

    $sql_auteur = "SELECT id, nom, prenom FROM auteurs WHERE id=" . $id_auteur . ";";
    $auteur = $bdd->query($sql_auteur)->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Auteur</title>
</head>
<body>

    <form action="index.php" method="POST">
        <input type="text" name="nom_auteur" value="<?php echo($auteur["nom"]); ?>">
        <input type="text" name="prenom_auteur" value="<?php echo($auteur["prenom"]); ?>">
        <input type="hidden" name="id_auteur" value=<?php echo($auteur["id"]); ?>>
        <input type="submit" name="btn_auteur" value="Modifier !"/>
    </form>

</body>
</html>