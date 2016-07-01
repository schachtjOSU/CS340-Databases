<?php
// Turn on the error reporting
ini_set('display_errors', 'On');
// Get the location of database and all the password stuff from a different file.
include('../connection-mysql.php');
//if(!$dbcon || $dbcon->connect_errno){
//	echo "Connection error " . $mysqldb->connect_errno . " " . $mysqldb->connect_error;
//	}
// Insert recipe values (name, beer number) from RecipeAdd.php's form	
if(!($state = $dbcon->prepare("INSERT INTO recipe(RName, BNum) VALUES (?,?)"))){
	echo "Prepare failed: "  . $state->errno . " " . $state->error;
}
// Bind the result, send an error if the bind failed
if(!($state->bind_param("si",$_POST['RecipeName'],$_POST['BeerID']))){
	echo "Bind failed: "  . $state->errno . " " . $state->error;
}
// Execute the statement, send an error if it failed or state a row was added
if(!$state->execute()){
	echo "Execute failed: "  . $state->errno . " " . $state->error;
} else {
	echo "Added " . $state->affected_rows . " rows to recipe table.";
}
?>
<!-- Ways to navigate back to the page to add another recipe or back to the Home page -->
<p><a href="../recipes/RecipeAdd.php">Add another recipe?</a></p>
<p><a href="../main.html">Home Page</a></p>