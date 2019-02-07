<!doctype html>
<html lang="fr">
<head>
  	<meta charset="utf-8">
  	<title>Pizza Commande</title>
</head>
<body>
	<header><h2>Pizza Commande</h2></header><br>

	<?php 

		if (isset($_GET['id']) && isset($_GET['validerId'])) {

			$fichier = fopen($_GET['id'], 'r');

			$tab = JSON_decode(fgets($fichier));

			foreach($tab as $clef => $val)
				echo $clef . " : " . $val . "<br>";

			fclose($fichier);

			echo "<a href='pizza.php'>Pages d'accueil</a>";

		}

		else if (isset($_POST['confirmer'])) {
			echo "Commande enregistré<br>";

			$nom = '' . $_POST['numTel'] . '-' . time();

			$fichier = fopen($nom, 'a+');

			fputs($fichier, JSON_encode($_POST));

			fclose($fichier);

			echo "<b>Votre identifiant : " . $nom . "</b><br>";

			echo "<a href='pizza.php'>Pages d'accueil</a>";
			
		}

		else if (!isset($_POST['numTel']) 
			  || !isset($_POST['mail']) 
			  || !isset($_POST['adresse']) 
			  || !isset($_POST['date']) 
			  || !isset($_POST['heure']) 
			  || !isset($_POST['pizza']) 
			  || !isset($_POST['taille']) 
			  || !isset($_POST['quantite']) 
			  || !isset($_POST['sauce']) 
			  || !isset($_POST['valider'])
			  || $_POST['pizza'] == "Pizza Custom" && (!isset($_POST['ingredient']) || !isset($_POST['pate']))
			  || $_POST['pizza'] == "Pizza Menu" && !isset($_POST['menu']) 
			  || $_POST['pizza'] == "Pizza Menu" && (isset($_POST['ingredient']) || isset($_POST['pate']))
			  || $_POST['pizza'] == "Pizza Custom" && isset($_POST['menu'])
			  ) {

			echo '

				<form method="get" action="pizza.php">
					<fieldset><legend>Ma commande</legend>
						<label for="id">Identifiant</label>
						<textarea type="name" name="id" id="id"></textarea>
						<input type="submit" name="validerId" value="visionner ma commande">
					</fieldset><br>
				</form>';

			echo "<b>Veuillez remplir votre commande correctement s'il vous plait</b><br>";
			echo '

				<form method="post" action="pizza.php">

					<fieldset><legend>Informations personnelles</legend>
						<div>
							<label for="numTel">Numéro de téléphone</label> 
							<input required type="text" placeholder="0623840753" name="numTel" id="numTel">
						</div>
						<br>
						<div>
							<label for="mail">E-mail</label>
							<input required type="email" placeholder="littlenoob@gmail.com" name="mail" id="mail">
						</div>
						<br>
						<div>
							<label for="adresse">Adresse de livraison</label>
							<textarea required placeholder="45 Rue de la Paix, Paris 15eme" name="adresse" id="adresse" cols="50" rows="2"></textarea>
						</div>
						<br>
						<div>
							<label for="date">Date de livraison</label>
							<input required type="date" name="date" id="date">
						</div>
						<br>
						<div>
							<label for="heure">Horaire de livraison</label>
							<input required type="time" name="heure" id="heure">
						</div>
					</fieldset>
					<br>

					<fieldset><legend>Pizza</legend>
						<div>
							<input required type="radio" name="pizza" value="Pizza Menu" id="PizzaMenu">Pizza Menu
							<br>
							Type
							<select required class="option1" name="menu">
								<option disabled selected>Choix</option>
								<option value="Napolitaine">Napolitaine</option>
								<option value="Royale">Royale</option>
								<option value="Orientale">Orientale</option>
								<option value="Fromage">3 Fromage</option>
								<option value="Paysanne">Paysanne</option>
								<option value="Reine">Reine</option>
								<option value="Thon">Thon</option>
								<option value="Chorizo">Chorizo</option>
								<option value="Saumon">Saumon</option>
								<option value="Parmesane">Parmesane</option>
							</select>
						</div>
						<br>
						<div>
							<input type="radio" name="pizza" value="Pizza Custom">Pizza Custom
							<br>
							Epaisseur de pate
							<select required class="option2" name="pate">
								<option disabled selected>Choix</option>
								<option>Fine</option>
								<option>Moyenne</option>
								<option>Epaisse</option>
							</select>
							<br>
							Ingrédients
							<input class="option2" type="checkbox" name="ingredient[]" value="tomate">tomate
							<input class="option2" type="checkbox" name="ingredient[]" value="fromage">fromage
							<input class="option2" type="checkbox" name="ingredient[]" value="anchois">anchois
							<input class="option2" type="checkbox" name="ingredient[]" value="olive">olive
							<input class="option2" type="checkbox" name="ingredient[]" value="champignon">champignon
							<input class="option2" type="checkbox" name="ingredient[]" value="poivron">poivron
							<input class="option2" type="checkbox" name="ingredient[]" value="oignon">oignon
							<input class="option2" type="checkbox" name="ingredient[]" value="chèvre">chèvre
							<input class="option2" type="checkbox" name="ingredient[]" value="bleu">bleu
							<input class="option2" type="checkbox" name="ingredient[]" value="ananas">ananas
							<input class="option2" type="checkbox" name="ingredient[]" value="chorizo">chorizo
						</div>
						<br><br><br><br><br>
						<div>
							Taille
							<select required name="taille">
								<option disabled selected>Choix</option>
								<option value="petite">Petite</option>
								<option value="moyenne">Moyenne</option>
								<option value="grande">Grande</option>
							</select>
						</div>
						<br>
						<div>
							<label for="quantite">Quantité</label>
							<input required type="number" placeholder="1" name="quantite" id="quantite">
						</div>
						<br>
						<div>
							Sauce Piquante
							<input required type="radio" name="sauce">oui
							<input type="radio" name="sauce">non
						</div>
						<br>
						<div>
							<label for="offre">Recevoir par e-mail les offres des pizza à venir</label>
							<input checked type="checkbox" name="offre" id="offre">
						</div>
						<br>
						<div>
							Niveau de faim
							<input type="range" name="faim">
						</div>
						<br>
					</fieldset>

					<br>
					<input value="Envoyer" type="submit" name="valider">
					<input value="Remettre à zéro" type="reset" name="zero">
				</form>

			';
		}

		else {
			echo "<b>Récapitulatif de la commande</b><br>";
			echo $_POST['pizza'] . "<br>";
			if ($_POST['pizza'] == "Pizza Menu")
				echo $_POST['menu'];
			else {
				echo $_POST['pate'] . "<br>";
				foreach ($_POST['ingredient'] as $val)
					echo $val . " ";
			}
			echo "<br>" . $_POST['taille'] . "<br>";
			echo "quantité : " . $_POST['quantite'] . "<br>";
			echo "sauce ";
			if ($_POST['sauce'] == "on")
				echo "oui<br>";
			else 
				echo "non<br>";

			$prix = 0;

			if ($_POST['pizza'] == "Pizza Menu")
				$prix += 10;
			if ($_POST['pizza'] == "Pizza Custom")
				$prix += 12;

			if ($_POST['taille'] == "petite")
				$prix /= (5/4);
			if ($_POST['taille'] == "grande")
				$prix *= (5/4);

			$prix *= $_POST['quantite'];

			echo "<b>Prix : " . $prix . " €</b>";

			echo '
				<form method="post" action="pizza.php">
					<input type="hidden" name="numTel" value="' . $_POST['numTel'] . '">
					<input type="hidden" name="mail" value="' . $_POST['mail'] .'">
					<input type="hidden" name="adresse" value="' . $_POST['adresse'] .'">
					<input type="hidden" name="date" value="' . $_POST['date'] .'">
					<input type="hidden" name="heure" value="' . $_POST['heure'] .'">
					<input type="hidden" name="pizza" value="' . $_POST['pizza'] .'">';
					if ($_POST['pizza'] == "Pizza Menu")
						echo '<input type="hidden" name="menu" value="' . $_POST['menu'] .'">';
					if ($_POST['pizza'] == "Pizza Custom") {
						echo '<input type="hidden" name="pate">';
						$string = "";
						foreach ($_POST['ingredient'] as $key => $value)
							$string = $string . ' ' . $value;
						echo  '<input type="hidden" name="ingredient" value="' . $string .'">';
					}
			echo '
					<input type="hidden" name="taille" value="' . $_POST['taille'] .'">
					<input type="hidden" name="quantite" value="' . $_POST['quantite'] .'">
					<input type="hidden" name="sauce" value="' . $_POST['sauce'] .'">
					<input type="hidden" name="prix" value="' . $prix . '">

					<input type="submit" name="confirmer" value="confirmer">
					<a href="pizza.php">Annuler</a>
				</form>
			';
		}

	?>

	<script>
		var bouton = document.querySelector("#PizzaMenu");
		var radio1 = document.querySelectorAll(".option1");
		var radio2 = document.querySelectorAll(".option2");

		function fct() {
			if (bouton.checked) {
				for (let i = 0; i < radio2.length; i+=1) 
					radio2[i].disabled = true;
				for (let i = 0; i < radio1.length; i+=1) 
					radio1[i].disabled = false;
			}
			else {
				for (let i = 0; i < radio2.length; i+=1) 
					radio2[i].disabled = false;
				for (let i = 0; i < radio1.length; i+=1)
					radio1[i].disabled = true;
			}
		}

		setInterval(fct, 100);
	</script>
</body>
</html>