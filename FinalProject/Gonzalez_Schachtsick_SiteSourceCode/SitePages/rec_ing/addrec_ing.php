<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Get the location of database and all the password stuff from a different file
include('../connection-mysql.php');
//if(!$dbcon || $dbcon->connect_errno){
//	echo "Connection error " . $mysqldb->connect_errno . " " . $mysqldb->connect_error;
//	}	
// Insert Recipe_Ingredient values(name and numbers of recipes as well as name and numbers of ingredinets.  Also, quantity) from RecipeIngredientsAdd.php's form
if(!($state = $dbcon->prepare("INSERT INTO recipe_ingredient(RNum, InNum, Quantity) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// Bind the result, send an error if the bind failed.
if(!($state->bind_param("iis",$_POST['QuantRecipe'],$_POST['QuantIngred'],$_POST['Quantity']))){
	echo "Bind failed: "  . $state->errno . " " . $state->error;
}
// Execute the statement, send an error if it failed or state a row was added.
if(!$state->execute()){
	echo "Execute failed: "  . $state->errno . " " . $state->error;
} else {
	echo "Added " . $state->affected_rows . " rows to recipe table.";
}
?>
<!-- Ways to navigate back to the page to add another beer or back to the Home page -->
<p><a href="../rec_ing/RecipeIngredientsAdd.php">Add another quantity?</a></p>
<p><a href="../main.html">Home Page</a></p>