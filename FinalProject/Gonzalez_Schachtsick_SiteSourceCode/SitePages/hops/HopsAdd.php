<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Include connections
include('../connection-mysql.php');

?>
<!-- Authors: Saul Gonzalez and Jeffrey Schachtsick
	 Class: CS340: Databases
	 Assignment: Database Project
	 Description: Display data for hops and add entries for hops table.
	 Date Updated: May 20, 2016-->
<!DOCTYPE html>
<html lang="en">
	<!-- Title of Hops Table -->
  <head>
    <meta charset="utf-8">
    <title>Hops Table</title>
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
	<p>Hops</p>
	<!-- List each hop from the database with Hop ID, name, date picked, expires, weight, nation grown, and from Beer's table the beer ID and name -->
	<table>
		<tr>
			<td>ID</td>
			<td>| Name</td>
			<td>| Date Picked</td>
			<td>| Expires</td>
			<td>| Weight(oz.)</td>
			<td>| Nation Grown</td>
			<td>| Form</td>
			<td>| Beer ID</td>
			<td>| Beer's Name</td>
		</tr>
<?php
// Make select statement
if(!($state = $dbcon->prepare("SELECT hop.HNum, hop.HopName, hop.DatePick, hop.DateExpired, hop.WeightOz, hop.NationGrown, hop.Form, hop.BNum, beer.BeerName FROM hop INNER JOIN beer ON beer.BNum = hop.BNum"))) { echo "Prepare failed: " . $state->errno . " " . $state->error;
}
// execute the statement, error if incorrect
if(!$state->execute()) {
	echo "Execute failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Bind the result
if(!$state->bind_result($id, $name, $pick, $expire, $weight, $nation, $form, $bid, $bname)){
	echo "Bind failed: " . $dbcon->connect_errno . " " . $dbcon->connect_error;
}
// Display items from select to table
while($state->fetch()) {
	echo "<tr>\n<td>\n" . $id . "\n</td>\n<td>\n | " . $name . "\n</td>\n<td>\n | " . $pick . "\n</td>\n<td>\n | " . $expire . "\n</td>\n<td>\n | " . $weight . "\n</td>\n<td>\n | " . $nation . "\n</td>\n<td>\n | " . $form . "\n</td>\n<td>\n | " . $bid . "\n</td>\n<td>\n | " . $bname . "\n</td>\n</tr>";
}
// Close the statement
$state->close();
?>
	</table>
	<div>
		<!-- Form for adding a hop, sends to addhop.php file -->
		<form method="post" action="addhop.php">
			<fieldset>
				<legend>Add Hop</legend>
				<!-- Add Hop Name with text -->
				<p>Hop Name: <input type="text" name="HopName" /></p>
				<!-- Add Hop date picked with text and transferred as a date -->
				<p>Date Picked (yyyy-mm-dd): <input type="text" name="HopPick" /></p>
				<!-- Add Hop expiration with text and transferred to date -->
				<p>Date Expires (yyyy-mm-dd): <input type="text" name="HopExpire" /></p>
				<!-- Add Hop weight with text and transferred to integer -->
				<p>Weight in oz.: <input type="text" name="HopOz" /></p>
				<!-- Add Hop nation grown with text -->
				<p>Nation grown: <input type="text" name="HopNation" /></p>
				<!-- Add Hop form with text -->
				<p>Hop Form: <input type="text" name="HopForm" /></p>
				<!-- Add hop in relation to beer from the beer table. Dynamically places beers from beer table into drop down menu -->
				<select name="BeerID">
<?php
// Make a select statement of the beer table
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
// Display beer items into drop down menu
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