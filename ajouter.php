
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Exercice</title>
</head>
<body>

    <?php
        include "connectBD.php";   

        // Afficher les messages de suppression
        if (isset($_GET['deleted'])) {
            if ($_GET['deleted'] === 'success') {
                echo '<div style="background-color: green; color: white; text-align: center; padding: 10px;">
                        <h3>Exercice supprimé avec succès</h3>
                    </div>';
            } elseif ($_GET['deleted'] === 'error') {
                echo '<div style="background-color: red; color: white; text-align: center; padding: 10px;">
                        <h3>Erreur lors de la suppression</h3>
                    </div>';
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre         = $_POST['titre'] ?? '';
            $auteur        = $_POST['auteur'] ?? '';
            $date_creation = $_POST['date_creation'] ?? '';
            
            if (trim($titre) && trim($auteur) && trim($date_creation)) {
                $sql = "INSERT INTO exercice (titre, auteur, date_creation)
                        VALUES (:titre, :auteur, :date_creation)";

                $stmt = $connect->prepare($sql);           
                $stmt->bindParam(':titre', $titre);       
                $stmt->bindParam(':auteur', $auteur);
                $stmt->bindParam(':date_creation', $date_creation);
                
                if ($stmt->execute()) {
                    echo '<div style="background-color: gray;
                                    align-content: center;
                                    justify-content: center;
                                    text-align: center;">
                            <h3>Exercice ajouté avec succès</h3>
                        </div>';
                }
            } else {
                // Optionnel : afficher un message si champs vides
                echo '<p>Veuillez remplir tous les champs.</p>';
            }
        }
    ?>
    <form action="ajouter.php" method="post">
        <fieldset>
            <legend>Ajouter un exercice</legend>
            <table>
                <tr>
                    <td><label for="titre">Titre de l'exercice</label></td>
                    <td><input type="text" name="titre" id="titre" required></td>
                </tr>
                <tr>
                    <td><label for="auteur">Auteur de l'exercice</label> </td>
                    <td><input type="text" name="auteur" id="auteur" required> </td>
                </tr>
                <tr>
                    <td><label for="date_creation">Date de creation</label></td>
                    <td><input type="date" name="date_creation" id="date_creation" required></td>
                </tr>
            </table>
            <input type="submit" value="Envoyer">
        </fieldset>
    </form>

    <br>
    <br>

    <table style="background-color: gray;
                align-items: center;
                justify-content: center;
                justify-self: center;
                text-align: center;
                margin : 100px;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Date de creation</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
        <?php
            
            $stmt = $connect->query("SELECT * FROM exercice ORDER BY id");
            $exercices = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($exercices as $exo) {
                echo "<tr>
                        <td>{$exo['id']}</td>
                        <td>{$exo['titre']}</td>
                        <td>{$exo['auteur']}</td>
                        <td>{$exo['date_creation']}</td>
                        <td><a href=\"modifier.php?id={$exo['id']}\">Modifier</a></td>
                        <td><a href=\"supprimer.php?id={$exo['id']}\">Supprimer</a></td>
                      </tr>";
            }
        ?> 
        </tbody>
    </table>
    

</body>
</html>