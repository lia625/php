<?php
    #connexion à la base de donnée
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "base_iaitogo";
    $connect = connect();
    
    function connect(){
        global $host, $username, $password, $database;
        try {
            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
            return $conn;
        } catch (\Throwable $th) {
            die("Erreur de connexion : " . $th->getMessage());
        }
    }
?>