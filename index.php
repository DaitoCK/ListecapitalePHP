<?php

$connect = new PDO('mysql:host=localhost;dbname=list_pays', 'root', '',);

$pdoStat = $connect->query ("SELECT * FROM capitales ");


// Vérifier si le formulaire est soumis
if (isset($_GET['pays'])) {

    $country = $_GET['pays'];

    $sql = $connect->prepare("select * from capitales where pays = :pays");
    $sql->bindparam(":pays", $country);
    $sql->execute();
    $fetch= $sql->fetch();
    $pay = $fetch['capitale'];

    echo "La $country a pour capital $pay";
}


//Récupération du tableau //

$pays = $pdoStat->fetchAll();

?>

<!DOCTYPE html>

<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          crossorigin="anonymous">
    <meta charset="utf-8">
    <title>Trouver capitale en fonction du pays</title>
</head>
<body>
<form method="GET" action="index.php">
    <select class="custom-select" name="pays">
        <option selected="selected">Sélectionner un pays</option>';
        <?php foreach ($pays as $value): ?>
            <option value="<?php echo $value['pays']; ?>"><?= $value['pays']; ?></option>
        <?php endforeach; ?>
    </select>
    <input class="btn btn-primary" type="submit"></input>

</form>



</body>