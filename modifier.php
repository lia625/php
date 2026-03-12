<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier exercice</title>
</head>
<body>
    <?php
        #recuperer l'utilisateur à travers get
        include 'connectBD.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM exercice WHERE id = :id";
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            if ($result) {
                $exercice = $stmt->fetchObject(PDO::FETCH_ASSOC);
            }

        }
    ?>
    <form action="ajouter.php" method="put">
        <fieldset>
            <legend>Modifier l'exercice</legend>
            <label for="titre"></label>
            <input type="text" name="titre" id="titre" value="">
        </fieldset>
        
    </form>

</body>
</html>