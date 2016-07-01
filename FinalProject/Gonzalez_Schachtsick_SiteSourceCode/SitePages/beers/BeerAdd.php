<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Include connections
include('../connection-mysql.php');

?>
<!-- Authors: Saul Gonzalez and Jeffrey Schachtsick
	 Class: CS340: Databases
	 Assignment: Database Project
	 Description: Display data for beer and add/update entries for beer table.
	 Date Updated: May 20, 2016-->

<!DOCTYPE html>
<html lang="en">
	<!-- Title of Beer Table -->
  <head>
    <meta charset="utf-8">
    <title>Beer Table</title>
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
	<p>Beers</p>
	<!-- List each beer from the database with Beer ID, Beer Name, and Beer's ABV -->
	<table>
		<tr>
			<td>ID</td>
			<td>| Name</td>
			<td>| Alcohol By Volume (ABV%)</td>
		</tr>
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT beer.BNum, beer.BeerName, beer.Alc FROM beer"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()) {
	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $name, $alc)){
	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()) {
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n | " . $name . "\n</td>\n<td>\n | " . $alc . "\n</td>\n</tr>";
}
// Close the state
$state->close();
?>
	</table>
	<div>
		<!-- Form for adding a beer, sends to addbeer.php file -->
		<form method="post" action="addbeer.php">
			<fieldset>
				<legend>Add Beer</legend>
				<!-- Add name of beer -->
				<p>Beer Name: <input type="text" name="BeerName" /></p>
				<!-- Add ABV as sting.  Will convert to integer in addbeer.php -->
				<p>Alcohol By Volume(ABV%): <input type="text" name="BeerPerc" /></p>
				<p><input type="submit" /></p>
			</fieldset>
		</form>
	</div>
  </body>
</html>