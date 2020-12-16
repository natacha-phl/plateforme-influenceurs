<?php

// Connexion à la BDD

try {

    $db = new PDO('mysql:host=sql209.epizy.com;dbname=epiz_27465595_influenceurs', 'epiz_27465595', 'AfsuHWoQuAHOk8');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $exception) {

    print "Erreur de connexion : " . $exception->getMessage() . "<br>";
    die();

}