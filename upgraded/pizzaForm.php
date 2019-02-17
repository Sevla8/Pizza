<form method="get" action="pizza.php">
  <fieldset><legend>Ma commande</legend>
    <label for="id">Identifiant</label>
    <textarea type="name" name="id" id="id"></textarea>
    <input type="submit" name="validerId" value="visionner ma commande">
  </fieldset><br>
</form>

<form method="post" action="pizza.php">

  <fieldset><legend>Informations personnelles</legend>
    <div>
      <label for="numTel">Numéro de téléphone</label> 
      <input required type="text" placeholder="06xxxxxxxx" name="numTel" id="numTel" <?php if(isset($_POST["numTel"])) echo "value=\"".$_POST['numTel']."\""; ?>>
    </div>
    <br>
    <div>
      <label for="mail">E-mail</label>
      <input required type="email" placeholder="littlenoob@gmail.com" name="mail" id="mail" <?php if(isset($_POST["mail"])) echo "value=\"".$_POST['mail']."\""; ?>>
    </div>
    <br>
    <div>
      <label for="adresse">Adresse de livraison</label>
      <textarea required placeholder="45 Rue de la Paix, Paris 15eme" name="adresse" id="adresse" cols="50" rows="2" ><?php if(isset($_POST["adresse"])) echo htmlentities($_POST['adresse']); ?></textarea>
    </div>
    <br>
    <div>
      <label for="date">Date de livraison</label>
      <input required type="date" name="date" id="date"  <?php if(isset($_POST["date"])) echo "value=\"".$_POST['date']."\""; ?>>
    </div>
    <br>
    <div>
      <label for="heure">Horaire de livraison</label>
      <input required type="time" name="heure" id="heure" <?php if(isset($_POST["heure"])) echo "value=\"".$_POST['heure']."\""; ?>>
    </div>
  </fieldset>
  <br>

  <fieldset><legend>Pizza</legend>
    <div>
      <input required type="radio" name="pizza" value="Pizza Menu" id="PizzaMenu"  <?php if(isset($_POST["pizza"]) && $_POST["pizza"]=="Pizza Menu") echo "checked"; ?>>Pizza Menu
      <br>
      Type
      <select required class="option1" name="menu">
	<option disabled <?php if(!isset($_POST["menu"])) echo "selected" ?>>Choix</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Napolitaine") echo "selected"; ?> value="Napolitaine">Napolitaine</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Royale") echo "selected"; ?> value="Royale">Royale</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Orientale") echo "selected"; ?> value="Orientale">Orientale</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Fromage") echo "selected"; ?> value="Fromage">3 Fromage</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Paysanne") echo "selected"; ?> value="Paysanne">Paysanne</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Reine") echo "selected"; ?> value="Reine">Reine</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Thon") echo "selected"; ?> value="Thon">Thon</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Chorizo") echo "selected"; ?> value="Chorizo">Chorizo</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Saumon") echo "selected"; ?> value="Saumon">Saumon</option>
	<option  <?php if(isset($_POST["menu"]) && $_POST["menu"]=="Parmesane") echo "selected"; ?> value="Parmesane">Parmesane</option>
      </select>
    </div>
    <br>
    <div>
      <input type="radio" name="pizza" value="Pizza Custom" id="PizzaCustom"  <?php if(isset($_POST["pizza"]) && $_POST["pizza"]=="Pizza Custom") echo "checked"; ?>>Pizza Custom
      <br>
      Epaisseur de pate
      <select required class="option2" name="pate">
	<option <?php if(!isset($_POST["pate"])) echo "selected" ?> selected>Choix</option>
	<option <?php if(isset($_POST["pate"]) && $_POST["pate"]=="fine") echo "selected"; ?>  value="fine">Fine</option>
	<option <?php if(isset($_POST["pate"]) && $_POST["pate"]=="moyenne") echo "selected"; ?>  value="moyenne">Moyenne</option>
	<option <?php if(isset($_POST["pate"]) && $_POST["pate"]=="epaisse") echo "selected"; ?>  value="epaisse">Epaisse</option>
      </select>
      <br>
      Ingrédients
      <input    <?php if(isset($_POST["ingredient"]) && in_array("tomate",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="tomate">tomate
      <input  <?php if(isset($_POST["ingredient"]) && in_array("fromage",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="fromage">fromage
      <input  <?php if(isset($_POST["ingredient"]) && in_array("anchois",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="anchois">anchois
      <input  <?php if(isset($_POST["ingredient"]) && in_array("olive",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="olive">olive
      <input  <?php if(isset($_POST["ingredient"]) && in_array("champignon",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="champignon">champignon
      <input  <?php if(isset($_POST["ingredient"]) && in_array("poivron",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="poivron">poivron
      <input  <?php if(isset($_POST["ingredient"]) && in_array("oignon",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="oignon">oignon
      <input  <?php if(isset($_POST["ingredient"]) && in_array("chèvre",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="chèvre">chèvre
      <input  <?php if(isset($_POST["ingredient"]) && in_array("bleu",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="bleu">bleu
      <input  <?php if(isset($_POST["ingredient"]) && in_array("ananas",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="ananas">ananas
      <input  <?php if(isset($_POST["ingredient"]) && in_array("chorizo",$_POST["ingredient"])) echo "checked"; ?>  class="option2" type="checkbox" name="ingredient[]" value="chorizo">chorizo
    </div>
    <br><br><br><br><br>
    <div>
      Taille
      <select required name="taille">
	<option disabled <?php if(!isset($_POST["taille"])) echo "selected"; ?>>Choix</option>
	<option <?php if(isset($_POST["taille"]) && $_POST["taille"]=="petite") echo "selected";?> value="petite">Petite</option>
	<option <?php if(isset($_POST["taille"]) && $_POST["taille"]=="moyenne") echo "selected";?> value="moyenne">Moyenne</option>
	<option <?php if(isset($_POST["taille"]) && $_POST["taille"]=="grande") echo "selected";?> value="grande">Grande</option>
      </select>
    </div>
    <br>
    <div>
      <label for="quantite">Quantité</label>
      <input required type="number" placeholder="1" name="quantite" id="quantite" <?php if(isset($_POST["pate"])) echo "value=\"".$_POST["quantite"]."\"";?>>
    </div>
    <br>
    <div>
      Sauce Piquante 
      <input value="on" required type="radio" name="sauce" <?php if(isset($_POST["sauce"]) && $_POST["sauce"]=="on") echo "checked";?>>oui
      <input value="off" type="radio" name="sauce"  <?php if(isset($_POST["sauce"]) && $_POST["sauce"]=="off") echo "checked";?>>non
    </div>
    <br>
    <div>
      <label for="offre">Recevoir par e-mail les offres des pizza à venir</label>
      <input checked type="checkbox" name="offre" id="offre">
    </div>
    <br>
  </fieldset>

  <br>
  <input value="Envoyer" type="submit" name="valider">
  <input value="Remettre à zéro" type="reset" name="zero">
</form>

<script> // Petite partie de JS pour ne pouvoir sélectionner qu'un type de pizza : custom ou menu.
 var bouton1 = document.querySelector("#PizzaMenu");
 var bouton2 = document.querySelector("#PizzaCustom");
 var radio1 = document.querySelectorAll(".option1");
 var radio2 = document.querySelectorAll(".option2");

 function updateDisabled() {
     if (bouton1.checked) {
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
 
 if(bouton1){
     document.body.onload = updateDisabled;
     bouton1.addEventListener("change", updateDisabled);
     bouton2.addEventListener("change", updateDisabled);
 }
</script>
