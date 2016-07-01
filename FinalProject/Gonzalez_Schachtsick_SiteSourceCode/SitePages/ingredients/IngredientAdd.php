<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Include connections
include('../connection-mysql.php');

?>
<!-- Authors: Saul Gonzalez and Jeffrey Schachtsick
	 Class: CS340: Databases
	 Assignment: Database Project
	 Description: Display data for ingredient and add/update entries for beer table.
	 Date Updated: May 20, 2016-->
	 
<!DOCTYPE html>
<html lang="en">
  <head>
	<!-- Title of Ingredient Table -->
    <meta charset="utf-8">
    <title>Ingredients Table</title>
  </head>
  <body>
	<!-- Interface for navigating between pages -->
	<table>
		<tr>
			<td><a href="../main.html">Home | </a></td>
			<td><a href="../beers/BeerAdd.php">Beer | </a></td>
			<td><a href="../recipes/RecipeAdd.php">Recipe | </a></td>
			<td><a href="../ingredients/IngredientAdd.php">Ingredient | </a></td>
			<td><a href="../rec_ing/RecipeIngredientsAdd.php">Recipe Ingredient | </a></td>
			<td><a href="../hops/HopsAdd.php">Hops</a></td>
		</tr>
	</table>
	<p>Ingredients</p>
	<!-- List each ingredient from the database with Ingredient ID and Name -->
	<table>
		<tr>
			<td>ID</td>
			<td>| Name</td>
		</tr>
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT ingredient.InNum, ingredient.InName FROM ingredient"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()) {
	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $name)){
	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()) {
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n | " . $name . "\n</td>\n</tr>";
}
// Close the state
$state->close();
?>
	</table>
	<div>
		<!-- Form for adding an ingredient, sends to addingredient.php file -->
		<form method="post" action="addingredient.php">
			<fieldset>
				<legend>Add Ingredient</legend>
				<!-- Add name of ingredient -->
				<p>Ingredient Name: <input type="text" name="IngredientName" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>
		<!-- Update section for Ingredients -->
		<form method="post" action="updateingredient.php">
			<fieldset>
				<legend>Update an Ingredient</legend>
				<!-- Drop down menu that selects the ingredient from the table -->
				<p>Select Ingredient <select name="IngredUpdate">
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT InNum, InName FROM ingredient"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()){
	echo "Execute failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $iname)){
	echo "Bind failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display the ingredient in the drop down menu
while($state->fetch()){
	echo '<option value=" '. $id . ' "> ' . $iname . '</option>\n';
}
// Close the state
$state->close();
?>	
				</select></p>
				<!-- Update the new name in the text -->
				<p>Update Name: <input type="text" name="UpdateName" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	<div>
	</div>
  </body>
</html>
