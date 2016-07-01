<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Include connections
include('../connection-mysql.php');

?>
<!-- Authors: Saul Gonzalez and Jeffrey Schachtsick
	 Class: CS340: Databases
	 Assignment: Database Project
	 Description: Display data for recipe and add entries for recipe table.
	 Date Updated: May 20, 2016-->

<!DOCTYPE html>
<html lang="en">
	<!-- Title of Recipe Table -->
  <head>
    <meta charset="utf-8">
    <title>Recipes Table</title>
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
	<p>Recipes</p>
	<!-- List each Recipe from the database with Recipe ID, Name, Beer it makes, and the Beer's ABV from the Beer table -->
	<table>
		<tr>
			<td>ID</td>
			<td>| Name</td>
			<td>| Makes Beer</td>
			<td>| Beer's Alc. %</td>
		</tr>
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT recipe.RNum, recipe.RName, beer.BeerName, beer.Alc FROM recipe INNER JOIN beer ON beer.BNum = recipe.BNum"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()) {
	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $name, $bname, $alc)){
	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()) {
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n | " . $name . "\n</td>\n<td>\n | " . $bname . "\n</td>\n<td>\n | " . $alc . "\n</td>\n</tr>";
}
$state->close();
?>
</table>
	<div>
		<!-- Form for adding a recipe, sends objects to addrecipe.php file -->
		<form method="post" action="addrecipe.php">
			<fieldset>
				<legend>Add Recipe</legend>
				<!-- Add name of recipe -->
				<p>Recipe Name: <input type="text" name="RecipeName" /></p>
				<!-- Drop down menu which dynamically lists the Beers from Beer table -->
				<select name="BeerID">
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT BNum, BeerName FROM beer"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()){
	echo "Execute failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $bname)){
	echo "Bind failed: "  . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()){
	echo '<option value=" '. $id . ' "> ' . $bname . '</option>\n';
}
// Close the state
$state->close();
?>				
				</select>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>
  </body>
</html>