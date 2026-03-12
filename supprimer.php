<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer Exercice</title>
</head>
<body>
    <?php
        include 'connectBD.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
                // Suppression confirmée
                $sql = "DELETE FROM exercice WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':id', $id);
                
                if ($stmt->execute()) {
                    header('Location: ajouter.php?deleted=success');
                    exit();
                } else {
                    header('Location: ajouter.php?deleted=error');
                    exit();
                }
            } else {
                // Afficher la confirmation
                $sql = "SELECT titre FROM exercice WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $exercice = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($exercice) {
                    echo "<h2>Confirmer la suppression</h2>";
                    echo "<p>Voulez-vous vraiment supprimer l'exercice : <strong>{$exercice['titre']}</strong> ?</p>";
                    echo "<form action='supprimer.php?id={$id}' method='post'>";
                    echo "<input type='hidden' name='confirm' value='yes'>";
                    echo "<input type='submit' value='OK'>";
                    echo " <a href='ajouter.php'>Cancel</a>";
                    echo "</form>";
                } else {
                    echo "<p>Exercice introuvable.</p>";
                    echo "<a href='ajouter.php'>Retour</a>";
                }
            }
        } else {
            echo "<p>ID manquant.</p>";
            echo "<a href='ajouter.php'>Retour</a>";
        }
    ?>
</body>
</html>
