<?php

/*************************************************************************************/
/* On crée une fonction qui fait plusieurs chose :
 *   - nettoye les chaines de caractères contenant potentiellement des balises html, 
 *   - vérifie que les valeurs correspondent à une valeur attendues,
 *   - output un message d'erreur pour chaque problème rencontré,
 * Cette fonction output true si elle n'a pas rencontrée d'erreur, et false sinon.   */
/*************************************************************************************/

function verification_et_nettoyage_post(&$array) { // On passe $array par reference car on va modifier ses valeurs ! d'où le & avant $array.
    
    // $flag vaut true au début, et dès qu'on rencontre une erreur on met $flag à false
    $flag=true;

    if (// Tous les champs ont été remplis
	isset($_POST['numTel']) && isset($_POST['mail']) && isset($_POST['adresse']) && isset($_POST['date']) && isset($_POST['heure']) && isset($_POST['pizza']) && isset($_POST['taille']) && isset($_POST['quantite'])&& isset($_POST['sauce'])
	// Y compris ceux dépendant du choix pizza menu/custom : l'une des deux options est selectionnée ...
	&& ($_POST['pizza'] == "Pizza Custom" && isset($_POST['ingredient']) && isset($_POST['pate'])
	 || $_POST['pizza'] == "Pizza Menu" && isset($_POST['menu']))
	// ... mais pas les deux !
	&& !($_POST['pizza'] == "Pizza Menu" && (isset($_POST['ingredient']) || isset($_POST['pate'])))
	&& !($_POST['pizza'] == "Pizza Custom" && isset($_POST['menu'])))
    { // Fin de la condition, on est dans le cas ou le formulaire est entièrement rempli
	
	// on filtre pour éviter l'injection de code HTML
	$array['adresse'] = filter_var($array['adresse'], FILTER_SANITIZE_STRING);	
	$array['date'] = filter_var($array['date'], FILTER_SANITIZE_STRING);
	$array['heure'] = filter_var($array['heure'], FILTER_SANITIZE_STRING);
	
	if ($array['pizza'] == "Pizza Custom") {
	    foreach ($array['ingredient'] as $value) {
		// On vérifie que les ingrédients ne sont que parmi ceux possibles
		if(!in_array($value, array("tomate", "fromage", "anchois", "olive", "champignon", "oignon", "poivron", "chèvre", "bleu", "ananas", "chorizo" ))) {
		    echo "Ingrédient incorrect !<br>";
		    $flag=false;
		}
	    }
	    // On vérifie que la pate n'est que parmi les options disponibles
	    if(!in_array($array['pate'], array("fine", "moyenne", "epaisse" ))) {
		echo "Pate incorrecte !<br>";
		$flag=false;
	    }
	}
	if ($array['pizza'] == "Pizza Menu")
	    // On vérifie que le menu n'est que parmi les options disponibles
	    if(!in_array($array["menu"],array("Parmesane", "Saumon", "Chorizo", "Thon", "Reine", "Paysanne", "Fromage", "Orientale", "Royale", "Napolitaine"))) {
		echo "Ingrédient incorrect !<br>";
		$flag=false;
	    }
	$array['numTel'] = filter_var($array['numTel'], FILTER_SANITIZE_NUMBER_INT); // On ne garde que les numéros, + - et .
	if (strlen($array['numTel']) < 10 || strlen($array['numTel']) > 15) {  // On vérifie la longueur
	    echo "Numéro de téléphone incorrect !<br>";
	    $flag=false;
	}
	else if (!filter_var($array['mail'], FILTER_VALIDATE_EMAIL)) { // on vérifie que l'email est valide
	    echo "Email incorrect !<br>";
	    $flag=false;
	}
	// On vérifie que la taille n'est que parmi les options disponibles
	else if (!($array['taille'] == "petite") && !($array['taille'] == "moyenne") && !($array['taille'] == "grande")) {
	    echo "Taille incorrect !<br>";
	    $flag=false;
	}
	// On vérifie que la quantité est entre 1 et 30
	else if (!filter_var($array['quantite'], FILTER_VALIDATE_INT, array("options" => array("min_range" => 1, "max_range" => 30)))) {
	    echo "Quantitée incorrecte !<br>";
	    $flag=false;
	}
	// $flag vaut true si et seulement si on n'a trouvé aucune erreur !
	return $flag;
    }
    else { // Cas où le formulaire n'est pas suffisement rempli
	echo "Formulaire incomplet !<br>";
	return false;
    }
}
?>

<!doctype html>
<html lang="fr">
    <head>
  	<meta charset="utf-8">
  	<title>Pizza Commande</title>
    </head>
    <body>
	<header><h2>Pizza Commande</h2></header><br>
	
	<?php 
	/*************************************************************************************/
	// Cas où l'on souhaite avoir le récapitulatif d'une commande !
	/*************************************************************************************/
	if (isset($_GET['id']) && isset($_GET['validerId'])) {
	    // On enlève les "/" pour pas que on puisse accéder à des fichiers dans d'autres repertoires 
	    $_GET['id'] = str_replace('/', '', $_GET['id']);
	    if (file_exists($_GET['id'])) { // Si le fichier existe
		$fichier = fopen($_GET['id'], 'r'); // On ouvre le fichier
		// On le lit et le décode pour retrouver ce qu'on avait stocké : le tableau $_POST au moment de la création de la commande !
		$tab = JSON_decode(fgets($fichier)); 
		foreach($tab as $clef => $val) {  // On affiche son contenu
		    echo $clef . " : " . $val . "<br>";
		}
		fclose($fichier);
		echo "<a href='pizza.php'>Page d'accueil</a>";
	    }
	    else {
		echo 'Identifiant de commande incorrect<br>'; 
		echo "<a href='pizza.php'>Pages d'accueil</a>";
	    }
	}
	/*************************************************************************************/
	// Cas où l'on souhaite confirmer une commande
	/*************************************************************************************/
	else if (isset($_POST['confirmer'])) {
	    if(!verification_et_nettoyage_post($_POST)) {
		echo "<b>Formulaire non valide</b><br>";
		echo "<a href='pizza.php'>Page d'accueil</a>";
	    }
	    else {
		$identifFichier = '' . $_POST['numTel'] . '-' . time();
		$fichier = fopen($identifFichier, 'a+');
		fputs($fichier, JSON_encode($_POST));
		fclose($fichier);
		echo "Commande enregistré<br>";
		echo "<b>Votre identifiant : " . $identifFichier . "</b><br>";
		echo "<a href='pizza.php'>Page d'accueil</a>";
	    }
	}
	/*************************************************************************************/
	// Cas où l'on souhaite avoir le valider le formulaire de commande
	/*************************************************************************************/
	else if (isset($_POST["valider"])){
	    if(verification_et_nettoyage_post($_POST))
		include("recap.php");
	    else // réécrire le formulaire avec les infos déjà rentrées
		include("pizzaForm.php");
	}
	/*************************************************************************************/
	// Cas où l'on souhaite voir le formulaire
	/*************************************************************************************/
	else {
	    include("pizzaForm.php");
	}
	
	?>

    </body>
</html>
