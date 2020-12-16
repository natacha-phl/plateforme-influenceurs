<?php

// Fonction getInfluencers() : Retourne tous les influenceurs
function getInfluencers()
{
    global $db;
    $sql = 'SELECT * FROM influencers';
    $query = $db->prepare($sql);
    $query->execute();
    return $query//->fecthAll()
    ;
}

// Fonction addInfluencers(...) : Insérer un influenceur
function addInfluencer($firstname, $lastname, $username, $instagram, $followers, $priceperpost, $email)
{

    global $db; // Récupération de $db l'espace global de PHP; voir database.php
    $query = $db->prepare('INSERT INTO influencers(firstname, lastname, username, instagram, followers, priceperpost, email) VALUES (:firstname, :lastname, :username, :instagram, :followers, :priceperpost, :email)');
    $query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindValue(':username', $username, PDO::PARAM_STR);
    $query->bindValue(':instagram', $instagram, PDO::PARAM_STR);
    $query->bindValue(':followers', $followers, PDO::PARAM_STR);
    $query->bindValue(':priceperpost', $priceperpost, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);


    // Si l'influenceur est bien inséré, alors je retourne l'ID sinon je retourne faux.
    return $query->execute() ? $db->lastInsertId() : false;
}

// Fonction deleteIfluencers (...) : Supprimer un véhicule
function deleteInfluencers($id)
{
 global $db;
 $delete = $db->prepare('DELETE from influencers WHERE id = :id');
 $delete->bindValue(':id, $id, PDO::PARAM_INT');
 return $delete->execute();
}


