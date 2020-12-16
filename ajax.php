<?php 
$host = 'mysql:host=sql209.epizy.com;dbname=epiz_27465595_influenceurs';
$login = 'epiz_27465595';
$password = 'AfsuHWoQuAHOk8';
$options = array(PDO::ATTR_ERRMODE => PDO ::ERRMODE_WARNING, PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
$pdo = new PDO ($host, $login, $password, $options );


$tab = array();
$tab['tableau'] =''; 


if(isset($_POST['id'])) {
    $id = $_POST[('id')];

    $recup_infos = $pdo->prepare("SELECT * FROM influencers WHERE id = :id");
    $recup_infos->bindParam(':id', $id, PDO::PARAM_STR).
    $recup_infos->execute();

    if($recup_infos->rowCount()>0){
        $infos = $recup_infos->fetch(PDO::FETCH_ASSOC);

        $tab['tableau'] .= '<table class="table table-responsive-sm" border ="1">';
        $tab['tableau'] .= '<tr>';
        $tab['tableau'] .= '<th>Prénom</th>
                            <th>Nom</th>
                            <th>Surnom</th>
                            <th>Instagram</th>
                            <th>Nombre de followers</th>
                            <th>Prix par post</th>
                            <th>Email</th>';
        $tab['tableau'] .= '</tr>';
        $tab['tableau'] .= '<tr>';
        $tab['tableau'] .= '<td>' .$infos['firstname'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['lastname'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['username'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['instagram'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['followers'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['priceperpost'] . '</td>';
        $tab['tableau'] .= '<td>' .$infos['email'] . '</td>';
        $tab['tableau'] .= '<tr></table>';


    } 
}

 echo json_encode($tab);
