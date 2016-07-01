<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Include connections
include('../connection-mysql.php');

?>
<!-- Authors: Saul Gonzalez and Jeffrey Schachtsick
	 Class: CS340: Databases
	 Assignment: Database Project
	 Description: Display table for recipe and ingredient.
	 Date Updated: May 20, 2016-->
<!DOCTYPE html>
<html lang="en">
	<!-- Title of Recipe_Ingredient Table -->
  <head>
    <meta charset="utf-8">
    <title>Recipe and Ingredient Table</title>
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
	<p>Recipe and Ingredients</p>
	<!-- List each Recipe-Ingredient from the database -->
		<table>
		<tr>
			<td>Recipe-Ingredient ID</td>
			<td>| Recipe ID</td>
			<td>| Recipe Name</td>
			<td>| Ingredient ID</td>
			<td>| Ingredient Name</td>
			<td>| Ingredient Quantity</td>
		</tr>
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT recipe_ingredient.RINum, recipe_ingredient.RNum, recipe.RName, ingredient.InNum, ingredient.InName, recipe_ingredient.Quantity FROM recipe INNER JOIN recipe_ingredient ON recipe.RNum = recipe_ingredient.RNum INNER JOIN ingredient ON ingredient.InNum = recipe_ingredient.InNum ORDER BY recipe_ingredient.RINum"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()) {
	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($rid, $rnum, $rname, $iid, $iname, $quant)){
	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()) {
	echo "<tr>\n<td>\n" . $rid . "\n</td>\n<td>\n | " . $rnum . "\n</td>\n<td>\n | " . $rname . "\n</td>\n<td>\n | " . $iid . "\n</td>\n<td>\n | " . $iname . "\n</td>\n<td>\n | " . $quant ."\n</td>\n</tr>";
}
// Close the state
$state->close();
?>
	</table>
	<div>
		<form method="post" action="addrec_ing.php">
			<fieldset>
				<legend>Add Quantity of Ingredients</legend>
				<!-- Drop down menu for all the names of Recipes from Recipe table -->
				<select name="QuantRecipe">
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT RNum, RName FROM recipe"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// Execute the statement, error if incorrect
if(!$state->execute()){
	echo "Execute failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $rname)){
	echo "Bind failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Disply recipes in the drop down menu
while($state->fetch()){
	echo '<option value=" '. $id . ' "> ' . $rname . '</option>\n';
}
// Close the state
$state->close();
?>	
				</select>
				<!-- Drop down menu for all the names of ingredients from Ingredients table -->
				<select name="QuantIngred">
<?php
// Make a select statement
if(!($state = $dbcon->prepare("SELECT InNum, InName FROM ingredient"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// Execute the statement, error if incorrect
if(!$state->execute()){
	echo "Execute failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $iname)){
	echo "Bind failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display ingredients in the drop down menu
while($state->fetch()){
	echo '<option value=" '. $id . ' "> ' . $iname . '</option>\n';
}
// Close the state
$state->close();
?>	
				</select>
				<!-- Add quantity of ingredients to the recipe with text -->
				<p>Quantity of Ingredients for Recipe: <input type="text" name="Quantity" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>
	</body>
</html>