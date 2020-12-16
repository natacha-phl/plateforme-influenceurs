// Mise en place d'un évènement change sur l'élément html ayant l'id "influencer" (ici le champ select)
document.getElementById('influencer').addEventListener('change', function (){
    // dans un évènement, le mot clé this représente l'élément html atant reçu l'évènement
    var valeur = this.value;
    console.log(valeur)


    // url cible
    var cible = 'ajax.php';

    // Création de l'objet Ajax
    if(window.XMLHttpRequest){ // si XMLHttpRequest existe
    var xhttp = new XMLHttpRequest(); // pour les navigateurs récents
    } else {
        var xhttp= new ActiveXObject('Microsoft.XMLHTTP'); // POUR IE < version 9 
    }

    // on prépare le ou les argument(s) à fournir dans POST
    var param = 'id=' + valeur;
    console.log(param);

    // on prépare la requete ajax
    xhttp.open('POST', cible);

    // la ligne suivante est obligatoire en methode POST, et il est obligatoire d'appeler cette ligne après la methode open()

    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    // l'évènement lié au changement de stat sur readyState

    xhttp.onreadystatechange = function (){
        if(xhttp.status == 200 && xhttp.readyState == 4 ){
            console.log(xhttp.responseText);

            // la réponse sera au format json donc pour que js le récupère sous forme d'objet, nous devons appliquer un parse
            var reponse = JSON.parse(xhttp.responseText); // on transforme la réponse sous forme d'objet JS  
            console.log(reponse);
            
            // on place dans le div id='resultat' le code html obtenu
            // l'indice tableau provient du script php (voir sur ajax.php)
            document.getElementById('resultat').innerHTML = reponse.tableau;
        }
    }

    xhttp.send(param);
});