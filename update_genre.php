<?php

    $user = "chef";
    $pass = "chefchef";
    $bdd = new PDO('mysql:host=localhost:3306;dbname=test', $user, $pass);

    $id_genre = $_POST['update_genre'];

    $sql_genre = "SELECT id, genre FROM genres WHERE id=" . $id_genre . ";";
    $genre = $bdd->query($sql_genre)->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Genre</title>
</head>
<body>

    <form action="index.php" method="POST">
        <input type="text" name="txt_genre" value="<?php echo($genre["genre"]); ?>">
        <input type="hidden" name="id_genre" value=<?php echo($genre["id"]); ?>>
        <input type="submit" name="btn_genre" value="Modifier !"/>
    </form>

</body>
</html>