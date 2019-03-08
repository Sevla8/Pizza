
<b>Récapitulatif de la commande</b><br>
<?php echo $_POST['pizza'] ?> <br>
<?php
if ($_POST['pizza'] == "Pizza Menu")
    echo $_POST['menu'];
else {
    echo $_POST['pate'] . "<br>";
    foreach ($_POST['ingredient'] as $val) {
	echo $val . " ";
    }
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
?>

<form method="post" action="pizza.php">
    <input type="hidden" name="numTel" value="<?php echo $_POST['numTel'];?>">
    <input type="hidden" name="mail" value="<?php echo $_POST['mail'];?>">
    <input type="hidden" name="adresse" value="<?php echo $_POST['adresse'];?>">
    <input type="hidden" name="date" value="<?php echo $_POST['date'];?>">
    <input type="hidden" name="heure" value="<?php echo $_POST['heure'];?>">
    <input type="hidden" name="pizza" value="<?php echo $_POST['pizza'];?>">
    <?php 
    if ($_POST['pizza'] == "Pizza Menu")
	echo '<input type="hidden" name="menu" value="' . $_POST['menu'] .'">'; 
    if ($_POST['pizza'] == "Pizza Custom") {
	echo '<input type="hidden" name="pate">';
	$string = "";
	foreach ($_POST['ingredient'] as $key => $value)
	$string = $string . ' ' . $value;
	echo  '<input type="hidden" name="ingredient" value="' . $string .'">';
    }?>
    <input type="hidden" name="taille" value="<?php echo $_POST['taille']; ?>">
    <input type="hidden" name="quantite" value="<?php echo $_POST['quantite'];?>">
    <input type="hidden" name="sauce" value="<?php echo $_POST['sauce'];?>">
    <input type="hidden" name="prix" value="<?php echo $prix; ?>">
    
    <input type="submit" name="confirmer" value="confirmer">
    <a href="pizza.php">Annuler</a>
</form>
