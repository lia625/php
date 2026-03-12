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
                $exercice = $stmt->fetch(PDO::FETCH_ASSOC);
            }

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $titre = $_POST['titre'] ?? '';
            $auteur = $_POST['auteur'] ?? '';
            $date_creation = $_POST['date_creation'] ?? '';
            
            if (trim($titre) && trim($auteur) && trim($date_creation)) {
                $sql = "UPDATE exercice SET titre = :titre, auteur = :auteur, date_creation = :date_creation WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':titre', $titre);
                $stmt->bindParam(':auteur', $auteur);
                $stmt->bindParam(':date_creation', $date_creation);
                $stmt->bindParam(':id', $id);
                
                if ($stmt->execute()) {
                    echo '<div style="background-color: gray;
                                    align-content: center;
                                    justify-content: center;
                                    text-align: center;">
                            <h3>Exercice modifié avec succès</h3>
                        </div>';
                }
            } else {
                echo '<p>Veuillez remplir tous les champs.</p>';
            }
        }
    ?>
    <form action="modifier.php" method="post">
        <fieldset>
            <legend>Modifier un exercice</legend>
            <?php
                if (isset($exercice)) {
                    echo "
                        <label for='titre'>Titre de l'exercice</label>
                        <input type='text' name='titre' id='titre' value='{$exercice['titre']}' required>

                        <br/>
                        <label for='auteur'>Auteur de l'exercice</label>
                        <input type='text' name='auteur' id='auteur' value='{$exercice['auteur']}' required>

                        <br/>
                        <label for='date_creation'>Date de creation</label>
                        <input type='date' name='date_creation' id='date_creation' value='{$exercice['date_creation']}' required>

                        <input type='hidden' name='id' value='{$exercice['id']}'>
                    ";
                }
            ?>
            <input type="submit" value="Modifier">
        </fieldset>

    </form>

</body>
</html>